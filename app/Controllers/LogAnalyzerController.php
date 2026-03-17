<?php

namespace App\Controllers;

class LogAnalyzerController extends BaseController
{
    public function index()
    {
        $data['title'] = 'AI Log Analyzer Assistant';
        return view('ainexus/log_analyzer/index', $data);
    }

    public function analyze()
    {
        $rawLogs = $this->request->getPost('raw_logs');
        
        if (empty(trim($rawLogs))) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Input log tidak boleh kosong.'
            ]);
        }

        // --- Simulasi Pemrosesan AI GeN AI ---
        // Deteksi pola sederhana berbasis Regex untuk simulasi respons pintar
        
        $insights = [];
        $dangerLevel = 'Low';
        $recommended = 'Tidak ada anomali kritikal ditemukan. Lanjutkan pemantauan rutin.';
        
        $upperLogs = strtoupper($rawLogs);
        
        if (strpos($upperLogs, 'UNION SELECT') !== false || strpos($upperLogs, 'OR 1=1') !== false) {
            $dangerLevel = 'Critical';
            $insights[] = [
                'type' => 'SQL Injection (SQLi)',
                'description' => 'Terdeteksi upaya manipulasi query database. Modifikasi parameter ditujukan untuk membypass autentikasi atau mengekstraksi data struktur internal.'
            ];
            $recommended = 'Blokir IP penyerang segera. Tinjau kembali penggunaan Prepared Statements (PDO) di level aplikasi.';
        }
        
        if (strpos($upperLogs, 'SCRIPT') !== false && (strpos($upperLogs, '<') !== false || strpos($upperLogs, '%3C') !== false)) {
            $dangerLevel = ($dangerLevel === 'Critical') ? 'Critical' : 'High';
            $insights[] = [
                'type' => 'Cross-Site Scripting (XSS)',
                'description' => 'Terdeteksi injeksi payload JavaScript. Penyerang mencoba mengeksekusi script berbayar pada sisi klien atau mencuri session cookie.'
            ];
            $recommended = 'Pastikan fungsi escape output (esc()) diterapkan pada semua refleksi input pengguna. Terapkan Content Security Policy (CSP).';
        }

        if (strpos($upperLogs, '../') !== false || strpos($upperLogs, 'ETC/PASSWD') !== false) {
            $dangerLevel = 'Critical';
            $insights[] = [
                'type' => 'Local File Inclusion (LFI) / Path Traversal',
                'description' => 'Akses mencurigakan mencoba melompat ke luar direktori web root menuju file konfidensial sistem operasi.'
            ];
            $recommended = 'Kunci konfigurasi open_basedir pada PHP dan pastikan fungsi path resolving disanitasi ketat dari karakter rotasi direktori.';
        }

        if (empty($insights)) {
            $insights[] = [
                'type' => 'Normal Traffic / Noise',
                'description' => 'Pola log terlihat normal. Beberapa error mungkin berasal dari scanner bot generik atau 404 Not Found yang wajar.'
            ];
        }

        // Artificial delay for realism
        sleep(1);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Analisis AI selesai.',
            'analysis' => [
                'threat_level' => $dangerLevel,
                'insights' => $insights,
                'recommended_actions' => $recommended
            ]
        ]);
    }
}
