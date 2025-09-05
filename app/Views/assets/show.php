<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-server text-blue-600 mr-3"></i>
                    Asset Details
                </h1>
                <p class="text-gray-600 mt-1">Comprehensive information and security status</p>
            </div>
            <div class="flex space-x-3">
                <a href="/assets/<?= $asset['id'] ?>/edit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Asset
                </a>
                <a href="/assets" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Assets
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Asset Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold"><?= esc($asset['asset_name']) ?></h2>
                            <p class="text-blue-100 mt-1"><?= esc($asset['operating_system']) ?></p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full
                                <?php 
                                switch($asset['status']) {
                                    case 'Online': echo 'bg-green-500 text-white'; break;
                                    case 'Offline': echo 'bg-red-500 text-white'; break;
                                    case 'Maintenance': echo 'bg-yellow-500 text-white'; break;
                                    case 'Decommissioned': echo 'bg-gray-500 text-white'; break;
                                    default: echo 'bg-gray-500 text-white'; break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-2"></i>
                                <?= esc($asset['status']) ?>
                            </span>
                            <div class="text-sm text-blue-100 mt-2">
                                Asset ID: #<?= $asset['id'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Basic Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                            Basic Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Asset Type:</span>
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
                                    <?= esc($asset['asset_type']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">IP Address:</span>
                                <span class="font-mono text-gray-900"><?= esc($asset['ip_address']) ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">MAC Address:</span>
                                <span class="font-mono text-gray-900"><?= esc($asset['mac_address']) ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Location:</span>
                                <span class="text-gray-900"><?= esc($asset['location']) ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Owner:</span>
                                <span class="text-gray-900"><?= esc($asset['owner']) ?></span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="font-medium text-gray-600">Criticality:</span>
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
                                    <?= esc($asset['criticality']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Status -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-gray-600"></i>
                            Security Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- Vulnerability Status -->
                            <div class="text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4
                                    <?php 
                                    switch($asset['vulnerability_status']) {
                                        case 'Vulnerable': echo 'bg-red-100'; break;
                                        case 'Secure': echo 'bg-green-100'; break;
                                        case 'Patching Required': echo 'bg-orange-100'; break;
                                        case 'Unknown': echo 'bg-gray-100'; break;
                                        default: echo 'bg-gray-100'; break;
                                    }
                                    ?>">
                                    <i class="fas <?php 
                                        switch($asset['vulnerability_status']) {
                                            case 'Vulnerable': echo 'fa-exclamation-triangle text-red-600 text-2xl'; break;
                                            case 'Secure': echo 'fa-shield-alt text-green-600 text-2xl'; break;
                                            case 'Patching Required': echo 'fa-tools text-orange-600 text-2xl'; break;
                                            case 'Unknown': echo 'fa-question text-gray-600 text-2xl'; break;
                                            default: echo 'fa-question text-gray-600 text-2xl'; break;
                                        }
                                        ?>"></i>
                                </div>
                                <h4 class="text-lg font-semibold text-gray-900">Vulnerability Status</h4>
                                <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full mt-2
                                    <?php 
                                    switch($asset['vulnerability_status']) {
                                        case 'Vulnerable': echo 'bg-red-100 text-red-800'; break;
                                        case 'Secure': echo 'bg-green-100 text-green-800'; break;
                                        case 'Patching Required': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Unknown': echo 'bg-gray-100 text-gray-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= esc($asset['vulnerability_status']) ?>
                                </span>
                            </div>

                            <!-- Last Scan Information -->
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="font-medium text-gray-600">Last Security Scan:</span>
                                    <span class="text-gray-900">
                                        <?= isset($asset['last_scan']) && $asset['last_scan'] ? 
                                            date('M j, Y \a\t H:i', strtotime($asset['last_scan'])) : 
                                            'Never scanned' ?>
                                    </span>
                                </div>
                                
                                <?php if (isset($asset['last_scan']) && $asset['last_scan']): ?>
                                <div class="mt-2 text-sm text-gray-500">
                                    <?php
                                    $scanTime = strtotime($asset['last_scan']);
                                    $now = time();
                                    $diff = $now - $scanTime;
                                    
                                    if ($diff < 3600) {
                                        echo floor($diff / 60) . ' minutes ago';
                                    } elseif ($diff < 86400) {
                                        echo floor($diff / 3600) . ' hours ago';
                                    } else {
                                        echo floor($diff / 86400) . ' days ago';
                                    }
                                    ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Action Buttons -->
                            <div class="border-t border-gray-200 pt-4 space-y-3">
                                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-search mr-2"></i>
                                    Initiate Security Scan
                                </button>
                                <button class="w-full bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-download mr-2"></i>
                                    Download Security Report
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline and Activity -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-history mr-2 text-gray-600"></i>
                        Asset Timeline & Activity
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Asset Created -->
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-plus text-blue-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Asset registered in system</p>
                                <p class="text-xs text-gray-500">
                                    <?= isset($asset['created_at']) ? date('M j, Y \a\t H:i', strtotime($asset['created_at'])) : 'Unknown' ?>
                                </p>
                            </div>
                        </div>

                        <?php if (isset($asset['last_scan']) && $asset['last_scan']): ?>
                        <!-- Last Security Scan -->
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-green-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Security scan completed</p>
                                <p class="text-xs text-gray-500">
                                    <?= date('M j, Y \a\t H:i', strtotime($asset['last_scan'])) ?>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Demo Activities -->
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tools text-yellow-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Configuration updated</p>
                                <p class="text-xs text-gray-500">Demo activity - 2 days ago</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-network-wired text-purple-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Network connectivity verified</p>
                                <p class="text-xs text-gray-500">Demo activity - 5 days ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-bolt mr-2 text-gray-600"></i>
                        Quick Actions
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-search text-xl mb-2"></i>
                            <span class="text-sm font-medium">Scan Asset</span>
                        </button>
                        <button class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-network-wired text-xl mb-2"></i>
                            <span class="text-sm font-medium">Ping Test</span>
                        </button>
                        <button class="bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-chart-line text-xl mb-2"></i>
                            <span class="text-sm font-medium">View Metrics</span>
                        </button>
                        <button class="bg-purple-50 hover:bg-purple-100 border border-purple-200 text-purple-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-cog text-xl mb-2"></i>
                            <span class="text-sm font-medium">Configure</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Demo functionality for quick actions
document.addEventListener('DOMContentLoaded', function() {
    const actionButtons = document.querySelectorAll('.bg-blue-50, .bg-green-50, .bg-orange-50, .bg-purple-50');
    
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.querySelector('span').textContent;
            alert(`${action} functionality would be implemented in production environment.`);
        });
    });
});
</script>

<?= $this->endSection() ?>