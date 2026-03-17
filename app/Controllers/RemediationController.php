<?php

namespace App\Controllers;

class RemediationController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Automated Mitigation & Remediation (AI)';
        
        // Mock data from an imaginary AI insight engine connecting vulnerabilities to patches
        $data['remediations'] = [
            [
                'id' => 'REM-001',
                'threat' => 'Log4Shell (CVE-2021-44228)',
                'asset' => 'Core Banking Backend',
                'urgency' => 'Critical',
                'ai_confidence' => '99%',
                'recommended_action' => 'Karantina node segera. Hapus layanan JNDILookup.class dari log4j-core.jar atau patch ke versi >= 2.15.0.',
                'auto_script' => 'apt-get update && apt-get install --only-upgrade log4j2',
                'status' => 'Pending Action'
            ],
            [
                'id' => 'REM-002',
                'threat' => 'Unauthenticated RCE',
                'asset' => 'VPN Gateway Edge',
                'urgency' => 'High',
                'ai_confidence' => '87%',
                'recommended_action' => 'Terapkan blok rule sementara di Firewall WAF untuk string payload tertentu. Persiapkan maintenance window untuk update firmware.',
                'auto_script' => 'iptables -A INPUT -p tcp --dport 443 -m string --string "bad_payload" --algo kmp -j DROP',
                'status' => 'Pending Action'
            ],
            [
                'id' => 'REM-003',
                'threat' => 'Weak SSH Configuration',
                'asset' => 'DB Server Staging',
                'urgency' => 'Low',
                'ai_confidence' => '95%',
                'recommended_action' => 'Nonaktifkan otentikasi berbasis password. Terapkan PubKeyAuthentication dan nonaktifkan PermitRootLogin.',
                'auto_script' => 'sed -i "s/PasswordAuthentication yes/PasswordAuthentication no/g" /etc/ssh/sshd_config',
                'status' => 'Applied'
            ]
        ];

        return view('ainexus/remediation/index', $data);
    }

    public function applyAction()
    {
        $id = $this->request->getPost('id');
        
        // Simulasi eksekusi aksi secara otomatis via Ansible/Bash
        sleep(2); // Mock process time

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Remediasi otomasi (Playbook) berhasil dieksekusi oleh AI ke target infrastruktur.',
            'id' => $id
        ]);
    }
}
