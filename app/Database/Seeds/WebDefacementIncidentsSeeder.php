<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WebDefacementIncidentsSeeder extends Seeder
{
    public function run()
    {
        $incidents = [
            [
                'title' => 'Website Perusahaan Terkena Defacement',
                'description' => 'Website perusahaan menunjukkan halaman yang telah diubah oleh pihak tidak berwenang. Konten asli telah diganti dengan pesan politik. Serangan ini terdeteksi pada pukul 02:30 pagi melalui monitoring sistem.',
                'source_ip' => '202.50.10.15',
                'attack_type' => 'Web Defacement',
                'severity' => 'High',
                'status' => 'In Progress',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-12 hours'))
            ],
            [
                'title' => 'Portal Berita Mengalami Perubahan Konten',
                'description' => 'Halaman depan portal berita menunjukkan konten yang telah diubah. Gambar dan teks telah diganti dengan propaganda kelompok peretas. Situs tampak normal kembali setelah 4 jam tanpa intervensi.',
                'source_ip' => '180.250.30.45',
                'attack_type' => 'Web Defacement',
                'severity' => 'Medium',
                'status' => 'Closed',
                'resolution_notes' => 'Website dipulihkan dari backup harian. Keamanan server ditingkatkan dengan menerapkan patch terbaru dan mengkonfigurasi WAF.',
                'resolved_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ]
        ];

        // Using insertBatch without specifying columns to avoid column count mismatch
        $this->db->table('incidents')->insertBatch($incidents);
        echo "Web defacement incidents seeded successfully!\n";
    }
}
