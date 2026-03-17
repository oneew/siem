<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2, h3 { text-align: center; margin: 0; }
    table { width: 100%; border-collapse: collapse; margin-top: 15px; }
    table, th, td { border: 1px solid #000; }
    th, td { padding: 8px; text-align: left; vertical-align: top; }
    .meta { margin-top: 10px; }
  </style>
</head>
<body>
  <h2>Laporan Insiden Keamanan</h2>
  <h3>Incident ID: <?= $incident['id'] ?></h3>

  <table>
    <tr><th>Judul</th><td><?= esc($incident['title']) ?></td></tr>
    <tr><th>Deskripsi</th><td><?= esc($incident['description']) ?></td></tr>
    <tr><th>Sumber IP</th><td><?= esc($incident['source_ip']) ?></td></tr>
    <tr><th>Severity</th><td><?= esc($incident['severity']) ?></td></tr>
    <tr><th>Status</th><td><?= esc($incident['status']) ?></td></tr>
    <tr><th>Dibuat</th><td><?= esc($incident['created_at']) ?></td></tr>
    <tr><th>Update Terakhir</th><td><?= esc($incident['updated_at']) ?></td></tr>
    <?php if($incident['resolved_at']): ?>
      <tr><th>Tanggal Selesai</th><td><?= esc($incident['resolved_at']) ?></td></tr>
    <?php endif; ?>
    <?php if($incident['resolution_notes']): ?>
      <tr><th>Catatan Penyelesaian</th><td><?= esc($incident['resolution_notes']) ?></td></tr>
    <?php endif; ?>
  </table>
</body>
</html>
