<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-orange-600 mr-3"></i>
                    Add New Security Alert
                </h1>
                <p class="text-gray-600 mt-1">Create a new security alert for monitoring and response</p>
            </div>
            <a href="/alerts" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Alerts
            </a>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-bell mr-2 text-gray-600"></i>
                        Alert Information
                    </h2>
                </div>

                <form action="/alerts/store" method="POST" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Alert Name -->
                        <div class="md:col-span-2">
                            <label for="alert_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Alert Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="alert_name" 
                                   name="alert_name" 
                                   required
                                   placeholder="e.g., Suspicious Login Activity, Malware Detection, Network Intrusion"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Alert Type -->
                        <div>
                            <label for="alert_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Alert Type <span class="text-red-500">*</span>
                            </label>
                            <select id="alert_type" 
                                    name="alert_type" 
                                    required
                                    onchange="updateAlertSuggestions()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                <option value="">Select Alert Type</option>
                                <option value="Authentication">Authentication</option>
                                <option value="Network">Network</option>
                                <option value="Malware">Malware</option>
                                <option value="Data Breach">Data Breach</option>
                                <option value="Intrusion">Intrusion</option>
                                <option value="System">System</option>
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                <option value="">Select Status</option>
                                <option value="Active" selected>Active</option>
                                <option value="Investigating">Investigating</option>
                                <option value="Closed">Closed</option>
                                <option value="False Positive">False Positive</option>
                            </select>
                        </div>

                        <!-- Source IP -->
                        <div>
                            <label for="source_ip" class="block text-sm font-medium text-gray-700 mb-2">
                                Source IP Address
                            </label>
                            <input type="text" 
                                   id="source_ip" 
                                   name="source_ip"
                                   placeholder="e.g., 192.168.1.100"
                                   pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Rule Name -->
                        <div>
                            <label for="rule_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Detection Rule
                            </label>
                            <input type="text" 
                                   id="rule_name" 
                                   name="rule_name"
                                   placeholder="e.g., SURICATA-2024001, Failed_Login_Attempts"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Alert Description <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      required
                                      rows="4"
                                      placeholder="Detailed description of the security alert, including what was detected, potential impact, and recommended actions..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"></textarea>
                        </div>
                    </div>

                    <!-- Alert Examples by Type -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                            Alert Examples by Type
                        </h3>
                        
                        <div id="alert-examples" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Authentication Examples -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 alert-example" data-type="Authentication">
                                <h4 class="font-semibold text-blue-900 mb-2">Authentication Alerts</h4>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Multiple failed login attempts</li>
                                    <li>• Suspicious login from new location</li>
                                    <li>• Privilege escalation detected</li>
                                    <li>• Account lockout threshold reached</li>
                                </ul>
                            </div>

                            <!-- Network Examples -->
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 alert-example" data-type="Network">
                                <h4 class="font-semibold text-green-900 mb-2">Network Alerts</h4>
                                <ul class="text-sm text-green-800 space-y-1">
                                    <li>• Port scan detected</li>
                                    <li>• Unusual network traffic</li>
                                    <li>• DDoS attack attempt</li>
                                    <li>• Unauthorized network access</li>
                                </ul>
                            </div>

                            <!-- Malware Examples -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 alert-example" data-type="Malware">
                                <h4 class="font-semibold text-red-900 mb-2">Malware Alerts</h4>
                                <ul class="text-sm text-red-800 space-y-1">
                                    <li>• Malicious file detected</li>
                                    <li>• Ransomware activity</li>
                                    <li>• Trojan communication</li>
                                    <li>• Suspicious process behavior</li>
                                </ul>
                            </div>

                            <!-- Data Breach Examples -->
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 alert-example" data-type="Data Breach">
                                <h4 class="font-semibold text-purple-900 mb-2">Data Breach Alerts</h4>
                                <ul class="text-sm text-purple-800 space-y-1">
                                    <li>• Unauthorized data access</li>
                                    <li>• Data exfiltration attempt</li>
                                    <li>• Sensitive file modification</li>
                                    <li>• Database anomaly detected</li>
                                </ul>
                            </div>

                            <!-- Intrusion Examples -->
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 alert-example" data-type="Intrusion">
                                <h4 class="font-semibold text-orange-900 mb-2">Intrusion Alerts</h4>
                                <ul class="text-sm text-orange-800 space-y-1">
                                    <li>• Unauthorized system access</li>
                                    <li>• Security policy violation</li>
                                    <li>• Backdoor detected</li>
                                    <li>• System compromise indicator</li>
                                </ul>
                            </div>

                            <!-- System Examples -->
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 alert-example" data-type="System">
                                <h4 class="font-semibold text-gray-900 mb-2">System Alerts</h4>
                                <ul class="text-sm text-gray-800 space-y-1">
                                    <li>• System resource exhaustion</li>
                                    <li>• Service failure detected</li>
                                    <li>• Configuration change</li>
                                    <li>• Hardware anomaly</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Automated Response Options -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-cog text-blue-600 mr-2"></i>
                            Automated Response Options
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                                <input type="checkbox" id="auto_block" name="auto_block" class="rounded text-blue-600">
                                <label for="auto_block" class="text-sm font-medium text-gray-700">
                                    Auto-block suspicious IPs
                                </label>
                            </div>
                            
                            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                                <input type="checkbox" id="auto_notify" name="auto_notify" class="rounded text-green-600" checked>
                                <label for="auto_notify" class="text-sm font-medium text-gray-700">
                                    Send email notifications
                                </label>
                            </div>
                            
                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <input type="checkbox" id="auto_incident" name="auto_incident" class="rounded text-purple-600">
                                <label for="auto_incident" class="text-sm font-medium text-gray-700">
                                    Create incident automatically
                                </label>
                            </div>
                            
                            <div class="flex items-center space-x-3 p-3 bg-orange-50 rounded-lg">
                                <input type="checkbox" id="auto_isolate" name="auto_isolate" class="rounded text-orange-600">
                                <label for="auto_isolate" class="text-sm font-medium text-gray-700">
                                    Isolate affected systems
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/alerts" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Create Alert
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
    const alertTypeSelect = document.getElementById('alert_type');
    const sourceIpInput = document.getElementById('source_ip');
    
    // Update alert examples visibility
    window.updateAlertSuggestions = function() {
        const selectedType = alertTypeSelect.value;
        const examples = document.querySelectorAll('.alert-example');
        
        examples.forEach(example => {
            if (selectedType === '' || example.dataset.type === selectedType) {
                example.style.display = 'block';
                example.style.opacity = selectedType === example.dataset.type ? '1' : '0.7';
            } else {
                example.style.display = 'none';
            }
        });
        
        // Auto-suggest alert names based on type
        const alertNameInput = document.getElementById('alert_name');
        if (!alertNameInput.value && selectedType) {
            const suggestions = {
                'Authentication': 'Suspicious Authentication Activity Detected',
                'Network': 'Network Anomaly Detected',
                'Malware': 'Malware Activity Detected',
                'Data Breach': 'Potential Data Breach Detected',
                'Intrusion': 'Security Intrusion Detected',
                'System': 'System Anomaly Detected'
            };
            alertNameInput.placeholder = suggestions[selectedType] || alertNameInput.placeholder;
        }
    };
    
    // IP Address validation
    sourceIpInput.addEventListener('input', function() {
        const ipPattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/;
        if (this.value && !ipPattern.test(this.value)) {
            this.setCustomValidity('Please enter a valid IP address (e.g., 192.168.1.100)');
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Priority-based styling
    const prioritySelect = document.getElementById('priority');
    prioritySelect.addEventListener('change', function() {
        this.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition-colors ' +
                         (this.value === 'Critical' ? 'focus:ring-red-500 focus:border-red-500' :
                          this.value === 'High' ? 'focus:ring-orange-500 focus:border-orange-500' :
                          this.value === 'Medium' ? 'focus:ring-yellow-500 focus:border-yellow-500' :
                          'focus:ring-blue-500 focus:border-blue-500');
    });
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Alert...';
        submitBtn.disabled = true;
        
        // Collect automation options
        const automationOptions = [];
        if (document.getElementById('auto_block').checked) automationOptions.push('auto_block');
        if (document.getElementById('auto_notify').checked) automationOptions.push('auto_notify');
        if (document.getElementById('auto_incident').checked) automationOptions.push('auto_incident');
        if (document.getElementById('auto_isolate').checked) automationOptions.push('auto_isolate');
        
        // Add automation options to form data (in production, this would be handled server-side)
        console.log('Automation options:', automationOptions);
    });
});
</script>

<?= $this->endSection() ?>