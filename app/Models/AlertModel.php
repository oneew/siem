<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertModel extends Model
{
    protected $table = 'alerts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'alert_name',
        'alert_type',
        'priority',
        'status',
        'source_ip',
        'description',
        'rule_name',
        'acknowledged',
        'resolved_at',
        'asset_id',
        'assigned_to'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'alert_name' => 'required|max_length[200]',
        'alert_type' => 'required|in_list[Authentication,Network,Malware,Data Breach,Intrusion,System,Vulnerability]',
        'priority' => 'required|in_list[Low,Medium,High,Critical]',
        'status' => 'required|in_list[Active,Investigating,Closed,False Positive]',
        'source_ip' => 'valid_ip'
    ];

    protected $validationMessages = [
        'alert_name' => [
            'required' => 'Alert name is required',
            'max_length' => 'Alert name cannot exceed 200 characters'
        ],
        'alert_type' => [
            'required' => 'Alert type is required',
            'in_list' => 'Alert type must be one of: Authentication, Network, Malware, Data Breach, Intrusion, System, Vulnerability'
        ],
        'priority' => [
            'required' => 'Priority is required',
            'in_list' => 'Priority must be one of: Low, Medium, High, Critical'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be one of: Active, Investigating, Closed, False Positive'
        ],
        'source_ip' => [
            'valid_ip' => 'Please provide a valid IP address'
        ]
    ];
}
