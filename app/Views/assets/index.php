<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-server text-blue-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Kelola dan pantau aset jaringan dan endpoint</p>
            </div>
            <a href="/asset-management/create" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Tambah Aset Baru
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-blue-100 text-sm font-medium">Total Aset</h3>
                        <p class="text-3xl font-bold"><?= $stats['total_assets'] ?></p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-server text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-green-100 text-sm font-medium">Aset Online</h3>
                        <p class="text-3xl font-bold"><?= $stats['online_assets'] ?></p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-red-100 text-sm font-medium">Aset Kritis</h3>
                        <p class="text-3xl font-bold"><?= $stats['critical_assets'] ?></p>
                    </div>
                    <div class="bg-red-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-orange-100 text-sm font-medium">Kerentanan</h3>
                        <p class="text-3xl font-bold"><?= $stats['vulnerabilities'] ?></p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assets Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-gray-600"></i>
                    Inventori Aset
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Info Aset</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tipe</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Alamat IP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kritikalitas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kerentanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Scan Terakhir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($assets as $asset): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-medium text-gray-900"><?= esc($asset['asset_name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($asset['operating_system']) ?></div>
                                    <div class="text-xs text-gray-400"><?= esc($asset['location']) ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($asset['asset_type']) {
                                        case 'Server': echo 'bg-blue-100 text-blue-800'; break;
                                        case 'Endpoint': echo 'bg-green-100 text-green-800'; break;
                                        case 'Network Device': echo 'bg-purple-100 text-purple-800'; break;
                                        case 'Mobile': echo 'bg-pink-100 text-pink-800'; break;
                                        case 'IoT Device': echo 'bg-orange-100 text-orange-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?php
                                        switch ($asset['asset_type']) {
                                            case 'Server':
                                                echo 'Server';
                                                break;
                                            case 'Endpoint':
                                                echo 'Endpoint';
                                                break;
                                            case 'Network Device':
                                                echo 'Perangkat Jaringan';
                                                break;
                                            case 'Mobile':
                                                echo 'Perangkat Mobile';
                                                break;
                                            case 'IoT Device':
                                                echo 'Perangkat IoT';
                                                break;
                                            case 'Database':
                                                echo 'Database';
                                                break;
                                            default:
                                                echo esc($asset['asset_type']);
                                                break;
                                        }
                                    ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-mono text-sm text-gray-900"><?= esc($asset['ip_address']) ?></div>
                                <div class="text-xs text-gray-500"><?= esc($asset['mac_address']) ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($asset['status']) {
                                        case 'Online': echo 'bg-green-100 text-green-800'; break;
                                        case 'Offline': echo 'bg-red-100 text-red-800'; break;
                                        case 'Maintenance': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Decommissioned': echo 'bg-gray-100 text-gray-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    <?= $asset['status'] === 'Online' ? 'Online' : ($asset['status'] === 'Offline' ? 'Offline' : ($asset['status'] === 'Maintenance' ? 'Pemeliharaan' : ($asset['status'] === 'Decommissioned' ? 'Didekomisioner' : esc($asset['status'])))) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($asset['criticality']) {
                                        case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                        case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= $asset['criticality'] === 'Critical' ? 'Kritis' : ($asset['criticality'] === 'High' ? 'Tinggi' : ($asset['criticality'] === 'Medium' ? 'Sedang' : ($asset['criticality'] === 'Low' ? 'Rendah' : esc($asset['criticality'])))) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($asset['vulnerability_status']) {
                                        case 'Vulnerable': echo 'bg-red-100 text-red-800'; break;
                                        case 'Secure': echo 'bg-green-100 text-green-800'; break;
                                        case 'Patching Required': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Unknown': echo 'bg-gray-100 text-gray-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= $asset['vulnerability_status'] === 'Vulnerable' ? 'Rentan' : ($asset['vulnerability_status'] === 'Secure' ? 'Aman' : ($asset['vulnerability_status'] === 'Patching Required' ? 'Perlu Patch' : ($asset['vulnerability_status'] === 'Unknown' ? 'Tidak Diketahui' : esc($asset['vulnerability_status'])))) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <?= isset($asset['last_scan']) ? date('M j, Y', strtotime($asset['last_scan'])) : 'Tidak Pernah' ?>
                                </div>
                                <div class="text-xs text-gray-500">
                                    <?= isset($asset['last_scan']) ? date('H:i', strtotime($asset['last_scan'])) : '' ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="/asset-management/<?= $asset['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/asset-management/<?= $asset['id'] ?>/edit" 
                                       class="text-yellow-600 hover:text-yellow-800 transition-colors" 
                                       title="Edit Aset">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="if(confirm('Apakah Anda yakin ingin menghapus aset ini?')) { 
                                                window.location.href='/asset-management/<?= $asset['id'] ?>/delete' 
                                            }"
                                            class="text-red-600 hover:text-red-800 transition-colors" 
                                            title="Hapus Aset">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($assets)): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-server text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Tidak ada aset ditemukan</p>
                                    <p class="text-sm">Mulai dengan menambahkan aset jaringan atau endpoint pertama Anda</p>
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

<script>
// Auto-refresh asset status every 30 seconds
setInterval(function() {
    // In a real implementation, this would update asset status via AJAX
    console.log('Asset status refresh triggered');
}, 30000);
</script>

<?= $this->endSection() ?>