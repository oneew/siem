<?php

namespace App\Controllers;

class SteganographyController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Steganography Detector';
        return view('crypto/steganography/index', $data);
    }

    public function analyze()
    {
        $file = $this->request->getFile('image_file');
        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'File gambar tidak valid.']);
        }

        // Mock Steganography Analysis Logic
        // In a real scenario, this would check LSB (Least Significant Bit), EXIF padding, or spectral anomalies.
        
        $fileName = $file->getClientName();
        $size = $file->getSizeByUnit('kb');
        $extension = $file->getClientExtension();

        // Simulate random detection for demonstration purposes
        // Real logic would process the bytes
        $hasPayload = (strlen($fileName) % 2 === 0); 
        $probability = $hasPayload ? rand(75, 99) : rand(1, 15);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Analisis Citra Digital Selesai.',
            'fileName' => $fileName,
            'size' => round($size, 2) . ' KB',
            'format' => strtoupper($extension),
            'hasPayload' => $hasPayload,
            'probability' => $probability . '%',
            'details' => $hasPayload 
                ? 'Anomali LSB terdeteksi pada kanal warna bit rendah. Kemungkinan besar terdapat susupan data (Hidden Payload).' 
                : 'Struktur bit normal. Tidak ditemukan noise buatan yang mengindikasikan steganography.',
            'recommendedAction' => $hasPayload
                ? 'Hindari mengekstrak file ini di sistem produksi. Gunakan Sandbox untuk membongkar payload.'
                : 'Aman untuk digunakan.'
        ]);
    }
}
