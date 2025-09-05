<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SiemSampleDataSeeder extends Seeder
{
    public function run()
    {
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
        
        // Seed Relationships
        $this->seedRelationships();
    }

    private function seedAssets()
    {
        $assets = [
            [
                'asset_name' => 'DC-01 Domain Controller',
                'asset_type' => 'Server',
                'ip_address' => '192.168.1.10',
                'mac_address' => '00:50:56:C0:00:01',
                'operating_system' => 'Windows Server 2019',
                'status' => 'Online',
                'criticality' => 'Critical',
                'location' => 'Data Center Rack A1',
                'owner' => 'IT Infrastructure Team',
                'vulnerability_status' => 'Secure',
                'last_scan' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'asset_name' => 'WEB-01 Application Server',
                'asset_type' => 'Server',
                'ip_address' => '192.168.1.20',
                'mac_address' => '00:50:56:C0:00:02',
                'operating_system' => 'Ubuntu 20.04 LTS',
                'status' => 'Online',
                'criticality' => 'High',
                'location' => 'Data Center Rack B1',
                'owner' => 'Web Development Team',
                'vulnerability_status' => 'Patching Required',
                'last_scan' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'asset_name' => 'DB-01 Database Server',
                'asset_type' => 'Database',
                'ip_address' => '192.168.1.30',
                'mac_address' => '00:50:56:C0:00:03',
                'operating_system' => 'CentOS 8',
                'status' => 'Online',
                'criticality' => 'Critical',
                'location' => 'Data Center Rack C1',
                'owner' => 'Database Administration Team',
                'vulnerability_status' => 'Secure',
                'last_scan' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'asset_name' => 'SW-01 Core Switch',
                'asset_type' => 'Network Device',
                'ip_address' => '192.168.1.1',
                'mac_address' => '00:23:04:EE:BE:01',
                'operating_system' => 'Cisco IOS 15.2',
                'status' => 'Online',
                'criticality' => 'High',
                'location' => 'Network Closet A',
                'owner' => 'Network Operations Team',
                'vulnerability_status' => 'Vulnerable',
                'last_scan' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'asset_name' => 'LAPTOP-USER001',
                'asset_type' => 'Endpoint',
                'ip_address' => '192.168.1.100',
                'mac_address' => 'AC:BC:32:D4:6F:2E',
                'operating_system' => 'Windows 11 Pro',
                'status' => 'Online',
                'criticality' => 'Medium',
                'location' => 'Office Floor 2',
                'owner' => 'John Smith - Finance',
                'vulnerability_status' => 'Secure',
                'last_scan' => date('Y-m-d H:i:s', strtotime('-12 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('assets')->insertBatch($assets);
    }

    private function seedThreats()
    {
        $threats = [
            [
                'ioc_type' => 'IP',
                'ioc_value' => '192.168.100.50',
                'threat_type' => 'Malware C&C Server',
                'severity' => 'Critical',
                'confidence' => 'High',
                'source' => 'Threat Intelligence Feed',
                'description' => 'Known command and control server for banking trojan campaigns',
                'status' => 'Active',
                'first_seen' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'last_seen' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'tags' => 'banking,trojan,c2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'ioc_type' => 'Domain',
                'ioc_value' => 'malicious-update.com',
                'threat_type' => 'Phishing Domain',
                'severity' => 'High',
                'confidence' => 'Medium',
                'source' => 'Security Researcher',
                'description' => 'Domain hosting fake software updates with embedded malware',
                'status' => 'Active',
                'first_seen' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'last_seen' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'tags' => 'phishing,fake-update,malware',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'ioc_type' => 'Hash',
                'ioc_value' => 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',
                'threat_type' => 'Ransomware Sample',
                'severity' => 'Critical',
                'confidence' => 'High',
                'source' => 'Internal Analysis',
                'description' => 'SHA256 hash of confirmed ransomware sample affecting multiple organizations',
                'status' => 'Active',
                'first_seen' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'last_seen' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'tags' => 'ransomware,malware,encryption',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('threats')->insertBatch($threats);
    }

    private function seedAlerts()
    {
        $alerts = [
            [
                'alert_name' => 'Multiple Failed Login Attempts',
                'alert_type' => 'Authentication',
                'priority' => 'High',
                'status' => 'Active',
                'source_ip' => '203.0.113.15',
                'destination_ip' => '192.168.1.10',
                'description' => 'Detected 15 failed login attempts within 5 minutes from external IP address',
                'rule_name' => 'AUTH_BRUTE_FORCE_DETECTION',
                'detection_time' => date('Y-m-d H:i:s', strtotime('-30 minutes')),
                'acknowledged' => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'alert_name' => 'Suspicious Network Traffic',
                'alert_type' => 'Network',
                'priority' => 'Medium',
                'status' => 'Investigating',
                'source_ip' => '192.168.1.100',
                'destination_ip' => '192.168.100.50',
                'description' => 'Unusual outbound traffic pattern detected to known malicious IP',
                'rule_name' => 'NET_MALICIOUS_IP_COMMUNICATION',
                'detection_time' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'acknowledged' => true,
                'acknowledged_by' => 'Security Analyst',
                'acknowledged_at' => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'alert_name' => 'Malware Detection',
                'alert_type' => 'Malware',
                'priority' => 'Critical',
                'status' => 'Closed',
                'source_ip' => '192.168.1.100',
                'description' => 'Endpoint protection detected and quarantined malicious file',
                'rule_name' => 'MALWARE_FILE_DETECTION',
                'detection_time' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'acknowledged' => true,
                'acknowledged_by' => 'SOC Analyst Level 2',
                'acknowledged_at' => date('Y-m-d H:i:s', strtotime('-23 hours')),
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-20 hours')),
                'resolution_notes' => 'Malware successfully quarantined. System scanned and cleaned.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('alerts')->insertBatch($alerts);
    }

    private function seedForensicsCases()
    {
        $cases = [
            [
                'case_number' => 'FOR-2024-001',
                'case_name' => 'Suspected Data Exfiltration Investigation',
                'case_type' => 'Network Forensics',
                'priority' => 'Critical',
                'status' => 'In Progress',
                'assigned_investigator' => 'Sarah Johnson - Senior Forensics Analyst',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'description' => 'Investigation into suspected unauthorized data access and potential exfiltration from database server DB-01. Initial indicators suggest potential insider threat or compromised credentials.',
                'evidence_count' => 3,
                'findings' => 'Network traffic analysis reveals large data transfers during off-hours. Database access logs show queries against sensitive customer data tables.',
                'recommendations' => 'Implement additional access controls, enable detailed database auditing, conduct user access review.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'case_number' => 'FOR-2024-002',
                'case_name' => 'Malware Analysis - Banking Trojan',
                'case_type' => 'Malware Analysis',
                'priority' => 'High',
                'status' => 'Active',
                'assigned_investigator' => 'Michael Chen - Malware Analyst',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'description' => 'Analysis of banking trojan sample detected on endpoint LAPTOP-USER001. Sample appears to be variant of known banking malware family.',
                'evidence_count' => 2,
                'findings' => 'Static analysis reveals code injection capabilities and keylogging functionality. Dynamic analysis shows communication with C&C server.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'case_number' => 'FOR-2024-003',
                'case_name' => 'Email Phishing Campaign Investigation',
                'case_type' => 'Email Forensics',
                'priority' => 'Medium',
                'status' => 'Completed',
                'assigned_investigator' => 'Lisa Rodriguez - Email Security Specialist',
                'incident_date' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'description' => 'Investigation of targeted phishing campaign against finance department personnel.',
                'evidence_count' => 5,
                'findings' => 'Campaign originated from compromised legitimate domain. 12 employees received phishing emails, 2 clicked malicious links.',
                'recommendations' => 'Enhanced email security training, implement additional email filtering rules, block identified IOCs.',
                'closed_date' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('forensics_cases')->insertBatch($cases);
    }

    private function seedEvidence()
    {
        $evidence = [
            [
                'forensics_case_id' => 1,
                'evidence_name' => 'Network Traffic Capture - DB Server',
                'evidence_type' => 'Network Capture',
                'file_path' => '/evidence/for-2024-001/network_capture_db01.pcap',
                'file_size' => 2547483648, // ~2.5GB
                'hash_md5' => 'a1b2c3d4e5f67890abcdef1234567890',
                'hash_sha1' => 'a1b2c3d4e5f67890abcdef1234567890abcdef12',
                'hash_sha256' => 'a1b2c3d4e5f67890abcdef1234567890abcdef1234567890abcdef1234567890',
                'collected_by' => 'Network Security Team',
                'collected_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'chain_of_custody' => 'Collected by John Doe, transferred to forensics team at 14:30',
                'verified' => true,
                'verified_by' => 'Sarah Johnson',
                'verified_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'description' => 'Complete network traffic capture from DB-01 during incident timeframe',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'forensics_case_id' => 1,
                'evidence_name' => 'Database Access Logs',
                'evidence_type' => 'Log Files',
                'file_path' => '/evidence/for-2024-001/db_access_logs.zip',
                'file_size' => 45678912, // ~45MB
                'hash_md5' => 'b2c3d4e5f67890abcdef1234567890a1',
                'hash_sha1' => 'b2c3d4e5f67890abcdef1234567890a1bcdef123',
                'hash_sha256' => 'b2c3d4e5f67890abcdef1234567890a1bcdef1234567890abcdef1234567890a',
                'collected_by' => 'Database Administrator',
                'collected_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'verified' => true,
                'verified_by' => 'Sarah Johnson',
                'verified_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'description' => 'Database query logs for 48-hour period covering incident window',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'forensics_case_id' => 2,
                'evidence_name' => 'Malware Sample - Banking Trojan',
                'evidence_type' => 'Digital Image',
                'file_path' => '/evidence/for-2024-002/malware_sample.exe',
                'file_size' => 2048576, // ~2MB
                'hash_md5' => 'c3d4e5f67890abcdef1234567890a1b2',
                'hash_sha1' => 'c3d4e5f67890abcdef1234567890a1b2cdef1234',
                'hash_sha256' => 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',
                'collected_by' => 'Endpoint Security System',
                'collected_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'verified' => true,
                'verified_by' => 'Michael Chen',
                'verified_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'description' => 'Quarantined malware sample from infected endpoint',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('evidence')->insertBatch($evidence);
    }

    private function seedRelationships()
    {
        // Alert-Asset relationships
        $alertAssets = [
            ['alert_id' => 1, 'asset_id' => 1, 'relationship_type' => 'Target', 'created_at' => date('Y-m-d H:i:s')],
            ['alert_id' => 2, 'asset_id' => 5, 'relationship_type' => 'Source', 'created_at' => date('Y-m-d H:i:s')],
            ['alert_id' => 3, 'asset_id' => 5, 'relationship_type' => 'Affected', 'created_at' => date('Y-m-d H:i:s')]
        ];
        $this->db->table('alert_assets')->insertBatch($alertAssets);

        // Threat-Asset relationships  
        $threatAssets = [
            ['threat_id' => 1, 'asset_id' => 5, 'impact_level' => 'High', 'detected_at' => date('Y-m-d H:i:s', strtotime('-2 hours')), 'created_at' => date('Y-m-d H:i:s')],
            ['threat_id' => 2, 'asset_id' => 5, 'impact_level' => 'Medium', 'detected_at' => date('Y-m-d H:i:s', strtotime('-6 hours')), 'created_at' => date('Y-m-d H:i:s')]
        ];
        $this->db->table('threat_assets')->insertBatch($threatAssets);
    }
}