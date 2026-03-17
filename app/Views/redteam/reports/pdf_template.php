<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Uji Penetrasi - <?= htmlspecialchars($target['target_name']) ?></title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 12px; color: #333; line-height: 1.5; }
        .header { text-align: center; border-bottom: 2px solid #3b82f6; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #1e293b; font-size: 24px; }
        .header p { margin: 5px 0 0; color: #64748b; font-size: 14px; }
        .section-title { font-size: 16px; color: #1e293b; border-bottom: 1px solid #e2e8f0; padding-bottom: 5px; margin-top: 30px; margin-bottom: 15px; }
        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .info-table th, .info-table td { padding: 8px; text-align: left; border-bottom: 1px solid #f1f5f9; }
        .info-table th { width: 30%; color: #64748b; font-weight: bold; }
        .vuln-item { border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 15px; border-radius: 5px; page-break-inside: avoid; }
        .vuln-title { font-size: 14px; font-weight: bold; margin: 0 0 10px 0; }
        .badge { padding: 3px 8px; border-radius: 3px; font-size: 10px; font-weight: bold; color: white; display: inline-block; }
        .badge.critical { background-color: #ef4444; }
        .badge.high { background-color: #f97316; }
        .badge.medium { background-color: #eab308; color: #333; }
        .badge.low { background-color: #22c55e; }
        .badge.info { background-color: #3b82f6; }
        .desc-title { font-size: 11px; font-weight: bold; color: #64748b; margin-top: 10px; margin-bottom: 5px; text-transform: uppercase; }
        .desc-content { margin: 0; font-size: 12px; }
        .footer { position: fixed; bottom: -20px; left: 0; right: 0; height: 30px; text-align: center; font-size: 10px; color: #94a3b8; border-top: 1px solid #e2e8f0; padding-top: 10px; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

<div class="header">
    <h1>Laporan Uji Penetrasi (Penetration Testing)</h1>
    <p>Target: <strong><?= htmlspecialchars($target['target_name']) ?></strong></p>
    <p>Tanggal Laporan: <?= htmlspecialchars($report_date) ?></p>
</div>

<h2 class="section-title">Informasi Target</h2>
<table class="info-table">
    <tr>
        <th>Nama Sistem</th>
        <td><?= htmlspecialchars($target['target_name']) ?></td>
    </tr>
    <tr>
        <th>IP / URL</th>
        <td><?= htmlspecialchars($target['ip_address_or_url']) ?></td>
    </tr>
    <tr>
        <th>Lingkungan</th>
        <td><?= htmlspecialchars(ucfirst($target['environment'])) ?></td>
    </tr>
    <tr>
        <th>Tingkat Kekritisan</th>
        <td><?= htmlspecialchars($target['criticality_level']) ?></td>
    </tr>
</table>

<h2 class="section-title">Ringkasan Eksekutif</h2>
<p>Dokumen ini mencatat temuan dari asesmen keamanan yang telah dilaksanakan pada lingkungan target. Terdapat total <strong><?= count($vulns) ?></strong> kerentanan yang berhasil diidentifikasi selama masa uji penetrasi.</p>

<h2 class="section-title">Daftar Temuan Kerentanan</h2>

<?php if (empty($vulns)): ?>
    <p>Tidak ada kerentanan yang ditemukan pada target ini.</p>
<?php else: ?>
    <?php foreach ($vulns as $index => $v): ?>
        <?php
            $badgeColorClass = 'info';
            switch ($v['severity']) {
                case 'Critical': $badgeColorClass = 'critical'; break;
                case 'High': $badgeColorClass = 'high'; break;
                case 'Medium': $badgeColorClass = 'medium'; break;
                case 'Low': $badgeColorClass = 'low'; break;
            }
        ?>
        <div class="vuln-item">
            <h3 class="vuln-title">
                <?= ($index + 1) ?>. <?= htmlspecialchars($v['vulnerability_name']) ?> 
                <span class="badge <?= $badgeColorClass ?>" style="float: right;"><?= htmlspecialchars($v['severity']) ?> (CVSS: <?= htmlspecialchars($v['cvss_score']) ?>)</span>
            </h3>
            
            <div class="desc-title">Deskripsi</div>
            <p class="desc-content"><?= nl2br(htmlspecialchars($v['description'])) ?></p>
            
            <div class="desc-title">Rekomendasi (PoC/Remediation)</div>
            <p class="desc-content" style="font-family: monospace; background: #f8fafc; padding: 10px; border: 1px solid #e2e8f0; border-radius: 3px;">
                <?= nl2br(htmlspecialchars($v['proof_of_concept'] ?: 'Belum ada bukti yang disertakan.')) ?>
            </p>

            <div style="margin-top: 10px; font-size: 11px;">
                Status Saat Ini: <strong><?= htmlspecialchars($v['status']) ?></strong>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="footer">
    Dokumen Rahasia &bull; Dihasilkan Otomatis oleh Sistem Command Center SIEM &bull; Halaman <span class="pagenum"></span>
</div>

</body>
</html>
