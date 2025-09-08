<?php

namespace App\Controllers;

use App\Models\CommentModel;

class TestComment extends BaseController
{
    public function insertTestComment()
    {
        $model = new CommentModel();
        
        $data = [
            'incident_id' => 1,
            'user_id' => 1,
            'comment' => 'This is a test comment from TestComment controller'
        ];
        
        if ($model->save($data)) {
            echo "Test comment inserted successfully!";
        } else {
            echo "Failed to insert test comment.";
        }
    }
}