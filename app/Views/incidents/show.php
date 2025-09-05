<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Detail Incident</h2>
<table class="table table-bordered">
  <tr><th>Judul</th><td><?= esc($incident['title']) ?></td></tr>
  <tr><th>Deskripsi</th><td><?= esc($incident['description']) ?></td></tr>
  <tr><th>IP</th><td><?= esc($incident['source_ip']) ?></td></tr>
  <tr><th>Severity</th><td><?= esc($incident['severity']) ?></td></tr>
  <tr><th>Status</th><td><?= esc($incident['status']) ?></td></tr>
  <tr><th>Dibuat</th><td><?= esc($incident['created_at']) ?></td></tr>
  <tr><th>Update</th><td><?= esc($incident['updated_at']) ?></td></tr>
  <?php if($incident['resolved_at']): ?>
    <tr><th>Selesai</th><td><?= esc($incident['resolved_at']) ?></td></tr>
  <?php endif; ?>
  <?php if($incident['resolution_notes']): ?>
    <tr><th>Catatan Penyelesaian</th><td><?= esc($incident['resolution_notes']) ?></td></tr>
  <?php endif; ?>
</table>

<a href="/reports/incident/<?= $incident['id'] ?>" class="btn btn-success">Export PDF</a>
<a href="/incidents/edit/<?= $incident['id'] ?>" class="btn btn-warning">Edit</a>
<a href="/incidents" class="btn btn-secondary">Kembali</a>

<?= $this->endSection() ?>
