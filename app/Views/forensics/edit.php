<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-search text-indigo-600 mr-3"></i>
                    Edit Forensics Case
                </h1>
                <p class="text-gray-600 mt-1">Modify forensics case details and investigation progress</p>
            </div>
            <div class="flex space-x-3">
                <a href="/forensics/show/<?= $case['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    View Case
                </a>
                <a href="/forensics" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Cases
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Case Information Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-indigo-900">Case Information</h3>
                        <div class="flex items-center space-x-4 text-sm text-indigo-700">
                            <span><i class="fas fa-calendar mr-1"></i> Created: <?= date('M j, Y', strtotime($case['created_at'])) ?></span>
                            <span><i class="fas fa-clock mr-1"></i> Last Updated: <?= date('M j, Y H:i', strtotime($case['updated_at'])) ?></span>
                        </div>
                    </div>
                </div>

                <form id="editCaseForm" action="/forensics/<?= $case['id'] ?>" method="POST" class="p-6">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Case Identification -->
                        <div class="space-y-4">
                            <div>
                                <label for="case_number" class="block text-sm font-medium text-gray-700 mb-1">Case Number</label>
                                <input type="text" id="case_number" name="case_number" 
                                       value="<?= $case['case_number'] ?>" readonly
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                                <p class="text-xs text-gray-500 mt-1">Case number cannot be changed</p>
                            </div>

                            <div>
                                <label for="case_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Case Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="case_name" name="case_name" 
                                       value="<?= $case['case_name'] ?>" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="case_type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Case Type <span class="text-red-500">*</span>
                                </label>
                                <select id="case_type" name="case_type" required 
                                        onchange="updateCaseTypeInfo()" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="">Select case type...</option>
                                    <option value="Malware Analysis" <?= $case['case_type'] == 'Malware Analysis' ? 'selected' : '' ?>>Malware Analysis</option>
                                    <option value="Network Forensics" <?= $case['case_type'] == 'Network Forensics' ? 'selected' : '' ?>>Network Forensics</option>
                                    <option value="Disk Forensics" <?= $case['case_type'] == 'Disk Forensics' ? 'selected' : '' ?>>Disk Forensics</option>
                                    <option value="Mobile Forensics" <?= $case['case_type'] == 'Mobile Forensics' ? 'selected' : '' ?>>Mobile Forensics</option>
                                    <option value="Memory Forensics" <?= $case['case_type'] == 'Memory Forensics' ? 'selected' : '' ?>>Memory Forensics</option>
                                    <option value="Email Forensics" <?= $case['case_type'] == 'Email Forensics' ? 'selected' : '' ?>>Email Forensics</option>
                                    <option value="Database Forensics" <?= $case['case_type'] == 'Database Forensics' ? 'selected' : '' ?>>Database Forensics</option>
                                    <option value="Cloud Forensics" <?= $case['case_type'] == 'Cloud Forensics' ? 'selected' : '' ?>>Cloud Forensics</option>
                                    <option value="Other" <?= $case['case_type'] == 'Other' ? 'selected' : '' ?>>Other</option>
                                </select>
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                                    Priority <span class="text-red-500">*</span>
                                </label>
                                <select id="priority" name="priority" required 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="Low" <?= $case['priority'] == 'Low' ? 'selected' : '' ?>>Low</option>
                                    <option value="Medium" <?= $case['priority'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                                    <option value="High" <?= $case['priority'] == 'High' ? 'selected' : '' ?>>High</option>
                                    <option value="Critical" <?= $case['priority'] == 'Critical' ? 'selected' : '' ?>>Critical</option>
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select id="status" name="status" required 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="Active" <?= $case['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                    <option value="In Progress" <?= $case['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                                    <option value="On Hold" <?= $case['status'] == 'On Hold' ? 'selected' : '' ?>>On Hold</option>
                                    <option value="Completed" <?= $case['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="Archived" <?= $case['status'] == 'Archived' ? 'selected' : '' ?>>Archived</option>
                                </select>
                            </div>
                        </div>

                        <!-- Investigation Details -->
                        <div class="space-y-4">
                            <div>
                                <label for="assigned_investigator" class="block text-sm font-medium text-gray-700 mb-1">
                                    Assigned Investigator <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="assigned_investigator" name="assigned_investigator" 
                                       value="<?= $case['assigned_investigator'] ?>" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="incident_date" class="block text-sm font-medium text-gray-700 mb-1">Incident Date</label>
                                <input type="datetime-local" id="incident_date" name="incident_date" 
                                       value="<?= $case['incident_date'] ? date('Y-m-d\TH:i', strtotime($case['incident_date'])) : '' ?>"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="evidence_count" class="block text-sm font-medium text-gray-700 mb-1">Evidence Count</label>
                                <input type="number" id="evidence_count" name="evidence_count" 
                                       value="<?= $case['evidence_count'] ?>" min="0"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="closed_date" class="block text-sm font-medium text-gray-700 mb-1">Closed Date</label>
                                <input type="datetime-local" id="closed_date" name="closed_date" 
                                       value="<?= $case['closed_date'] ? date('Y-m-d\TH:i', strtotime($case['closed_date'])) : '' ?>"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Set when case is completed</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Case Description</label>
                        <textarea id="description" name="description" rows="4" 
                                  placeholder="Detailed description of the case and initial observations..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"><?= $case['description'] ?></textarea>
                    </div>

                    <!-- Findings -->
                    <div class="mt-6">
                        <label for="findings" class="block text-sm font-medium text-gray-700 mb-1">Investigation Findings</label>
                        <textarea id="findings" name="findings" rows="4" 
                                  placeholder="Key findings, evidence analysis results, and conclusions..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"><?= $case['findings'] ?></textarea>
                    </div>

                    <!-- Recommendations -->
                    <div class="mt-6">
                        <label for="recommendations" class="block text-sm font-medium text-gray-700 mb-1">Recommendations</label>
                        <textarea id="recommendations" name="recommendations" rows="3" 
                                  placeholder="Security recommendations and remediation steps..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"><?= $case['recommendations'] ?></textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="/forensics" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="button" onclick="resetForm()" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-undo mr-2"></i>Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i>Update Case
                        </button>
                    </div>
                </form>
            </div>

            <!-- Case Type Information -->
            <div id="caseTypeInfo" class="bg-blue-50 rounded-xl border border-blue-200 p-6 mb-6" style="display: none;">
                <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Case Type Guidelines
                </h4>
                <div id="caseTypeContent" class="text-blue-800 text-sm"></div>
            </div>
        </div>
    </div>
</div>

<script>
const caseTypeGuidelines = {
    'Malware Analysis': 'Focus on static and dynamic analysis of suspicious files. Document IOCs, behavior patterns, and mitigation strategies.',
    'Network Forensics': 'Analyze network traffic, packet captures, and communication patterns. Look for data exfiltration and lateral movement.',
    'Disk Forensics': 'Examine file systems, deleted files, and disk artifacts. Maintain proper chain of custody for all evidence.',
    'Mobile Forensics': 'Extract and analyze data from mobile devices. Consider device encryption and cloud synchronization.',
    'Memory Forensics': 'Analyze RAM dumps for running processes, network connections, and malware artifacts.',
    'Email Forensics': 'Investigate email headers, attachments, and communication patterns. Look for phishing indicators.',
    'Database Forensics': 'Examine database logs, unauthorized access, and data modification patterns.',
    'Cloud Forensics': 'Investigate cloud infrastructure, access logs, and distributed evidence across multiple platforms.',
    'Other': 'Follow standard forensic procedures and document all investigative steps thoroughly.'
};

function updateCaseTypeInfo() {
    const caseType = document.getElementById('case_type').value;
    const infoDiv = document.getElementById('caseTypeInfo');
    const contentDiv = document.getElementById('caseTypeContent');
    
    if (caseType && caseTypeGuidelines[caseType]) {
        contentDiv.textContent = caseTypeGuidelines[caseType];
        infoDiv.style.display = 'block';
    } else {
        infoDiv.style.display = 'none';
    }
}

function resetForm() {
    if (confirm('Are you sure you want to reset all changes? This will restore the original case values.')) {
        document.getElementById('editCaseForm').reset();
        // Restore original values
        <?php foreach($case as $key => $value): ?>
        <?php if ($key !== 'id' && $key !== 'case_number'): ?>
        const <?= $key ?>Field = document.querySelector('[name="<?= $key ?>"]');
        if (<?= $key ?>Field) {
            <?= $key ?>Field.value = <?= json_encode($value) ?>;
        }
        <?php endif; ?>
        <?php endforeach; ?>
        updateCaseTypeInfo();
    }
}

// Form validation
document.getElementById('editCaseForm').addEventListener('submit', function(e) {
    const requiredFields = ['case_name', 'case_type', 'priority', 'status', 'assigned_investigator'];
    let isValid = true;
    
    requiredFields.forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (!field.value.trim()) {
            field.classList.add('border-red-500', 'bg-red-50');
            isValid = false;
        } else {
            field.classList.remove('border-red-500', 'bg-red-50');
        }
    });
    
    if (!isValid) {
        e.preventDefault();
        showErrorAlert('Validation Error', 'Please fill in all required fields.');
        return false;
    }
    
    // Confirm update in demo mode
    e.preventDefault();
    showConfirmAlert('Update Forensics Case', 'Update forensics case? (Demo Mode - No actual database changes)', () => {
        showSuccessAlert('Case Updated', 'Forensics case updated successfully (Demo Mode)');
    });
});

// Initialize case type info
updateCaseTypeInfo();

// Auto-save draft (demo)
let autoSaveTimer;
document.getElementById('editCaseForm').addEventListener('input', function() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(function() {
        console.log('Auto-saving case draft... (Demo Mode)');
    }, 5000);
});
</script>

<?= $this->endSection() ?>