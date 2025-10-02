<?php

namespace App\Controllers;

use App\Models\AssetModel;
use App\Models\AlertModel;

class Monitoring extends BaseController
{
    public function index()
    {
        $assetModel = new AssetModel();
        $alertModel = new AlertModel();

        // Get all assets with their monitoring data
        $assets = $assetModel->orderBy('created_at', 'DESC')->findAll();

        // Get recent alerts for assets
        $recentAlerts = $alertModel->orderBy('created_at', 'DESC')->limit(10)->findAll();

        // Calculate monitoring statistics
        $stats = [
            'total_assets' => $assetModel->countAll(),
            'online_assets' => $assetModel->where('status', 'Online')->countAllResults(),
            'vulnerable_assets' => $assetModel->where('vulnerability_status', 'Vulnerable')->countAllResults(),
            'recent_alerts' => $alertModel->countAll(),
            'critical_assets' => $assetModel->where('criticality', 'Critical')->countAllResults()
        ];

        $data = [
            'title' => 'Monitoring Aset',
            'assets' => $assets,
            'recent_alerts' => $recentAlerts,
            'stats' => $stats
        ];

        return view('monitoring/index', $data);
    }

    public function asset($id)
    {
        $assetModel = new AssetModel();
        $alertModel = new AlertModel();

        $asset = $assetModel->find($id);

        if (!$asset) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Asset not found');
        }

        // Get alerts related to this asset
        $assetAlerts = $alertModel->where('asset_id', $id)->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Monitoring Detail: ' . $asset['asset_name'],
            'asset' => $asset,
            'alerts' => $assetAlerts
        ];

        return view('monitoring/asset_detail', $data);
    }

    // Simulate a security check for an asset
    public function checkSecurity($id)
    {
        $assetModel = new AssetModel();
        $asset = $assetModel->find($id);

        if (!$asset) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Asset not found']);
        }

        // In a real implementation, this would connect to security tools
        // For now, we'll simulate a security check

        // Randomly determine if vulnerabilities are found (30% chance)
        $isVulnerable = (rand(1, 100) <= 30);

        // Update asset vulnerability status
        $vulnerabilityStatus = $isVulnerable ? 'Vulnerable' : 'Secure';
        $assetModel->update($id, [
            'vulnerability_status' => $vulnerabilityStatus,
            'last_scan' => date('Y-m-d H:i:s')
        ]);

        // If vulnerabilities found, create an alert
        if ($isVulnerable) {
            $alertModel = new \App\Models\AlertModel();
            $alertModel->insert([
                'alert_name' => 'Vulnerability Detected on ' . $asset['asset_name'],
                'description' => 'Security scan detected vulnerabilities on asset ' . $asset['asset_name'] . ' (' . $asset['ip_address'] . ')',
                'priority' => ($asset['criticality'] == 'Critical') ? 'High' : 'Medium',
                'status' => 'Active',
                'asset_id' => $id,
                'assigned_to' => null,
                'alert_type' => 'Vulnerability',
                'source_ip' => $asset['ip_address']
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $isVulnerable ? 'Vulnerabilities detected!' : 'No vulnerabilities found',
            'vulnerable' => $isVulnerable,
            'asset_id' => $id
        ]);
    }
}
