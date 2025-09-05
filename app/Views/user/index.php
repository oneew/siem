<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h2 class="text-xl font-semibold mb-4">Manajemen Pengguna</h2>
<a href="/users/create" class="btn btn-success mb-3">+ Tambah User</a>

<table class="table-auto w-full border">
  <thead>
    <tr class="bg-gray-100">
      <th class="px-4 py-2 border">Username</th>
      <th class="px-4 py-2 border">Role</th>
      <th class="px-4 py-2 border">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $u): ?>
    <tr>
      <td class="px-4 py-2 border"><?= esc($u['username']) ?></td>
      <td class="px-4 py-2 border"><?= esc($u['role']) ?></td>
      <td class="px-4 py-2 border">
        <a href="/users/edit/<?= $u['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="/users/delete/<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')" class="btn btn-sm btn-danger">Hapus</a>
        <a href="/users/reset/<?= $u['id'] ?>" onclick="return confirm('Reset password user ini?')" class="btn btn-sm btn-info">Reset PW</a>
      </td>

    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>
