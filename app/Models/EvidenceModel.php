<?php

namespace App\Models;

use CodeIgniter\Model;

class EvidenceModel extends Model
{
    protected $table            = 'evidence';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // id, case_id, evidence_name, file_hash_sha256, acquired_date, uploaded_by
    protected $allowedFields    = [
        'case_id', 
        'evidence_name', 
        'file_hash_sha256', 
        'acquired_date',
        'uploaded_by'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    
    // We don't want an update timestamp as evidence should be immutable after upload
    // but CodeIgniter Model might complain if we say useTimestamps without updatedField
    // So we just won't rely on updated_at
}
