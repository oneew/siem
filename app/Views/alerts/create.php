<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-orange-600 mr-3"></i>
                    Tambah Peringatan Keamanan Baru
                </h1>
                <p class="text-gray-600 mt-1">Buat peringatan keamanan baru untuk pemantauan dan respons</p>
            </div>
            <a href="/alerts" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
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
                        <i class="fas fa-bell mr-2 text-gray-600"></i>
                        Informasi Peringatan
                    </h2>
                </div>

                <form action="/alerts" method="POST" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Alert Name -->
                        <div class="md:col-span-2">
                            <label for="alert_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Peringatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="alert_name" 
                                   name="alert_name" 
                                   required
                                   placeholder="Contoh: Aktivitas Login Mencurigakan, Deteksi Malware, Intrusi Jaringan"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Alert Type -->
                        <div>
                            <label for="alert_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Peringatan <span class="text-red-500">*</span>
                            </label>
                            <select id="alert_type" 
                                    name="alert_type" 
                                    required
                                    onchange="updateAlertSuggestions()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                <option value="">Pilih Tipe Peringatan</option>
                                <option value="Authentication">Otentikasi (Authentication)</option>
                                <option value="Network">Jaringan (Network)</option>
                                <option value="Malware">Malware</option>
                                <option value="Data Breach">Kebocoran Data (Data Breach)</option>
                                <option value="Intrusion">Intrusi (Intrusion)</option>
                                <option value="System">Sistem (System)</option>
                            </select>
                        </div>

                        <!-- Priority -->
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                                Prioritas <span class="text-red-500">*</span>
                            </label>
                            <select id="priority" 
                                    name="priority" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                <option value="">Pilih Prioritas</option>
                                <option value="Low">Rendah (Low)</option>
                                <option value="Medium">Sedang (Medium)</option>
                                <option value="High">Tinggi (High)</option>
                                <option value="Critical">Kritis (Critical)</option>
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
                                <option value="">Pilih Status</option>
                                <option value="Active" selected>Aktif</option>
                                <option value="Investigating">Sedang Diinvestigasi</option>
                                <option value="Closed">Ditutup</option>
                                <option value="False Positive">Positif Palsu</option>
                            </select>
                        </div>

                        <!-- Source IP -->
                        <div>
                            <label for="source_ip" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat IP Sumber
                            </label>
                            <input type="text" 
                                   id="source_ip" 
                                   name="source_ip"
                                   placeholder="Contoh: 192.168.1.100"
                                   pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Rule Name -->
                        <div>
                            <label for="rule_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Aturan Deteksi
                            </label>
                            <input type="text" 
                                   id="rule_name" 
                                   name="rule_name"
                                   placeholder="Contoh: SURICATA-2024001, Failed_Login_Attempts"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi Peringatan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      required
                                      rows="4"
                                      placeholder="Deskripsi detail mengenai peringatan keamanan, termasuk apa yang dideteksi, potensi dampak, dan tindakan yang disarankan..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"></textarea>
                        </div>
                    </div>

                    <!-- Alert Examples by Type -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                            Contoh Peringatan Berdasarkan Tipe
                        </h3>
                        
                        <div id="alert-examples" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Authentication Examples -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 alert-example" data-type="Authentication">
                                <h4 class="font-semibold text-blue-900 mb-2">Peringatan Otentikasi</h4>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Percobaan login gagal berulang kali</li>
                                    <li>• Login mencurigakan dari lokasi baru</li>
                                    <li>• Peningkatan hak akses terdeteksi</li>
                                    <li>• Batas penguncian akun tercapai</li>
                                </ul>
                            </div>

                            <!-- Network Examples -->
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 alert-example" data-type="Network">
                                <h4 class="font-semibold text-green-900 mb-2">Peringatan Jaringan</h4>
                                <ul class="text-sm text-green-800 space-y-1">
                                    <li>• Pemindaian port (Port scan) terdeteksi</li>
                                    <li>• Lalu lintas jaringan tidak biasa</li>
                                    <li>• Upaya serangan DDoS</li>
                                    <li>• Akses jaringan tidak sah</li>
                                </ul>
                            </div>

                            <!-- Malware Examples -->
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 alert-example" data-type="Malware">
                                <h4 class="font-semibold text-red-900 mb-2">Peringatan Malware</h4>
                                <ul class="text-sm text-red-800 space-y-1">
                                    <li>• File berbahaya terdeteksi</li>
                                    <li>• Aktivitas Ransomware</li>
                                    <li>• Komunikasi Trojan</li>
                                    <li>• Perilaku proses mencurigakan</li>
                                </ul>
                            </div>

                            <!-- Data Breach Examples -->
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 alert-example" data-type="Data Breach">
                                <h4 class="font-semibold text-purple-900 mb-2">Peringatan Kebocoran Data</h4>
                                <ul class="text-sm text-purple-800 space-y-1">
                                    <li>• Akses data tidak sah</li>
                                    <li>• Upaya eksfiltrasi data</li>
                                    <li>• Modifikasi file sensitif</li>
                                    <li>• Anomali database terdeteksi</li>
                                </ul>
                            </div>

                            <!-- Intrusion Examples -->
                            <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 alert-example" data-type="Intrusion">
                                <h4 class="font-semibold text-orange-900 mb-2">Peringatan Intrusi</h4>
                                <ul class="text-sm text-orange-800 space-y-1">
                                    <li>• Akses sistem tidak sah</li>
                                    <li>• Pelanggaran kebijakan keamanan</li>
                                    <li>• Backdoor terdeteksi</li>
                                    <li>• Indikator kompromi sistem (IOC)</li>
                                </ul>
                            </div>

                            <!-- System Examples -->
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 alert-example" data-type="System">
                                <h4 class="font-semibold text-gray-900 mb-2">Peringatan Sistem</h4>
                                <ul class="text-sm text-gray-800 space-y-1">
                                    <li>• Kehabisan sumber daya sistem</li>
                                    <li>• Kegagalan layanan terdeteksi</li>
                                    <li>• Perubahan konfigurasi</li>
                                    <li>• Anomali perangkat keras</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Automated Response Options -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-cog text-blue-600 mr-2"></i>
                            Opsi Respons Otomatis
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                                <input type="checkbox" id="auto_block" name="auto_block" class="rounded text-blue-600">
                                <label for="auto_block" class="text-sm font-medium text-gray-700">
                                    Blokir otomatis IP mencurigakan
                                </label>
                            </div>
                            
                            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                                <input type="checkbox" id="auto_notify" name="auto_notify" class="rounded text-green-600" checked>
                                <label for="auto_notify" class="text-sm font-medium text-gray-700">
                                    Kirim notifikasi email
                                </label>
                            </div>
                            
                            <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-lg">
                                <input type="checkbox" id="auto_incident" name="auto_incident" class="rounded text-purple-600">
                                <label for="auto_incident" class="text-sm font-medium text-gray-700">
                                    Buat insiden secara otomatis
                                </label>
                            </div>
                            
                            <div class="flex items-center space-x-3 p-3 bg-orange-50 rounded-lg">
                                <input type="checkbox" id="auto_isolate" name="auto_isolate" class="rounded text-orange-600">
                                <label for="auto_isolate" class="text-sm font-medium text-gray-700">
                                    Isolasi sistem yang terdampak
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/alerts" 
                               class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Simpan Peringatan
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
                'Authentication': 'Aktivitas Otentikasi Mencurigakan Terdeteksi',
                'Network': 'Anomali Jaringan Terdeteksi',
                'Malware': 'Aktivitas Malware Terdeteksi',
                'Data Breach': 'Potensi Kebocoran Data Terdeteksi',
                'Intrusion': 'Intrusi Keamanan Terdeteksi',
                'System': 'Anomali Sistem Terdeteksi'
            };
            alertNameInput.placeholder = suggestions[selectedType] || alertNameInput.placeholder;
        }
    };
    
    // IP Address validation
    sourceIpInput.addEventListener('input', function() {
        const ipPattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/;
        if (this.value && !ipPattern.test(this.value)) {
            this.setCustomValidity('Masukkan alamat IP yang valid (contoh: 192.168.1.100)');
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
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Collect automation options
        const automationOptions = [];
        if (document.getElementById('auto_block').checked) automationOptions.push('auto_block');
        if (document.getElementById('auto_notify').checked) automationOptions.push('auto_notify');
        if (document.getElementById('auto_incident').checked) automationOptions.push('auto_incident');
        if (document.getElementById('auto_isolate').checked) automationOptions.push('auto_isolate');
        
        // Add automation options to form data (in production, this would be handled server-side)
        console.log('Opsi otomasi:', automationOptions);
    });
});
</script>

<?= $this->endSection() ?>