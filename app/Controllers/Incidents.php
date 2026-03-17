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
        $model = new IncidentModel();
        $post = $this->request->getPost();
        // Normalize closed -> resolved_at
        if (isset($post['status']) && $post['status'] === 'Closed' && empty($post['resolved_at'])) {
            $post['resolved_at'] = date('Y-m-d H:i:s');
        }
        $model->save($post);
        return redirect()->to('/incidents')->with('success','Incident berhasil ditambahkan');
    }

    public function show($id)
    {
        $model = new IncidentModel();
        $incident = $model->find($id);
        if (!$incident) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Incident tidak ditemukan');
        }
        return view('incidents/show', ['incident' => $incident]);
    }

    public function edit($id)
    {
        $model = new IncidentModel();
        $incident = $model->find($id);
        if (!$incident) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Incident tidak ditemukan');
        }
        return view('incidents/edit', ['incident' => $incident]);
    }

    public function update($id)
    {
        $model = new IncidentModel();
        $post = $this->request->getPost();
        if (isset($post['status']) && $post['status'] === 'Closed' && empty($post['resolved_at'])) {
            $post['resolved_at'] = date('Y-m-d H:i:s');
        }
        $model->update($id, $post);
        return redirect()->to('/incidents')->with('success','Incident berhasil diupdate');
    }

    public function delete($id)
    {
        $model = new IncidentModel();
        $model->delete($id);
        return redirect()->to('/incidents')->with('success','Incident berhasil dihapus');
    }
}
