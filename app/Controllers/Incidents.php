<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Models\CommentModel;

class Incidents extends BaseController
{
    public function index()
    {
        $model = new IncidentModel();
        $builder = $model;

        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        if ($start && $end) {
            $builder = $builder->where('created_at >=', $start . ' 00:00:00')
                               ->where('created_at <=', $end . ' 23:59:59');
        }

        $data['incidents'] = $builder->orderBy('created_at', 'DESC')->findAll();
        return view('incidents/index', $data);
    }

    public function create()
    {
        return view('incidents/create');
    }

    public function store()
    {
        helper(['form']);
        
        $model = new IncidentModel();
        $post = $this->request->getPost();
        
        // Normalize closed -> resolved_at
        if (isset($post['status']) && $post['status'] === 'Closed' && empty($post['resolved_at'])) {
            $post['resolved_at'] = date('Y-m-d H:i:s');
        }
        
        // Handle evidence file uploads
        $evidenceFiles = [];
        if ($this->request->getFileMultiple('evidence_files')) {
            $files = $this->request->getFileMultiple('evidence_files');
            foreach ($files as $file) {
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    // Validate file type and size
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'text/plain', 'application/pdf'];
                    if (in_array($file->getMimeType(), $allowedTypes) && $file->getSize() <= 5242880) { // 5MB limit
                        $fileName = 'incident_' . time() . '_' . $file-> getRandomName();
                        $file->move(ROOTPATH . 'public/uploads/incidents', $fileName);
                        $evidenceFiles[] = $fileName;
                    }
                }
            }
        }
        
        // Add evidence files to post data if any
        if (!empty($evidenceFiles)) {
            $post['evidence_collected'] = json_encode($evidenceFiles);
        } else {
            $post['evidence_collected'] = null;
        }
        
        // Validation rules
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'severity' => 'required|in_list[Low,Medium,High,Critical]',
            'status' => 'required|in_list[Open,In Progress,Closed]',
            'source_ip' => 'required|valid_ip'
        ];
        
        if (!$this->validate($rules)) {
            log_message('error', 'Incident validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Try to insert the incident
        $id = $model->insert($post);
        
        if ($id) {
            log_message('info', 'Incident created successfully with ID: ' . $id);
            return redirect()->to('/incidents/show/' . $id)->with('success','Incident created successfully!');
        } else {
            // Get the actual errors
            $errors = $model->errors();
            log_message('error', 'Failed to create incident. Model errors: ' . json_encode($errors));
            
            // If we have specific errors, show them
            if (!empty($errors)) {
                return redirect()->back()->withInput()->with('error', 'Failed to create incident. Errors: ' . json_encode($errors));
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to create incident. Please check the logs for more details.');
            }
        }
    }

    public function show($id)
    {
        $model = new IncidentModel();
        $commentModel = new CommentModel();
        $incident = $model->find($id);
        
        if (!$incident) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Incident not found');
        }
        
        // Get comments for this incident
        $comments = $commentModel->getCommentsWithUser($id);
        
        return view('incidents/show', [
            'incident' => $incident,
            'comments' => $comments
        ]);
    }

    public function addComment()
    {
        helper(['form']);
        
        $commentModel = new CommentModel();
        $post = $this->request->getPost();
        
        // Add user_id from session
        $post['user_id'] = session()->get('user_id');
        
        // Validation rules
        $rules = [
            'incident_id' => 'required|is_natural_no_zero',
            'comment' => 'required|max_length[1000]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        if ($commentModel->save($post)) {
            // Get the inserted comment with user info
            $comment = $commentModel->select('comments.*, users.username, users.profile_picture')
                                   ->join('users', 'users.id = comments.user_id')
                                   ->where('comments.id', $commentModel->getInsertID())
                                   ->first();
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Comment added successfully',
                'comment' => $comment
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to add comment'
            ]);
        }
    }

    public function edit($id)
    {
        $model = new IncidentModel();
        $incident = $model->find($id);
        if (!$incident) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Incident not found');
        }
        return view('incidents/edit', ['incident' => $incident]);
    }

    public function update($id)
    {
        helper(['form']);
        
        $model = new IncidentModel();
        $post = $this->request->getPost();
        
        if (isset($post['status']) && $post['status'] === 'Closed' && empty($post['resolved_at'])) {
            $post['resolved_at'] = date('Y-m-d H:i:s');
        }
        
        // Handle evidence file uploads
        $existingEvidence = json_decode($model->find($id)['evidence_collected'] ?? '[]', true);
        $evidenceFiles = $existingEvidence ?: [];
        
        // Handle file deletions
        if (isset($post['delete_files']) && is_array($post['delete_files'])) {
            foreach ($post['delete_files'] as $fileToDelete) {
                // Remove file from array
                $key = array_search($fileToDelete, $evidenceFiles);
                if ($key !== false) {
                    unset($evidenceFiles[$key]);
                    
                    // Delete the actual file from the filesystem
                    $filePath = ROOTPATH . 'public/uploads/incidents/' . $fileToDelete;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            // Re-index array
            $evidenceFiles = array_values($evidenceFiles);
        }
        
        // Handle new file uploads
        if ($this->request->getFileMultiple('evidence_files')) {
            $files = $this->request->getFileMultiple('evidence_files');
            foreach ($files as $file) {
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    // Validate file type and size
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'text/plain', 'application/pdf'];
                    if (in_array($file->getMimeType(), $allowedTypes) && $file->getSize() <= 5242880) { // 5MB limit
                        $fileName = 'incident_' . time() . '_' . $file-> getRandomName();
                        $file->move(ROOTPATH . 'public/uploads/incidents', $fileName);
                        $evidenceFiles[] = $fileName;
                    }
                }
            }
        }
        
        // Add evidence files to post data if any new files were uploaded or files were deleted
        if (!empty($evidenceFiles)) {
            $post['evidence_collected'] = json_encode($evidenceFiles);
        } elseif (isset($post['evidence_collected'])) {
            // Remove evidence_collected from post data to avoid overwriting with empty value
            unset($post['evidence_collected']);
        }
        
        // Validation rules
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'severity' => 'required|in_list[Low,Medium,High,Critical]',
            'status' => 'required|in_list[Open,In Progress,Closed]',
            'source_ip' => 'required|valid_ip'
        ];
        
        if (!$this->validate($rules)) {
            log_message('error', 'Incident update validation failed: ' . json_encode($this->validator->getErrors()));
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Try to update the incident
        if ($model->update($id, $post)) {
            log_message('info', 'Incident updated successfully with ID: ' . $id);
            return redirect()->to('/incidents/show/' . $id)->with('success','Incident updated successfully!');
        } else {
            // Get the actual errors
            $errors = $model->errors();
            log_message('error', 'Failed to update incident. Model errors: ' . json_encode($errors));
            
            // If we have specific errors, show them
            if (!empty($errors)) {
                return redirect()->back()->withInput()->with('error', 'Failed to update incident. Errors: ' . json_encode($errors));
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update incident. Please check the logs for more details.');
            }
        }
    }

    public function delete($id)
    {
        $model = new IncidentModel();
        if ($model->delete($id)) {
            log_message('info', 'Incident deleted successfully with ID: ' . $id);
            return redirect()->to('/incidents')->with('success','Incident deleted successfully!');
        } else {
            log_message('error', 'Failed to delete incident with ID: ' . $id);
            return redirect()->to('/incidents')->with('error','Failed to delete incident.');
        }
    }
}