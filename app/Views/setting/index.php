<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2 class="text-xl font-semibold mb-4">Pengaturan Sistem</h2>
<form method="post" action="/settings/update" class="space-y-4">
  <?php foreach($settings as $s): ?>
  <div>
    <label class="block font-medium"><?= esc(ucwords(str_replace('_',' ',$s['key']))) ?></label>
    <input type="text" name="<?= esc($s['key']) ?>" value="<?= esc($s['value']) ?>" class="form-input w-full border rounded p-2">
  </div>
  <?php endforeach; ?>
  <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
</form>

<?= $this->endSection() ?>
