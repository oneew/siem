<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                    Detail Intelijen Ancaman
                </h1>
                <p class="text-gray-600 mt-1">Informasi dan analisis komprehensif terkait IOC</p>
            </div>
            <div class="flex space-x-3">
                <a href="/threats/<?= $threat['id'] ?>/edit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Ancaman
                </a>
                <a href="/threats" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Threat Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-red-600 to-red-700 text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold"><?= esc($threat['ioc_value']) ?></h2>
                            <p class="text-red-100 mt-1"><?= esc($threat['threat_type']) ?></p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full
                                <?php 
                                switch($threat['status']) {
                                    case 'Active': echo 'bg-red-500 text-white'; break;
                                    case 'Inactive': echo 'bg-gray-500 text-white'; break;
                                    case 'Investigating': echo 'bg-yellow-500 text-white'; break;
                                    default: echo 'bg-gray-500 text-white'; break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-2"></i>
                                <?php 
                                switch($threat['status']) {
                                    case 'Active': echo 'Aktif'; break;
                                    case 'Inactive': echo 'Tidak Aktif'; break;
                                    case 'Investigating': echo 'Sedang Diinvestigasi'; break;
                                    default: echo esc($threat['status']); break;
                                }
                                ?>
                            </span>
                            <div class="text-sm text-red-100 mt-2">
                                ID Ancaman: #<?= $threat['id'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- IOC Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-search mr-2 text-gray-600"></i>
                            Informasi IOC
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Tipe IOC:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
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
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Nilai IOC:</span>
                                <span class="font-mono text-gray-900 break-all"><?= esc($threat['ioc_value']) ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Keparahan:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($threat['severity']) {
                                        case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                        case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?php 
                                    switch($threat['severity']) {
                                        case 'Critical': echo 'Kritis'; break;
                                        case 'High': echo 'Tinggi'; break;
                                        case 'Medium': echo 'Sedang'; break;
                                        case 'Low': echo 'Rendah'; break;
                                        default: echo esc($threat['severity']); break;
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Tingkat Kepercayaan:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($threat['confidence']) {
                                        case 'High': echo 'bg-green-100 text-green-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-red-100 text-red-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <?php 
                                    switch($threat['confidence']) {
                                        case 'High': echo 'Tinggi'; break;
                                        case 'Medium': echo 'Sedang'; break;
                                        case 'Low': echo 'Rendah'; break;
                                        default: echo esc($threat['confidence']); break;
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Sumber:</span>
                                <span class="text-gray-900"><?= esc($threat['source']) ?: 'Tidak Diketahui' ?></span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="font-medium text-gray-600">Tags/Label:</span>
                                <div class="text-gray-900">
                                    <?php if ($threat['tags']): ?>
                                        <?php $tags = explode(',', $threat['tags']); ?>
                                        <?php foreach($tags as $tag): ?>
                                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded mr-1 mb-1">
                                                <?= esc(trim($tag)) ?>
                                            </span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span class="text-gray-500 text-sm">Tidak ada tag</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Timeline Information -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clock mr-2 text-gray-600"></i>
                            Informasi Garis Waktu
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- First Seen -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Pertama Terdeteksi</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($threat['first_seen']) && $threat['first_seen'] ? 
                                            date('j M Y, H:i', strtotime($threat['first_seen'])) : 'Tidak Diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Last Seen -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-eye-slash text-orange-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Terakhir Terdeteksi</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($threat['last_seen']) && $threat['last_seen'] ? 
                                            date('j M Y, H:i', strtotime($threat['last_seen'])) : 'Tidak Diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Added to System -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-green-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Ditambahkan ke Sistem</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($threat['created_at']) ? 
                                            date('j M Y, H:i', strtotime($threat['created_at'])) : 'Tidak Diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Last Updated -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-purple-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Terakhir Diperbarui</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($threat['updated_at']) ? 
                                            date('j M Y, H:i', strtotime($threat['updated_at'])) : 'Tidak Diketahui' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <?php if ($threat['description']): ?>
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                        Deskripsi & Analisis
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed"><?= nl2br(esc($threat['description'])) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Threat Intelligence Actions -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-gray-600"></i>
                        Aksi Intelijen Ancaman
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center" onclick="blockThreat()">
                            <i class="fas fa-ban text-xl mb-2"></i>
                            <span class="text-sm font-medium mt-1">Blokir IOC</span>
                        </button>
                        <button class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center" onclick="analyzeIOC()">
                            <i class="fas fa-search-plus text-xl mb-2"></i>
                            <span class="text-sm font-medium mt-1">Analisis Mendalam</span>
                        </button>
                        <button class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center" onclick="exportIOC()">
                            <i class="fas fa-download text-xl mb-2"></i>
                            <span class="text-sm font-medium mt-1">Ekspor IOC</span>
                        </button>
                        <button class="bg-purple-50 hover:bg-purple-100 border border-purple-200 text-purple-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center" onclick="shareIOC()">
                            <i class="fas fa-share-alt text-xl mb-2"></i>
                            <span class="text-sm font-medium mt-1">Bagikan Intelijen</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Threats -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-link mr-2 text-gray-600"></i>
                        Ancaman Terkait
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Demo related threats -->
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">IP</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">192.168.1.101</p>
                                <p class="text-xs text-gray-500">Satu subnet - Berpotensi dikompromikan</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-xs text-gray-500">Kemiripan 85%</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <span class="inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Domain</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">similar-threat.com</p>
                                <p class="text-xs text-gray-500">Aktor ancaman sama - Grup APT</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="text-xs text-gray-500">Kemiripan 72%</span>
                            </div>
                        </div>

                        <div class="text-center py-4">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Lihat semua ancaman terkait →
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
    if (confirm('Apakah Anda yakin ingin memblokir IOC ini di seluruh sistem keamanan?')) {
        alert('Permintaan pemblokiran IOC telah dikirim ke sistem keamanan (Mode Demo)');
    }
}

function analyzeIOC() {
    alert('Analisis mendalam dimulai. Hasil akan tersedia di dasbor analisis ancaman (Mode Demo)');
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
    alert('Berbagi intelijen ancaman dengan organisasi mitra dimulai (Mode Demo)');
}

// Auto-refresh threat status
setInterval(function() {
    console.log('Pembaruan status ancaman dipicu');
}, 60000);
</script>

<?= $this->endSection() ?>