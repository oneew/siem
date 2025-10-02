<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Kejadian Serangan Siber (Web Defacement)</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        .logo {
            float: left;
            width: 80px;
            height: 80px;
            margin-right: 15px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
        }

        .report-subtitle {
            font-size: 14px;
            margin: 5px 0;
        }

        .clear {
            clear: both;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            border-bottom: 1px solid #666;
            padding-bottom: 3px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #eee;
            font-weight: bold;
        }

        .finding-high {
            background-color: #ffebee;
        }

        .finding-medium {
            background-color: #fff3e0;
        }

        .finding-low {
            background-color: #f1f8e9;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            width: 45%;
            text-align: center;
        }

        .signature-line {
            height: 1px;
            background-color: #000;
            margin: 40px 0 10px 0;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #ccc;
            padding: 5px 0;
        }

        .page-number:before {
            content: "Halaman " counter(page);
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <!-- Logo would be placed here in a real implementation -->
            <div style="border: 1px solid #000; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 8px;">
                LOGO
            </div>
        </div>
        <div class="report-header-text">
            <div class="report-title">LAPORAN KEJADIAN SERANGAN SIBER</div>
            <div class="report-subtitle">(WEB DEFACEMENT)</div>
            <div class="report-subtitle">TIM KEAMANAN TI</div>
            <div class="report-subtitle">ORGANISASI ANDA</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="section">
        <div class="section-title">INFORMASI DASAR</div>
        <table>
            <tr>
                <th>ID Insiden</th>
                <td colspan="3"><?= esc($incident['id']) ?></td>
            </tr>
            <tr>
                <th>Tanggal/Waktu Kejadian</th>
                <td><?= isset($incident['created_at']) ? date('d M Y H:i', strtotime($incident['created_at'])) : 'N/A' ?></td>
                <th>Tanggal/Waktu Terdeteksi</th>
                <td><?= isset($incident['updated_at']) ? date('d M Y H:i', strtotime($incident['updated_at'])) : 'N/A' ?></td>
            </tr>
            <tr>
                <th>Nama Website yang Terkena</th>
                <td><?= esc($incident['title']) ?></td>
                <th>Alamat IP Server</th>
                <td><?= esc($incident['source_ip'] ?? 'N/A') ?></td>
            </tr>
            <tr>
                <th>Tingkat Keparahan</th>
                <td>
                    <?php
                    switch ($incident['severity']) {
                        case 'Critical':
                            echo '<span style="color: #d32f2f; font-weight: bold;">KRITIS</span>';
                            break;
                        case 'High':
                            echo '<span style="color: #f57c00; font-weight: bold;">TINGGI</span>';
                            break;
                        case 'Medium':
                            echo '<span style="color: #fbc02d; font-weight: bold;">SEDANG</span>';
                            break;
                        case 'Low':
                            echo '<span style="color: #388e3c; font-weight: bold;">RENDAH</span>';
                            break;
                        default:
                            echo esc($incident['severity']);
                    }
                    ?>
                </td>
                <th>Status Insiden</th>
                <td><?= esc($incident['status']) ?></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">DESKRIPSI KEJADIAN</div>
        <p><?= esc($incident['description']) ?></p>
    </div>

    <div class="section">
        <div class="section-title">INFORMASI TAMBAHAN</div>
        <table>
            <tr>
                <th>Tipe Serangan</th>
                <td><?= esc($incident['attack_type'] ?? 'Web Defacement') ?></td>
            </tr>
            <tr>
                <th>Alamat IP Sumber</th>
                <td><?= esc($incident['source_ip'] ?? 'N/A') ?></td>
            </tr>
            <?php if (!empty($incident['resolution_notes'])): ?>
                <tr>
                    <th>Catatan Penyelesaian</th>
                    <td><?= esc($incident['resolution_notes']) ?></td>
                </tr>
            <?php endif; ?>
            <?php if (!empty($incident['resolved_at'])): ?>
                <tr>
                    <th>Tanggal Penyelesaian</th>
                    <td><?= date('d M Y H:i', strtotime($incident['resolved_at'])) ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="section">
        <div class="section-title">TEMUAN KEAMANAN</div>
        <table>
            <tr>
                <th>Temuan</th>
                <th>Tingkat Risiko</th>
                <th>Deskripsi</th>
                <th>Rekomendasi</th>
            </tr>
            <tr class="finding-high">
                <td>Web Defacement Terdeteksi</td>
                <td>Tinggi</td>
                <td>Halaman web telah diubah oleh pihak yang tidak berwenang, menunjukkan kemungkinan kompromi sistem.</td>
                <td>
                    1. Isolasi server dari jaringan<br>
                    2. Lakukan forensic analysis<br>
                    3. Periksa log sistem<br>
                    4. Pulihkan dari backup bersih
                </td>
            </tr>
            <tr class="finding-medium">
                <td>Kemungkinan Backdoor</td>
                <td>Sedang</td>
                <td>Adanya kemungkinan backdoor yang ditinggalkan penyerang untuk akses berkelanjutan.</td>
                <td>
                    1. Lakukan scanning malware<br>
                    2. Periksa file sistem<br>
                    3. Ubah semua credential<br>
                    4. Pantau aktivitas mencurigakan
                </td>
            </tr>
            <tr class="finding-medium">
                <td>Kerentanan Web</td>
                <td>Sedang</td>
                <td>Kemungkinan adanya kerentanan pada aplikasi web yang dieksploitasi (misalnya file upload, SQL injection).</td>
                <td>
                    1. Audit keamanan aplikasi<br>
                    2. Update semua komponen<br>
                    3. Terapkan WAF<br>
                    4. Lakukan penetration testing
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">INVESTIGASI DAN ANALISIS</div>
        <p>Berdasarkan investigasi awal, ditemukan bahwa website telah mengalami perubahan konten oleh pihak yang tidak berwenang. Serangan ini kemungkinan dilakukan melalui eksploitasi kerentanan pada aplikasi web. Tim keamanan telah mengambil langkah-langkah mitigasi awal dengan mengisolasi server dan memulai proses forensic analysis.</p>

        <p>Langkah-langkah yang telah dilakukan:</p>
        <ol>
            <li>Pengisolasian server dari jaringan untuk mencegah penyebaran</li>
            <li>Pembuatan forensic image untuk analisis lebih lanjut</li>
            <li>Pemeriksaan log sistem dan aplikasi</li>
            <li>Identifikasi titik masuk penyerang</li>
            <li>Pemberitahuan kepada stakeholder terkait</li>
        </ol>
    </div>

    <div class="section">
        <div class="section-title">REKOMENDASI</div>
        <p>Untuk mencegah terjadinya insiden serupa di masa depan, disarankan untuk:</p>
        <ol>
            <li><strong>Pemulihan Sistem:</strong> Pulihkan website dari backup bersih yang diverifikasi</li>
            <li><strong>Patch Management:</strong> Pastikan semua komponen sistem dan aplikasi terbaru</li>
            <li><strong>Web Application Firewall:</strong> Terapkan WAF untuk melindungi aplikasi web</li>
            <li><strong>Security Audit:</strong> Lakukan audit keamanan menyeluruh terhadap aplikasi web</li>
            <li><strong>Monitoring:</strong> Tingkatkan monitoring dan alerting untuk mendeteksi aktivitas mencurigakan</li>
            <li><strong>Training:</strong> Berikan pelatihan keamanan kepada tim pengembang</li>
        </ol>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div>Dibuat oleh,</div>
            <div class="signature-line"></div>
            <div>Nama: ________________________</div>
            <div>Jabatan: Analis Keamanan TI</div>
            <div>Tanggal: ______________________</div>
        </div>

        <div class="signature-box">
            <div>Disetujui oleh,</div>
            <div class="signature-line"></div>
            <div>Nama: ________________________</div>
            <div>Jabatan: Manajer Keamanan TI</div>
            <div>Tanggal: ______________________</div>
        </div>
    </div>

    <div class="footer">
        <div>Dokumen ini merupakan milik organisasi dan mengandung informasi rahasia. Distribusi hanya untuk pihak yang berwenang.</div>
        <div class="page-number"></div>
    </div>
</body>

</html>