<?php

namespace App\Controllers;

class OSINTController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Threat Intelligence (OSINT)';
        return view('osint/index', $data);
    }

    public function lookup()
    {
        if ($this->request->isAJAX()) {
            $target = $this->request->getPost('target');
            $type = $this->request->getPost('type'); // ip or domain
            
            // Simulation of lookup to external API like VirusTotal, AbuseIPDB, Shodan
            sleep(2); // Simulate network delay
            
            // Mock Data
            $isMalicious = rand(1, 10) > 7; // 30% chance of being malicious in the simulation
            
            $data = [
                'target' => $target,
                'type' => $type,
                'status' => 'success',
                'reputation' => $isMalicious ? 'Malicious' : 'Clean',
                'score' => $isMalicious ? rand(60, 100) : rand(0, 15),
                'reports' => $isMalicious ? rand(5, 45) : 0,
                'last_analysis' => date('Y-m-d H:i:s'),
                'provider' => 'SIEM Threat Intel Network (Mock)'
            ];
            
            if ($type === 'ip') {
                $data['geo'] = ['country' => 'Unknown', 'city' => 'Unknown'];
                if (!$isMalicious) $data['geo'] = ['country' => 'United States', 'city' => 'Ashburn'];
                else $data['geo'] = ['country' => 'Russia', 'city' => 'Moscow'];
            }

            return $this->response->setJSON($data);
        }
    }
}
