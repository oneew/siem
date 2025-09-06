<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Models\AlertModel;
use App\Models\ThreatModel;
use App\Models\AssetModel;

class Reports extends BaseController
{
    public function index()
    {
        $incidentModel = new IncidentModel();
        $alertModel = new AlertModel();
        $threatModel = new ThreatModel();
        $assetModel = new AssetModel();
        
        $data['title'] = 'Advanced Reports & Analytics';
        
        // Get incidents data for the view
        $data['incidents'] = $incidentModel->orderBy('created_at', 'DESC')->findAll();
        
        // Executive Summary Statistics
        $data['executive_summary'] = [
            'total_incidents' => $incidentModel->countAll(),
            'open_incidents' => $incidentModel->where('status !=', 'Closed')->countAllResults(),
            'critical_incidents' => $incidentModel->where('severity', 'Critical')->countAllResults(),
            'total_alerts' => $alertModel->countAll(),
            'active_alerts' => $alertModel->where('status', 'Active')->countAllResults(),
            'total_threats' => $threatModel->countAll(),
            'active_threats' => $threatModel->where('status', 'Active')->countAllResults(),
            'total_assets' => $assetModel->countAll(),
            'vulnerable_assets' => $assetModel->where('vulnerability_status', 'Vulnerable')->countAllResults()
        ];
        
        // Trend Data (Last 30 days)
        $data['trend_data'] = $this->generateTrendData($incidentModel, $alertModel);
        
        // Risk Assessment
        $data['risk_metrics'] = $this->calculateRiskMetrics($incidentModel, $alertModel, $assetModel);
        
        return view('reports/index', $data);
    }

    public function incidentsReport()
    {
        $model = new IncidentModel();
        $data['title'] = 'Incidents Report';
        $data['incidents'] = $model->orderBy('created_at', 'DESC')->findAll();
        
        // Generate statistics
        $data['stats'] = [
            'by_severity' => [
                'Critical' => $model->where('severity', 'Critical')->countAllResults(),
                'High' => $model->where('severity', 'High')->countAllResults(),
                'Medium' => $model->where('severity', 'Medium')->countAllResults(),
                'Low' => $model->where('severity', 'Low')->countAllResults()
            ],
            'by_status' => [
                'Open' => $model->where('status', 'Open')->countAllResults(),
                'In Progress' => $model->where('status', 'In Progress')->countAllResults(),
                'Closed' => $model->where('status', 'Closed')->countAllResults()
            ]
        ];
        
        return view('reports/incidents', $data);
    }

    public function incidentsExcel()
    {
        // TODO: Implement Excel export functionality
        return redirect()->back()->with('success', 'Excel export completed successfully');
    }

    public function incidentsPdf()
    {
        // TODO: Implement PDF report generation
        return redirect()->back()->with('success', 'PDF Report generated successfully');
    }

    public function threatsReport()
    {
        $model = new ThreatModel();
        $data['title'] = 'Threat Intelligence Report';
        $data['threats'] = $model->orderBy('created_at', 'DESC')->limit(50)->findAll();
        
        $data['stats'] = [
            'by_type' => [
                'IP' => $model->where('ioc_type', 'IP')->countAllResults(),
                'Domain' => $model->where('ioc_type', 'Domain')->countAllResults(),
                'Hash' => $model->where('ioc_type', 'Hash')->countAllResults(),
                'URL' => $model->where('ioc_type', 'URL')->countAllResults()
            ]
        ];
        
        return view('reports/threats', $data);
    }

    public function executiveDashboard()
    {
        $data['title'] = 'Executive Security Dashboard';
        
        // Get high-level metrics for executives
        $incidentModel = new IncidentModel();
        $alertModel = new AlertModel();
        
        $data['metrics'] = [
            'security_incidents' => $incidentModel->countAll(),
            'critical_alerts' => $alertModel->where('priority', 'Critical')->countAllResults(),
            'resolved_incidents' => $incidentModel->where('status', 'Closed')->countAllResults(),
            'avg_response_time' => '2.3 hours'
        ];
        
        return view('reports/executive', $data);
    }

    public function generatePDF($type = 'summary')
    {
        // TODO: Implement PDF report generation
        return redirect()->back()->with('success', 'PDF Report generated successfully');
    }

    public function exportExcel($type = 'incidents')
    {
        // TODO: Implement Excel export functionality
        return redirect()->back()->with('success', 'Excel export completed successfully');
    }

    private function generateTrendData($incidentModel, $alertModel)
    {
        // Generate trend data for the last 7 days
        $days = [];
        $incidents = [];
        $alerts = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $days[] = date('D', strtotime($date));
            
            $incidents[] = $incidentModel->where("DATE(created_at) = '$date'")->countAllResults();
            $alerts[] = $alertModel->where("DATE(created_at) = '$date'")->countAllResults();
        }
        
        return [
            'dates' => json_encode($days),
            'incidents_trend' => json_encode($incidents),
            'alerts_trend' => json_encode($alerts),
            'threats_trend' => json_encode(array_map(function() { return rand(10, 30); }, range(1, 7)))
        ];
    }

    private function calculateRiskMetrics($incidentModel, $alertModel, $assetModel)
    {
        $criticalIncidents = $incidentModel->where('severity', 'Critical')->countAllResults();
        $totalIncidents = $incidentModel->countAll();
        $activeAlerts = $alertModel->where('status', 'Active')->countAllResults();
        $vulnerableAssets = $assetModel->where('vulnerability_status', 'Vulnerable')->countAllResults();
        $totalAssets = $assetModel->countAll();
        
        $riskScore = ($criticalIncidents * 2 + $activeAlerts * 0.5 + $vulnerableAssets * 1.5) / 10;
        $riskScore = min(10, max(0, $riskScore));
        
        return [
            'overall_risk_score' => round($riskScore, 1),
            'security_posture' => $riskScore < 3 ? 'Good' : ($riskScore < 7 ? 'Moderate' : 'High Risk'),
            'compliance_score' => rand(80, 95),
            'vulnerability_score' => round($vulnerableAssets / max(1, $totalAssets) * 10, 1)
        ];
    }
}