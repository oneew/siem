<?php

namespace App\Controllers;

use App\Models\PlaybookModel;

class Playbooks extends BaseController
{
    public function index()
    {
        $model = new PlaybookModel();
        $data['title'] = 'Incident Playbooks';
        $data['playbooks'] = $model->orderBy('created_at', 'DESC')->findAll();
        
        // Get statistics
        $data['stats'] = [
            'total_playbooks' => $model->countAll(),
            'active_playbooks' => $model->where('status', 'Active')->countAllResults(),
            'automated_playbooks' => $model->where('type', 'Automated')->countAllResults(),
            'manual_playbooks' => $model->where('type', 'Manual')->countAllResults()
        ];
        
        return view('playbooks/index', $data);
    }

    public function show($id)
    {
        $model = new PlaybookModel();
        $playbook = $model->find($id);
        
        if (!$playbook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Playbook not found');
        }
        
        $data['title'] = 'Playbook Details';
        $data['playbook'] = $playbook;
        
        return view('playbooks/show', $data);
    }

    public function create()
    {
        $data['title'] = 'Create New Playbook';
        return view('playbooks/create', $data);
    }

    public function store()
    {
        $model = new PlaybookModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'severity_level' => $this->request->getPost('severity_level'),
            'steps' => $this->request->getPost('steps'),
            'trigger_conditions' => $this->request->getPost('trigger_conditions'),
            'estimated_time' => $this->request->getPost('estimated_time'),
            'required_tools' => $this->request->getPost('required_tools'),
            'status' => 'Active',
            'created_by' => session()->get('username')
        ];
        
        if ($model->insert($data)) {
            return redirect()->to('/playbooks')->with('success', 'Playbook created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create playbook');
        }
    }

    public function edit($id)
    {
        $model = new PlaybookModel();
        $playbook = $model->find($id);
        
        if (!$playbook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Playbook not found');
        }
        
        $data['title'] = 'Edit Playbook';
        $data['playbook'] = $playbook;
        
        return view('playbooks/edit', $data);
    }

    public function update($id)
    {
        $model = new PlaybookModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'type' => $this->request->getPost('type'),
            'category' => $this->request->getPost('category'),
            'severity_level' => $this->request->getPost('severity_level'),
            'steps' => $this->request->getPost('steps'),
            'trigger_conditions' => $this->request->getPost('trigger_conditions'),
            'estimated_time' => $this->request->getPost('estimated_time'),
            'required_tools' => $this->request->getPost('required_tools'),
            'status' => $this->request->getPost('status'),
            'updated_by' => session()->get('username')
        ];
        
        if ($model->update($id, $data)) {
            return redirect()->to('/playbooks')->with('success', 'Playbook updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update playbook');
        }
    }

    public function delete($id)
    {
        $model = new PlaybookModel();
        $model->delete($id);
        return redirect()->to('/playbooks')->with('success', 'Playbook deleted successfully');
    }

    public function execute($id)
    {
        $model = new PlaybookModel();
        $playbook = $model->find($id);
        
        if (!$playbook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Playbook not found');
        }
        
        // Handle POST request for execution tracking
        if ($this->request->getMethod() === 'post') {
            // Update execution count and last executed time
            $model->update($id, [
                'execution_count' => ($playbook['execution_count'] ?? 0) + 1,
                'last_executed' => date('Y-m-d H:i:s')
            ]);
            
            return $this->response->setJSON(['success' => true]);
        }
        
        $data['title'] = 'Execute Playbook';
        $data['playbook'] = $playbook;
        
        return view('playbooks/execute', $data);
    }
}