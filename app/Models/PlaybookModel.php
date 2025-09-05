<?php

namespace App\Models;

use CodeIgniter\Model;

class PlaybookModel extends Model
{
    protected $table = 'playbooks';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name',
        'description',
        'type',
        'category',
        'severity_level',
        'steps',
        'trigger_conditions',
        'estimated_time',
        'required_tools',
        'status',
        'execution_count',
        'success_rate',
        'last_executed',
        'created_by',
        'updated_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|max_length[255]',
        'type' => 'required|in_list[Manual,Automated,Semi-Automated]',
        'category' => 'required|max_length[100]',
        'severity_level' => 'required|in_list[Low,Medium,High,Critical]',
        'status' => 'required|in_list[Active,Inactive,Draft]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Playbook name is required',
            'max_length' => 'Playbook name cannot exceed 255 characters'
        ],
        'type' => [
            'required' => 'Playbook type is required',
            'in_list' => 'Invalid playbook type'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}