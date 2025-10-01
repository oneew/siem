<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                Manajemen Insiden
            </h1>
            <p class="text-gray-600 mt-1">Memantau, mengelola, dan menyelesaikan insiden keamanan</p>
        </div>
        <div class="flex space-x-3">
            <a href="/incidents/create" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Buat Insiden
            </a>
        </div>
    </div>
</div>

<!-- Flash Messages -->
<?= $this->include('components/flash_messages') ?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Total Insiden</p>
                <p class="text-3xl font-bold text-gray-800"><?= count($incidents) ?></p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg text-blue-500 text-xl">
                <i class="fas fa-shield-alt"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Insiden Terbuka</p>
                <p class="text-3xl font-bold text-gray-800"><?= count(array_filter($incidents, fn($i) => $i['status'] === 'Open')) ?></p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-orange-100 rounded-lg text-orange-500 text-xl">
                <i class="fas fa-folder-open"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Dalam Proses</p>
                <p class="text-3xl font-bold text-gray-800"><?= count(array_filter($incidents, fn($i) => $i['status'] === 'In Progress')) ?></p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-yellow-100 rounded-lg text-yellow-500 text-xl">
                <i class="fas fa-tasks"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Diselesaikan</p>
                <p class="text-3xl font-bold text-gray-800"><?= count(array_filter($incidents, fn($i) => $i['status'] === 'Closed')) ?></p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-lg text-green-500 text-xl">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-list mr-2 text-gray-600"></i>
            Semua Insiden
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Detail Insiden</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tingkat Keparahan</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dibuat</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($incidents)): ?>
                    <?php foreach ($incidents as $incident): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-medium text-gray-900"><?= esc($incident['title']) ?></div>
                                    <div class="text-sm text-gray-500">IP: <?= esc($incident['source_ip'] ?? 'N/A') ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                <?php
                                switch ($incident['severity']) {
                                    case 'Critical':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    case 'High':
                                        echo 'bg-orange-100 text-orange-800';
                                        break;
                                    case 'Medium':
                                        echo 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'Low':
                                        echo 'bg-blue-100 text-blue-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                        break;
                                }
                                ?>">
                                    <?= esc($incident['severity']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                <?php
                                switch ($incident['status']) {
                                    case 'Open':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    case 'In Progress':
                                        echo 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'Closed':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                        break;
                                }
                                ?>">
                                    <?= esc($incident['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <?= date('j M Y', strtotime($incident['created_at'])) ?>
                                </div>
                                <div class="text-xs text-gray-500">
                                    <?= date('H:i', strtotime($incident['created_at'])) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="/incidents/show/<?= $incident['id'] ?>"
                                        class="text-blue-600 hover:text-blue-800 transition-colors"
                                        title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/incidents/edit/<?= $incident['id'] ?>"
                                        class="text-yellow-600 hover:text-yellow-800 transition-colors"
                                        title="Edit Insiden">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                                <p class="text-lg font-medium">Tidak ada insiden ditemukan</p>
                                <p class="text-sm">Buat insiden pertama Anda untuk memulai</p>
                                <a href="/incidents/create" class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                                    <i class="fas fa-plus mr-1"></i> Buat Insiden
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>