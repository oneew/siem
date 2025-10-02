<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Insiden Keamanan</title>
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
            <div class="report-title">LAPORAN INSIDEN KEAMANAN</div>
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
                <th>Judul Insiden</th>
                <td><?= esc($incident['title']) ?></td>
                <th>Alamat IP Sumber</th>
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
            <?php if (!empty($incident['attack_type'])): ?>
                <tr>
                    <th>Tipe Serangan</th>
                    <td colspan="3"><?= esc($incident['attack_type']) ?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="section">
        <div class="section-title">DESKRIPSI KEJADIAN</div>
        <p><?= esc($incident['description']) ?></p>
    </div>

    <?php if (!empty($incident['resolution_notes']) || !empty($incident['resolved_at'])): ?>
        <div class="section">
            <div class="section-title">INFORMASI PENYELESAIAN</div>
            <table>
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
    <?php endif; ?>

    <?php if (!empty($incident['evidence_collected'])): ?>
        <div class="section">
            <div class="section-title">BERKAS BUKTI</div>
            <?php
            $evidenceFiles = json_decode($incident['evidence_collected'], true);
            if (!empty($evidenceFiles) && is_array($evidenceFiles)):
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nama File</th>
                            <th>Tipe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($evidenceFiles as $file): ?>
                            <tr>
                                <td><?= esc($file) ?></td>
                                <td>
                                    <?php
                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                    echo esc(strtoupper($fileExtension));
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Tidak ada berkas bukti.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

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