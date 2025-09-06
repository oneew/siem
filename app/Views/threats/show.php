<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2 sm:mr-3"></i>
                    Threat Intelligence Details
                </h1>
                <p class="text-gray-600 mt-1 text-sm">Comprehensive IOC information and analysis</p>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3">
                <a href="/threats/edit/<?= $threat['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                    <i class="fas fa-edit mr-1 sm:mr-2"></i>
                    Edit Threat
                </a>
                <a href="/threats" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                    <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
                    Back to Threats
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-2 sm:p-4 md:p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Threat Header -->
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden mb-4 sm:mb-6 md:mb-8">
                <div class="bg-gradient-to-r from-red-600 to-red-700 text-white p-3 sm:p-4 md:p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">
                        <div class="min-w-0">
                            <h2 class="text-lg sm:text-xl md:text-2xl font-bold truncate"><?= esc(substr($threat['ioc_value'], 0, 50)) ?><?= strlen($threat['ioc_value']) > 50 ? '...' : '' ?></h2>
                            <p class="text-red-100 mt-1 text-sm"><?= esc($threat['threat_type']) ?></p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-2 py-1 sm:px-3 sm:py-1.5 text-xs sm:text-sm font-medium rounded-full
                                <?php 
                                switch($threat['status']) {
                                    case 'Active': echo 'bg-red-500 text-white'; break;
                                    case 'Inactive': echo 'bg-gray-500 text-white'; break;
                                    case 'Investigating': echo 'bg-yellow-500 text-white'; break;
                                    default: echo 'bg-gray-500 text-white'; break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-1 sm:mr-2"></i>
                                <?= esc($threat['status']) ?>
                            </span>
                            <div class="text-xs sm:text-sm text-red-100 mt-1 sm:mt-2">
                                Threat ID: #<?= $threat['id'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
                <!-- IOC Information -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-search mr-1.5 sm:mr-2 text-gray-600"></i>
                            IOC Information
                        </h3>
                    </div>
                    <div class="p-3 sm:p-4 md:p-6">
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">IOC Type:</span>
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($threat['ioc_type']) {
                                        case 'IP': echo 'bg-blue-100 text-blue-800'; break;
                                        case 'Domain': echo 'bg-green-100 text-green-800'; break;
                                        case 'Hash': echo 'bg-purple-100 text-purple-800'; break;
                                        case 'URL': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Email': echo 'bg-red-100 text-red-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= esc($threat['ioc_type']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">IOC Value:</span>
                                <span class="font-mono text-gray-900 break-all text-xs sm:text-sm max-w-[150px] sm:max-w-xs md:max-w-md truncate"><?= esc($threat['ioc_value']) ?></span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Severity:</span>
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($threat['severity']) {
                                        case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                        case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= esc($threat['severity']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Confidence:</span>
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($threat['confidence']) {
                                        case 'High': echo 'bg-green-100 text-green-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-red-100 text-red-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?= esc($threat['confidence']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Source:</span>
                                <span class="text-gray-900 text-xs sm:text-sm max-w-[100px] sm:max-w-xs truncate"><?= esc($threat['source']) ?: 'Unknown' ?></span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2">
                                <span class="font-medium text-gray-600 text-sm">Tags:</span>
                                <div class="text-gray-900 max-w-[120px] sm:max-w-xs text-right">
                                    <?php if ($threat['tags']): ?>
                                        <?php $tags = explode(',', $threat['tags']); ?>
                                        <div class="flex flex-wrap justify-end gap-1">
                                            <?php foreach($tags as $tag): ?>
                                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                                    <?= esc(trim($tag)) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-500 text-xs sm:text-sm">No tags</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Information -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clock mr-1.5 sm:mr-2 text-gray-600"></i>
                            Timeline Information
                        </h3>
                    </div>
                    <div class="p-3 sm:p-4 md:p-6">
                        <div class="space-y-4 sm:space-y-5">
                            <!-- First Seen -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye text-blue-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">First Seen</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['first_seen']) && $threat['first_seen'] ? 
                                            date('M j, Y \a\t H:i', strtotime($threat['first_seen'])) : 'Unknown' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Last Seen -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye-slash text-orange-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Last Seen</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['last_seen']) && $threat['last_seen'] ? 
                                            date('M j, Y \a\t H:i', strtotime($threat['last_seen'])) : 'Unknown' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Added to System -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-green-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Added to System</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['created_at']) ? 
                                            date('M j, Y \a\t H:i', strtotime($threat['created_at'])) : 'Unknown' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-purple-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Last Updated</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['updated_at']) ? 
                                            date('M j, Y \a\t H:i', strtotime($threat['updated_at'])) : 'Unknown' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <?php if ($threat['description']): ?>
            <div class="mt-4 sm:mt-6 md:mt-8 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-file-alt mr-1.5 sm:mr-2 text-gray-600"></i>
                        Description & Analysis
                    </h3>
                </div>
                <div class="p-3 sm:p-4 md:p-6">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-sm sm:text-base"><?= nl2br(esc($threat['description'])) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Threat Intelligence Actions -->
            <div class="mt-4 sm:mt-6 md:mt-8 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-shield-alt mr-1.5 sm:mr-2 text-gray-600"></i>
                        Threat Intelligence Actions
                    </h3>
                </div>
                <div class="p-3 sm:p-4 md:p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                        <button class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="blockThreat()">
                            <i class="fas fa-ban text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Block IOC</span>
                        </button>
                        <button class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="analyzeIOC()">
                            <i class="fas fa-search-plus text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Deep Analysis</span>
                        </button>
                        <button class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="exportIOC()">
                            <i class="fas fa-download text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Export IOC</span>
                        </button>
                        <button class="bg-purple-50 hover:bg-purple-100 border border-purple-200 text-purple-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="shareIOC()">
                            <i class="fas fa-share-alt text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Share Intel</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Threats -->
            <div class="mt-4 sm:mt-6 md:mt-8 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-link mr-1.5 sm:mr-2 text-gray-600"></i>
                        Related Threats
                    </h3>
                </div>
                <div class="p-3 sm:p-4 md:p-6">
                    <div class="space-y-3 sm:space-y-4">
                        <!-- Demo related threats -->
                        <div class="flex items-center space-x-2 sm:space-x-3 p-2 sm:p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">IP</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-900 truncate">192.168.1.101</p>
                                <p class="text-xs text-gray-500 truncate">Same subnet - Potentially compromised</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-xs text-gray-500">85% similarity</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-2 sm:space-x-3 p-2 sm:p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Domain</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-900 truncate">similar-threat.com</p>
                                <p class="text-xs text-gray-500 truncate">Same threat actor - APT group</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-xs text-gray-500">72% similarity</span>
                            </div>
                        </div>

                        <div class="text-center py-2 sm:py-3">
                            <button class="text-blue-600 hover:text-blue-800 text-xs sm:text-sm font-medium">
                                View all related threats →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Threat intelligence actions
function blockThreat() {
    if (confirm('Are you sure you want to block this IOC across all security systems?')) {
        alert('IOC blocking request sent to security systems (Demo Mode)');
    }
}

function analyzeIOC() {
    alert('Deep analysis initiated. Results will be available in the threat analysis dashboard (Demo Mode)');
}

function exportIOC() {
    // Create a simple IOC export
    const iocData = {
        id: '<?= $threat['id'] ?>',
        type: '<?= esc($threat['ioc_type']) ?>',
        value: '<?= esc($threat['ioc_value']) ?>',
        threat_type: '<?= esc($threat['threat_type']) ?>',
        severity: '<?= esc($threat['severity']) ?>',
        confidence: '<?= esc($threat['confidence']) ?>',
        status: '<?= esc($threat['status']) ?>',
        created_at: '<?= isset($threat['created_at']) ? $threat['created_at'] : '' ?>'
    };
    
    const dataStr = JSON.stringify(iocData, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    const url = URL.createObjectURL(dataBlob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'threat_ioc_<?= $threat['id'] ?>.json';
    link.click();
}

function shareIOC() {
    alert('Threat intelligence sharing initiated with partner organizations (Demo Mode)');
}

// Auto-refresh threat status
setInterval(function() {
    console.log('Threat status refresh triggered');
}, 60000);
</script>

<?= $this->endSection() ?>