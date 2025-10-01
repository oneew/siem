<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                    Detail Pengguna
                </h1>
                <p class="text-gray-600 mt-1">Informasi lengkap tentang pengguna</p>
            </div>
            <div class="flex space-x-3">
                <a href="/users/<?= $user['id'] ?>/edit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Pengguna
                </a>
                <a href="/users" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-user mr-2 text-gray-600"></i>
                        Informasi Pengguna
                    </h2>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- User Profile Section -->
                        <div class="md:w-1/3">
                            <div class="bg-gray-50 rounded-lg p-6 text-center">
                                <?php if (!empty($user['profile_picture'])): ?>
                                    <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile" class="w-32 h-32 rounded-full object-cover mx-auto mb-4">
                                <?php else: ?>
                                    <div class="w-32 h-32 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-4xl mx-auto mb-4">
                                        <?= substr($user['username'], 0, 1) ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="text-xl font-bold text-gray-900"><?= esc($user['username']) ?></h3>
                                <p class="text-gray-600 mt-1"><?= esc($user['role']) ?></p>

                                <div class="mt-6 space-y-3">
                                    <div class="flex justify-between py-2 border-b border-gray-200">
                                        <span class="text-gray-500">Status:</span>
                                        <span class="font-medium text-green-600">Aktif</span>
                                    </div>
                                    <div class="flex justify-between py-2 border-b border-gray-200">
                                        <span class="text-gray-500">Tanggal Bergabung:</span>
                                        <span class="font-medium">
                                            <?= isset($user['created_at']) ? date('j M Y', strtotime($user['created_at'])) : 'N/A' ?>
                                        </span>
                                    </div>
                                    <div class="flex justify-between py-2">
                                        <span class="text-gray-500">Terakhir Diubah:</span>
                                        <span class="font-medium">
                                            <?= isset($user['updated_at']) ? date('j M Y', strtotime($user['updated_at'])) : 'N/A' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Details Section -->
                        <div class="md:w-2/3">
                            <div class="space-y-6">
                                <!-- Account Information -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                        <i class="fas fa-user-circle text-gray-600 mr-2"></i>
                                        Informasi Akun
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Username</label>
                                            <p class="font-medium"><?= esc($user['username']) ?></p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Peran</label>
                                            <p class="font-medium">
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
                                            </p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Bergabung</label>
                                            <p class="font-medium">
                                                <?= isset($user['created_at']) ? date('j F Y', strtotime($user['created_at'])) : 'N/A' ?>
                                            </p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-500 mb-1">Terakhir Diubah</label>
                                            <p class="font-medium">
                                                <?= isset($user['updated_at']) ? date('j F Y', strtotime($user['updated_at'])) : 'N/A' ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Activity Section -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                        <i class="fas fa-history text-gray-600 mr-2"></i>
                                        Aktivitas Terakhir
                                    </h3>

                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user-plus text-blue-600 text-sm"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">Akun dibuat</p>
                                                <p class="text-xs text-gray-500">
                                                    <?= isset($user['created_at']) ? date('j F Y \p\a\d\a H:i', strtotime($user['created_at'])) : 'N/A' ?>
                                                </p>
                                            </div>
                                        </div>

                                        <?php if (isset($user['updated_at']) && $user['updated_at'] != $user['created_at']): ?>
                                            <div class="flex items-start">
                                                <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user-edit text-yellow-600 text-sm"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">Profil terakhir diubah</p>
                                                    <p class="text-xs text-gray-500">
                                                        <?= date('j F Y \p\a\d\a H:i', strtotime($user['updated_at'])) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="flex items-start">
                                            <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-shield-alt text-green-600 text-sm"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-gray-900">Status akun</p>
                                                <p class="text-xs text-gray-500">Aktif</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>