<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-desktop text-teal-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Pantau keamanan aset jaringan dan endpoint secara real-time</p>
            </div>
            <button onclick="scanAllAssets()" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-search mr-2"></i>
                Scan Semua Aset
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
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
                        <h3 class="text-red-100 text-sm font-medium">Aset Rentan</h3>
                        <p class="text-3xl font-bold"><?= $stats['vulnerable_assets'] ?></p>
                    </div>
                    <div class="bg-red-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-orange-100 text-sm font-medium">Peringatan</h3>
                        <p class="text-3xl font-bold"><?= $stats['recent_alerts'] ?></p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-bell text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-purple-100 text-sm font-medium">Aset Kritis</h3>
                        <p class="text-3xl font-bold"><?= $stats['critical_assets'] ?></p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-crown text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Assets Monitoring Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-gray-600"></i>
                    Status Monitoring Aset
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keamanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Scan Terakhir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($assets as $asset): ?>
                            <tr class="hover:bg-gray-50 transition-colors" id="asset-row-<?= $asset['id'] ?>">
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
                                    switch ($asset['asset_type']) {
                                        case 'Server':
                                            echo 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'Endpoint':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'Network Device':
                                            echo 'bg-purple-100 text-purple-800';
                                            break;
                                        case 'Mobile':
                                            echo 'bg-pink-100 text-pink-800';
                                            break;
                                        case 'IoT Device':
                                            echo 'bg-orange-100 text-orange-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
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
                                </td>
                                <td class="px-6 py-4">
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
                                    ?>" id="security-status-<?= $asset['id'] ?>">
                                        <?= $asset['vulnerability_status'] === 'Vulnerable' ? 'Rentan' : ($asset['vulnerability_status'] === 'Secure' ? 'Aman' : ($asset['vulnerability_status'] === 'Patching Required' ? 'Perlu Patch' : ($asset['vulnerability_status'] === 'Unknown' ? 'Tidak Diketahui' : esc($asset['vulnerability_status'])))) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900" id="last-scan-<?= $asset['id'] ?>">
                                        <?= isset($asset['last_scan']) ? date('M j, Y', strtotime($asset['last_scan'])) : 'Tidak Pernah' ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <?= isset($asset['last_scan']) ? date('H:i', strtotime($asset['last_scan'])) : '' ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button onclick="scanAsset(<?= $asset['id'] ?>)"
                                            class="text-teal-600 hover:text-teal-800 transition-colors scan-btn"
                                            title="Scan Keamanan" id="scan-btn-<?= $asset['id'] ?>">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <a href="/monitoring/asset/<?= $asset['id'] ?>"
                                            class="text-blue-600 hover:text-blue-800 transition-colors"
                                            title="Detail Monitoring">
                                            <i class="fas fa-chart-bar"></i>
                                        </a>
                                        <a href="/asset-management/<?= $asset['id'] ?>"
                                            class="text-gray-600 hover:text-gray-800 transition-colors"
                                            title="Detail Aset">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($assets)): ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-server text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">Tidak ada aset ditemukan</p>
                                        <p class="text-sm">Mulai dengan menambahkan aset jaringan atau endpoint pertama Anda</p>
                                        <a href="/asset-management/create" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                            Tambah Aset Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Alerts -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bell mr-2 text-gray-600"></i>
                    Peringatan Keamanan Terbaru
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Peringatan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aset</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Keparahan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($recent_alerts as $alert): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900"><?= esc($alert['alert_name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc($alert['description']) ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if (!empty($alert['asset_id'])): ?>
                                        <?php
                                        $assetModel = new \App\Models\AssetModel();
                                        $asset = $assetModel->find($alert['asset_id']);
                                        ?>
                                        <?php if ($asset): ?>
                                            <div class="font-medium text-gray-900"><?= esc($asset['asset_name']) ?></div>
                                            <div class="text-sm text-gray-500"><?= esc($asset['ip_address']) ?></div>
                                        <?php else: ?>
                                            <span class="text-gray-400">Aset tidak ditemukan</span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
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
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($recent_alerts)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-400">
                                        <i class="fas fa-bell-slash text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">Tidak ada peringatan keamanan</p>
                                        <p class="text-sm">Sistem tidak mendeteksi ancaman keamanan saat ini</p>
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
    // Scan a single asset
    function scanAsset(assetId) {
        const scanBtn = document.getElementById('scan-btn-' + assetId);
        const originalIcon = scanBtn.innerHTML;

        // Show scanning indicator
        scanBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
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
                    const statusElement = document.getElementById('security-status-' + assetId);
                    const lastScanElement = document.getElementById('last-scan-' + assetId);

                    // Update status class and text
                    statusElement.className = statusElement.className.replace(/bg-\w+-100/g, '').replace(/text-\w+-800/g, '');
                    if (data.vulnerable) {
                        statusElement.classList.add('bg-red-100', 'text-red-800');
                        statusElement.textContent = 'Rentan';

                        // Show notification for vulnerable assets
                        showNotification('Vulnerability Detected', 'Vulnerabilities found on ' + data.asset_name, 'error');
                    } else {
                        statusElement.classList.add('bg-green-100', 'text-green-800');
                        statusElement.textContent = 'Aman';
                    }

                    // Update last scan time
                    const now = new Date();
                    lastScanElement.innerHTML = now.toLocaleDateString('id-ID', {
                        month: 'short',
                        day: 'numeric',
                        year: 'numeric'
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
                scanBtn.innerHTML = originalIcon;
                scanBtn.disabled = false;
            });
    }

    // Scan all assets
    function scanAllAssets() {
        const assets = <?= json_encode(array_column($assets, 'id')) ?>;

        if (assets.length === 0) {
            showNotification('No Assets', 'No assets to scan', 'info');
            return;
        }

        // Disable scan button
        const scanAllBtn = document.querySelector('.bg-teal-600.hover\\:bg-teal-700');
        const originalText = scanAllBtn.innerHTML;
        scanAllBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Scanning...';
        scanAllBtn.disabled = true;

        // Scan each asset sequentially
        let index = 0;
        const scanNext = () => {
            if (index >= assets.length) {
                // All done
                scanAllBtn.innerHTML = originalText;
                scanAllBtn.disabled = false;
                showNotification('Scan Complete', 'All assets scanned successfully', 'success');
                return;
            }

            const assetId = assets[index];
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
                        const statusElement = document.getElementById('security-status-' + assetId);
                        const lastScanElement = document.getElementById('last-scan-' + assetId);

                        // Update status class and text
                        statusElement.className = statusElement.className.replace(/bg-\w+-100/g, '').replace(/text-\w+-800/g, '');
                        if (data.vulnerable) {
                            statusElement.classList.add('bg-red-100', 'text-red-800');
                            statusElement.textContent = 'Rentan';
                        } else {
                            statusElement.classList.add('bg-green-100', 'text-green-800');
                            statusElement.textContent = 'Aman';
                        }

                        // Update last scan time
                        const now = new Date();
                        lastScanElement.innerHTML = now.toLocaleDateString('id-ID', {
                            month: 'short',
                            day: 'numeric',
                            year: 'numeric'
                        });
                    }
                    index++;
                    scanNext();
                })
                .catch(error => {
                    console.error('Error scanning asset ' + assetId + ':', error);
                    index++;
                    scanNext();
                });
        };

        scanNext();
    }

    // Show notification
    function showNotification(title, message, type) {
        // In a real implementation, you would use a proper notification library
        // For now, we'll use a simple alert
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