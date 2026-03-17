<?php

namespace App\Controllers;

use App\Models\TargetModel;

class TargetController extends BaseController
{
    protected $targetModel;

    public function __construct()
    {
        $this->targetModel = new TargetModel();
    }

    public function index()
    {
        $data['title'] = 'Target Management (Red Team)';
        return view('redteam/targets/index', $data);
    }

    // --- AJAX Endpoints ---

    // Get all targets for DataTables
    public function get_all()
    {
        $targets = $this->targetModel->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $targets]);
    }

    // Get single target
    public function get_target($id)
    {
        $target = $this->targetModel->find($id);
        if ($target) {
            return $this->response->setJSON(['status' => 'success', 'data' => $target]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
    }

    // Store new target via AJAX
    public function store()
    {
        $data = [
            'target_name'       => $this->request->getPost('target_name'),
            'ip_address_or_url' => $this->request->getPost('ip_address_or_url'),
            'environment'       => $this->request->getPost('environment'),
            'criticality_level' => $this->request->getPost('criticality_level'),
        ];

        if ($this->targetModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Target berhasil ditambahkan.']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menambahkan target.']);
    }

    // Update existing target via AJAX
    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'target_name'       => $this->request->getPost('target_name'),
            'ip_address_or_url' => $this->request->getPost('ip_address_or_url'),
            'environment'       => $this->request->getPost('environment'),
            'criticality_level' => $this->request->getPost('criticality_level'),
        ];

        if ($this->targetModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Target berhasil diperbarui.']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui target.']);
    }

    // Delete target via AJAX
    public function delete($id)
    {
        if ($this->targetModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Target berhasil dihapus.']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus target.']);
    }
}
