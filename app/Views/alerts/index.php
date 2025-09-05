<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Security Alerts Dashboard -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Security Alerts</h2>
            <p class="text-gray-600 mt-1">Real-time security monitoring and alerting system</p>
        </div>
        <div class="flex gap-3">
            <a href="/alerts/create" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Create Alert
            </a>
            <button onclick="refreshAlerts()" class="btn btn-secondary">
                <i class="fas fa-sync-alt mr-2"></i>
                Refresh
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Alerts</p>
                        <p class="text-3xl font-bold"><?= $stats['total_alerts'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-bell text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-red-500 to-red-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Active Alerts</p>
                        <p class="text-3xl font-bold"><?= $stats['active_alerts'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-red-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-orange-500 to-orange-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">High Priority</p>
                        <p class="text-3xl font-bold"><?= $stats['high_priority'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-orange-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-fire text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-green-500 to-green-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Last 24h</p>
                        <p class="text-3xl font-bold"><?= $stats['recent_24h'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="card">
        <div class="card-content p-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" id="searchAlert" placeholder="Search alerts..." 
                           class="form-input w-full" onkeyup="searchAlerts()">
                </div>
                <div class="flex gap-2">
                    <select id="filterPriority" class="form-select" onchange="filterAlerts()">
                        <option value="">All Priorities</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <select id="filterStatus" class="form-select" onchange="filterAlerts()">
                        <option value="">All Status</option>
                        <option value="Active">Active</option>
                        <option value="Investigating">Investigating</option>
                        <option value="Closed">Closed</option>
                        <option value="False Positive">False Positive</option>
                    </select>
                    <select id="filterType" class="form-select" onchange="filterAlerts()">
                        <option value="">All Types</option>
                        <option value="Authentication">Authentication</option>
                        <option value="Network">Network</option>
                        <option value="Malware">Malware</option>
                        <option value="Data Breach">Data Breach</option>
                        <option value="Intrusion">Intrusion</option>
                        <option value="System">System</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-bell mr-2"></i>
                Active Security Alerts
            </h3>
        </div>
        <div class="card-content">
            <div class="table-wrapper">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alert</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="alertsTableBody">
                        <?php foreach ($alerts as $alert): ?>
                        <tr class="hover:bg-gray-50 <?= !$alert['acknowledged'] ? 'bg-red-50' : '' ?>" 
                            data-priority="<?= $alert['priority'] ?>" 
                            data-status="<?= $alert['status'] ?>" 
                            data-type="<?= $alert['alert_type'] ?>">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <?php if (!$alert['acknowledged']): ?>
                                        <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse mr-3"></div>
                                    <?php else: ?>
                                        <div class="w-2 h-2 bg-gray-300 rounded-full mr-3"></div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= esc($alert['alert_name']) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            Rule: <?= esc($alert['rule_name'] ?? 'N/A') ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getAlertTypeClass($alert['alert_type']) ?>">
                                    <i class="<?= getAlertTypeIcon($alert['alert_type']) ?> mr-1"></i>
                                    <?= esc($alert['alert_type']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getPriorityClass($alert['priority']) ?>">
                                    <?= esc($alert['priority']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?= esc($alert['source_ip'] ?? 'Unknown') ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getAlertStatusClass($alert['status']) ?>">
                                    <?= esc($alert['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?= date('M j, H:i', strtotime($alert['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="/alerts/show/<?= $alert['id'] ?>" class="text-blue-600 hover:text-blue-800" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <?php if (!$alert['acknowledged']): ?>
                                <a href="/alerts/acknowledge/<?= $alert['id'] ?>" class="text-green-600 hover:text-green-800" title="Acknowledge">
                                    <i class="fas fa-check"></i>
                                </a>
                                <?php endif; ?>
                                <?php if ($alert['status'] === 'Active'): ?>
                                <a href="/alerts/close/<?= $alert['id'] ?>" class="text-orange-600 hover:text-orange-800" title="Close Alert">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                                <?php endif; ?>
                                <a href="/alerts/delete/<?= $alert['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this alert?')"
                                   class="text-red-600 hover:text-red-800" title="Delete">
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
function getAlertTypeClass($type) {
    switch($type) {
        case 'Authentication': return 'bg-blue-100 text-blue-800';
        case 'Network': return 'bg-purple-100 text-purple-800';
        case 'Malware': return 'bg-red-100 text-red-800';
        case 'Data Breach': return 'bg-pink-100 text-pink-800';
        case 'Intrusion': return 'bg-orange-100 text-orange-800';
        case 'System': return 'bg-gray-100 text-gray-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getAlertTypeIcon($type) {
    switch($type) {
        case 'Authentication': return 'fas fa-user-shield';
        case 'Network': return 'fas fa-network-wired';
        case 'Malware': return 'fas fa-virus';
        case 'Data Breach': return 'fas fa-database';
        case 'Intrusion': return 'fas fa-door-open';
        case 'System': return 'fas fa-server';
        default: return 'fas fa-question';
    }
}

function getPriorityClass($priority) {
    switch($priority) {
        case 'Critical': return 'bg-red-100 text-red-800';
        case 'High': return 'bg-orange-100 text-orange-800';
        case 'Medium': return 'bg-yellow-100 text-yellow-800';
        case 'Low': return 'bg-green-100 text-green-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getAlertStatusClass($status) {
    switch($status) {
        case 'Active': return 'bg-red-100 text-red-800';
        case 'Investigating': return 'bg-yellow-100 text-yellow-800';
        case 'Closed': return 'bg-green-100 text-green-800';
        case 'False Positive': return 'bg-gray-100 text-gray-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}
?>

<script>
function searchAlerts() {
    const searchTerm = document.getElementById('searchAlert').value.toLowerCase();
    const rows = document.querySelectorAll('#alertsTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterAlerts() {
    const priorityFilter = document.getElementById('filterPriority').value;
    const statusFilter = document.getElementById('filterStatus').value;
    const typeFilter = document.getElementById('filterType').value;
    const rows = document.querySelectorAll('#alertsTableBody tr');
    
    rows.forEach(row => {
        const priority = row.dataset.priority;
        const status = row.dataset.status;
        const type = row.dataset.type;
        
        const priorityMatch = !priorityFilter || priority === priorityFilter;
        const statusMatch = !statusFilter || status === statusFilter;
        const typeMatch = !typeFilter || type === typeFilter;
        
        if (priorityMatch && statusMatch && typeMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function refreshAlerts() {
    // Show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Refreshing...';
    button.disabled = true;
    
    // Simulate refresh
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
        showAdvancedToast('success', 'Success', 'Security alerts refreshed successfully');
        location.reload();
    }, 1500);
}

// Auto-refresh every 30 seconds
setInterval(() => {
    // In production, this would make an AJAX call to refresh data
    console.log('Auto-refreshing alerts...');
}, 30000);
</script>

<?= $this->endSection() ?>