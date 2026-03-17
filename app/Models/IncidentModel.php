<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidentModel extends Model
{
    protected $table = 'incidents';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'description', 'source_ip', 'attack_type', 'attack_vector',
        'severity', 'impact', 'status', 'priority', 'assigned_to',
        'resolution_notes', 'resolved_at', 'first_detected', 'containment_time',
        'eradication_time', 'recovery_time', 'lessons_learned', 'tags',
        'affected_systems', 'evidence_collected', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'description' => 'required',
        'attack_type' => 'in_list[Malware,Phishing,DDoS,Data Breach,Insider Threat,Advanced Persistent Threat,Ransomware,Social Engineering,Physical Security,Other]',
        'attack_vector' => 'in_list[Email,Web Application,Network,USB/Removable Media,Social Engineering,Physical Access,Third Party,Unknown,Other]',
        'severity' => 'required|in_list[Low,Medium,High,Critical]',
        'impact' => 'in_list[None,Low,Medium,High,Critical]',
        'status' => 'required|in_list[New,Assigned,In Progress,Contained,Eradicated,Recovered,Closed]',
        'priority' => 'in_list[Low,Medium,High,Critical]',
        'source_ip' => 'valid_ip'
    ];
    
    protected $validationMessages = [
        'title' => [
            'required' => 'Incident title is required',
            'max_length' => 'Title cannot exceed 255 characters'
        ],
        'description' => [
            'required' => 'Incident description is required'
        ],
        'severity' => [
            'required' => 'Severity level is required',
            'in_list' => 'Severity must be one of: Low, Medium, High, Critical'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be valid incident response status'
        ],
        'source_ip' => [
            'valid_ip' => 'Please provide a valid IP address'
        ]
    ];
}
