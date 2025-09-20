<?php

namespace App\Controllers;

use App\Models\ThreatModel;

class Threats extends BaseController
{
    public function index()
    {
        $model = new ThreatModel();
        $data['title'] = 'Threat Intelligence';
        $data['threats'] = $model->orderBy('created_at', 'DESC')->findAll();
        
        // Get statistics
        $data['stats'] = [
            'total_iocs' => $model->countAll(),
            'active_threats' => $model->where('status', 'Active')->countAllResults(),
            'high_severity' => $model->where('severity', 'High')->countAllResults(),
            'recent_24h' => $model->where('created_at >=', date('Y-m-d H:i:s', strtotime('-24 hours')))->countAllResults()
        ];
        
        return view('threats/index', $data);
    }

    public function create()
    {
        $data['title'] = 'Add Threat Intelligence';
        return view('threats/create', $data);
    }

    public function store()
    {
        $model = new ThreatModel();
        
        $data = [
            'ioc_type' => $this->request->getPost('ioc_type'),
            'ioc_value' => $this->request->getPost('ioc_value'),
            'threat_type' => $this->request->getPost('threat_type'),
            'severity' => $this->request->getPost('severity'),
            'confidence' => $this->request->getPost('confidence'),
            'source' => $this->request->getPost('source'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'first_seen' => $this->request->getPost('first_seen'),
            'last_seen' => $this->request->getPost('last_seen'),
            'tags' => $this->request->getPost('tags')
        ];
        
        if ($model->insert($data)) {
            return redirect()->to('/threats')->with('success', 'IOC berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan IOC');
        }
    }

    public function show($id)
    {
        $model = new ThreatModel();
        $threat = $model->find($id);
        
        if (!$threat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('IOC tidak ditemukan');
        }
        
        $data['title'] = 'Threat Intelligence Detail';
        $data['threat'] = $threat;
        return view('threats/show', $data);
    }

    public function edit($id)
    {
        $model = new ThreatModel();
        $threat = $model->find($id);
        
        if (!$threat) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('IOC tidak ditemukan');
        }
        
        $data['title'] = 'Edit Threat Intelligence';
        $data['threat'] = $threat;
        return view('threats/edit', $data);
    }

    // Updated to match the new route: /threats/(:num) with POST method and _method=PUT
    public function update($id)
    {
        $model = new ThreatModel();
        
        $data = [
            'ioc_type' => $this->request->getPost('ioc_type'),
            'ioc_value' => $this->request->getPost('ioc_value'),
            'threat_type' => $this->request->getPost('threat_type'),
            'severity' => $this->request->getPost('severity'),
            'confidence' => $this->request->getPost('confidence'),
            'source' => $this->request->getPost('source'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'first_seen' => $this->request->getPost('first_seen'),
            'last_seen' => $this->request->getPost('last_seen'),
            'tags' => $this->request->getPost('tags')
        ];
        
        if ($model->update($id, $data)) {
            return redirect()->to('/threats')->with('success', 'IOC berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate IOC');
        }
    }

    // Updated to match the new route: /threats/delete/(:num) with GET method
    public function delete($id)
    {
        $model = new ThreatModel();
        
        if ($model->delete($id)) {
            return redirect()->to('/threats')->with('success', 'IOC berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus IOC');
        }
    }

    public function search()
    {
        $model = new ThreatModel();
        $query = $this->request->getGet('q');
        
        if ($query) {
            $threats = $model->like('ioc_value', $query)
                           ->orLike('description', $query)
                           ->orLike('source', $query)
                           ->findAll();
        } else {
            $threats = [];
        }
        
        $data['title'] = 'Search Threat Intelligence';
        $data['threats'] = $threats;
        $data['query'] = $query;
        
        return view('threats/search', $data);
    }
}