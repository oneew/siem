<?php

namespace App\Controllers;

use App\Models\AlertModel;

class Alerts extends BaseController
{
    public function index()
    {
        $model = new AlertModel();
        $data['title'] = 'Security Alerts';
        $data['alerts'] = $model->orderBy('created_at', 'DESC')->findAll();
        
        // Get statistics
        $data['stats'] = [
            'total_alerts' => $model->countAll(),
            'active_alerts' => $model->where('status', 'Active')->countAllResults(),
            'high_priority' => $model->where('priority', 'High')->countAllResults(),
            'recent_24h' => $model->where('created_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))->countAllResults()
        ];
        
        return view('alerts/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Create Security Alert';
        return view('alerts/create', $data);
    }

    public function store()
    {
        $model = new AlertModel();
        
        $data = [
            'alert_name' => $this->request->getPost('alert_name'),
            'alert_type' => $this->request->getPost('alert_type'),
            'priority' => $this->request->getPost('priority'),
            'source_ip' => $this->request->getPost('source_ip'),
            'description' => $this->request->getPost('description'),
            'rule_name' => $this->request->getPost('rule_name'),
            'status' => 'Active',
            'acknowledged' => 0
        ];
        
        if ($model->insert($data)) {
            return redirect()->to('/alerts')->with('success', 'Security alert created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create alert');
        }
    }

    public function show($id)
    {
        $model = new AlertModel();
        $alert = $model->find($id);
        
        if (!$alert) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Alert not found');
        }
        
        $data['title'] = 'Alert Details';
        $data['alert'] = $alert;
        
        return view('alerts/show', $data);
    }

    public function edit($id)
    {
        $model = new AlertModel();
        $alert = $model->find($id);
        
        if (!$alert) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Alert not found');
        }
        
        $data['title'] = 'Edit Security Alert';
        $data['alert'] = $alert;
        
        return view('alerts/edit', $data);
    }

    // Updated to match the new route: /alerts/(:num) with POST method and _method=PUT
    public function update($id)
    {
        $model = new AlertModel();
        
        $data = [
            'alert_name' => $this->request->getPost('alert_name'),
            'alert_type' => $this->request->getPost('alert_type'),
            'priority' => $this->request->getPost('priority'),
            'source_ip' => $this->request->getPost('source_ip'),
            'description' => $this->request->getPost('description'),
            'rule_name' => $this->request->getPost('rule_name'),
            'status' => $this->request->getPost('status'),
            'acknowledged' => $this->request->getPost('acknowledged') ? 1 : 0
        ];
        
        if ($model->update($id, $data)) {
            return redirect()->to('/alerts/show/' . $id)->with('success', 'Security alert updated successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to update alert');
        }
    }

    public function acknowledge($id)
    {
        $model = new AlertModel();
        $model->update($id, ['acknowledged' => 1]);
        return redirect()->back()->with('success', 'Alert acknowledged');
    }

    public function close($id)
    {
        $model = new AlertModel();
        $model->update($id, ['status' => 'Closed']);
        return redirect()->back()->with('success', 'Alert closed');
    }

    // Updated to match the new route: /alerts/delete/(:num) with GET method
    public function delete($id)
    {
        $model = new AlertModel();
        $model->delete($id);
        return redirect()->to('/alerts')->with('success', 'Alert deleted');
    }

    public function clearAll()
    {
        // Only allow this in development environment for safety
        if (ENVIRONMENT !== 'development') {
            return redirect()->to('/alerts')->with('error', 'This action is only available in development mode.');
        }
        
        $model = new AlertModel();
        $model->truncate();
        
        return redirect()->to('/alerts')->with('success', 'All alerts have been cleared from the database.');
    }

    public function createIncident($id)
    {
        // In a real implementation, this would create an incident record
        // For now, we'll just redirect to the incidents creation page with alert data
        return redirect()->to('/incidents/create')->with('info', 'Create an incident based on alert #' . $id);
    }

    public function escalate($id)
    {
        $model = new AlertModel();
        $alert = $model->find($id);
        
        if (!$alert) {
            return redirect()->back()->with('error', 'Alert not found');
        }
        
        // Escalate priority: Low -> Medium, Medium -> High, High -> Critical
        $newPriority = $alert['priority'];
        switch($alert['priority']) {
            case 'Low':
                $newPriority = 'Medium';
                break;
            case 'Medium':
                $newPriority = 'High';
                break;
            case 'High':
                $newPriority = 'Critical';
                break;
            // Critical stays Critical
        }
        
        $model->update($id, ['priority' => $newPriority]);
        return redirect()->back()->with('success', 'Alert escalated to ' . $newPriority . ' priority');
    }
}