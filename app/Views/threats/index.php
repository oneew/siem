<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Threat Intelligence Dashboard -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Intelijen Ancaman</h2>
            <p class="text-gray-600 mt-1">Pantau dan kelola *Indicators of Compromise* (IOC)</p>
        </div>
        <div class="flex gap-3">
            <a href="/threats/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm font-medium transition-colors flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Tambah IOC
            </a>
            <button onclick="refreshThreatFeed()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow-sm text-sm font-medium transition-colors flex items-center">
                <i class="fas fa-sync-alt mr-2"></i>
                Segarkan Data
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
                <i class="fas fa-database text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total IOC</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['total_iocs'] ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
                <i class="fas fa-shield-alt text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Ancaman Aktif</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['active_threats'] ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="p-3 rounded-lg bg-red-50 text-red-600 mr-4">
                <i class="fas fa-exclamation-triangle text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Keparahan Tinggi</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['high_severity'] ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
            <div class="p-3 rounded-lg bg-yellow-50 text-yellow-600 mr-4">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Terbaru (24j)</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['recent_24h'] ?></p>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-gray-50 p-6 border-b border-gray-200 rounded-lg mb-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" id="searchIOC" placeholder="Cari Data IOC..." 
                           class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onkeyup="searchThreats()">
                </div>
                <div class="flex gap-2">
                    <select id="filterType" class="border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="filterThreats()">
                        <option value="">Semua Tipe</option>
                        <option value="IP">IP Address</option>
                        <option value="Domain">Domain</option>
                        <option value="Hash">Hash</option>
                        <option value="URL">URL</option>
                        <option value="Email">Email</option>
                    </select>
                    <select id="filterSeverity" class="border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="filterThreats()">
                        <option value="">Semua Tingkat (Keparahan)</option>
                        <option value="Critical">Kritis (Critical)</option>
                        <option value="High">Tinggi (High)</option>
                        <option value="Medium">Sedang (Medium)</option>
                        <option value="Low">Rendah (Low)</option>
                    </select>
                </div>
            </div>
    </div>

    <!-- IOCs Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="font-semibold text-gray-900">
                <i class="fas fa-virus text-gray-400 mr-2"></i>
                Indikator Kompromi (IOC)
            </h3>
        </div>
        <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="p-4">Detail IOC</th>
                            <th class="p-4">Tipe</th>
                            <th class="p-4">Jenis Ancaman</th>
                            <th class="p-4">Tingkat Keparahan</th>
                            <th class="p-4">Tingkat Kepercayaan</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Terakhir Dilihat</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="threatsTableBody">
                        <?php foreach ($threats as $threat): ?>
                        <tr class="hover:bg-gray-50" data-type="<?= $threat['ioc_type'] ?>" data-severity="<?= $threat['severity'] ?>">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 mr-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="<?= getIOCIcon($threat['ioc_type']) ?> text-sm text-gray-600"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= esc(substr($threat['ioc_value'], 0, 50)) ?><?= strlen($threat['ioc_value']) > 50 ? '...' : '' ?>
                                        </div>
                                        <div class="text-sm text-gray-500"><?= esc($threat['source']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                    <?= esc($threat['ioc_type']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900"><?= esc($threat['threat_type']) ?></td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getSeverityClass($threat['severity']) ?>">
                                    <?= esc($threat['severity']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="<?= getConfidenceColor($threat['confidence']) ?> h-2 rounded-full" 
                                             style="width: <?= getConfidenceWidth($threat['confidence']) ?>%"></div>
                                    </div>
                                    <span class="text-sm text-gray-600"><?= esc($threat['confidence']) ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getStatusClass($threat['status']) ?>">
                                    <?= esc($threat['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?= $threat['last_seen'] ? date('M j, Y', strtotime($threat['last_seen'])) : 'N/A' ?>
                            </td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="/threats/show/<?= $threat['id'] ?>" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/threats/edit/<?= $threat['id'] ?>" class="text-green-600 hover:text-green-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/threats/delete/<?= $threat['id'] ?>" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus IOC ini?')"
                                   class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>

<?php
function getIOCIcon($type) {
    switch($type) {
        case 'IP': return 'fas fa-globe';
        case 'Domain': return 'fas fa-link';
        case 'Hash': return 'fas fa-fingerprint';
        case 'URL': return 'fas fa-external-link-alt';
        case 'Email': return 'fas fa-envelope';
        default: return 'fas fa-question';
    }
}

function getSeverityClass($severity) {
    switch($severity) {
        case 'Critical': return 'bg-red-100 text-red-800';
        case 'High': return 'bg-orange-100 text-orange-800';
        case 'Medium': return 'bg-yellow-100 text-yellow-800';
        case 'Low': return 'bg-green-100 text-green-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getConfidenceColor($confidence) {
    switch($confidence) {
        case 'High': return 'bg-green-500';
        case 'Medium': return 'bg-yellow-500';
        case 'Low': return 'bg-red-500';
        default: return 'bg-gray-500';
    }
}

function getConfidenceWidth($confidence) {
    switch($confidence) {
        case 'High': return 100;
        case 'Medium': return 66;
        case 'Low': return 33;
        default: return 0;
    }
}

function getStatusClass($status) {
    switch($status) {
        case 'Active': return 'bg-green-100 text-green-800';
        case 'Inactive': return 'bg-gray-100 text-gray-800';
        case 'Investigating': return 'bg-blue-100 text-blue-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}
?>

<script>
function searchThreats() {
    const searchTerm = document.getElementById('searchIOC').value.toLowerCase();
    const rows = document.querySelectorAll('#threatsTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterThreats() {
    const typeFilter = document.getElementById('filterType').value;
    const severityFilter = document.getElementById('filterSeverity').value;
    const rows = document.querySelectorAll('#threatsTableBody tr');
    
    rows.forEach(row => {
        const type = row.dataset.type;
        const severity = row.dataset.severity;
        
        const typeMatch = !typeFilter || type === typeFilter;
        const severityMatch = !severityFilter || severity === severityFilter;
        
        if (typeMatch && severityMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function refreshThreatFeed() {
    // Show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyegarkan...';
    button.disabled = true;
    
    // Simulate refresh
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
        showAdvancedToast('success', 'Berhasil', 'Umpan intelijen ancaman berhasil disegarkan');
    }, 2000);
}
</script>

<?= $this->endSection() ?>