<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-red-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Tambahkan Indikator Kompromi (IOC) baru ke database intelijen ancaman</p>
            </div>
            <a href="/threats" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2 text-gray-600"></i>
                        Informasi Intelijen Ancaman
                    </h2>
                </div>

                <form action="/threats" method="POST" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- IOC Type -->
                        <div>
                            <label for="ioc_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe IOC <span class="text-red-500">*</span>
                            </label>
                            <select id="ioc_type" 
                                    name="ioc_type" 
                                    required
                                    onchange="updateIOCPlaceholder()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Pilih Tipe IOC</option>
                                <option value="IP">IP Address</option>
                                <option value="Domain">Domain</option>
                                <option value="Hash">File Hash</option>
                                <option value="URL">URL</option>
                                <option value="Email">Email Address</option>
                            </select>
                        </div>

                        <!-- IOC Value -->
                        <div>
                            <label for="ioc_value" class="block text-sm font-medium text-gray-700 mb-2">
                                Nilai/Data IOC <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="ioc_value" 
                                   name="ioc_value" 
                                   required
                                   placeholder="Masukkan data IOC"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Threat Type -->
                        <div>
                            <label for="threat_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Ancaman <span class="text-red-500">*</span>
                            </label>
                            <select id="threat_type" 
                                    name="threat_type" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Pilih Jenis Ancaman</option>
                                <option value="Malware C&C">Malware C&C</option>
                                <option value="Botnet">Botnet</option>
                                <option value="Phishing">Phishing</option>
                                <option value="APT">Advanced Persistent Threat</option>
                                <option value="Ransomware">Ransomware</option>
                                <option value="Trojan">Trojan</option>
                                <option value="Spyware">Spyware</option>
                                <option value="Rootkit">Rootkit</option>
                                <option value="Exploit Kit">Exploit Kit</option>
                                <option value="Suspicious Activity">Suspicious Activity</option>
                                <option value="Other">Lainnya</option>
                            </select>
                        </div>

                        <!-- Severity -->
                        <div>
                            <label for="severity" class="block text-sm font-medium text-gray-700 mb-2">
                                Tingkat Keparahan <span class="text-red-500">*</span>
                            </label>
                            <select id="severity" 
                                    name="severity" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Pilih Keparahan</option>
                                <option value="Low">Rendah (Low)</option>
                                <option value="Medium">Sedang (Medium)</option>
                                <option value="High">Tinggi (High)</option>
                                <option value="Critical">Kritis (Critical)</option>
                            </select>
                        </div>

                        <!-- Confidence -->
                        <div>
                            <label for="confidence" class="block text-sm font-medium text-gray-700 mb-2">
                                Tingkat Kepercayaan <span class="text-red-500">*</span>
                            </label>
                            <select id="confidence" 
                                    name="confidence" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                                <option value="">Pilih Kepercayaan</option>
                                <option value="Low">Rendah (Belum Terverifikasi)</option>
                                <option value="Medium">Sedang (Kemungkinan)</option>
                                <option value="High">Tinggi (Terkonfirmasi)</option>
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
                                <option value="">Pilih Status</option>
                                <option value="Active" selected>Aktif</option>
                                <option value="Inactive">Tidak Aktif</option>
                                <option value="Investigating">Sedang Diivestigasi</option>
                            </select>
                        </div>

                        <!-- Source -->
                        <div>
                            <label for="source" class="block text-sm font-medium text-gray-700 mb-2">
                                Sumber Identifikasi
                            </label>
                            <input type="text" 
                                   id="source" 
                                   name="source"
                                   placeholder="Contoh: VirusTotal, Analisis Internal, CSIRT"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- First Seen -->
                        <div>
                            <label for="first_seen" class="block text-sm font-medium text-gray-700 mb-2">
                                Pertama Terdeteksi
                            </label>
                            <input type="datetime-local" 
                                   id="first_seen" 
                                   name="first_seen"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Last Seen -->
                        <div>
                            <label for="last_seen" class="block text-sm font-medium text-gray-700 mb-2">
                                Terakhir Terdeteksi
                            </label>
                            <input type="datetime-local" 
                                   id="last_seen" 
                                   name="last_seen"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">
                                Label / Tags
                            </label>
                            <input type="text" 
                                   id="tags" 
                                   name="tags"
                                   placeholder="Contoh: apt29, malware, c2 (pisahkan dengan koma)"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi Detail
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4"
                                      placeholder="Penjelasan mendetail mengenai ancaman, konteks penyebaran, dan info lainnya..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"></textarea>
                        </div>
                    </div>

                    <!-- IOC Examples -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                            Contoh IOC
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-900 mb-2">IP Address</h4>
                                <p class="text-sm text-blue-800 font-mono">192.168.1.100</p>
                                <p class="text-xs text-blue-600 mt-1">IP berbahaya atau mencurigakan</p>
                            </div>
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h4 class="font-semibold text-green-900 mb-2">Domain</h4>
                                <p class="text-sm text-green-800 font-mono">malicious-site.com</p>
                                <p class="text-xs text-green-600 mt-1">Domain terindikasi phising</p>
                            </div>
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-900 mb-2">Hash</h4>
                                <p class="text-sm text-purple-800 font-mono">a1b2c3d4...</p>
                                <p class="text-xs text-purple-600 mt-1">Hash file (MD5, SHA1, SHA256)</p>
                            </div>
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                <h4 class="font-semibold text-orange-900 mb-2">URL</h4>
                                <p class="text-sm text-orange-800 font-mono">http://evil.com/payload</p>
                                <p class="text-xs text-orange-600 mt-1">URL langsung ke malware</p>
                            </div>
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <h4 class="font-semibold text-red-900 mb-2">Email</h4>
                                <p class="text-sm text-red-800 font-mono">attacker@evil.com</p>
                                <p class="text-xs text-red-600 mt-1">Alamat email penyerang</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/threats" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Ancaman
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
    const iocTypeSelect = document.getElementById('ioc_type');
    const iocValueInput = document.getElementById('ioc_value');
    const firstSeenInput = document.getElementById('first_seen');
    const lastSeenInput = document.getElementById('last_seen');
    
    // Set current datetime for first seen
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    firstSeenInput.value = now.toISOString().slice(0, 16);
    
    // IOC Type change handler
    window.updateIOCPlaceholder = function() {
        const type = iocTypeSelect.value;
        let placeholder = 'Masukkan data IOC';
        
        switch(type) {
            case 'IP':
                placeholder = 'Contoh: 192.168.1.100 atau 2001:db8::1';
                break;
            case 'Domain':
                placeholder = 'Contoh: malicious-domain.com';
                break;
            case 'Hash':
                placeholder = 'Contoh: d41d8cd98f00b204e9800998ecf8427e (MD5, SHA1, atau SHA256)';
                break;
            case 'URL':
                placeholder = 'Contoh: https://malicious-site.com/payload';
                break;
            case 'Email':
                placeholder = 'Contoh: attacker@malicious-domain.com';
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
                message = 'Mohon masukkan IP address yang valid';
                break;
            case 'Domain':
                const domainPattern = /^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/;
                isValid = domainPattern.test(value);
                message = 'Mohon masukkan nama domain yang valid';
                break;
            case 'Hash':
                const hashPattern = /^[a-fA-F0-9]{32}$|^[a-fA-F0-9]{40}$|^[a-fA-F0-9]{64}$/;
                isValid = hashPattern.test(value);
                message = 'Mohon masukkan hash yang valid (MD5, SHA1, atau SHA256)';
                break;
            case 'URL':
                try {
                    new URL(value);
                    isValid = true;
                } catch {
                    isValid = false;
                    message = 'Mohon masukkan URL yang valid';
                }
                break;
            case 'Email':
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                isValid = emailPattern.test(value);
                message = 'Mohon masukkan email address yang valid';
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
            this.setCustomValidity('Waktu terakhir terdeteksi tidak bisa mundur sebelum pertama terdeteksi');
        } else {
            this.setCustomValidity('');
        }
    });
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        if (this.getAttribute('data-submitting') === 'true') {
            e.preventDefault();
            return;
        }
        this.setAttribute('data-submitting', 'true');
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan Data...';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        }
    });
});
</script>

<?= $this->endSection() ?>