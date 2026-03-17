<?php

namespace App\Models;

use CodeIgniter\Model;

class MonitoredWebsiteModel extends Model
{
    protected $table            = 'monitored_websites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'url', 'status', 'last_checked', 'response_time', 'indicators_found'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
