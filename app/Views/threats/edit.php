<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-edit text-red-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Update threat intelligence information and IOC details</p>
            </div>
            <div class="flex space-x-3">
                <a href="/threats/<?= $threat['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    View Details
                </a>
                <a href="/threats" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Threats
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-gray-600"></i>
                        Threat Intelligence Information
                    </h2>
                </div>

                <form action="/threats/<?= $threat['id'] ?>" method="POST" class="p-6">
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- IOC Type -->
                        <div>
                            <label for="ioc_type" class="block text-sm font-medium text-gray-700 mb-2">
                                IOC Type <span class="text-red-500">*</span>
                            </label>
                            <select id="ioc_type" 
                                    name="ioc_type" 
                                    required
                                    onchange="updateIOCPlaceholder()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select IOC Type</option>
                                <option value="IP" <?= $threat['ioc_type'] == 'IP' ? 'selected' : '' ?>>IP Address</option>
                                <option value="Domain" <?= $threat['ioc_type'] == 'Domain' ? 'selected' : '' ?>>Domain</option>
                                <option value="Hash" <?= $threat['ioc_type'] == 'Hash' ? 'selected' : '' ?>>File Hash</option>
                                <option value="URL" <?= $threat['ioc_type'] == 'URL' ? 'selected' : '' ?>>URL</option>
                                <option value="Email" <?= $threat['ioc_type'] == 'Email' ? 'selected' : '' ?>>Email Address</option>
                            </select>
                        </div>

                        <!-- IOC Value -->
                        <div>
                            <label for="ioc_value" class="block text-sm font-medium text-gray-700 mb-2">
                                IOC Value <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="ioc_value" 
                                   name="ioc_value" 
                                   value="<?= esc($threat['ioc_value']) ?>"
                                   required
                                   placeholder="Enter IOC value"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Threat Type -->
                        <div>
                            <label for="threat_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Threat Type <span class="text-red-500">*</span>
                            </label>
                            <select id="threat_type" 
                                    name="threat_type" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Threat Type</option>
                                <option value="Malware C&C" <?= $threat['threat_type'] == 'Malware C&C' ? 'selected' : '' ?>>Malware C&C</option>
                                <option value="Botnet" <?= $threat['threat_type'] == 'Botnet' ? 'selected' : '' ?>>Botnet</option>
                                <option value="Phishing" <?= $threat['threat_type'] == 'Phishing' ? 'selected' : '' ?>>Phishing</option>
                                <option value="APT" <?= $threat['threat_type'] == 'APT' ? 'selected' : '' ?>>Advanced Persistent Threat</option>
                                <option value="Ransomware" <?= $threat['threat_type'] == 'Ransomware' ? 'selected' : '' ?>>Ransomware</option>
                                <option value="Trojan" <?= $threat['threat_type'] == 'Trojan' ? 'selected' : '' ?>>Trojan</option>
                                <option value="Spyware" <?= $threat['threat_type'] == 'Spyware' ? 'selected' : '' ?>>Spyware</option>
                                <option value="Rootkit" <?= $threat['threat_type'] == 'Rootkit' ? 'selected' : '' ?>>Rootkit</option>
                                <option value="Exploit Kit" <?= $threat['threat_type'] == 'Exploit Kit' ? 'selected' : '' ?>>Exploit Kit</option>
                                <option value="Suspicious Activity" <?= $threat['threat_type'] == 'Suspicious Activity' ? 'selected' : '' ?>>Suspicious Activity</option>
                                <option value="Other" <?= $threat['threat_type'] == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>

                        <!-- Severity -->
                        <div>
                            <label for="severity" class="block text-sm font-medium text-gray-700 mb-2">
                                Severity <span class="text-red-500">*</span>
                            </label>
                            <select id="severity" 
                                    name="severity" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Severity</option>
                                <option value="Low" <?= $threat['severity'] == 'Low' ? 'selected' : '' ?>>Low</option>
                                <option value="Medium" <?= $threat['severity'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                                <option value="High" <?= $threat['severity'] == 'High' ? 'selected' : '' ?>>High</option>
                                <option value="Critical" <?= $threat['severity'] == 'Critical' ? 'selected' : '' ?>>Critical</option>
                            </select>
                        </div>

                        <!-- Confidence -->
                        <div>
                            <label for="confidence" class="block text-sm font-medium text-gray-700 mb-2">
                                Confidence Level <span class="text-red-500">*</span>
                            </label>
                            <select id="confidence" 
                                    name="confidence" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Confidence</option>
                                <option value="Low" <?= $threat['confidence'] == 'Low' ? 'selected' : '' ?>>Low (Unverified)</option>
                                <option value="Medium" <?= $threat['confidence'] == 'Medium' ? 'selected' : '' ?>>Medium (Likely)</option>
                                <option value="High" <?= $threat['confidence'] == 'High' ? 'selected' : '' ?>>High (Confirmed)</option>
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Select Status</option>
                                <option value="Active" <?= $threat['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
                                <option value="Inactive" <?= $threat['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="Investigating" <?= $threat['status'] == 'Investigating' ? 'selected' : '' ?>>Investigating</option>
                            </select>
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                                Source
                            </label>
                            <input type="text" 
                                   id="source" 
                                   name="source"
                                   value="<?= esc($threat['source']) ?>"
                                   placeholder="e.g., VirusTotal, Internal Analysis, MISP"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- First Seen -->
                        <div>
                            <label for="first_seen" class="block text-sm font-medium text-gray-700 mb-2">
                                First Seen
                            </label>
                            <input type="datetime-local" 
                                   id="first_seen" 
                                   name="first_seen"
                                   value="<?= isset($threat['first_seen']) && $threat['first_seen'] ? date('Y-m-d\TH:i', strtotime($threat['first_seen'])) : '' ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Last Seen -->
                        <div>
                            <label for="last_seen" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Seen
                            </label>
                            <input type="datetime-local" 
                                   id="last_seen" 
                                   name="last_seen"
                                   value="<?= isset($threat['last_seen']) && $threat['last_seen'] ? date('Y-m-d\TH:i', strtotime($threat['last_seen'])) : '' ?>"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                                Tags
                            </label>
                            <input type="text" 
                                   id="tags" 
                                   name="tags"
                                   value="<?= esc($threat['tags']) ?>"
                                   placeholder="e.g., apt29, malware, c2 (comma-separated)"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Detailed description of the threat, context, and any additional information..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"><?= esc($threat['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Threat History -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-history text-blue-600 mr-2"></i>
                            Threat History
                        </h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-600">Created:</span>
                                    <div class="text-gray-900">
                                        <?= isset($threat['created_at']) ? date('M j, Y \a\t H:i', strtotime($threat['created_at'])) : 'Unknown' ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Last Updated:</span>
                                    <div class="text-gray-900">
                                        <?= isset($threat['updated_at']) ? date('M j, Y \a\t H:i', strtotime($threat['updated_at'])) : 'Unknown' ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Threat ID:</span>
                                    <div class="text-gray-900 font-mono">#<?= $threat['id'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between">
                            <button type="button" 
                                    onclick="if(confirm('Are you sure you want to delete this threat IOC?')) { 
                                        window.location.href='/threats/<?= $threat['id'] ?>/delete' 
                                    }"
                                    class="px-6 py-3 border border-red-300 text-red-700 rounded-lg hover:bg-red-50 transition-colors flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Delete Threat IOC
                            </button>
                            
                            <div class="flex space-x-4">
                                <a href="/threats" 
                                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Update Threat IOC
                                </button>
                            </div>
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
    const iocTypeSelect = document.getElementById('ioc_type');
    const iocValueInput = document.getElementById('ioc_value');
    const firstSeenInput = document.getElementById('first_seen');
    const lastSeenInput = document.getElementById('last_seen');
    
    // Initialize IOC placeholder on page load
    updateIOCPlaceholder();
    
    // IOC Type change handler
    window.updateIOCPlaceholder = function() {
        const type = iocTypeSelect.value;
        let placeholder = 'Enter IOC value';
        
        switch(type) {
            case 'IP':
                placeholder = 'e.g., 192.168.1.100 or 2001:db8::1';
                break;
            case 'Domain':
                placeholder = 'e.g., malicious-domain.com';
                break;
            case 'Hash':
                placeholder = 'e.g., d41d8cd98f00b204e9800998ecf8427e (MD5, SHA1, or SHA256)';
                break;
            case 'URL':
                placeholder = 'e.g., https://malicious-site.com/payload';
                break;
            case 'Email':
                placeholder = 'e.g., attacker@malicious-domain.com';
                break;
        }
        
        iocValueInput.placeholder = placeholder;
    };
    
    // IOC Value validation
    iocValueInput.addEventListener('input', function() {
        const type = iocTypeSelect.value;
        const value = this.value;
        
        if (!type || !value) return;
        
        let isValid = true;
        let message = '';
        
        switch(type) {
            case 'IP':
                const ipv4Pattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/;
                const ipv6Pattern = /^(?:[0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}$/;
                isValid = ipv4Pattern.test(value) || ipv6Pattern.test(value);
                message = 'Please enter a valid IP address';
                break;
            case 'Domain':
                const domainPattern = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
                isValid = domainPattern.test(value);
                message = 'Please enter a valid domain name';
                break;
            case 'Hash':
                const hashPattern = /^[a-fA-F0-9]{32}$|^[a-fA-F0-9]{40}$|^[a-fA-F0-9]{64}$/;
                isValid = hashPattern.test(value);
                message = 'Please enter a valid hash (MD5, SHA1, or SHA256)';
                break;
            case 'URL':
                try {
                    new URL(value);
                    isValid = true;
                } catch {
                    isValid = false;
                    message = 'Please enter a valid URL';
                }
                break;
            case 'Email':
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                isValid = emailPattern.test(value);
                message = 'Please enter a valid email address';
                break;
        }
        
        if (!isValid) {
            this.setCustomValidity(message);
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Date validation
    lastSeenInput.addEventListener('change', function() {
        const firstSeen = new Date(firstSeenInput.value);
        const lastSeen = new Date(this.value);
        
        if (firstSeen && lastSeen && lastSeen < firstSeen) {
            this.setCustomValidity('Last seen cannot be earlier than first seen');
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Threat IOC...';
        submitBtn.disabled = true;
    });
});
</script>

<?= $this->endSection() ?>