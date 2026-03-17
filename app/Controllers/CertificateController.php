<?php

namespace App\Controllers;

class CertificateController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Sertifikat Elektronik & TTE';
        return view('crypto/certificate/index', $data);
    }

    public function sign()
    {
        $file = $this->request->getFile('document');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Dokumen tidak valid.']);
        }

        // Placeholder untuk integrasi backend BSrE / OpenSSL API
        // $apiResponse = $this->callBsreApi($file, $this->request->getPost('passphrase'));

        // Mock response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Dokumen berhasil ditandatangani secara elektronik.',
            'signed_file_url' => '#' // Mock download link
        ]);
    }

    public function verify()
    {
        $file = $this->request->getFile('signed_document');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Dokumen tidak valid.']);
        }

        // Placeholder untuk validasi sertifikat SSL/TTE
        // Mock response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Verifikasi Selesai. Tanda tangan VALID.',
            'details' => [
                'signer' => 'Pemerintah Otoritas Sertifikat',
                'timestamp' => date('Y-m-d H:i:s'),
                'integrity' => 'Verified - Dokumen tidak berubah sejak ditandatangani.'
            ]
        ]);
    }
}
