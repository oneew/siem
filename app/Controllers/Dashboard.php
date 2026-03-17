<?php

namespace App\Controllers;

use App\Models\IncidentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $incidentModel = new \App\Models\IncidentModel();
        $alertModel    = new \App\Models\AlertModel();

        // Determine user role from session (default to 'admin' if not set for demo)
        $role = session()->get('role') ?? 'admin';

        // ── Shared Data (used by all roles) ──
        $criticalAlerts = $alertModel->whereIn('status', ['Active', 'Investigating'])
                                     ->where('priority', 'Critical')
                                     ->countAllResults();
        $baseScore = 95 - ($criticalAlerts * 5);
        $securityScore = max(0, min(100, $baseScore));

        $sharedData = [
            'criticalAlerts'  => $criticalAlerts,
            'securityScore'   => $securityScore,
            'activeIncidents' => $incidentModel->where('status', 'Open')->orderBy('created_at', 'DESC')->limit(5)->findAll(),
            'totalIncidents'  => $incidentModel->countAll(),
            'openIncidents'   => $incidentModel->where('status', 'Open')->countAllResults(),
            'role'            => $role,
        ];

        // ── Route to role-specific view ──
        if (in_array($role, ['c_level', 'executive'])) {
            $sharedData['title']         = 'Executive Security Overview';
            $sharedData['riskLevel']     = $securityScore >= 80 ? 'Low' : ($securityScore >= 50 ? 'Medium' : 'High');
            $sharedData['complianceScore'] = 87; // Mock
            $sharedData['mttr']            = '4.2 hrs'; // Mean Time to Respond mock
            $sharedData['openPentests']    = 3;
            $sharedData['maliciousFiles']  = 14;
            return view('dashboard/role_clevel', $sharedData);

        } elseif (in_array($role, ['red_team', 'pentester'])) {
            $sharedData['title']       = 'Red Team Command Center';
            $sharedData['openPentests'] = 3;
            $sharedData['recentVulnerabilities'] = [
                ['id' => 'VUL-2026-001', 'target' => 'Web Portal Utama',   'type' => 'SQL Injection',        'severity' => 'Critical', 'date' => date('Y-m-d', strtotime('-1 days'))],
                ['id' => 'VUL-2026-002', 'target' => 'API Gateway',         'type' => 'Broken Authentication', 'severity' => 'High',     'date' => date('Y-m-d', strtotime('-2 days'))],
                ['id' => 'VUL-2026-003', 'target' => 'Internal Server',     'type' => 'Outdated Software',     'severity' => 'Medium',   'date' => date('Y-m-d', strtotime('-3 days'))],
            ];
            return view('dashboard/role_redteam', $sharedData);

        } else {
            // admin / blue_team / default SOC view
            $sharedData['title']           = 'SOC Dashboard — Cyber Security Command Center';
            $sharedData['openPentests']    = 3;
            $sharedData['maliciousFiles']  = 14;
            $sharedData['recentVulnerabilities'] = [
                ['id' => 'VUL-2026-001', 'target' => 'Web Portal Utama',   'type' => 'SQL Injection',        'severity' => 'Critical', 'date' => date('Y-m-d', strtotime('-1 days'))],
                ['id' => 'VUL-2026-002', 'target' => 'API Gateway',         'type' => 'Broken Authentication', 'severity' => 'High',     'date' => date('Y-m-d', strtotime('-2 days'))],
                ['id' => 'VUL-2026-003', 'target' => 'Internal Server',     'type' => 'Outdated Software',     'severity' => 'Medium',   'date' => date('Y-m-d', strtotime('-3 days'))],
            ];
            $sharedData['aiThreatSummary'] = "SIEM Bot mendeteksi **3 anomali** signifikan hari ini:\n"
                . "- Serangan *Brute-Force* SSH dari IP `192.168.1.45` pada server utama.\n"
                . "- Ditemukan sampel file *Ransomware* di direktori `/var/www/uploads/` via DFIR Analyzer.\n"
                . "- *Ping Sweep* terdeteksi di subnet 10.0.0.0/24.\n"
                . "\n**Rekomendasi**: Segera blokir IP sumber dan isolasi server web untuk forensik lebih lanjut.";
            return view('dashboard/dashboard', $sharedData);
        }
    }


    /**
     * Demo role switcher — for testing RBAC views without a full auth system.
     * Cycles through: admin → c_level → red_team → admin
     */
    public function switchRole()
    {
        $current = session()->get('role') ?? 'admin';
        $roles   = ['admin', 'c_level', 'red_team'];
        $idx     = array_search($current, $roles);
        $next    = $roles[($idx + 1) % count($roles)];
        session()->set('role', $next);
        return redirect()->to('/dashboard')->with('success', 'Mode berganti ke: ' . strtoupper($next));
    }

    public function stream()
    {
        // Set headers for Server-Sent Events
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');

        // Note: For a true realtime app, this would tie into a queue or pub/sub.
        // As a prototype, we will simulate periodic attack events.

        $events = [
            ['type' => 'attack', 'source' => 'China', 'lat' => 35.8617, 'lon' => 104.1954, 'protocol' => 'SSH', 'severity' => 'High'],
            ['type' => 'attack', 'source' => 'Russia', 'lat' => 61.5240, 'lon' => 105.3188, 'protocol' => 'HTTP', 'severity' => 'Critical'],
            ['type' => 'attack', 'source' => 'USA', 'lat' => 37.0902, 'lon' => -95.7129, 'protocol' => 'MySQL', 'severity' => 'Medium'],
            ['type' => 'attack', 'source' => 'Brazil', 'lat' => -14.2350, 'lon' => -51.9253, 'protocol' => 'FTP', 'severity' => 'Low'],
            ['type' => 'attack', 'source' => 'India', 'lat' => 20.5937, 'lon' => 78.9629, 'protocol' => 'SMB', 'severity' => 'High']
        ];

        // Randomly pick an event to simulate real-time attacks map
        $randomEvent = $events[array_rand($events)];
        $randomEvent['timestamp'] = date('Y-m-d H:i:s');

        // Simulate new active incident count fluctuation
        $incidentModel = new \App\Models\IncidentModel();
        $activeIncidents = $incidentModel->where('status', 'Open')->countAllResults();

        $payload = [
            'threat_map' => $randomEvent,
            'active_incidents_count' => $activeIncidents + rand(-1, 1), // slight fake fluctuation for visual effect
            'security_score' => rand(85, 96) // Fake fluctuation for demo
        ];

        echo "data: " . json_encode($payload) . "\n\n";
        ob_flush();
        flush();
        
        // Terminate so it doesn't hold the CodeIgniter process forever in this particular setup
        // The front-end EventSource will auto-reconnect typically every 3 seconds.
        exit();
    }
}
