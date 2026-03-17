<?php

namespace App\Controllers;

class AssetController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Manajemen Aset (Asset Discovery)';
        return view('assets/index', $data);
    }

    public function scan()
    {
        if ($this->request->isAJAX()) {
            $subnet = $this->request->getPost('subnet');
            
            // Simulation of a heavy Nmap / Ping Sweep task
            sleep(3);

            // Mock discovered assets
            $assets = [
                ['ip' => '192.168.1.1', 'mac' => '00:1A:2B:3C:4D:5E', 'hostname' => 'gateway-router', 'os' => 'Cisco IOS', 'status' => 'Online', 'ports' => '80, 443, 22'],
                ['ip' => '192.168.1.10', 'mac' => '1A:2B:3C:4D:5E:6F', 'hostname' => 'web-server-01', 'os' => 'Ubuntu Linux 22.04', 'status' => 'Online', 'ports' => '80, 443, 22, 3306'],
                ['ip' => '192.168.1.15', 'mac' => '2B:3C:4D:5E:6F:7A', 'hostname' => 'db-server-main', 'os' => 'Windows Server 2019', 'status' => 'Online', 'ports' => '1433, 3389'],
                ['ip' => '192.168.1.45', 'mac' => '3C:4D:5E:6F:7A:8B', 'hostname' => 'hr-workstation-2', 'os' => 'Windows 11', 'status' => 'Online', 'ports' => '135, 139, 445'],
                ['ip' => '192.168.1.100', 'mac' => '4D:5E:6F:7A:8B:9C', 'hostname' => 'unknown-device', 'os' => 'Unknown', 'status' => 'Offline', 'ports' => 'None'],
            ];

            return $this->response->setJSON([
                'status' => 'success',
                'message' => count($assets) . ' perangkat ditemukan pada subnet ' . htmlspecialchars($subnet),
                'data' => $assets
            ]);
        }
    }
}
