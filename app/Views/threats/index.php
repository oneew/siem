<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Threat Intelligence Dashboard -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Threat Intelligence</h2>
            <p class="text-gray-600 mt-1">Monitor and manage Indicators of Compromise (IOCs)</p>
        </div>
        <div class="flex gap-3">
            <a href="/threats/create" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Add IOC
            </a>
            <button onclick="refreshThreatFeed()" class="btn btn-secondary">
                <i class="fas fa-sync-alt mr-2"></i>
                Refresh Feed
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="card bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <div class="card-content p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total IOCs</p>
                        <p class="text-2xl sm:text-3xl font-bold"><?= $stats['total_iocs'] ?></p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-database text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-green-500 to-green-600 text-white">
            <div class="card-content p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Active Threats</p>
                        <p class="text-2xl sm:text-3xl font-bold"><?= $stats['active_threats'] ?></p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-red-500 to-red-600 text-white">
            <div class="card-content p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">High Severity</p>
                        <p class="text-2xl sm:text-3xl font-bold"><?= $stats['high_severity'] ?></p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-yellow-500 to-yellow-600 text-white">
            <div class="card-content p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium">Recent (24h)</p>
                        <p class="text-2xl sm:text-3xl font-bold"><?= $stats['recent_24h'] ?></p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card">
        <div class="card-content p-4 sm:p-6">
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <input type="text" id="searchIOC" placeholder="Search IOCs..." 
                           class="form-input w-full" onkeyup="searchThreats()">
                </div>
                <div class="flex gap-2 flex-wrap">
                    <select id="filterType" class="form-select" onchange="filterThreats()">
                        <option value="">All Types</option>
                        <option value="IP">IP Address</option>
                        <option value="Domain">Domain</option>
                        <option value="Hash">Hash</option>
                        <option value="URL">URL</option>
                        <option value="Email">Email</option>
                    </select>
                    <select id="filterSeverity" class="form-select" onchange="filterThreats()">
                        <option value="">All Severities</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- IOCs Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-virus mr-2"></i>
                Indicators of Compromise
            </h3>
        </div>
        <div class="card-content">
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IOC</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Threat</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Severity</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Confidence</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Seen</th>
                            <th class="px-2 py-2 sm:px-3 sm:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="threatsTableBody">
                        <?php foreach ($threats as $threat): ?>
                        <tr class="hover:bg-gray-50" data-type="<?= $threat['ioc_type'] ?>" data-severity="<?= $threat['severity'] ?>">
                            <td class="px-2 py-2 sm:px-3 sm:py-3 max-w-[120px] sm:max-w-xs">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-6 h-6 sm:w-8 sm:h-8 mr-1 sm:mr-2">
                                        <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="<?= getIOCIcon($threat['ioc_type']) ?> text-xs sm:text-sm text-gray-600"></i>
                                        </div>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="text-xs sm:text-sm font-medium text-gray-900 truncate">
                                            <?= esc(substr($threat['ioc_value'], 0, 20)) ?><?= strlen($threat['ioc_value']) > 20 ? '...' : '' ?>
                                        </div>
                                        <div class="text-xs text-gray-500 truncate hidden sm:block"><?= esc($threat['source']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3">
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                    <?= esc($threat['ioc_type']) ?>
                                </span>
                            </td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3 text-xs sm:text-sm text-gray-900 max-w-[100px] sm:max-w-xs truncate"><?= esc(substr($threat['threat_type'], 0, 15)) ?><?= strlen($threat['threat_type']) > 15 ? '...' : '' ?></td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3">
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full <?= getSeverityClass($threat['severity']) ?>">
                                    <?= esc($threat['severity']) ?>
                                </span>
                            </td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3">
                                <div class="flex items-center">
                                    <div class="w-8 sm:w-12 bg-gray-200 rounded-full h-1 mr-1">
                                        <div class="<?= getConfidenceColor($threat['confidence']) ?> h-1 rounded-full" 
                                             style="width: <?= getConfidenceWidth($threat['confidence']) ?>%"></div>
                                    </div>
                                    <span class="text-xs text-gray-600 hidden sm:inline"><?= esc($threat['confidence']) ?></span>
                                </div>
                            </td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3">
                                <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full <?= getStatusClass($threat['status']) ?>">
                                    <?= esc($threat['status']) ?>
                                </span>
                            </td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3 text-xs text-gray-900 whitespace-nowrap">
                                <?= $threat['last_seen'] ? date('M j, Y', strtotime($threat['last_seen'])) : 'N/A' ?>
                            </td>
                            <td class="px-2 py-2 sm:px-3 sm:py-3 text-sm space-x-1">
                                <a href="/threats/show/<?= $threat['id'] ?>" class="text-blue-600 hover:text-blue-800 p-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/threats/edit/<?= $threat['id'] ?>" class="text-green-600 hover:text-green-800 p-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/threats/delete/<?= $threat['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this IOC?')"
                                   class="text-red-600 hover:text-red-800 p-1">
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
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Refreshing...';
    button.disabled = true;
    
    // Simulate refresh
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
        showAdvancedToast('success', 'Success', 'Threat intelligence feed refreshed successfully');
    }, 2000);
}
</script>

<?= $this->endSection() ?>