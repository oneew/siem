<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2 sm:mr-3"></i>
                    Detail Intelijen Ancaman
                </h1>
                <p class="text-gray-600 mt-1 text-sm">Informasi dan analisis IOC yang komprehensif</p>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3">
                <a href="/threats/edit/<?= $threat['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                    <i class="fas fa-edit mr-1 sm:mr-2"></i>
                    Ubah Ancaman
                </a>
                <a href="/threats" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                    <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
                    Kembali ke Daftar Ancaman
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-2 sm:p-4 md:p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Header Ancaman -->
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
                                switch ($threat['status']) {
                                    case 'Active':
                                        echo 'bg-red-500 text-white';
                                        break;
                                    case 'Inactive':
                                        echo 'bg-gray-500 text-white';
                                        break;
                                    case 'Investigating':
                                        echo 'bg-yellow-500 text-white';
                                        break;
                                    default:
                                        echo 'bg-gray-500 text-white';
                                        break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-1 sm:mr-2"></i>
                                <?= esc($threat['status']) ?>
                            </span>
                            <div class="text-xs sm:text-sm text-red-100 mt-1 sm:mt-2">
                                ID Ancaman: #<?= $threat['id'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
                <!-- Informasi IOC -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-search mr-1.5 sm:mr-2 text-gray-600"></i>
                            Informasi IOC
                        </h3>
                    </div>
                    <div class="p-3 sm:p-4 md:p-6">
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Tipe IOC:</span>
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($threat['ioc_type']) {
                                        case 'IP':
                                            echo 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'Domain':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'Hash':
                                            echo 'bg-purple-100 text-purple-800';
                                            break;
                                        case 'URL':
                                            echo 'bg-orange-100 text-orange-800';
                                            break;
                                        case 'Email':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                    }
                                    ?>">
                                    <?= esc($threat['ioc_type']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Nilai IOC:</span>
                                <span class="font-mono text-gray-900 break-all text-xs sm:text-sm max-w-[150px] sm:max-w-xs md:max-w-md truncate"><?= esc($threat['ioc_value']) ?></span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Tingkat Keparahan:</span>
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($threat['severity']) {
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
                                    <?= esc($threat['severity']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Tingkat Keyakinan:</span>
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($threat['confidence']) {
                                        case 'High':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'Medium':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'Low':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                    }
                                    ?>">
                                    <?= esc($threat['confidence']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600 text-sm">Sumber:</span>
                                <span class="text-gray-900 text-xs sm:text-sm max-w-[100px] sm:max-w-xs truncate"><?= esc($threat['source']) ?: 'Tidak diketahui' ?></span>
                            </div>
                            <div class="flex justify-between py-1.5 sm:py-2">
                                <span class="font-medium text-gray-600 text-sm">Tag:</span>
                                <div class="text-gray-900 max-w-[120px] sm:max-w-xs text-right">
                                    <?php if ($threat['tags']): ?>
                                        <?php $tags = explode(',', $threat['tags']); ?>
                                        <div class="flex flex-wrap justify-end gap-1">
                                            <?php foreach ($tags as $tag): ?>
                                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">
                                                    <?= esc(trim($tag)) ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-500 text-xs sm:text-sm">Tidak ada tag</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Waktu -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clock mr-1.5 sm:mr-2 text-gray-600"></i>
                            Informasi Waktu
                        </h3>
                    </div>
                    <div class="p-3 sm:p-4 md:p-6">
                        <div class="space-y-4 sm:space-y-5">
                            <!-- Pertama Kali Terlihat -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye text-blue-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Pertama Kali Terlihat</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['first_seen']) && $threat['first_seen'] ?
                                            date('d M Y \p\u\k\u l H:i', strtotime($threat['first_seen'])) : 'Tidak diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Terakhir Terlihat -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye-slash text-orange-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Terakhir Terlihat</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['last_seen']) && $threat['last_seen'] ?
                                            date('d M Y \p\u\k\u l H:i', strtotime($threat['last_seen'])) : 'Tidak diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Ditambahkan ke Sistem -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-green-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Ditambahkan ke Sistem</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['created_at']) ?
                                            date('d M Y \p\u\k\u l H:i', strtotime($threat['created_at'])) : 'Tidak diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Terakhir Diperbarui -->
                            <div class="flex items-start space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 mt-0.5">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-purple-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900">Terakhir Diperbarui</p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($threat['updated_at']) ?
                                            date('d M Y \p\u\k\u l H:i', strtotime($threat['updated_at'])) : 'Tidak diketahui' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <?php if ($threat['description']): ?>
                <div class="mt-4 sm:mt-6 md:mt-8 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-file-alt mr-1.5 sm:mr-2 text-gray-600"></i>
                            Deskripsi & Analisis
                        </h3>
                    </div>
                    <div class="p-3 sm:p-4 md:p-6">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap text-sm sm:text-base"><?= nl2br(esc($threat['description'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Aksi Intelijen Ancaman -->
            <div class="mt-4 sm:mt-6 md:mt-8 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-shield-alt mr-1.5 sm:mr-2 text-gray-600"></i>
                        Aksi Intelijen Ancaman
                    </h3>
                </div>
                <div class="p-3 sm:p-4 md:p-6">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 md:gap-4">
                        <button class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="blockThreat()">
                            <i class="fas fa-ban text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Blokir IOC</span>
                        </button>
                        <button class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="analyzeIOC()">
                            <i class="fas fa-search-plus text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Analisis Mendalam</span>
                        </button>
                        <button class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="exportIOC()">
                            <i class="fas fa-download text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Ekspor IOC</span>
                        </button>
                        <button class="bg-purple-50 hover:bg-purple-100 border border-purple-200 text-purple-700 py-2 px-2 sm:py-3 sm:px-3 rounded-lg transition-colors flex flex-col items-center text-xs sm:text-sm" onclick="shareIOC()">
                            <i class="fas fa-share-alt text-base sm:text-lg mb-1"></i>
                            <span class="font-medium text-center">Bagikan Intel</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Ancaman Terkait -->
            <div class="mt-4 sm:mt-6 md:mt-8 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-3 sm:px-4 md:px-6 py-2 sm:py-3 md:py-4 border-b border-gray-200">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-link mr-1.5 sm:mr-2 text-gray-600"></i>
                        Ancaman Terkait
                    </h3>
                </div>
                <div class="p-3 sm:p-4 md:p-6">
                    <div class="space-y-3 sm:space-y-4">
                        <!-- Demo ancaman terkait -->
                        <div class="flex items-center justify-between bg-gray-50 p-2 sm:p-3 rounded-lg">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-red-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-red-600 text-xs sm:text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-900">IOC terkait #1</p>
                                    <p class="text-xs text-gray-500">Domain - malicious.com</p>
                                </div>
                            </div>
                            <a href="#" class="text-blue-600 hover:underline text-xs sm:text-sm">Lihat Detail</a>
                        </div>

                        <div class="flex items-center justify-between bg-gray-50 p-2 sm:p-3 rounded-lg">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-circle text-orange-600 text-xs sm:text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-900">IOC terkait #2</p>
                                    <p class="text-xs text-gray-500">IP - 192.168.1.100</p>
                                </div>
                            </div>
                            <a href="#" class="text-blue-600 hover:underline text-xs sm:text-sm">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function blockThreat() {
        alert('Aksi untuk memblokir IOC belum diimplementasikan.');
    }

    function analyzeIOC() {
        alert('Aksi untuk analisis IOC belum diimplementasikan.');
    }

    function exportIOC() {
        alert('Aksi untuk ekspor IOC belum diimplementasikan.');
    }

    function shareIOC() {
        alert('Aksi untuk berbagi IOC belum diimplementasikan.');
    }
</script>
<script>
    // Threat intelligence actions
    function blockThreat() {
        showConfirmAlert('Block Threat', 'Are you sure you want to block this IOC across all security systems?', () => {
            showInfoAlert('Block Threat', 'IOC blocking request sent to security systems (Demo Mode)');
        });
    }

    function analyzeIOC() {
        showInfoAlert('Analyze IOC', 'Deep analysis initiated. Results will be available in the threat analysis dashboard (Demo Mode)');
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
        const dataBlob = new Blob([dataStr], {
            type: 'application/json'
        });
        const url = URL.createObjectURL(dataBlob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'threat_ioc_<?= $threat['id'] ?>.json';
        link.click();
    }

    function shareIOC() {
        showInfoAlert('Share IOC', 'Threat intelligence sharing initiated with partner organizations (Demo Mode)');
    }

    // Auto-refresh threat status
    setInterval(function() {
        console.log('Threat status refresh triggered');
    }, 60000);
</script>

<?= $this->endSection() ?>