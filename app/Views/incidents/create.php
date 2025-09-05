<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Tambah Incident</h2>
<form method="post" action="/incidents/store" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Sumber IP</label>
    <input type="text" name="source_ip" class="form-control">
  </div>
  <div class="col-12">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4"></textarea>
  </div>
  <div class="col-md-4">
    <label class="form-label">Severity</label>
    <select name="severity" class="form-select">
      <option>Low</option><option>Medium</option><option>High</option><option>Critical</option>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
      <option>Open</option><option>In Progress</option><option>Closed</option>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Tanggal Selesai (opsional jika Closed)</label>
    <input type="datetime-local" name="resolved_at" class="form-control">
  </div>
  <div class="col-12">
    <label class="form-label">Catatan Penyelesaian</label>
    <textarea name="resolution_notes" class="form-control" rows="3"></textarea>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="/incidents" class="btn btn-secondary">Batal</a>
  </div>
</form>

<?= $this->endSection() ?>
