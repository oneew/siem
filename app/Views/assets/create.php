<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-blue-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Tambahkan aset baru ke inventori pemantauan keamanan Anda</p>
            </div>
            <a href="/asset-management" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Aset
            </a>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-server mr-2 text-gray-600"></i>
                        Informasi Aset
                    </h2>
                </div>

                <form action="/asset-management" method="POST" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Asset Name -->
                        <div class="md:col-span-2">
                            <label for="asset_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Aset <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                id="asset_name"
                                name="asset_name"
                                required
                                placeholder="contoh: Domain Controller 01, Web Server, Laptop CEO"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Asset Type -->
                        <div>
                            <label for="asset_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Aset <span class="text-red-500">*</span>
                            </label>
                            <select id="asset_type"
                                name="asset_type"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Pilih Tipe Aset</option>
                                <option value="Server">Server</option>
                                <option value="Endpoint">Endpoint</option>
                                <option value="Network Device">Perangkat Jaringan</option>
                                <option value="Mobile">Perangkat Mobile</option>
                                <option value="IoT Device">Perangkat IoT</option>
                                <option value="Database">Database</option>
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Pilih Status</option>
                                <option value="Online" selected>Online</option>
                                <option value="Offline">Offline</option>
                                <option value="Maintenance">Pemeliharaan</option>
                                <option value="Decommissioned">Didekomisioner</option>
                            </select>
                        </div>

                        <!-- IP Address -->
                        <div>
                            <label for="ip_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat IP
                            </label>
                            <input type="text"
                                id="ip_address"
                                name="ip_address"
                                placeholder="e.g., 192.168.1.100"
                                pattern="^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- MAC Address -->
                        <div>
                            <label for="mac_address" class="block text-sm font-medium text-gray-700 mb-2">
                                Alamat MAC
                            </label>
                            <input type="text"
                                id="mac_address"
                                name="mac_address"
                                placeholder="e.g., 00:1B:44:11:3A:B7"
                                pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Operating System -->
                        <div>
                            <label for="operating_system" class="block text-sm font-medium text-gray-700 mb-2">
                                Sistem Operasi
                            </label>
                            <input type="text"
                                id="operating_system"
                                name="operating_system"
                                placeholder="e.g., Windows Server 2022, Ubuntu 22.04, macOS"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Criticality -->
                        <div>
                            <label for="criticality" class="block text-sm font-medium text-gray-700 mb-2">
                                Kritikalitas <span class="text-red-500">*</span>
                            </label>
                            <select id="criticality"
                                name="criticality"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Pilih Kritikalitas</option>
                                <option value="Low">Rendah</option>
                                <option value="Medium" selected>Sedang</option>
                                <option value="High">Tinggi</option>
                                <option value="Critical">Kritis</option>
                            </select>
                        </div>

                        <!-- Location -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi
                            </label>
                            <input type="text"
                                id="location"
                                name="location"
                                placeholder="e.g., Data Center - Rack A1, Office Floor 3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Owner -->
                        <div>
                            <label for="owner" class="block text-sm font-medium text-gray-700 mb-2">
                                Pemilik/Departemen
                            </label>
                            <input type="text"
                                id="owner"
                                name="owner"
                                placeholder="e.g., IT Department, Finance Team, John Doe"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <!-- Security Information -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-shield-alt text-blue-600 mr-2"></i>
                            Informasi Keamanan
                        </h3>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                <p class="text-sm text-blue-800">
                                    <strong>Catatan:</strong> Status kerentanan akan disetel ke "Tidak Diketahui" awalnya.
                                    Jalankan scan keamanan untuk memperbarui penilaian kerentanan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-end space-x-4">
                            <a href="/asset-management"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Tambah Aset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const ipInput = document.getElementById('ip_address');
        const macInput = document.getElementById('mac_address');

        // IP Address validation
        ipInput.addEventListener('input', function() {
            const ipPattern = /^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/;
            if (this.value && !ipPattern.test(this.value)) {
                this.setCustomValidity('Silakan masukkan alamat IP yang valid (contoh: 192.168.1.100)');
            } else {
                this.setCustomValidity('');
            }
        });

        // MAC Address formatting
        macInput.addEventListener('input', function() {
            let value = this.value.replace(/[^0-9A-Fa-f]/g, '');
            if (value.length > 0) {
                value = value.match(/.{1,2}/g).join(':');
                if (value.length > 17) {
                    value = value.substring(0, 17);
                }
                this.value = value.toUpperCase();
            }
        });

        // Form submission handling
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menambahkan Aset...';
            submitBtn.disabled = true;
        });
    });
</script>

<?= $this->endSection() ?>