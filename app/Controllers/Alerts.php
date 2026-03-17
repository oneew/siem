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

    public function delete($id)
    {
        $model = new AlertModel();
        $model->delete($id);
        return redirect()->to('/alerts')->with('success', 'Alert deleted');
    }
}