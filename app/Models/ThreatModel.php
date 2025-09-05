<?php

namespace App\Models;

use CodeIgniter\Model;

class ThreatModel extends Model
{
    protected $table = 'threats';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'ioc_type', 'ioc_value', 'threat_type', 'severity', 'confidence',
        'source', 'description', 'status', 'first_seen', 'last_seen', 'tags'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'ioc_type' => 'required|in_list[IP,Domain,Hash,URL,Email]',
        'ioc_value' => 'required',
        'threat_type' => 'required',
        'severity' => 'required|in_list[Low,Medium,High,Critical]',
        'confidence' => 'required|in_list[Low,Medium,High]',
        'status' => 'required|in_list[Active,Inactive,Investigating]'
    ];
    
    protected $validationMessages = [
        'ioc_type' => [
            'required' => 'IOC Type is required',
            'in_list' => 'IOC Type must be one of: IP, Domain, Hash, URL, Email'
        ],
        'ioc_value' => [
            'required' => 'IOC Value is required'
        ],
        'threat_type' => [
            'required' => 'Threat Type is required'
        ],
        'severity' => [
            'required' => 'Severity is required',
            'in_list' => 'Severity must be one of: Low, Medium, High, Critical'
        ],
        'confidence' => [
            'required' => 'Confidence is required',
            'in_list' => 'Confidence must be one of: Low, Medium, High'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be one of: Active, Inactive, Investigating'
        ]
    ];
}