<?php

namespace App\Models;

use CodeIgniter\Model;

class AssetModel extends Model
{
    protected $table = 'assets';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'asset_name', 'asset_type', 'ip_address', 'mac_address', 'operating_system',
        'status', 'criticality', 'location', 'owner', 'vulnerability_status', 'last_scan'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
    protected $validationRules = [
        'asset_name' => 'required|max_length[200]',
        'asset_type' => 'required|in_list[Server,Endpoint,Network Device,Mobile,IoT Device,Database]',
        'ip_address' => 'valid_ip',
        'status' => 'required|in_list[Online,Offline,Maintenance,Decommissioned]',
        'criticality' => 'required|in_list[Low,Medium,High,Critical]',
        'vulnerability_status' => 'in_list[Unknown,Secure,Vulnerable,Patching Required]'
    ];
    
    protected $validationMessages = [
        'asset_name' => [
            'required' => 'Asset name is required',
            'max_length' => 'Asset name cannot exceed 200 characters'
        ],
        'asset_type' => [
            'required' => 'Asset type is required',
            'in_list' => 'Asset type must be one of: Server, Endpoint, Network Device, Mobile, IoT Device, Database'
        ],
        'ip_address' => [
            'valid_ip' => 'Please provide a valid IP address'
        ],
        'status' => [
            'required' => 'Status is required',
            'in_list' => 'Status must be one of: Online, Offline, Maintenance, Decommissioned'
        ],
        'criticality' => [
            'required' => 'Criticality is required',
            'in_list' => 'Criticality must be one of: Low, Medium, High, Critical'
        ]
    ];
}