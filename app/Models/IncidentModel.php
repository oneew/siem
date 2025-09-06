<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidentModel extends Model
{
    protected $table = 'incidents';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'description', 'source_ip', 'severity', 'status', 
        'resolution_notes', 'resolved_at', 'evidence_collected', 
        'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'description' => 'required',
        'severity' => 'required|in_list[Low,Medium,High,Critical]',
        'status' => 'required|in_list[Open,In Progress,Closed]',
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
            'in_list' => 'Status must be one of: Open, In Progress, Closed'
        ],
        'source_ip' => [
            'valid_ip' => 'Please provide a valid IP address'
        ]
    ];
}