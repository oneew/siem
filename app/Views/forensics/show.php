<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-search text-indigo-600 mr-3"></i>
                    Forensics Case Details
                </h1>
                <p class="text-gray-600 mt-1">Case #<?= $case['case_number'] ?> - <?= $case['case_name'] ?></p>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportCase('pdf')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Export PDF
                </button>
                <a href="/forensics/edit/<?= $case['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Case
                </a>
                <a href="/forensics" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    All Cases
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Case Status Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-indigo-900">Case Overview</h3>
                        <div class="flex items-center space-x-4">
                            <?php
                            $statusColors = [
                                'Active' => 'bg-green-100 text-green-800',
                                'In Progress' => 'bg-blue-100 text-blue-800',
                                'On Hold' => 'bg-yellow-100 text-yellow-800',
                                'Completed' => 'bg-gray-100 text-gray-800',
                                'Archived' => 'bg-gray-100 text-gray-600'
                            ];
                            $priorityColors = [
                                'Low' => 'bg-green-100 text-green-800',
                                'Medium' => 'bg-yellow-100 text-yellow-800',
                                'High' => 'bg-orange-100 text-orange-800',
                                'Critical' => 'bg-red-100 text-red-800'
                            ];
                            ?>
                            <span class="px-3 py-1 rounded-full text-xs font-medium <?= $statusColors[$case['status']] ?>">
                                <?= $case['status'] ?>
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium <?= $priorityColors[$case['priority']] ?>">
                                <?= $case['priority'] ?> Priority
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 mb-1"><?= $case['case_type'] ?></div>
                            <div class="text-sm text-gray-600">Case Type</div>
                        </div>
                        
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 mb-1"><?= $case['evidence_count'] ?: 0 ?></div>
                            <div class="text-sm text-gray-600">Evidence Items</div>
                        </div>
                        
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 mb-1">
                                <?php
                                $createdDate = new DateTime($case['created_at']);
                                $now = new DateTime();
                                $diff = $createdDate->diff($now);
                                echo $diff->days;
                                ?>
                            </div>
                            <div class="text-sm text-gray-600">Days Active</div>
                        </div>
                        
                        <div class="text-center p-4 bg-orange-50 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600 mb-1">
                                <?= $case['assigned_investigator'] ? '1' : '0' ?>
                            </div>
                            <div class="text-sm text-gray-600">Investigators</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Case Information -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Case Details -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-clipboard-list mr-2 text-gray-600"></i>
                                Case Information
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Case Number</label>
                                    <p class="text-gray-900 font-mono"><?= $case['case_number'] ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Case Name</label>
                                    <p class="text-gray-900"><?= $case['case_name'] ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Assigned Investigator</label>
                                    <p class="text-gray-900 flex items-center">
                                        <i class="fas fa-user-tie mr-2 text-gray-400"></i>
                                        <?= $case['assigned_investigator'] ?>
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Incident Date</label>
                                    <p class="text-gray-900">
                                        <?= $case['incident_date'] ? date('M j, Y g:i A', strtotime($case['incident_date'])) : 'Not specified' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Case Description -->
                    <?php if ($case['description']): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                                Case Description
                            </h3>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= $case['description'] ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Investigation Findings -->
                    <?php if ($case['findings']): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-search mr-2 text-gray-600"></i>
                                Investigation Findings
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= $case['findings'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Recommendations -->
                    <?php if ($case['recommendations']): ?>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-lightbulb mr-2 text-gray-600"></i>
                                Recommendations
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= $case['recommendations'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Evidence List -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-archive mr-2 text-gray-600"></i>
                                    Evidence Chain of Custody
                                </h3>
                                <button onclick="addEvidence()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">
                                    <i class="fas fa-plus mr-1"></i>Add Evidence
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div id="evidenceList" class="space-y-4">
                                <!-- Demo Evidence Items -->
                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">System Memory Dump</h4>
                                            <p class="text-sm text-gray-600 mt-1">Complete RAM image captured from affected workstation</p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span><i class="fas fa-calendar mr-1"></i>Collected: <?= date('M j, Y H:i') ?></span>
                                                <span><i class="fas fa-file-alt mr-1"></i>Size: 8.2 GB</span>
                                                <span><i class="fas fa-shield-alt mr-1"></i>Hash: SHA256</span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Verified</span>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">Network Packet Capture</h4>
                                            <p class="text-sm text-gray-600 mt-1">PCAP file containing suspicious network traffic</p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span><i class="fas fa-calendar mr-1"></i>Collected: <?= date('M j, Y H:i', strtotime('-2 hours')) ?></span>
                                                <span><i class="fas fa-file-alt mr-1"></i>Size: 152 MB</span>
                                                <span><i class="fas fa-shield-alt mr-1"></i>Hash: SHA256</span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Verified</span>
                                    </div>
                                </div>
                                
                                <div class="text-center py-8 text-gray-500" id="noEvidence" style="display: none;">
                                    <i class="fas fa-archive text-4xl mb-2 opacity-50"></i>
                                    <p>No evidence items recorded yet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-bolt mr-2 text-gray-600"></i>
                                Quick Actions
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <button onclick="updateStatus()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-flag mr-2"></i>Update Status
                            </button>
                            <button onclick="assignInvestigator()" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-user-plus mr-2"></i>Assign Investigator
                            </button>
                            <button onclick="generateReport()" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-file-alt mr-2"></i>Generate Report
                            </button>
                            <button onclick="closeCase()" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-archive mr-2"></i>Close Case
                            </button>
                        </div>
                    </div>

                    <!-- Case Timeline -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-timeline mr-2 text-gray-600"></i>
                                Case Timeline
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <!-- Timeline Items -->
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-blue-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Case Created</p>
                                        <p class="text-xs text-gray-500"><?= date('M j, Y H:i', strtotime($case['created_at'])) ?></p>
                                    </div>
                                </div>

                                <?php if ($case['incident_date']): ?>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exclamation text-red-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Incident Occurred</p>
                                        <p class="text-xs text-gray-500"><?= date('M j, Y H:i', strtotime($case['incident_date'])) ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($case['updated_at'] !== $case['created_at']): ?>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-yellow-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Case Updated</p>
                                        <p class="text-xs text-gray-500"><?= date('M j, Y H:i', strtotime($case['updated_at'])) ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php if ($case['closed_date']): ?>
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-gray-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Case Closed</p>
                                        <p class="text-xs text-gray-500"><?= date('M j, Y H:i', strtotime($case['closed_date'])) ?></p>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Related Cases -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-link mr-2 text-gray-600"></i>
                                Related Cases
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <!-- Demo Related Cases -->
                                <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="font-medium text-sm text-gray-900">CASE-2024-001</div>
                                    <div class="text-xs text-gray-600">Network Intrusion</div>
                                </a>
                                <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="font-medium text-sm text-gray-900">CASE-2024-003</div>
                                    <div class="text-xs text-gray-600">Data Exfiltration</div>
                                </a>
                                <div class="text-center py-4 text-gray-500 text-sm" id="noRelated" style="display: none;">
                                    No related cases found
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Quick action functions
function updateStatus() {
    const newStatus = prompt('Enter new status (Active, In Progress, On Hold, Completed, Archived):');
    if (newStatus) {
        alert(`Case status updated to: ${newStatus} (Demo Mode)`);
        // In production: make API call to update status
    }
}

function assignInvestigator() {
    const investigator = prompt('Enter investigator name:');
    if (investigator) {
        alert(`Case assigned to: ${investigator} (Demo Mode)`);
        // In production: make API call to assign investigator
    }
}

function generateReport() {
    alert('Generating forensics report... (Demo Mode)\n\nReport will include case summary, evidence analysis, and recommendations.');
    // In production: redirect to report generation
}

function closeCase() {
    if (confirm('Are you sure you want to close this case? This action cannot be undone.')) {
        alert('Case marked as closed (Demo Mode)');
        // In production: make API call to close case
    }
}

function addEvidence() {
    const evidenceName = prompt('Enter evidence item name:');
    if (evidenceName) {
        const evidenceList = document.getElementById('evidenceList');
        const newEvidence = document.createElement('div');
        newEvidence.className = 'border border-gray-200 rounded-lg p-4 bg-gray-50';
        newEvidence.innerHTML = `
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h4 class="font-medium text-gray-900">${evidenceName}</h4>
                    <p class="text-sm text-gray-600 mt-1">New evidence item added</p>
                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                        <span><i class="fas fa-calendar mr-1"></i>Collected: ${new Date().toLocaleString()}</span>
                        <span><i class="fas fa-shield-alt mr-1"></i>Hash: Pending</span>
                    </div>
                </div>
                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded">Pending</span>
            </div>
        `;
        evidenceList.appendChild(newEvidence);
        alert('Evidence item added (Demo Mode)');
    }
}

function exportCase(format) {
    if (format === 'pdf') {
        alert('Exporting case to PDF format (Demo Mode)\n\nReport will include all case details, timeline, and evidence chain.');
        // In production: generate and download PDF
    }
}

// Auto-refresh case status every 5 minutes
setInterval(function() {
    console.log('Refreshing case status... (Demo Mode)');
}, 300000);
</script>

<?= $this->endSection() ?>