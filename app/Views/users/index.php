<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-users text-blue-600 mr-3"></i>
                    Manajemen Pengguna
                </h1>
                <p class="text-gray-600 mt-1">Kelola akun pengguna dan hak akses sistem</p>
            </div>
            <a href="/users/create" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah Pengguna
            </a>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-gray-600"></i>
                    Daftar Pengguna
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pengguna</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Peran</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Bergabung</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <?php if (!empty($user['profile_picture'])): ?>
                                                <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile" class="w-10 h-10 rounded-full object-cover mr-3">
                                            <?php else: ?>
                                                <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">
                                                    <?= substr($user['username'], 0, 1) ?>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <div class="font-medium text-gray-900">
                                                    <a href="/users/<?= $user['id'] ?>" class="text-blue-600 hover:text-blue-800">
                                                        <?= esc($user['username']) ?>
                                                    </a>
                                                </div>
                                                <div class="text-sm text-gray-500">ID: <?= $user['id'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                            <?php
                                            switch ($user['role']) {
                                                case 'Admin':
                                                    echo 'bg-purple-100 text-purple-800';
                                                    break;
                                                case 'Analyst':
                                                    echo 'bg-blue-100 text-blue-800';
                                                    break;
                                                case 'Operator':
                                                    echo 'bg-green-100 text-green-800';
                                                    break;
                                                default:
                                                    echo 'bg-gray-100 text-gray-800';
                                                    break;
                                            }
                                            ?>">
                                            <?= esc($user['role']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Aktif
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <?= isset($user['created_at']) ? date('j M Y', strtotime($user['created_at'])) : 'N/A' ?>
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            <?= isset($user['created_at']) ? date('H:i', strtotime($user['created_at'])) : '' ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="/users/<?= $user['id'] ?>/edit"
                                                class="text-blue-600 hover:text-blue-800 transition-colors"
                                                title="Edit Pengguna">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <?php if ($user['id'] != session()->get('user_id')): ?>
                                                <button onclick="if(confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) { 
                                                            window.location.href='/users/<?= $user['id'] ?>/delete' 
                                                        }"
                                                    class="text-red-600 hover:text-red-800 transition-colors"
                                                    title="Hapus Pengguna">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-users text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">Tidak ada pengguna ditemukan</p>
                                        <p class="text-sm">Mulai dengan menambahkan pengguna pertama Anda</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>