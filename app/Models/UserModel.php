<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username','password','role','profile_picture','created_at','updated_at'];
    protected $useTimestamps = true;
    
    // Validation rules
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'password' => 'required|min_length[6]',
        'role' => 'required|in_list[Admin,Analyst,Operator]',
    ];
    
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'This username is already taken. Please choose another one.',
        ],
    ];
}