<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-purple-600 mr-3"></i>
                    Create New Forensics Case
                </h1>
                <p class="text-gray-600 mt-1">Initialize a new digital forensics investigation case</p>
            </div>
            <a href="/forensics" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Forensics
            </a>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-search mr-2 text-gray-600"></i>
                        Forensics Case Information
                    </h2>
                </div>

                <form action="/forensics" method="POST" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Case Name -->
                        <div class="md:col-span-2">
                            <label for="case_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Case Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="case_name" 
                                   name="case_name" 
                                   required
                                   placeholder="e.g., Malware Analysis - Executive Laptop, Network Intrusion Investigation"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Case Number -->
                        <div>
                            <label for="case_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Case Number
                            </label>
                            <input type="text" 
                                   id="case_number" 
                                   name="case_number"
                                   value="FOR-<?= date('Y') ?>-<?= str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) ?>"
                                   placeholder="Auto-generated or manual entry"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Case Type -->
                        <div>
                            <label for="case_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Case Type <span class="text-red-500">*</span>
                            </label>
                            <select id="case_type" 
                                    name="case_type" 
                                    required
                                    onchange="updateCaseGuidelines()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                <option value="">Select Case Type</option>
                                <option value="Malware Analysis">Malware Analysis</option>
                                <option value="Network Forensics">Network Forensics</option>
                                <option value="Disk Forensics">Disk Forensics</option>
                                <option value="Mobile Forensics">Mobile Forensics</option>
                                <option value="Memory Forensics">Memory Forensics</option>
                                <option value="Email Forensics">Email Forensics</option>
                                <option value="Database Forensics">Database Forensics</option>
                                <option value="Cloud Forensics">Cloud Forensics</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <!-- Priority -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                                Priority <span class="text-red-500">*</span>
                            </label>
                            <select id="priority" 
                                    name="priority" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                <option value="">Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Critical">Critical</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" 
                                    name="status" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                <option value="">Select Status</option>
                                <option value="Active" selected>Active</option>
                                <option value="In Progress">In Progress</option>
                                <option value="On Hold">On Hold</option>
                                <option value="Completed">Completed</option>
                                <option value="Archived">Archived</option>
                            </select>
                        </div>

                        <!-- Assigned Investigator -->
                        <div>
                            <label for="assigned_investigator" class="block text-sm font-medium text-gray-700 mb-2">
                                Assigned Investigator <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="assigned_investigator" 
                                   name="assigned_investigator" 
                                   required
                                   placeholder="e.g., John Smith, Digital Forensics Team"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Incident Date -->
                        <div>
                            <label for="incident_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Incident Date
                            </label>
                            <input type="datetime-local" 
                                   id="incident_date" 
                                   name="incident_date"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Evidence Count -->
                        <div>
                            <label for="evidence_count" class="block text-sm font-medium text-gray-700 mb-2">
                                Initial Evidence Count
                            </label>
                            <input type="number" 
                                   id="evidence_count" 
                                   name="evidence_count"
                                   min="0"
                                   value="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Case Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      required
                                      rows="4"
                                      placeholder="Detailed description of the forensics case, including background, scope, objectives, and initial findings..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"></textarea>
                        </div>
                    </div>

                    <!-- Case Guidelines by Type -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                            Forensics Guidelines by Case Type
                        </h3>
                        
                        <div id="case-guidelines">
                            <!-- Malware Analysis -->
                            <div class="case-guideline bg-red-50 border border-red-200 rounded-lg p-4 mb-4" data-type="Malware Analysis" style="display: none;">
                                <h4 class="font-semibold text-red-900 mb-2">Malware Analysis Guidelines</h4>
                                <ul class="text-sm text-red-800 space-y-1">
                                    <li>• Isolate suspected infected systems immediately</li>
                                    <li>• Collect memory dumps and system snapshots</li>
                                    <li>• Document malware behavior and indicators</li>
                                    <li>• Analyze network communications and C&C servers</li>
                                    <li>• Preserve evidence integrity with proper hashing</li>
                                </ul>
                            </div>

                            <!-- Network Forensics -->
                            <div class="case-guideline bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4" data-type="Network Forensics" style="display: none;">
                                <h4 class="font-semibold text-blue-900 mb-2">Network Forensics Guidelines</h4>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Capture and preserve network traffic logs</li>
                                    <li>• Analyze firewall and IDS/IPS logs</li>
                                    <li>• Document network topology and configurations</li>
                                    <li>• Identify suspicious connections and data flows</li>
                                    <li>• Correlate timeline of network events</li>
                                </ul>
                            </div>

                            <!-- Disk Forensics -->
                            <div class="case-guideline bg-green-50 border border-green-200 rounded-lg p-4 mb-4" data-type="Disk Forensics" style="display: none;">
                                <h4 class="font-semibold text-green-900 mb-2">Disk Forensics Guidelines</h4>
                                <ul class="text-sm text-green-800 space-y-1">
                                    <li>• Create bit-for-bit forensic disk images</li>
                                    <li>• Document chain of custody meticulously</li>
                                    <li>• Analyze file systems and recover deleted files</li>
                                    <li>• Examine metadata and timestamp evidence</li>
                                    <li>• Use write-blocking hardware to preserve evidence</li>
                                </ul>
                            </div>

                            <!-- Mobile Forensics -->
                            <div class="case-guideline bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4" data-type="Mobile Forensics" style="display: none;">
                                <h4 class="font-semibold text-purple-900 mb-2">Mobile Forensics Guidelines</h4>
                                <ul class="text-sm text-purple-800 space-y-1">
                                    <li>• Place device in airplane mode or Faraday bag</li>
                                    <li>• Document device state and physical condition</li>
                                    <li>• Extract data using appropriate forensic tools</li>
                                    <li>• Analyze app data, messages, and call logs</li>
                                    <li>• Preserve cloud synchronization evidence</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Chain of Custody -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-link text-blue-600 mr-2"></i>
                            Chain of Custody Requirements
                        </h3>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                                <div>
                                    <p class="text-sm text-yellow-800 mb-2">
                                        <strong>Important:</strong> All evidence collected for this case must maintain a proper chain of custody to be admissible in legal proceedings.
                                    </p>
                                    <ul class="text-xs text-yellow-700 space-y-1">
                                        <li>• Document who, what, when, where, and why for all evidence handling</li>
                                        <li>• Use tamper-evident seals and secure storage</li>
                                        <li>• Maintain detailed logs of all access and transfers</li>
                                        <li>• Obtain proper authorization before evidence collection</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/forensics" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Create Forensics Case
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Form enhancement and validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const caseTypeSelect = document.getElementById('case_type');
    const incidentDateInput = document.getElementById('incident_date');
    
    // Set current datetime for incident date
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    incidentDateInput.value = now.toISOString().slice(0, 16);
    
    // Case type guidelines
    window.updateCaseGuidelines = function() {
        const selectedType = caseTypeSelect.value;
        const guidelines = document.querySelectorAll('.case-guideline');
        
        guidelines.forEach(guideline => {
            if (guideline.dataset.type === selectedType) {
                guideline.style.display = 'block';
            } else {
                guideline.style.display = 'none';
            }
        });
        
        // Auto-suggest case names based on type
        const caseNameInput = document.getElementById('case_name');
        if (!caseNameInput.value && selectedType) {
            const suggestions = {
                'Malware Analysis': 'Malware Analysis - Suspected Infection',
                'Network Forensics': 'Network Intrusion Investigation',
                'Disk Forensics': 'Digital Evidence Recovery Case',
                'Mobile Forensics': 'Mobile Device Investigation',
                'Memory Forensics': 'Memory Dump Analysis',
                'Email Forensics': 'Email Communication Investigation',
                'Database Forensics': 'Database Security Breach Analysis',
                'Cloud Forensics': 'Cloud Infrastructure Investigation'
            };
            caseNameInput.placeholder = suggestions[selectedType] || caseNameInput.placeholder;
        }
    };
    
    // Priority-based styling
    const prioritySelect = document.getElementById('priority');
    prioritySelect.addEventListener('change', function() {
        this.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition-colors ' +
                         (this.value === 'Critical' ? 'focus:ring-red-500 focus:border-red-500 bg-red-50' :
                          this.value === 'High' ? 'focus:ring-orange-500 focus:border-orange-500 bg-orange-50' :
                          this.value === 'Medium' ? 'focus:ring-yellow-500 focus:border-yellow-500 bg-yellow-50' :
                          this.value === 'Low' ? 'focus:ring-blue-500 focus:border-blue-500 bg-blue-50' :
                          'focus:ring-purple-500 focus:border-purple-500');
    });
    
    // Auto-generate case number if empty
    const caseNumberInput = document.getElementById('case_number');
    form.addEventListener('submit', function(e) {
        if (!caseNumberInput.value.trim()) {
            const year = new Date().getFullYear();
            const random = Math.floor(Math.random() * 9000) + 1000;
            caseNumberInput.value = `FOR-${year}-${random}`;
        }
        
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Case...';
        submitBtn.disabled = true;
    });
    
    // Validate evidence count
    const evidenceCountInput = document.getElementById('evidence_count');
    evidenceCountInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.setCustomValidity('Evidence count cannot be negative');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>

<?= $this->endSection() ?>