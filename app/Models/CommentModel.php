<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'incident_id', 'user_id', 'comment'
    ];
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'incident_id' => 'required|is_natural_no_zero',
        'user_id' => 'required|is_natural_no_zero',
        'comment' => 'required|max_length[1000]'
    ];
    
    protected $validationMessages = [
        'incident_id' => [
            'required' => 'Incident ID is required',
            'is_natural_no_zero' => 'Incident ID must be a positive integer'
        ],
        'user_id' => [
            'required' => 'User ID is required',
            'is_natural_no_zero' => 'User ID must be a positive integer'
        ],
        'comment' => [
            'required' => 'Comment is required',
            'max_length' => 'Comment cannot exceed 1000 characters'
        ]
    ];
    
    /**
     * Get comments for an incident with user information
     */
    public function getCommentsWithUser($incidentId)
    {
        return $this->select('comments.*, users.username, users.profile_picture')
                    ->join('users', 'users.id = comments.user_id')
                    ->where('incident_id', $incidentId)
                    ->orderBy('comments.created_at', 'ASC')
                    ->findAll();
    }
}