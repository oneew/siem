<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2>Edit Incident</h2>
<form method="post" action="/incidents/update/<?= $incident['id'] ?>" class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" value="<?= esc($incident['title']) ?>" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Sumber IP</label>
    <input type="text" name="source_ip" class="form-control" value="<?= esc($incident['source_ip']) ?>">
  </div>
  <div class="col-12">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4"><?= esc($incident['description']) ?></textarea>
  </div>
  <div class="col-md-4">
    <label class="form-label">Severity</label>
    <select name="severity" class="form-select">
      <?php foreach(['Low','Medium','High','Critical'] as $s): ?>
        <option value="<?= $s ?>" <?= $incident['severity']==$s?'selected':'' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
      <?php foreach(['Open','In Progress','Closed'] as $s): ?>
        <option value="<?= $s ?>" <?= $incident['status']==$s?'selected':'' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-4">
    <label class="form-label">Tanggal Selesai</label>
    <input type="datetime-local" name="resolved_at" class="form-control" value="<?= $incident['resolved_at'] ? date('Y-m-d\TH:i', strtotime($incident['resolved_at'])) : '' ?>">
  </div>
  <div class="col-12">
    <label class="form-label">Catatan Penyelesaian</label>
    <textarea name="resolution_notes" class="form-control" rows="3"><?= esc($incident['resolution_notes']) ?></textarea>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/incidents" class="btn btn-secondary">Batal</a>
  </div>
</form>

<?= $this->endSection() ?>
