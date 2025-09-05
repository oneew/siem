<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IncidentsSeeder extends Seeder
{
    public function run()
    {
        $incidents = [
            [
                'title' => 'Suspected Data Breach - Customer Database',
                'description' => 'Unauthorized access detected to customer database. Multiple suspicious queries executed during off-hours targeting sensitive customer information.',
                'severity' => 'Critical',
                'status' => 'Open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Ransomware Attack - Production Servers',
                'description' => 'Multiple production servers showing signs of ransomware infection. Files encrypted and ransom note detected.',
                'severity' => 'Critical',
                'status' => 'In Progress',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Phishing Campaign Targeting Finance Department',
                'description' => 'Coordinated phishing attack targeting finance department employees. Multiple malicious emails detected with fake invoice attachments.',
                'severity' => 'High',
                'status' => 'Open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Insider Threat - Unauthorized File Access',
                'description' => 'Employee accessing files outside authorized scope. Unusual after-hours activity and access to sensitive documents detected.',
                'severity' => 'High',
                'status' => 'Open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'DDoS Attack - Web Services',
                'description' => 'Large-scale distributed denial of service attack targeting public web services. Traffic volume exceeding normal capacity.',
                'severity' => 'Medium',
                'status' => 'Closed',
                'resolution_notes' => 'DDoS mitigation activated successfully. Traffic filtered and normal operations restored.',
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Malware Detection - Banking Trojan',
                'description' => 'Banking trojan detected on executive workstation. Potential credential theft and keylogging activity identified.',
                'severity' => 'High',
                'status' => 'Closed',
                'resolution_notes' => 'Endpoint isolated and cleaned. Credentials reset. User security training completed.',
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Unauthorized VPN Access Attempt',
                'description' => 'Multiple failed VPN login attempts from foreign IP addresses. Potential brute force attack against VPN infrastructure.',
                'severity' => 'Medium',
                'status' => 'In Progress',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'SQL Injection Attempt',
                'description' => 'Web application firewall detected multiple SQL injection attempts against customer portal. Various attack vectors identified.',
                'severity' => 'Medium',
                'status' => 'Closed',
                'resolution_notes' => 'WAF rules updated. Application security review completed. No data compromise detected.',
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('incidents')->insertBatch($incidents);
        echo "Incidents seeded successfully!\n";
    }
}