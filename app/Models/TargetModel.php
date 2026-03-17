<?php

namespace App\Models;

use CodeIgniter\Model;

class TargetModel extends Model
{
    protected $table            = 'targets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // id, target_name, ip_address_or_url, environment, criticality_level
    protected $allowedFields    = [
        'target_name', 
        'ip_address_or_url', 
        'environment', 
        'criticality_level'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
