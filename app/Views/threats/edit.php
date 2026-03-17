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
                <p class="text-gray-600 mt-1">Perbarui informasi intelijen ancaman dan detail IOC</p>
            </div>
            <div class="flex space-x-3">
                <a href="/threats/<?= $threat['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    Lihat Detail
                </a>
                <a href="/threats" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
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
                        Informasi Intelijen Ancaman
                    </h2>
                </div>

                <form action="/threats/<?= $threat['id'] ?>" method="POST" class="p-6">
                    <input type="hidden" name="_method" value="PUT">
                    
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
                                Nilai/Data IOC <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="ioc_value" 
                                   name="ioc_value" 
                                   value="<?= esc($threat['ioc_value']) ?>"
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
                                <option value="Other" <?= $threat['threat_type'] == 'Other' ? 'selected' : '' ?>>Lainnya</option>
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
                                <option value="Low" <?= $threat['severity'] == 'Low' ? 'selected' : '' ?>>Rendah (Low)</option>
                                <option value="Medium" <?= $threat['severity'] == 'Medium' ? 'selected' : '' ?>>Sedang (Medium)</option>
                                <option value="High" <?= $threat['severity'] == 'High' ? 'selected' : '' ?>>Tinggi (High)</option>
                                <option value="Critical" <?= $threat['severity'] == 'Critical' ? 'selected' : '' ?>>Kritis (Critical)</option>
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
                                <option value="Low" <?= $threat['confidence'] == 'Low' ? 'selected' : '' ?>>Rendah (Belum Terverifikasi)</option>
                                <option value="Medium" <?= $threat['confidence'] == 'Medium' ? 'selected' : '' ?>>Sedang (Kemungkinan)</option>
                                <option value="High" <?= $threat['confidence'] == 'High' ? 'selected' : '' ?>>Tinggi (Terkonfirmasi)</option>
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
                                <option value="Active" <?= $threat['status'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                                <option value="Inactive" <?= $threat['status'] == 'Inactive' ? 'selected' : '' ?>>Tidak Aktif</option>
                                <option value="Investigating" <?= $threat['status'] == 'Investigating' ? 'selected' : '' ?>>Sedang Diivestigasi</option>
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
                                   value="<?= esc($threat['source']) ?>"
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
                                   value="<?= isset($threat['first_seen']) && $threat['first_seen'] ? date('Y-m-d\TH:i', strtotime($threat['first_seen'])) : '' ?>"
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
                                   value="<?= isset($threat['last_seen']) && $threat['last_seen'] ? date('Y-m-d\TH:i', strtotime($threat['last_seen'])) : '' ?>"
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
                                   value="<?= esc($threat['tags']) ?>"
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
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"><?= esc($threat['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Threat History -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-history text-blue-600 mr-2"></i>
                            Riwayat Ancaman
                        </h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-600">Terdaftar Pada:</span>
                                    <div class="text-gray-900">
                                        <?= isset($threat['created_at']) ? date('j M Y, H:i', strtotime($threat['created_at'])) : 'Tidak Diketahui' ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Terakhir Diperbarui:</span>
                                    <div class="text-gray-900">
                                        <?= isset($threat['updated_at']) ? date('j M Y, H:i', strtotime($threat['updated_at'])) : 'Tidak Diketahui' ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">ID Ancaman:</span>
                                    <div class="text-gray-900 font-mono">#<?= $threat['id'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between">
                            <button type="button" 
                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus IOC ancaman ini?')) { 
                                        window.location.href='/threats/<?= $threat['id'] ?>/delete' 
                                    }"
                                    class="px-6 py-3 border border-red-300 text-red-700 rounded-lg hover:bg-red-50 transition-colors flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Ancaman
                            </button>
                            
                            <div class="flex space-x-4">
                                <a href="/threats" 
                                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    Batal
                                </a>
                                <button type="submit" 
                                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Perbarui Ancaman
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
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan Pembaruan...';
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        }
    });
});
</script>

<?= $this->endSection() ?>