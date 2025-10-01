<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['key', 'value'];
    protected $useTimestamps = true;

    // Validation rules
    protected $validationRules = [
        'key' => 'required|max_length[100]',
        'value' => 'permit_empty',
    ];

    protected $validationMessages = [
        'key' => [
            'required' => 'Key pengaturan harus diisi',
            'max_length' => 'Key pengaturan tidak boleh lebih dari 100 karakter',
        ],
    ];
}
