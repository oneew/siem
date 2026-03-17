<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-edit text-orange-600 mr-3"></i>
                    Edit Peringatan Keamanan
                </h1>
                <p class="text-gray-600 mt-1">Perbarui informasi peringatan dan pengaturan respons</p>
            </div>
            <div class="flex space-x-3">
                <a href="/alerts/<?= $alert['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    Lihat Detail
                </a>
                <a href="/alerts" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
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
                        <i class="fas fa-bell mr-2 text-gray-600"></i>
                        Informasi Peringatan
                    </h2>
                </div>

                <form action="/alerts/<?= $alert['id'] ?>" method="POST" class="p-6">
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Alert Name -->
                        <div class="md:col-span-2">
                            <label for="alert_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Peringatan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="alert_name" 
                                   name="alert_name" 
                                   value="<?= esc($alert['alert_name']) ?>"
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                                <option value="">Pilih Tipe Peringatan</option>
                                <option value="Authentication" <?= $alert['alert_type'] == 'Authentication' ? 'selected' : '' ?>>Otentikasi (Authentication)</option>
                                <option value="Network" <?= $alert['alert_type'] == 'Network' ? 'selected' : '' ?>>Jaringan (Network)</option>
                                <option value="Malware" <?= $alert['alert_type'] == 'Malware' ? 'selected' : '' ?>>Malware</option>
                                <option value="Data Breach" <?= $alert['alert_type'] == 'Data Breach' ? 'selected' : '' ?>>Kebocoran Data (Data Breach)</option>
                                <option value="Intrusion" <?= $alert['alert_type'] == 'Intrusion' ? 'selected' : '' ?>>Intrusi (Intrusion)</option>
                                <option value="System" <?= $alert['alert_type'] == 'System' ? 'selected' : '' ?>>Sistem (System)</option>
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
                                <option value="Low" <?= $alert['priority'] == 'Low' ? 'selected' : '' ?>>Rendah (Low)</option>
                                <option value="Medium" <?= $alert['priority'] == 'Medium' ? 'selected' : '' ?>>Sedang (Medium)</option>
                                <option value="High" <?= $alert['priority'] == 'High' ? 'selected' : '' ?>>Tinggi (High)</option>
                                <option value="Critical" <?= $alert['priority'] == 'Critical' ? 'selected' : '' ?>>Kritis (Critical)</option>
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
                                <option value="Active" <?= $alert['status'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                                <option value="Investigating" <?= $alert['status'] == 'Investigating' ? 'selected' : '' ?>>Sedang Diinvestigasi</option>
                                <option value="Closed" <?= $alert['status'] == 'Closed' ? 'selected' : '' ?>>Ditutup</option>
                                <option value="False Positive" <?= $alert['status'] == 'False Positive' ? 'selected' : '' ?>>Positif Palsu</option>
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
                                   value="<?= esc($alert['source_ip']) ?>"
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
                                   value="<?= esc($alert['rule_name']) ?>"
                                   placeholder="Contoh: SURICATA-2024001, Failed_Login_Attempts"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors">
                        </div>

                        <!-- Acknowledged Checkbox -->
                        <div class="md:col-span-2">
                            <div class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <input type="checkbox" 
                                       id="acknowledged" 
                                       name="acknowledged" 
                                       <?= $alert['acknowledged'] ? 'checked' : '' ?>
                                       class="rounded text-blue-600">
                                <label for="acknowledged" class="text-sm font-medium text-gray-700">
                                    Tandai peringatan ini telah diakui oleh tim keamanan
                                </label>
                            </div>
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
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"><?= esc($alert['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Alert History -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-history text-blue-600 mr-2"></i>
                            Riwayat Peringatan
                        </h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <span class="font-medium text-gray-600">Dibuat:</span>
                                    <div class="text-gray-900">
                                        <?= isset($alert['created_at']) ? date('j M Y, H:i', strtotime($alert['created_at'])) : 'Tidak diketahui' ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Terakhir Diperbarui:</span>
                                    <div class="text-gray-900">
                                        <?= isset($alert['updated_at']) ? date('j M Y, H:i', strtotime($alert['updated_at'])) : 'Tidak diketahui' ?>
                                    </div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">ID Peringatan:</span>
                                    <div class="text-gray-900 font-mono">#<?= $alert['id'] ?></div>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-600">Diselesaikan:</span>
                                    <div class="text-gray-900">
                                        <?= isset($alert['resolved_at']) && $alert['resolved_at'] ? 
                                            date('j M Y', strtotime($alert['resolved_at'])) : 'Belum diselesaikan' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-tools text-purple-600 mr-2"></i>
                            Aksi Cepat
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <button type="button" 
                                    onclick="acknowledgeAlert()"
                                    class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fas fa-check mr-2"></i>
                                Akui (Acknowledge)
                            </button>
                            
                            <button type="button" 
                                    onclick="escalateAlert()"
                                    class="bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fas fa-arrow-up mr-2"></i>
                                Eskalasi
                            </button>
                            
                            <button type="button" 
                                    onclick="createIncident()"
                                    class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Buat Insiden
                            </button>
                            
                            <button type="button" 
                                    onclick="markFalsePositive()"
                                    class="bg-gray-50 hover:bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 rounded-lg transition-colors flex items-center justify-center">
                                <i class="fas fa-times mr-2"></i>
                                Positif Palsu
                            </button>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between">
                            <button type="button" 
                                    onclick="if(confirm('Apakah Anda yakin ingin menghapus peringatan ini?')) { 
                                        window.location.href='/alerts/<?= $alert['id'] ?>/delete' 
                                    }"
                                    class="px-6 py-3 border border-red-300 text-red-700 rounded-lg hover:bg-red-50 transition-colors flex items-center">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus Peringatan
                            </button>
                            
                            <div class="flex space-x-4">
                                <a href="/alerts" 
                                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                    Batal
                                </a>
                                <button type="submit" 
                                        class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors flex items-center">
                                    <i class="fas fa-save mr-2"></i>
                                    Perbarui Peringatan
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
    const sourceIpInput = document.getElementById('source_ip');
    const statusSelect = document.getElementById('status');
    
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
    function updatePriorityStyle() {
        const priority = prioritySelect.value;
        prioritySelect.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 transition-colors ' +
                         (priority === 'Critical' ? 'focus:ring-red-500 focus:border-red-500 bg-red-50' :
                          priority === 'High' ? 'focus:ring-orange-500 focus:border-orange-500 bg-orange-50' :
                          priority === 'Medium' ? 'focus:ring-yellow-500 focus:border-yellow-500 bg-yellow-50' :
                          priority === 'Low' ? 'focus:ring-blue-500 focus:border-blue-500 bg-blue-50' :
                          'focus:ring-orange-500 focus:border-orange-500');
    }
    
    prioritySelect.addEventListener('change', updatePriorityStyle);
    updatePriorityStyle(); // Initial styling
    
    // Status change handling
    statusSelect.addEventListener('change', function() {
        if (this.value === 'Closed' || this.value === 'False Positive') {
            if (confirm('Tindakan ini akan menandai peringatan sebagai diselesaikan. Lanjutkan?')) {
                // In production, this would set resolved_at timestamp
                console.log('Peringatan ditandai sebagai diselesaikan');
            } else {
                this.value = '<?= $alert['status'] ?>'; // Revert to original value
            }
        }
    });
    
    // Form submission handling
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
        submitBtn.disabled = true;
    });
});

// Quick action functions
function acknowledgeAlert() {
    document.getElementById('acknowledged').checked = true;
    alert('Peringatan ditandai sebagai diakui (Mode Demo)');
}

function escalateAlert() {
    document.getElementById('priority').value = 'Critical';
    document.getElementById('priority').dispatchEvent(new Event('change'));
    alert('Peringatan dieskalasi ke prioritas Kritis (Mode Demo)');
}

function createIncident() {
    if (confirm('Buat insiden baru berdasarkan peringatan ini?')) {
        alert('Insiden berhasil dibuat (Mode Demo)\nID Insiden: INC-2024-001');
    }
}

function markFalsePositive() {
    if (confirm('Tandai peringatan ini sebagai positif palsu? Tindakan ini tidak dapat dibatalkan.')) {
        document.getElementById('status').value = 'False Positive';
        alert('Peringatan ditandai sebagai positif palsu (Mode Demo)');
    }
}
</script>

<?= $this->endSection() ?>