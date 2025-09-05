<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="max-w-lg mx-auto bg-white shadow p-6 rounded">
  <h2 class="text-xl font-semibold mb-4">Ganti Password</h2>

  <?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
      <?= session()->getFlashdata('error') ?>
    </div>
  <?php endif; ?>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 text-green-700 p-2 mb-3 rounded">
      <?= session()->getFlashdata('success') ?>
    </div>
  <?php endif; ?>

  <form method="post" action="/change-password/update" class="space-y-4">
    <div>
      <label class="block mb-1">Password Lama</label>
      <input type="password" name="old_password" class="w-full border p-2 rounded" required>
    </div>
    <div>
      <label class="block mb-1">Password Baru</label>
      <input type="password" name="new_password" class="w-full border p-2 rounded" required>
    </div>
    <div>
      <label class="block mb-1">Konfirmasi Password Baru</label>
      <input type="password" name="confirm_password" class="w-full border p-2 rounded" required>
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Simpan</button>
  </form>
</div>

<?= $this->endSection() ?>
