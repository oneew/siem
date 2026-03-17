<?php

namespace App\Controllers;

use App\Models\PlaybookModel;

class PlaybookController extends BaseController
{
    protected $playbookModel;

    public function __construct()
    {
        $this->playbookModel = new PlaybookModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Red Team Playbooks',
            'playbooks' => $this->playbookModel->findAll()
        ];
        return view('playbooks/v2_index', $data);
    }

    public function store()
    {
        $data = [
            'mitre_attack_id'  => $this->request->getPost('mitre_attack_id') ?? '',
            'tactic_name'      => $this->request->getPost('tactic_name') ?? '',
            'description'      => $this->request->getPost('description') ?? '',
            'command_examples' => $this->request->getPost('command_examples') ?? '',
        ];

        if ($this->playbookModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Playbook berhasil ditambahkan!']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan playbook.']);
    }

    public function delete($id)
    {
        if ($this->playbookModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Playbook berhasil dihapus!']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus playbook.']);
    }
}
