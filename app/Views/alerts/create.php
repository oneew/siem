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
                Kembali ke Daftar Peringatan
            </a>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-bell mr-2 text-gray-600"></i>
                        Informasi Peringatan
                    </h2>
                </div>

                <form action="/alerts/store" method="POST" class="p-6">
                    <!-- Two-column layout: form on left, examples on right -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left column: Form inputs -->
                        <div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Peringatan -->
                                <div class="md:col-span-2">
                                    <label for="alert_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Peringatan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        id="alert_name"
                                        name="alert_name"
                                        required
                                        placeholder="contoh: Aktivitas Login Mencurigakan, Deteksi Malware, Intrusi Jaringan"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                </div>

                                <!-- Jenis Peringatan -->
                                <div class="md:col-span-2">
                                    <label for="alert_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Peringatan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="alert_type"
                                        name="alert_type"
                                        required
                                        onchange="updateAlertSuggestions()"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Authentication">Otentikasi</option>
                                        <option value="Network">Jaringan</option>
                                        <option value="Malware">Malware</option>
                                        <option value="Data Breach">Kebocoran Data</option>
                                        <option value="Intrusion">Intrusi</option>
                                        <option value="System">Sistem</option>
                                    </select>
                                </div>

                                <!-- Prioritas -->
                                <div class="md:col-span-2">
                                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">
                                        Prioritas <span class="text-red-500">*</span>
                                    </label>
                                    <select id="priority"
                                        name="priority"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                        <option value="">Pilih Prioritas</option>
                                        <option value="Low">Rendah</option>
                                        <option value="Medium">Sedang</option>
                                        <option value="High">Tinggi</option>
                                        <option value="Critical">Kritis</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="md:col-span-2">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status"
                                        name="status"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                        <option value="">Pilih Status</option>
                                        <option value="Active" selected>Aktif</option>
                                        <option value="Investigating">Sedang Diselidiki</option>
                                        <option value="Closed">Ditutup</option>
                                        <option value="False Positive">Positif Palsu</option>
                                    </select>
                                </div>

                                <!-- IP Sumber -->
                                <div class="md:col-span-2">
                                    <label for="source_ip" class="block text-sm font-medium text-gray-700 mb-2">
                                        Alamat IP Sumber
                                    </label>
                                    <input type="text"
                                        id="source_ip"
                                        name="source_ip"
                                        placeholder="contoh: 192.168.1.100"
                                        pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                </div>

                                <!-- Aturan Deteksi -->
                                <div class="md:col-span-2">
                                    <label for="rule_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Aturan Deteksi
                                    </label>
                                    <input type="text"
                                        id="rule_name"
                                        name="rule_name"
                                        placeholder="contoh: SURICATA-2024001, Gagal_Login_Berulang"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                </div>

                                <!-- Deskripsi -->
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi Peringatan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="description"
                                        name="description"
                                        required
                                        rows="4"
                                        placeholder="Deskripsi rinci mengenai peringatan keamanan, termasuk apa yang terdeteksi, dampak potensial, dan tindakan yang disarankan..."
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"></textarea>
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <div class="flex justify-end space-x-4">
                                    <a href="/alerts"
                                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors flex items-center">
                                        <i class="fas fa-save mr-2"></i>
                                        Buat Peringatan
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right column: Examples and automation options -->
                        <div>
                            <!-- Contoh Peringatan -->
                            <div class="mb-8">
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                                    Contoh Peringatan Berdasarkan Jenis
                                </h3>

                                <div id="alert-examples" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Left column examples -->
                                    <!-- Authentication Examples -->
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 alert-example" data-type="Authentication">
                                        <h4 class="font-semibold text-blue-900 mb-2">Peringatan Otentikasi</h4>
                                        <ul class="text-sm text-blue-800 space-y-1">
                                            <li>• Gagal login berulang kali</li>
                                            <li>• Login mencurigakan dari lokasi baru</li>
                                            <li>• Eskalasi hak akses terdeteksi</li>
                                            <li>• Akun terkunci setelah batas percobaan</li>
                                        </ul>
                                    </div>

                                    <!-- Network Examples -->
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 alert-example" data-type="Network">
                                        <h4 class="font-semibold text-green-900 mb-2">Peringatan Jaringan</h4>
                                        <ul class="text-sm text-green-800 space-y-1">
                                            <li>• Deteksi pemindaian port</li>
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
                                            <li>• Aktivitas ransomware</li>
                                            <li>• Komunikasi trojan</li>
                                            <li>• Perilaku proses mencurigakan</li>
                                        </ul>
                                    </div>

                                    <!-- Data Breach Examples -->
                                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 alert-example" data-type="Data Breach">
                                        <h4 class="font-semibold text-purple-900 mb-2">Peringatan Kebocoran Data</h4>
                                        <ul class="text-sm text-purple-800 space-y-1">
                                            <li>• Akses data tidak sah</li>
                                            <li>• Upaya eksfiltrasi data</li>
                                            <li>• Perubahan file sensitif</li>
                                            <li>• Anomali database terdeteksi</li>
                                        </ul>
                                    </div>

                                    <!-- Right column examples -->
                                    <!-- Intrusion Examples -->
                                    <div class="bg-orange-50 border border-orange-200 rounded-lg p-4 alert-example" data-type="Intrusion">
                                        <h4 class="font-semibold text-orange-900 mb-2">Peringatan Intrusi</h4>
                                        <ul class="text-sm text-orange-800 space-y-1">
                                            <li>• Akses sistem tidak sah</li>
                                            <li>• Pelanggaran kebijakan keamanan</li>
                                            <li>• Backdoor terdeteksi</li>
                                            <li>• Indikator kompromi sistem</li>
                                        </ul>
                                    </div>

                                    <!-- System Examples -->
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 alert-example" data-type="System">
                                        <h4 class="font-semibold text-gray-900 mb-2">Peringatan Sistem</h4>
                                        <ul class="text-sm text-gray-800 space-y-1">
                                            <li>• Sumber daya sistem habis</li>
                                            <li>• Kegagalan layanan terdeteksi</li>
                                            <li>• Perubahan konfigurasi</li>
                                            <li>• Anomali perangkat keras</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Opsi Respons Otomatis -->
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                                    <i class="fas fa-cog text-blue-600 mr-2"></i>
                                    Opsi Respons Otomatis
                                </h3>

                                <div class="grid grid-cols-1 gap-4">
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
                                            Buat insiden otomatis
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Perbaikan dan validasi form
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const alertTypeSelect = document.getElementById('alert_type');
        const sourceIpInput = document.getElementById('source_ip');

        // Perbarui tampilan contoh peringatan
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

            // Saran nama otomatis berdasarkan jenis
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

        // Validasi alamat IP
        sourceIpInput.addEventListener('input', function() {
            const ipPattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/;
            if (this.value && !ipPattern.test(this.value)) {
                this.setCustomValidity('Harap masukkan alamat IP yang valid (contoh: 192.168.1.100)');
            } else {
                this.setCustomValidity('');
            }
        });

        // Gaya berdasarkan prioritas
        const prioritySelect = document.getElementById('priority');
        prioritySelect.addEventListener('change', function() {
            this.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition-colors ' +
                (this.value === 'Critical' ? 'focus:ring-red-500 focus:border-red-500' :
                    this.value === 'High' ? 'focus:ring-orange-500 focus:border-orange-500' :
                    this.value === 'Medium' ? 'focus:ring-yellow-500 focus:border-yellow-500' :
                    'focus:ring-blue-500 focus:border-blue-500');
        });

        // Tangani submit form
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Membuat Peringatan...';
            submitBtn.disabled = true;

            // Kumpulkan opsi otomatisasi
            const automationOptions = [];
            if (document.getElementById('auto_block').checked) automationOptions.push('auto_block');
            if (document.getElementById('auto_notify').checked) automationOptions.push('auto_notify');
            if (document.getElementById('auto_incident').checked) automationOptions.push('auto_incident');
            if (document.getElementById('auto_isolate').checked) automationOptions.push('auto_isolate');

            // Tambahkan ke data form (hanya contoh, server yang akan mengolah)
            console.log('Opsi otomatisasi:', automationOptions);
        });
    });
</script>

<?= $this->endSection() ?>