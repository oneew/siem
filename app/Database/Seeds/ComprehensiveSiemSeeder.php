<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ComprehensiveSiemSeeder extends Seeder
{
    public function run()
    {
        echo "Starting comprehensive SIEM data seeding...\n";
        
        // Seed Users first (if not already present)
        $this->seedUsers();
        
        // Seed Incidents
        $this->seedIncidents();
        
        // Seed Assets
        $this->seedAssets();
        
        // Seed Threats
        $this->seedThreats();
        
        // Seed Alerts
        $this->seedAlerts();
        
        // Seed Forensics Cases
        $this->seedForensicsCases();
        
        // Seed Evidence
        $this->seedEvidence();
        
        // Seed Playbooks
        $this->seedPlaybooks();
        
        // Seed Relationships
        $this->seedRelationships();
        
        echo "SIEM data seeding completed successfully!\n";
    }

    private function seedUsers()
    {
        // Check if users already exist
        $existingUsers = $this->db->table('users')->countAllResults();
        if ($existingUsers > 0) {
            echo "Users already exist, skipping user seeding...\n";
            return;
        }

        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@siem.local',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'analyst1',
                'email' => 'analyst1@siem.local',
                'password' => password_hash('analyst123', PASSWORD_DEFAULT),
                'role' => 'Analyst',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'soc_operator',
                'email' => 'soc@siem.local',
                'password' => password_hash('soc123', PASSWORD_DEFAULT),
                'role' => 'SOC Operator',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('users')->insertBatch($users);
        echo "Users seeded successfully.\n";
    }

    private function seedIncidents()
    {
        $incidents = [
            [
                'title' => 'Suspected Data Breach - Customer Database',
                'description' => 'Unauthorized access detected to customer database. Multiple suspicious queries executed during off-hours.',
                'severity' => 'Critical',
                'status' => 'Open',
                'assigned_to' => 'SOC Team Alpha',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Ransomware Attack - Production Servers',
                'description' => 'Multiple production servers showing signs of ransomware infection. Files encrypted and ransom note detected.',
                'severity' => 'Critical',
                'status' => 'In Progress',
                'assigned_to' => 'Incident Response Team',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Phishing Campaign Targeting Finance Department',
                'description' => 'Coordinated phishing attack targeting finance department employees. Multiple malicious emails detected.',
                'severity' => 'High',
                'status' => 'Investigating',
                'assigned_to' => 'Email Security Team',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Insider Threat - Unauthorized File Access',
                'description' => 'Employee accessing files outside their authorized scope. Unusual after-hours activity detected.',
                'severity' => 'High',
                'status' => 'Under Review',
                'assigned_to' => 'HR Security Team',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'DDoS Attack - Web Services',
                'description' => 'Large-scale distributed denial of service attack targeting public web services.',
                'severity' => 'Medium',
                'status' => 'Resolved',
                'assigned_to' => 'Network Operations Center',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'resolution_notes' => 'DDoS mitigation activated successfully. Traffic filtered and normal operations restored.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Malware Detection - Endpoint Compromise',
                'description' => 'Banking trojan detected on executive workstation. Potential credential theft identified.',
                'severity' => 'High',
                'status' => 'Closed',
                'assigned_to' => 'Endpoint Security Team',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'resolution_notes' => 'Endpoint isolated and cleaned. Credentials reset. User re-trained on security awareness.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('incidents')->insertBatch($incidents);
        echo "Incidents seeded successfully.\n";
    }

    // Additional methods will be added in separate calls due to size constraints
    private function seedAssets() { /* Will implement in next part */ }
    private function seedThreats() { /* Will implement in next part */ }
    private function seedAlerts() { /* Will implement in next part */ }
    private function seedForensicsCases() { /* Will implement in next part */ }
    private function seedEvidence() { /* Will implement in next part */ }
    private function seedPlaybooks() { /* Will implement in next part */ }
    private function seedRelationships() { /* Will implement in next part */ }
}