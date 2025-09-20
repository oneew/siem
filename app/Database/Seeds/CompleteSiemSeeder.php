<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CompleteSiemSeeder extends Seeder
{
    public function run()
    {
        // Check if we want to clear existing data first
        $clearData = (bool) $this->cli->getOption('clear');
        
        if ($clearData) {
            $this->clearAllData();
        }
        
        // Seed Users first (for relationships)
        $this->seedUsers();
        
        // Seed Assets 
        $this->seedAssets();
        
        // Seed Threats
        $this->seedThreats();
        
        // Seed Alerts (only if not clearing)
        if (!$clearData) {
            $this->seedAlerts();
        }
        
        // Seed Incidents
        $this->seedIncidents();
        
        // Seed Forensics Cases
        $this->seedForensicsCases();
        
        // Seed Evidence
        $this->seedEvidence();
        
        // Seed Playbooks
        $this->seedPlaybooks();
        
        // Seed Relationships
        $this->seedRelationships();
    }

    private function clearAllData()
    {
        echo "Clearing all existing data...\n";
        
        // Clear tables in reverse order of dependencies
        $tables = [
            'comments',
            'incident_assets', 
            'incident_threats',
            'incident_evidence',
            'incident_playbooks',
            'evidence',
            'forensics_cases',
            'incident_responses',
            'incidents',
            'alert_assets',
            'threat_assets',
            'alerts',
            'threats',
            'assets',
            'playbook_steps',
            'playbooks',
            'users'
        ];
        
        foreach ($tables as $table) {
            $this->db->table($table)->truncate();
            echo "Cleared table: $table\n";
        }
        
        echo "All data cleared successfully.\n\n";
    }

    private function seedUsers()
    {
        // Check if users already exist
        $userCount = $this->db->table('users')->countAll();
        
        if ($userCount == 0) {
            $users = [
                [
                    'username' => 'admin',
                    'password' => password_hash('admin123', PASSWORD_DEFAULT),
                    'role' => 'Administrator',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'username' => 'analyst1',
                    'password' => password_hash('analyst123', PASSWORD_DEFAULT),
                    'role' => 'Security Analyst',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'username' => 'investigator1',
                    'password' => password_hash('invest123', PASSWORD_DEFAULT),
                    'role' => 'Forensics Investigator',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'username' => 'manager1',
                    'password' => password_hash('manager123', PASSWORD_DEFAULT),
                    'role' => 'Security Manager',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ];

            foreach ($users as $user) {
                $this->db->table('users')->insert($user);
            }
        }
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
            ],
            [
                'asset_name' => 'MOBILE-DEV001',
                'asset_type' => 'Mobile',
                'ip_address' => '192.168.1.150',
                'mac_address' => 'B4:52:7E:12:34:56',
                'operating_system' => 'Android 12',
                'status' => 'Online',
                'criticality' => 'Low',
                'location' => 'Mobile Device Pool',
                'owner' => 'Security Testing Team',
                'vulnerability_status' => 'Unknown',
                'last_scan' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($assets as $asset) {
            $this->db->table('assets')->insert($asset);
        }
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
            ],
            [
                'ioc_type' => 'URL',
                'ioc_value' => 'http://suspicious-site.net/login.php',
                'threat_type' => 'Credential Harvesting',
                'severity' => 'High',
                'confidence' => 'Medium',
                'source' => 'Web Filter',
                'description' => 'Fake login page designed to steal user credentials',
                'status' => 'Active',
                'first_seen' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'last_seen' => date('Y-m-d H:i:s', strtotime('-4 hours')),
                'tags' => 'phishing,credentials,fake-login',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'ioc_type' => 'Email',
                'ioc_value' => 'support@fake-bank.com',
                'threat_type' => 'Email Spoofing',
                'severity' => 'Medium',
                'confidence' => 'High',
                'source' => 'Email Security Gateway',
                'description' => 'Spoofed email address used in banking phishing campaigns',
                'status' => 'Investigating',
                'first_seen' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'last_seen' => date('Y-m-d H:i:s', strtotime('-8 hours')),
                'tags' => 'email,spoofing,banking',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($threats as $threat) {
            $this->db->table('threats')->insert($threat);
        }
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
                'acknowledged' => 0,
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
                'acknowledged' => 1,
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
                'acknowledged' => 1,
                'acknowledged_by' => 'SOC Analyst Level 2',
                'acknowledged_at' => date('Y-m-d H:i:s', strtotime('-23 hours')),
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-20 hours')),
                'resolution_notes' => 'Malware successfully quarantined. System scanned and cleaned.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'alert_name' => 'Data Breach Attempt',
                'alert_type' => 'Data Breach',
                'priority' => 'Critical',
                'status' => 'Active',
                'source_ip' => '10.0.0.55',
                'destination_ip' => '192.168.1.30',
                'description' => 'Unauthorized access attempt to customer database detected',
                'rule_name' => 'DB_UNAUTHORIZED_ACCESS',
                'detection_time' => date('Y-m-d H:i:s', strtotime('-45 minutes')),
                'acknowledged' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'alert_name' => 'Intrusion Detection',
                'alert_type' => 'Intrusion',
                'priority' => 'High',
                'status' => 'False Positive',
                'source_ip' => '192.168.1.200',
                'destination_ip' => '192.168.1.1',
                'description' => 'Potential intrusion attempt detected on network infrastructure',
                'rule_name' => 'NET_INTRUSION_DETECTION',
                'detection_time' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'acknowledged' => 1,
                'acknowledged_by' => 'Network Security Team',
                'acknowledged_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'false_positive_reason' => 'Authorized network maintenance activity',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert alerts one by one to avoid column count issues
        foreach ($alerts as $alert) {
            $this->db->table('alerts')->insert($alert);
        }
    }

    private function seedIncidents()
    {
        $incidents = [
            [
                'title' => 'Suspected Data Exfiltration - Customer Database',
                'description' => 'Large amounts of customer data accessed during off-business hours. Potential insider threat or compromised credentials detected.',
                'source_ip' => '192.168.1.100',
                'severity' => 'Critical',
                'status' => 'Open',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Ransomware Attack on File Server',
                'description' => 'Ransomware detected on file server FS-01. Multiple files encrypted. Investigation ongoing.',
                'source_ip' => '192.168.1.50',
                'severity' => 'Critical',
                'status' => 'In Progress',
                'resolution_notes' => 'Server isolated. Forensics team investigating. Backups being restored.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 hours'))
            ],
            [
                'title' => 'Phishing Campaign Targeting Finance Department',
                'description' => 'Coordinated phishing emails sent to finance department employees. Multiple users reported suspicious emails.',
                'source_ip' => '203.0.113.25',
                'severity' => 'High',
                'status' => 'Closed',
                'resolution_notes' => 'All phishing emails blocked. Users trained on identification. Sender domains blacklisted.',
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-12 hours')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-12 hours'))
            ],
            [
                'title' => 'Unauthorized Network Access',
                'description' => 'Unknown device detected on corporate network. Device attempting to access restricted resources.',
                'source_ip' => '192.168.1.199',
                'severity' => 'Medium',
                'status' => 'Open',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 hour'))
            ],
            [
                'title' => 'Privilege Escalation Attempt',
                'description' => 'User account attempting to gain administrative privileges without authorization.',
                'source_ip' => '192.168.1.75',
                'severity' => 'High',
                'status' => 'In Progress',
                'resolution_notes' => 'Account temporarily disabled. HR and Legal teams notified.',
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 hours')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-30 minutes'))
            ]
        ];

        foreach ($incidents as $incident) {
            $this->db->table('incidents')->insert($incident);
        }
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
                'description' => 'Investigation into suspected unauthorized data access and potential exfiltration from database server DB-01.',
                'evidence_count' => 3,
                'findings' => 'Network traffic analysis reveals large data transfers during off-hours.',
                'recommendations' => 'Implement additional access controls, enable detailed database auditing.',
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
                'description' => 'Analysis of banking trojan sample detected on endpoint LAPTOP-USER001.',
                'evidence_count' => 2,
                'findings' => 'Static analysis reveals code injection capabilities and keylogging functionality.',
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
                'findings' => 'Campaign originated from compromised legitimate domain.',
                'recommendations' => 'Enhanced email security training, implement additional email filtering rules.',
                'closed_date' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($cases as $case) {
            $this->db->table('forensics_cases')->insert($case);
        }
    }

    private function seedEvidence()
    {
        $evidence = [
            [
                'forensics_case_id' => 1,
                'evidence_name' => 'Network Traffic Capture - DB Server',
                'evidence_type' => 'Network Capture',
                'file_path' => '/evidence/for-2024-001/network_capture_db01.pcap',
                'file_size' => 2547483648,
                'hash_md5' => 'a1b2c3d4e5f67890abcdef1234567890',
                'hash_sha1' => 'a1b2c3d4e5f67890abcdef1234567890abcdef12',
                'hash_sha256' => 'a1b2c3d4e5f67890abcdef1234567890abcdef1234567890abcdef1234567890',
                'collected_by' => 'Network Security Team',
                'collected_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'chain_of_custody' => 'Collected by John Doe, transferred to forensics team at 14:30',
                'verified' => 1,
                'verified_by' => 'Sarah Johnson',
                'verified_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'description' => 'Complete network traffic capture from DB-01 during incident timeframe',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'forensics_case_id' => 2,
                'evidence_name' => 'Malware Sample - Banking Trojan',
                'evidence_type' => 'Digital Image',
                'file_path' => '/evidence/for-2024-002/malware_sample.exe',
                'file_size' => 2048576,
                'hash_md5' => 'c3d4e5f67890abcdef1234567890a1b2',
                'hash_sha1' => 'c3d4e5f67890abcdef1234567890a1b2cdef1234',
                'hash_sha256' => 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855',
                'collected_by' => 'Endpoint Security System',
                'collected_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'verified' => 1,
                'verified_by' => 'Michael Chen',
                'verified_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'description' => 'Quarantined malware sample from infected endpoint',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'forensics_case_id' => 3,
                'evidence_name' => 'Email Headers and Content',
                'evidence_type' => 'Email Archive',
                'file_path' => '/evidence/for-2024-003/phishing_emails.mbox',
                'file_size' => 15728640,
                'hash_md5' => 'd4e5f67890abcdef1234567890a1b2c3',
                'hash_sha1' => 'd4e5f67890abcdef1234567890a1b2c3def12345',
                'hash_sha256' => 'd4e5f67890abcdef1234567890a1b2c3def1234567890abcdef1234567890ab',
                'collected_by' => 'Email Security Gateway',
                'collected_at' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'verified' => 1,
                'verified_by' => 'Lisa Rodriguez',
                'verified_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'description' => 'Complete collection of phishing email samples and headers',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($evidence as $item) {
            $this->db->table('evidence')->insert($item);
        }
    }

    private function seedPlaybooks()
    {
        $playbooks = [
            [
                'name' => 'Malware Incident Response',
                'description' => 'Standard operating procedure for responding to malware detection and containment',
                'type' => 'Semi-Automated',
                'category' => 'Incident Response',
                'severity_level' => 'High',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Isolate affected systems from network', 'estimated_time' => '5 minutes'],
                    ['step' => 2, 'action' => 'Preserve evidence and create forensic images', 'estimated_time' => '30 minutes'],
                    ['step' => 3, 'action' => 'Analyze malware sample in sandbox environment', 'estimated_time' => '2 hours']
                ]),
                'trigger_conditions' => 'Malware detection alert from endpoint protection or network monitoring',
                'estimated_time' => '6-8 hours',
                'required_tools' => 'Malware analysis sandbox, Forensic imaging tools, Network isolation capabilities',
                'status' => 'Active',
                'execution_count' => 12,
                'success_rate' => 92.50,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_by' => 'Security Team Lead',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Data Breach Response',
                'description' => 'Comprehensive response plan for suspected or confirmed data breach incidents',
                'type' => 'Manual',
                'category' => 'Incident Response',
                'severity_level' => 'Critical',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Activate incident response team', 'estimated_time' => '15 minutes'],
                    ['step' => 2, 'action' => 'Assess scope and impact of breach', 'estimated_time' => '2 hours'],
                    ['step' => 3, 'action' => 'Contain the breach and secure affected systems', 'estimated_time' => '1 hour']
                ]),
                'trigger_conditions' => 'Confirmed or suspected unauthorized access to sensitive data',
                'estimated_time' => '24-48 hours',
                'required_tools' => 'Incident management platform, Forensic tools, Legal notification templates',
                'status' => 'Active',
                'execution_count' => 3,
                'success_rate' => 100.00,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-3 weeks')),
                'created_by' => 'CISO Office',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phishing Email Response',
                'description' => 'Quick response procedure for reported phishing emails',
                'type' => 'Automated',
                'category' => 'Email Security',
                'severity_level' => 'Medium',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Quarantine reported email across all mailboxes', 'estimated_time' => '2 minutes'],
                    ['step' => 2, 'action' => 'Extract and analyze email headers and URLs', 'estimated_time' => '5 minutes'],
                    ['step' => 3, 'action' => 'Update email security filters', 'estimated_time' => '3 minutes']
                ]),
                'trigger_conditions' => 'User reports suspicious email or email security system detects phishing',
                'estimated_time' => '15-20 minutes',
                'required_tools' => 'Email security gateway, URL analysis tools, Threat intelligence feeds',
                'status' => 'Active',
                'execution_count' => 47,
                'success_rate' => 96.80,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_by' => 'Email Security Team',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($playbooks as $playbook) {
            $this->db->table('playbooks')->insert($playbook);
        }
    }

    private function seedRelationships()
    {
        // Alert-Asset relationships
        $alertAssets = [
            ['alert_id' => 1, 'asset_id' => 1, 'relationship_type' => 'Target', 'created_at' => date('Y-m-d H:i:s')],
            ['alert_id' => 2, 'asset_id' => 5, 'relationship_type' => 'Source', 'created_at' => date('Y-m-d H:i:s')],
            ['alert_id' => 3, 'asset_id' => 5, 'relationship_type' => 'Affected', 'created_at' => date('Y-m-d H:i:s')]
        ];
        foreach ($alertAssets as $aa) {
            $this->db->table('alert_assets')->insert($aa);
        }

        // Threat-Asset relationships  
        $threatAssets = [
            ['threat_id' => 1, 'asset_id' => 5, 'impact_level' => 'High', 'detected_at' => date('Y-m-d H:i:s', strtotime('-2 hours')), 'created_at' => date('Y-m-d H:i:s')],
            ['threat_id' => 2, 'asset_id' => 5, 'impact_level' => 'Medium', 'detected_at' => date('Y-m-d H:i:s', strtotime('-6 hours')), 'created_at' => date('Y-m-d H:i:s')],
            ['threat_id' => 3, 'asset_id' => 5, 'impact_level' => 'Critical', 'detected_at' => date('Y-m-d H:i:s', strtotime('-1 day')), 'created_at' => date('Y-m-d H:i:s')]
        ];
        foreach ($threatAssets as $ta) {
            $this->db->table('threat_assets')->insert($ta);
        }

        // Incident-Asset relationships
        $incidentAssets = [
            ['incident_id' => 1, 'asset_id' => 3, 'involvement_type' => 'Compromised', 'created_at' => date('Y-m-d H:i:s')],
            ['incident_id' => 2, 'asset_id' => 2, 'involvement_type' => 'Compromised', 'created_at' => date('Y-m-d H:i:s')],
            ['incident_id' => 3, 'asset_id' => 5, 'involvement_type' => 'Target', 'created_at' => date('Y-m-d H:i:s')]
        ];
        foreach ($incidentAssets as $ia) {
            $this->db->table('incident_assets')->insert($ia);
        }
    }
}