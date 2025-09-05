<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PlaybooksSeeder extends Seeder
{
    public function run()
    {
        $playbooks = [
            [
                'name' => 'Malware Incident Response',
                'description' => 'Standard operating procedure for responding to malware infections including containment, analysis, and remediation steps.',
                'category' => 'Malware Response',
                'severity_level' => 'High',
                'type' => 'Semi-Automated',
                'trigger_conditions' => 'Antivirus detection, suspicious process behavior, C&C communication',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Isolate infected endpoint from network', 'automated' => true],
                    ['step' => 2, 'action' => 'Collect memory dump and disk image', 'automated' => false],
                    ['step' => 3, 'action' => 'Analyze malware sample in sandbox', 'automated' => true],
                    ['step' => 4, 'action' => 'Update threat intelligence feeds', 'automated' => true],
                    ['step' => 5, 'action' => 'Notify security team and management', 'automated' => true],
                    ['step' => 6, 'action' => 'Implement containment measures', 'automated' => false],
                    ['step' => 7, 'action' => 'Clean and restore affected systems', 'automated' => false],
                    ['step' => 8, 'action' => 'Conduct post-incident review', 'automated' => false]
                ]),
                'success_criteria' => 'Malware removed, systems restored, no data loss',
                'execution_count' => 15,
                'success_rate' => 93.33,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Data Breach Response',
                'description' => 'Comprehensive response plan for data breach incidents including legal, regulatory, and technical response procedures.',
                'category' => 'Data Protection',
                'severity_level' => 'Critical',
                'type' => 'Manual',
                'trigger_conditions' => 'Unauthorized data access, data exfiltration detection, privacy violation alerts',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Activate incident response team', 'automated' => false],
                    ['step' => 2, 'action' => 'Contain the breach and prevent further data loss', 'automated' => false],
                    ['step' => 3, 'action' => 'Assess scope and impact of data compromise', 'automated' => false],
                    ['step' => 4, 'action' => 'Notify legal and compliance teams', 'automated' => true],
                    ['step' => 5, 'action' => 'Preserve evidence for investigation', 'automated' => false],
                    ['step' => 6, 'action' => 'Notify regulatory authorities (if required)', 'automated' => false],
                    ['step' => 7, 'action' => 'Prepare customer notification', 'automated' => false],
                    ['step' => 8, 'action' => 'Implement remediation measures', 'automated' => false],
                    ['step' => 9, 'action' => 'Monitor for additional threats', 'automated' => true],
                    ['step' => 10, 'action' => 'Conduct lessons learned session', 'automated' => false]
                ]),
                'success_criteria' => 'Breach contained, compliance requirements met, reputation preserved',
                'execution_count' => 3,
                'success_rate' => 100.00,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-2 weeks')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Phishing Attack Response',
                'description' => 'Response procedures for phishing attacks including email containment, user notification, and threat hunting.',
                'category' => 'Email Security',
                'severity_level' => 'Medium',
                'type' => 'Automated',
                'trigger_conditions' => 'Phishing email detection, user reports, suspicious email patterns',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Identify and quarantine malicious emails', 'automated' => true],
                    ['step' => 2, 'action' => 'Block sender domains and IPs', 'automated' => true],
                    ['step' => 3, 'action' => 'Notify affected users', 'automated' => true],
                    ['step' => 4, 'action' => 'Scan for IoCs across environment', 'automated' => true],
                    ['step' => 5, 'action' => 'Update email security rules', 'automated' => true],
                    ['step' => 6, 'action' => 'Generate threat intelligence report', 'automated' => true],
                    ['step' => 7, 'action' => 'Schedule security awareness training', 'automated' => false]
                ]),
                'success_criteria' => 'Phishing emails blocked, users protected, no credential compromise',
                'execution_count' => 47,
                'success_rate' => 89.36,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-3 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'DDoS Mitigation',
                'description' => 'Automated response to distributed denial of service attacks including traffic analysis and mitigation deployment.',
                'category' => 'Network Security',
                'severity_level' => 'High',
                'type' => 'Automated',
                'trigger_conditions' => 'Traffic volume thresholds, connection anomalies, service degradation',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Activate DDoS protection service', 'automated' => true],
                    ['step' => 2, 'action' => 'Analyze attack traffic patterns', 'automated' => true],
                    ['step' => 3, 'action' => 'Implement rate limiting rules', 'automated' => true],
                    ['step' => 4, 'action' => 'Block malicious source IPs', 'automated' => true],
                    ['step' => 5, 'action' => 'Notify network operations team', 'automated' => true],
                    ['step' => 6, 'action' => 'Monitor service availability', 'automated' => true],
                    ['step' => 7, 'action' => 'Generate attack analysis report', 'automated' => true]
                ]),
                'success_criteria' => 'Service availability maintained, attack traffic filtered',
                'execution_count' => 8,
                'success_rate' => 87.50,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-1 week')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Insider Threat Investigation',
                'description' => 'Investigation procedures for suspected insider threats including evidence collection and user activity analysis.',
                'category' => 'Insider Threat',
                'severity_level' => 'High',
                'type' => 'Manual',
                'trigger_conditions' => 'Unusual user behavior, unauthorized access, data exfiltration alerts',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Preserve user activity logs', 'automated' => true],
                    ['step' => 2, 'action' => 'Coordinate with HR and legal teams', 'automated' => false],
                    ['step' => 3, 'action' => 'Conduct discrete user activity analysis', 'automated' => false],
                    ['step' => 4, 'action' => 'Interview relevant personnel', 'automated' => false],
                    ['step' => 5, 'action' => 'Implement additional monitoring', 'automated' => true],
                    ['step' => 6, 'action' => 'Document findings and recommendations', 'automated' => false],
                    ['step' => 7, 'action' => 'Take appropriate disciplinary action', 'automated' => false]
                ]),
                'success_criteria' => 'Threat identified and mitigated, evidence preserved, policy compliance',
                'execution_count' => 5,
                'success_rate' => 80.00,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ransomware Recovery',
                'description' => 'Emergency response and recovery procedures for ransomware attacks including system isolation and backup restoration.',
                'category' => 'Malware Response',
                'severity_level' => 'Critical',
                'type' => 'Semi-Automated',
                'trigger_conditions' => 'File encryption detected, ransom notes discovered, mass file modifications',
                'steps' => json_encode([
                    ['step' => 1, 'action' => 'Immediately isolate affected systems', 'automated' => true],
                    ['step' => 2, 'action' => 'Activate crisis management team', 'automated' => true],
                    ['step' => 3, 'action' => 'Assess encryption scope and damage', 'automated' => false],
                    ['step' => 4, 'action' => 'Identify and preserve clean backups', 'automated' => false],
                    ['step' => 5, 'action' => 'Notify law enforcement and insurance', 'automated' => false],
                    ['step' => 6, 'action' => 'Begin system restoration from backups', 'automated' => false],
                    ['step' => 7, 'action' => 'Implement additional security controls', 'automated' => false],
                    ['step' => 8, 'action' => 'Conduct business continuity procedures', 'automated' => false],
                    ['step' => 9, 'action' => 'Monitor for persistence mechanisms', 'automated' => true]
                ]),
                'success_criteria' => 'Systems restored, business operations resumed, no ransom paid',
                'execution_count' => 2,
                'success_rate' => 100.00,
                'last_executed' => date('Y-m-d H:i:s', strtotime('-6 hours')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('playbooks')->insertBatch($playbooks);
        echo "Playbooks seeded successfully!\n";
    }
}