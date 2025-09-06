<?php

namespace App\Controllers;

use App\Models\IncidentModel;

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
        }
        
        // Validation rules
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'severity' => 'required|in_list[Low,Medium,High,Critical]',
            'status' => 'required|in_list[Open,In Progress,Closed]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        if ($model->save($post)) {
            return redirect()->to('/incidents')->with('success','Incident created successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create incident. Please try again.');
        }
    }

    public function show($id)
    {
        $model = new IncidentModel();
        $incident = $model->find($id);
        if (!$incident) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Incident not found');
        }
        return view('incidents/show', ['incident' => $incident]);
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
        
        // Validation rules
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'severity' => 'required|in_list[Low,Medium,High,Critical]',
            'status' => 'required|in_list[Open,In Progress,Closed]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        if ($model->update($id, $post)) {
            return redirect()->to('/incidents')->with('success','Incident updated successfully!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update incident. Please try again.');
        }
    }

    public function delete($id)
    {
        $model = new IncidentModel();
        $model->delete($id);
        return redirect()->to('/incidents')->with('success','Incident deleted successfully!');
    }
}