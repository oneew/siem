<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidentModel extends Model
{
    protected $table = 'incidents';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title',
        'description',
        'source_ip',
        'attack_type',
        'severity',
        'status',
        'resolution_notes',
        'resolved_at',
        'evidence_collected',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;

    protected $validationRules = [
        'title' => 'required|max_length[255]',
        'description' => 'required',
        'severity' => 'required|in_list[Low,Medium,High,Critical]',
        'status' => 'required|in_list[Open,In Progress,Closed]',
        'source_ip' => 'required|valid_ip'
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
            'required' => 'Source IP address is required',
            'valid_ip' => 'Please provide a valid IP address'
        ]
    ];

    // Override the insert method to add better error handling
    public function insert($data = null, bool $returnID = true)
    {
        // Log the data being inserted
        log_message('debug', 'Attempting to insert incident data: ' . json_encode($data));

        try {
            $result = parent::insert($data, $returnID);

            if ($result === false) {
                // Log the errors
                $errors = $this->errors();
                log_message('error', 'Failed to insert incident. Validation errors: ' . json_encode($errors));
                return false;
            }

            log_message('debug', 'Incident inserted successfully with ID: ' . $result);
            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Exception during incident insert: ' . $e->getMessage());
            return false;
        }
    }
}
