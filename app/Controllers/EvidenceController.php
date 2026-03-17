<?php

namespace App\Controllers;

use App\Models\EvidenceModel;

class EvidenceController extends BaseController
{
    protected $evidenceModel;

    public function __construct()
    {
        $this->evidenceModel = new EvidenceModel();
    }

    public function index()
    {
        $data['title'] = 'Digital Evidence Locker (Chain of Custody)';
        return view('dfir/evidence/index', $data);
    }

    // --- AJAX Endpoints ---

    public function get_all()
    {
        $evidence = $this->evidenceModel->orderBy('id', 'DESC')->findAll();
        return $this->response->setJSON(['data' => $evidence]);
    }

    public function get_evidence($id)
    {
        $evidence = $this->evidenceModel->find($id);
        if ($evidence) {
            return $this->response->setJSON(['status' => 'success', 'data' => $evidence]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak ditemukan.']);
    }

    public function store()
    {
        $file = $this->request->getFile('evidence_file');
        
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'File barang bukti tidak valid.']);
        }

        // Generate SHA-256 of the file content
        $hash = hash_file('sha256', $file->getTempName());
        
        // Simpan file secara aman (contoh di folder khusus evidence)
        $newName = $file->getRandomName();
        $uploadPath = WRITEPATH . 'uploads/evidence/';
        
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        
        $file->move($uploadPath, $newName);

        $data = [
            'case_id'          => $this->request->getPost('case_id'),
            'evidence_name'    => $this->request->getPost('evidence_name'),
            'file_hash_sha256' => $hash, // Automatic integrity calculation
            'acquired_date'    => $this->request->getPost('acquired_date'),
            'uploaded_by'      => $this->request->getPost('uploaded_by') ?? 'DFIR Responder',
        ];

        if ($this->evidenceModel->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success', 
                'message' => 'Barang Bukti terkunci dengan aman di Vault.',
                'hash' => $hash
            ]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
    }

    public function update()
    {
        // Dalam konteks digital forensics, Chain of Custody harusnya immutable (hanya bisa read/append log)
        // Namun, jika diperlukan update meta doang (kecuali HASH):
        $id = $this->request->getPost('id');
        
        // We do not update the hash or the file!
        $data = [
            'case_id'       => $this->request->getPost('case_id'),
            'evidence_name' => $this->request->getPost('evidence_name'),
            'acquired_date' => $this->request->getPost('acquired_date'),
        ];

        if ($this->evidenceModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Metadata bukti berhasil diperbarui. HASH terjaga secara otomatis.']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui metadata.']);
    }

    public function delete($id)
    {
        // Secara ideal di DFIR, delete harus disable / di flag delete bukan hard delete. Tapi untuk CRUD basic:
        if ($this->evidenceModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Bukti berhasil dihapus.']);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus bukti.']);
    }
}
