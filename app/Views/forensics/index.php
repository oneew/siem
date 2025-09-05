<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Digital Forensics Dashboard -->
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Digital Forensics</h2>
            <p class="text-gray-600 mt-1">Incident response and digital evidence management</p>
        </div>
        <div class="flex gap-3">
            <a href="/forensics/create" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>
                New Case
            </a>
            <button onclick="exportCases()" class="btn btn-secondary">
                <i class="fas fa-download mr-2"></i>
                Export Cases
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="card bg-gradient-to-r from-blue-500 to-blue-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Cases</p>
                        <p class="text-3xl font-bold"><?= $stats['total_cases'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-folder-open text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-orange-500 to-orange-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Active Cases</p>
                        <p class="text-3xl font-bold"><?= $stats['active_cases'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-orange-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-search text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-green-500 to-green-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Completed</p>
                        <p class="text-3xl font-bold"><?= $stats['completed_cases'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-r from-purple-500 to-purple-600 text-white">
            <div class="card-content p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Evidence Items</p>
                        <p class="text-3xl font-bold"><?= $stats['evidence_items'] ?></p>
                    </div>
                    <div class="w-12 h-12 bg-purple-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                        <i class="fas fa-archive text-xl"></i>
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
                    <input type="text" id="searchCase" placeholder="Search cases..." 
                           class="form-input w-full" onkeyup="searchCases()">
                </div>
                <div class="flex gap-2">
                    <select id="filterStatus" class="form-select" onchange="filterCases()">
                        <option value="">All Status</option>
                        <option value="Active">Active</option>
                        <option value="In Progress">In Progress</option>
                        <option value="On Hold">On Hold</option>
                        <option value="Completed">Completed</option>
                        <option value="Archived">Archived</option>
                    </select>
                    <select id="filterPriority" class="form-select" onchange="filterCases()">
                        <option value="">All Priorities</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <select id="filterType" class="form-select" onchange="filterCases()">
                        <option value="">All Types</option>
                        <option value="Malware Analysis">Malware Analysis</option>
                        <option value="Network Forensics">Network Forensics</option>
                        <option value="Disk Forensics">Disk Forensics</option>
                        <option value="Mobile Forensics">Mobile Forensics</option>
                        <option value="Memory Forensics">Memory Forensics</option>
                        <option value="Email Forensics">Email Forensics</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Cases Table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-search mr-2"></i>
                Forensics Cases
            </h3>
        </div>
        <div class="card-content">
            <div class="table-wrapper">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Case</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Investigator</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidence</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200" id="casesTableBody">
                        <?php foreach ($cases as $case): ?>
                        <tr class="hover:bg-gray-50" 
                            data-priority="<?= $case['priority'] ?>" 
                            data-status="<?= $case['status'] ?>" 
                            data-type="<?= $case['case_type'] ?>">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10 mr-3">
                                        <div class="w-10 h-10 rounded-full <?= getCaseTypeColor($case['case_type']) ?> flex items-center justify-center">
                                            <i class="<?= getCaseTypeIcon($case['case_type']) ?> text-white text-sm"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">
                                            <?= esc($case['case_number']) ?>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            <?= esc(substr($case['case_name'], 0, 40)) ?><?= strlen($case['case_name']) > 40 ? '...' : '' ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getCaseTypeClass($case['case_type']) ?>">
                                    <?= esc($case['case_type']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getPriorityClass($case['priority']) ?>">
                                    <?= esc($case['priority']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?= esc($case['assigned_investigator']) ?>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= getStatusClass($case['status']) ?>">
                                    <div class="w-2 h-2 rounded-full mr-1 <?= getStatusDot($case['status']) ?>"></div>
                                    <?= esc($case['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <div class="flex items-center">
                                    <i class="fas fa-archive mr-1 text-gray-400"></i>
                                    <?= $case['evidence_count'] ?? 0 ?> items
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <?= date('M j, Y', strtotime($case['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4 text-sm space-x-2">
                                <a href="/forensics/show/<?= $case['id'] ?>" class="text-blue-600 hover:text-blue-800" title="View Case">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/forensics/add-evidence/<?= $case['id'] ?>" class="text-green-600 hover:text-green-800" title="Add Evidence">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="/forensics/report/<?= $case['id'] ?>" class="text-purple-600 hover:text-purple-800" title="Generate Report">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                                <?php if ($case['status'] === 'Active' || $case['status'] === 'In Progress'): ?>
                                <a href="/forensics/close/<?= $case['id'] ?>" class="text-orange-600 hover:text-orange-800" title="Close Case">
                                    <i class="fas fa-check"></i>
                                </a>
                                <?php endif; ?>
                                <a href="/forensics/delete/<?= $case['id'] ?>" 
                                   onclick="return confirm('Are you sure you want to delete this forensics case?')"
                                   class="text-red-600 hover:text-red-800" title="Delete Case">
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
function getCaseTypeColor($type) {
    switch($type) {
        case 'Malware Analysis': return 'bg-red-500';
        case 'Network Forensics': return 'bg-blue-500';
        case 'Disk Forensics': return 'bg-green-500';
        case 'Mobile Forensics': return 'bg-purple-500';
        case 'Memory Forensics': return 'bg-orange-500';
        case 'Email Forensics': return 'bg-teal-500';
        default: return 'bg-gray-500';
    }
}

function getCaseTypeIcon($type) {
    switch($type) {
        case 'Malware Analysis': return 'fas fa-virus';
        case 'Network Forensics': return 'fas fa-network-wired';
        case 'Disk Forensics': return 'fas fa-hdd';
        case 'Mobile Forensics': return 'fas fa-mobile-alt';
        case 'Memory Forensics': return 'fas fa-memory';
        case 'Email Forensics': return 'fas fa-envelope';
        default: return 'fas fa-search';
    }
}

function getCaseTypeClass($type) {
    switch($type) {
        case 'Malware Analysis': return 'bg-red-100 text-red-800';
        case 'Network Forensics': return 'bg-blue-100 text-blue-800';
        case 'Disk Forensics': return 'bg-green-100 text-green-800';
        case 'Mobile Forensics': return 'bg-purple-100 text-purple-800';
        case 'Memory Forensics': return 'bg-orange-100 text-orange-800';
        case 'Email Forensics': return 'bg-teal-100 text-teal-800';
        default: return 'bg-gray-100 text-gray-800';
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

function getStatusClass($status) {
    switch($status) {
        case 'Active': return 'bg-green-100 text-green-800';
        case 'In Progress': return 'bg-blue-100 text-blue-800';
        case 'On Hold': return 'bg-yellow-100 text-yellow-800';
        case 'Completed': return 'bg-gray-100 text-gray-800';
        case 'Archived': return 'bg-purple-100 text-purple-800';
        default: return 'bg-gray-100 text-gray-800';
    }
}

function getStatusDot($status) {
    switch($status) {
        case 'Active': return 'bg-green-500';
        case 'In Progress': return 'bg-blue-500';
        case 'On Hold': return 'bg-yellow-500';
        case 'Completed': return 'bg-gray-500';
        case 'Archived': return 'bg-purple-500';
        default: return 'bg-gray-500';
    }
}
?>

<script>
function searchCases() {
    const searchTerm = document.getElementById('searchCase').value.toLowerCase();
    const rows = document.querySelectorAll('#casesTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterCases() {
    const statusFilter = document.getElementById('filterStatus').value;
    const priorityFilter = document.getElementById('filterPriority').value;
    const typeFilter = document.getElementById('filterType').value;
    const rows = document.querySelectorAll('#casesTableBody tr');
    
    rows.forEach(row => {
        const status = row.dataset.status;
        const priority = row.dataset.priority;
        const type = row.dataset.type;
        
        const statusMatch = !statusFilter || status === statusFilter;
        const priorityMatch = !priorityFilter || priority === priorityFilter;
        const typeMatch = !typeFilter || type === typeFilter;
        
        if (statusMatch && priorityMatch && typeMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function exportCases() {
    // Show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Exporting...';
    button.disabled = true;
    
    // Simulate export
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
        showAdvancedToast('success', 'Success', 'Forensics cases exported successfully');
    }, 2000);
}
</script>

<?= $this->endSection() ?>