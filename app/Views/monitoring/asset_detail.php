<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-chart-bar text-teal-600 mr-3"></i>
                    Monitoring Detail: <?= $asset['asset_name'] ?>
                </h1>
                <p class="text-gray-600 mt-1">Detail keamanan dan monitoring untuk aset <?= $asset['ip_address'] ?></p>
            </div>
            <div class="flex space-x-3">
                <button onclick="scanAsset(<?= $asset['id'] ?>)" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors" id="scan-btn">
                    <i class="fas fa-search mr-2"></i>
                    Scan Keamanan
                </button>
                <a href="/monitoring" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="p-6">
        <!-- Asset Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Nama Aset</h3>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?= esc($asset['asset_name']) ?></p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-server text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Alamat IP</h3>
                        <p class="text-xl font-bold text-gray-900 mt-1"><?= esc($asset['ip_address']) ?></p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-network-wired text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Status</h3>
                        <p class="text-xl font-bold mt-1">
                            <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                <?php
                                switch ($asset['status']) {
                                    case 'Online':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    case 'Offline':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    case 'Maintenance':
                                        echo 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'Decommissioned':
                                        echo 'bg-gray-100 text-gray-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                        break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-1"></i>
                                <?= $asset['status'] === 'Online' ? 'Online' : ($asset['status'] === 'Offline' ? 'Offline' : ($asset['status'] === 'Maintenance' ? 'Pemeliharaan' : ($asset['status'] === 'Decommissioned' ? 'Didekomisioner' : esc($asset['status'])))) ?>
                            </span>
                        </p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-info-circle text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-gray-500 text-sm font-medium">Keamanan</h3>
                        <p class="text-xl font-bold mt-1">
                            <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full security-status
                                <?php
                                switch ($asset['vulnerability_status']) {
                                    case 'Vulnerable':
                                        echo 'bg-red-100 text-red-800';
                                        break;
                                    case 'Secure':
                                        echo 'bg-green-100 text-green-800';
                                        break;
                                    case 'Patching Required':
                                        echo 'bg-orange-100 text-orange-800';
                                        break;
                                    case 'Unknown':
                                        echo 'bg-gray-100 text-gray-800';
                                        break;
                                    default:
                                        echo 'bg-gray-100 text-gray-800';
                                        break;
                                }
                                ?>" id="security-status">
                                <?= $asset['vulnerability_status'] === 'Vulnerable' ? 'Rentan' : ($asset['vulnerability_status'] === 'Secure' ? 'Aman' : ($asset['vulnerability_status'] === 'Patching Required' ? 'Perlu Patch' : ($asset['vulnerability_status'] === 'Unknown' ? 'Tidak Diketahui' : esc($asset['vulnerability_status'])))) ?>
                            </span>
                        </p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-lg">
                        <i class="fas fa-shield-alt text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Chart and Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Security Chart -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                    Riwayat Keamanan
                </h2>
                <div class="h-64 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-chart-bar text-4xl mb-4"></i>
                        <p>Grafik keamanan akan muncul di sini</p>
                        <p class="text-sm mt-2">Fitur ini akan diimplementasikan dalam versi berikutnya</p>
                    </div>
                </div>
            </div>

            <!-- Asset Details -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                    Detail Aset
                </h2>
                <div class="space-y-4">
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-600">Tipe Aset</span>
                        <span class="font-medium">
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
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-600">Alamat MAC</span>
                        <span class="font-medium"><?= esc($asset['mac_address']) ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-600">Sistem Operasi</span>
                        <span class="font-medium"><?= esc($asset['operating_system']) ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-600">Lokasi</span>
                        <span class="font-medium"><?= esc($asset['location']) ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-600">Pemilik</span>
                        <span class="font-medium"><?= esc($asset['owner']) ?></span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-3">
                        <span class="text-gray-600">Kritikalitas</span>
                        <span class="font-medium">
                            <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                <?php
                                switch ($asset['criticality']) {
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
                                <?= $asset['criticality'] === 'Critical' ? 'Kritis' : ($asset['criticality'] === 'High' ? 'Tinggi' : ($asset['criticality'] === 'Medium' ? 'Sedang' : ($asset['criticality'] === 'Low' ? 'Rendah' : esc($asset['criticality'])))) ?>
                            </span>
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Scan Terakhir</span>
                        <span class="font-medium">
                            <?= isset($asset['last_scan']) ? date('M j, Y H:i', strtotime($asset['last_scan'])) : 'Tidak Pernah' ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Alerts for this Asset -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bell mr-2 text-gray-600"></i>
                    Peringatan Keamanan untuk Aset Ini
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Peringatan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keparahan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($alerts as $alert): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900"><?= esc($alert['alert_name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($alert['description']) ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($alert['priority']) {
                                        case 'High':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        case 'Medium':
                                            echo 'bg-orange-100 text-orange-800';
                                            break;
                                        case 'Low':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                    }
                                    ?>">
                                        <?= $alert['priority'] === 'High' ? 'Tinggi' : ($alert['priority'] === 'Medium' ? 'Sedang' : ($alert['priority'] === 'Low' ? 'Rendah' : esc($alert['priority']))) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900"><?= date('M j, Y', strtotime($alert['created_at'])) ?></div>
                                    <div class="text-xs text-gray-500"><?= date('H:i', strtotime($alert['created_at'])) ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($alert['status']) {
                                        case 'Active':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        case 'Investigating':
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
                                        <?= $alert['status'] === 'Active' ? 'Aktif' : ($alert['status'] === 'Investigating' ? 'Dalam Investigasi' : ($alert['status'] === 'Closed' ? 'Ditutup' : esc($alert['status']))) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/alerts/show/<?= $alert['id'] ?>" class="text-blue-600 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($alerts)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-bell-slash text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">Tidak ada peringatan keamanan</p>
                                        <p class="text-sm">Aset ini tidak memiliki peringatan keamanan aktif</p>
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
    // Scan asset
    function scanAsset(assetId) {
        const scanBtn = document.getElementById('scan-btn');
        const originalText = scanBtn.innerHTML;

        // Show scanning indicator
        scanBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Scanning...';
        scanBtn.disabled = true;

        fetch('/monitoring/check-security/' + assetId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update the security status display
                    const statusElement = document.getElementById('security-status');

                    // Update status class and text
                    statusElement.className = statusElement.className.replace(/bg-\w+-100/g, '').replace(/text-\w+-800/g, '');
                    if (data.vulnerable) {
                        statusElement.classList.add('bg-red-100', 'text-red-800');
                        statusElement.textContent = 'Rentan';

                        // Show notification for vulnerable assets
                        showNotification('Vulnerability Detected', data.message, 'error');
                    } else {
                        statusElement.classList.add('bg-green-100', 'text-green-800');
                        statusElement.textContent = 'Aman';
                    }

                    // Update last scan time in asset details
                    const now = new Date();
                    document.querySelector('.flex.justify-between:last-child .font-medium').textContent =
                        now.toLocaleDateString('id-ID', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                    // Show success message
                    showNotification('Scan Complete', data.message, 'success');
                } else {
                    showNotification('Scan Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Scan Error', 'Failed to scan asset', 'error');
            })
            .finally(() => {
                // Restore button
                scanBtn.innerHTML = originalText;
                scanBtn.disabled = false;
            });
    }

    // Show notification
    function showNotification(title, message, type) {
        Swal.fire({
            title: title,
            text: message,
            icon: type,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    }
</script>

<?= $this->endSection() ?>