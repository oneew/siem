<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Manajemen Pengguna</h1>
    <p class="text-sm text-gray-500">Kelola akun pengguna, hak akses, dan detail keamanan sistem.</p>
  </div>
  <a href="/users/create" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
    <i class="fas fa-plus mr-2"></i>
    Tambah Pengguna
  </a>
</div>

<!-- Search & Filter Bar -->
<div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
  <div class="relative flex-1 max-w-md">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
      <i class="fas fa-search text-gray-400"></i>
    </div>
    <input type="text" placeholder="Cari pengguna berdasarkan nama atau email..." class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
  </div>
  <div class="flex items-center space-x-3">
    <select class="block w-full pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none bg-no-repeat" style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23131313%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'); background-position: right 0.7rem top 50%; background-size: 0.65rem auto;">
      <option value="">Semua Peran (Role)</option>
      <option value="admin">Admin</option>
      <option value="analyst">Analyst</option>
    </select>
  </div>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full whitespace-nowrap">
      <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Pengguna
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Peran (Role)
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Status
          </th>
          <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
            Aksi
          </th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        <?php foreach($users as $u): ?>
        <tr class="hover:bg-gray-50 transition-colors">
          <td class="px-6 py-4">
            <div class="flex items-center">
              <div class="flex-shrink-0 h-10 w-10">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                  <?= strtoupper(substr($u['username'], 0, 1)) ?>
                </div>
              </div>
              <div class="ml-4">
                <div class="text-sm font-medium text-gray-900"><?= esc($u['username']) ?></div>
                <div class="text-sm text-gray-500"><?= esc($u['username']) ?>@siem-local.net</div>
              </div>
            </div>
          </td>
          <td class="px-6 py-4">
            <?php
            $roleColor = strtolower($u['role']) === 'admin' 
              ? 'bg-purple-100 text-purple-800 border-purple-200' 
              : 'bg-blue-100 text-blue-800 border-blue-200';
            ?>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $roleColor ?>">
              <?= esc(ucfirst($u['role'])) ?>
            </span>
          </td>
          <td class="px-6 py-4">
            <div class="flex items-center">
              <div class="h-2 w-2 rounded-full bg-green-400 mr-2"></div>
              <span class="text-sm text-gray-600">Aktif</span>
            </div>
          </td>
          <td class="px-6 py-4 text-right text-sm font-medium">
            <div class="flex items-center justify-end space-x-2">
              <a href="/users/edit/<?= $u['id'] ?>" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-2 rounded-lg transition-colors" title="Edit Pengguna">
                <i class="fas fa-edit"></i>
              </a>
              <a href="/users/reset/<?= $u['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin mengatur ulang kata sandi pengguna ini menjadi default?')" class="text-amber-600 hover:text-amber-900 bg-amber-50 hover:bg-amber-100 p-2 rounded-lg transition-colors" title="Reset Password">
                <i class="fas fa-key"></i>
              </a>
              <a href="/users/delete/<?= $u['id'] ?>" onclick="return confirm('PERINGATAN! Apakah Anda yakin ingin menghapus pengguna ini secara permanen?')" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors" title="Hapus Pengguna">
                <i class="fas fa-trash-alt"></i>
              </a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        
        <?php if(empty($users)): ?>
        <tr>
          <td colspan="4" class="px-6 py-8 text-center text-gray-500">
            <i class="fas fa-users text-4xl text-gray-300 mb-3"></i>
            <p>Belum ada data pengguna yang terdaftar.</p>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
  
  <!-- Pagination (Mock) -->
  <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 flex items-center justify-between sm:px-6">
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium"><?= count($users) ?></span> dari <span class="font-medium"><?= count($users) ?></span> hasil
        </p>
      </div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">Sebelumnya</span>
            <i class="fas fa-chevron-left"></i>
          </a>
          <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">Selanjutnya</span>
            <i class="fas fa-chevron-right"></i>
          </a>
        </nav>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
