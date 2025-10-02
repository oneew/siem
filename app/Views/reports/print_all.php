<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Keamanan Komprehensif</title>
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
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid #666;
            padding-bottom: 3px;
            margin-bottom: 10px;
        }

        .subsection-title {
            font-size: 14px;
            font-weight: bold;
            margin: 15px 0 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            page-break-inside: auto;
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

        tr {
            page-break-inside: avoid;
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

        .page-break {
            page-break-before: always;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
        }

        .stat-value {
            font-size: 20px;
            font-weight: bold;
            margin: 5px 0;
        }

        .stat-label {
            font-size: 12px;
            color: #6c757d;
        }

        @media print {
            .page-break {
                page-break-before: always;
            }
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
            <div class="report-title">LAPORAN KEAMANAN KOMPREHENSIF</div>
            <div class="report-subtitle">TIM KEAMANAN TI</div>
            <div class="report-subtitle">ORGANISASI ANDA</div>
            <div class="report-subtitle">Tanggal: <?= date('d M Y') ?></div>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Executive Summary -->
    <div class="section">
        <div class="section-title">RINGKASAN EKSEKUTIF</div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value"><?= esc($executive_summary['total_incidents'] ?? 0) ?></div>
                <div class="stat-label">Total Insiden</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= esc($executive_summary['open_incidents'] ?? 0) ?></div>
                <div class="stat-label">Insiden Terbuka</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= esc($executive_summary['critical_incidents'] ?? 0) ?></div>
                <div class="stat-label">Insiden Kritis</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= esc($executive_summary['active_alerts'] ?? 0) ?></div>
                <div class="stat-label">Alert Aktif</div>
            </div>
        </div>

        <?php if (isset($risk_metrics)): ?>
            <div class="subsection-title">METRIK RISIKO</div>
            <table>
                <tr>
                    <th>Skor Risiko Keseluruhan</th>
                    <td><?= esc($risk_metrics['overall_risk_score'] ?? 'N/A') ?>/10</td>
                </tr>
                <tr>
                    <th>Postur Keamanan</th>
                    <td><?= esc($risk_metrics['security_posture'] ?? 'N/A') ?></td>
                </tr>
                <tr>
                    <th>Skor Kepatuhan</th>
                    <td><?= esc($risk_metrics['compliance_score'] ?? 'N/A') ?>%</td>
                </tr>
                <tr>
                    <th>Skor Kerentanan</th>
                    <td><?= esc($risk_metrics['vulnerability_score'] ?? 'N/A') ?>/10</td>
                </tr>
            </table>
        <?php endif; ?>
    </div>

    <div class="page-break"></div>

    <!-- Incidents Report -->
    <div class="section">
        <div class="section-title">LAPORAN INSIDEN</div>

        <?php if (isset($incidents_stats)): ?>
            <div class="subsection-title">STATISTIK INSIDEN</div>
            <table>
                <tr>
                    <th>Kategori</th>
                    <th>Kritis</th>
                    <th>Tinggi</th>
                    <th>Sedang</th>
                    <th>Rendah</th>
                </tr>
                <tr>
                    <td>Berdasarkan Tingkat Keparahan</td>
                    <td><?= esc($incidents_stats['by_severity']['Critical'] ?? 0) ?></td>
                    <td><?= esc($incidents_stats['by_severity']['High'] ?? 0) ?></td>
                    <td><?= esc($incidents_stats['by_severity']['Medium'] ?? 0) ?></td>
                    <td><?= esc($incidents_stats['by_severity']['Low'] ?? 0) ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>Kategori</th>
                    <th>Terbuka</th>
                    <th>Dalam Proses</th>
                    <th>Tertutup</th>
                </tr>
                <tr>
                    <td>Berdasarkan Status</td>
                    <td><?= esc($incidents_stats['by_status']['Open'] ?? 0) ?></td>
                    <td><?= esc($incidents_stats['by_status']['In Progress'] ?? 0) ?></td>
                    <td><?= esc($incidents_stats['by_status']['Closed'] ?? 0) ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <div class="subsection-title">DAFTAR INSIDEN</div>
        <?php if (!empty($incidents)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Tingkat Keparahan</th>
                        <th>Status</th>
                        <th>Tipe Serangan</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incidents as $incident): ?>
                        <tr>
                            <td><?= esc($incident['id']) ?></td>
                            <td><?= esc($incident['title']) ?></td>
                            <td><?= esc($incident['severity']) ?></td>
                            <td><?= esc($incident['status']) ?></td>
                            <td><?= esc($incident['attack_type'] ?? 'N/A') ?></td>
                            <td><?= isset($incident['created_at']) ? date('d M Y H:i', strtotime($incident['created_at'])) : 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada insiden yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="page-break"></div>

    <!-- Threats Report -->
    <div class="section">
        <div class="section-title">LAPORAN ANCAMAN</div>

        <?php if (isset($threats_stats)): ?>
            <div class="subsection-title">STATISTIK ANCAMAN</div>
            <table>
                <tr>
                    <th>Kategori</th>
                    <th>IP</th>
                    <th>Domain</th>
                    <th>Hash</th>
                    <th>URL</th>
                </tr>
                <tr>
                    <td>Berdasarkan Tipe IOC</td>
                    <td><?= esc($threats_stats['by_type']['IP'] ?? 0) ?></td>
                    <td><?= esc($threats_stats['by_type']['Domain'] ?? 0) ?></td>
                    <td><?= esc($threats_stats['by_type']['Hash'] ?? 0) ?></td>
                    <td><?= esc($threats_stats['by_type']['URL'] ?? 0) ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <div class="subsection-title">DAFTAR ANCAMAN</div>
        <?php if (!empty($threats)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Indikator</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($threats as $threat): ?>
                        <tr>
                            <td><?= esc($threat['id']) ?></td>
                            <td><?= esc($threat['ioc_value']) ?></td>
                            <td><?= esc($threat['ioc_type']) ?></td>
                            <td><?= esc($threat['description']) ?></td>
                            <td><?= esc($threat['status']) ?></td>
                            <td><?= isset($threat['created_at']) ? date('d M Y H:i', strtotime($threat['created_at'])) : 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada ancaman yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="page-break"></div>

    <!-- Alerts Report -->
    <div class="section">
        <div class="section-title">LAPORAN ALERT</div>

        <div class="subsection-title">DAFTAR ALERT</div>
        <?php if (!empty($alerts)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Alamat IP Sumber</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alerts as $alert): ?>
                        <tr>
                            <td><?= esc($alert['id']) ?></td>
                            <td><?= esc($alert['alert_name']) ?></td>
                            <td><?= esc($alert['priority']) ?></td>
                            <td><?= esc($alert['status']) ?></td>
                            <td><?= esc($alert['source_ip'] ?? 'N/A') ?></td>
                            <td><?= isset($alert['created_at']) ? date('d M Y H:i', strtotime($alert['created_at'])) : 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada alert yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="page-break"></div>

    <!-- Assets Report -->
    <div class="section">
        <div class="section-title">LAPORAN ASET</div>

        <div class="subsection-title">DAFTAR ASET</div>
        <?php if (!empty($assets)): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Alamat IP</th>
                        <th>Status Kerentanan</th>
                        <th>Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($assets as $asset): ?>
                        <tr>
                            <td><?= esc($asset['id']) ?></td>
                            <td><?= esc($asset['asset_name']) ?></td>
                            <td><?= esc($asset['asset_type']) ?></td>
                            <td><?= esc($asset['ip_address'] ?? 'N/A') ?></td>
                            <td><?= esc($asset['vulnerability_status'] ?? 'N/A') ?></td>
                            <td><?= isset($asset['created_at']) ? date('d M Y H:i', strtotime($asset['created_at'])) : 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada aset yang ditemukan.</p>
        <?php endif; ?>
    </div>

    <div class="signature-section">
        <div class="signature-box">
            <div>Dibuat oleh,</div>
            <div class="signature-line"></div>
            <div>Nama: ________________________</div>
            <div>Jabatan: Analis Keamanan TI</div>
            <div>Tanggal: <?= date('d M Y') ?></div>
        </div>

        <div class="signature-box">
            <div>Disetujui oleh,</div>
            <div class="signature-line"></div>
            <div>Nama: ________________________</div>
            <div>Jabatan: Manajer Keamanan TI</div>
            <div>Tanggal: <?= date('d M Y') ?></div>
        </div>
    </div>

    <div class="footer">
        <div>Dokumen ini merupakan milik organisasi dan mengandung informasi rahasia. Distribusi hanya untuk pihak yang berwenang.</div>
        <div class="page-number"></div>
    </div>
</body>

</html>