<?php

namespace App\Models;

use CodeIgniter\Model;

class ForensicsModel extends Model
{
    protected $table = 'forensics_cases';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'case_number', 'case_name', 'case_type', 'priority', 'status',
        'assigned_investigator', 'incident_date', 'description', 'evidence_count',
        'findings', 'recommendations', 'closed_date'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'case_name' => 'required|max_length[255]',
        'case_type' => 'required|in_list[Malware Analysis,Network Forensics,Disk Forensics,Mobile Forensics,Memory Forensics,Email Forensics,Database Forensics,Cloud Forensics,Other]',
        'priority' => 'required|in_list[Low,Medium,High,Critical]',
        'status' => 'required|in_list[Active,In Progress,On Hold,Completed,Archived]',
        'assigned_investigator' => 'required|max_length[100]'
    ];
    
    protected $validationMessages = [
        'case_name' => [
            'required' => 'Case name is required',
            'max_length' => 'Case name cannot exceed 255 characters'
        ],
        'case_type' => [
            'required' => 'Case type is required',
            'in_list' => 'Please select a valid case type'
        ],
        'priority' => [
            'required' => 'Priority is required',
            'in_list' => 'Priority must be one of: Low, Medium, High, Critical'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Please select a valid status'
        ],
        'assigned_investigator' => [
            'required' => 'Assigned investigator is required',
            'max_length' => 'Investigator name cannot exceed 100 characters'
        ]
    ];
}