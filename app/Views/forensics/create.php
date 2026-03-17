<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-purple-600 mr-3"></i>
                    Buat Kasus Forensik Baru
                </h1>
                <p class="text-gray-600 mt-1">Mulai kasus investigasi forensik digital baru</p>
            </div>
            <a href="/forensics" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
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
                        <i class="fas fa-search mr-2 text-gray-600"></i>
                        Informasi Kasus Forensik
                    </h2>
                </div>

                <form action="/forensics" method="POST" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Case Name -->
                        <div class="md:col-span-2">
                            <label for="case_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kasus <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="case_name" 
                                   name="case_name" 
                                   required
                                   placeholder="Contoh: Analisis Malware - Laptop Eksekutif, Investigasi Intrusi Jaringan"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Case Number -->
                        <div>
                            <label for="case_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Kasus
                            </label>
                            <input type="text" 
                                   id="case_number" 
                                   name="case_number"
                                   value="FOR-<?= date('Y') ?>-<?= str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) ?>"
                                   placeholder="Dihasilkan otomatis atau entri manual"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Case Type -->
                        <div>
                            <label for="case_type" class="block text-sm font-medium text-gray-700 mb-2">
                                Tipe Kasus <span class="text-red-500">*</span>
                            </label>
                            <select id="case_type" 
                                    name="case_type" 
                                    required
                                    onchange="updateCaseGuidelines()"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                <option value="">Pilih Tipe Kasus</option>
                                <option value="Malware Analysis">Analisis Malware</option>
                                <option value="Network Forensics">Forensik Jaringan</option>
                                <option value="Disk Forensics">Forensik Disk</option>
                                <option value="Mobile Forensics">Forensik Seluler</option>
                                <option value="Memory Forensics">Forensik Memori</option>
                                <option value="Email Forensics">Forensik Email</option>
                                <option value="Database Forensics">Forensik Database</option>
                                <option value="Cloud Forensics">Forensik Cloud</option>
                                <option value="Other">Lainnya</option>
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
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                <option value="">Pilih Prioritas</option>
                                <option value="Low">Rendah</option>
                                <option value="Medium">Sedang</option>
                                <option value="High">Tinggi</option>
                                <option value="Critical">Kritis</option>
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
                                <option value="">Pilih Status</option>
                                <option value="Active" selected>Aktif</option>
                                <option value="In Progress">Sedang Berlangsung</option>
                                <option value="On Hold">Ditunda</option>
                                <option value="Completed">Selesai</option>
                                <option value="Archived">Diarsipkan</option>
                            </select>
                        </div>

                        <!-- Assigned Investigator -->
                        <div>
                            <label for="assigned_investigator" class="block text-sm font-medium text-gray-700 mb-2">
                                Penyelidik yang Ditugaskan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="assigned_investigator" 
                                   name="assigned_investigator" 
                                   required
                                   placeholder="Contoh: John Smith, Tim Forensik Digital"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Incident Date -->
                        <div>
                            <label for="incident_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Insiden
                            </label>
                            <input type="datetime-local" 
                                   id="incident_date" 
                                   name="incident_date"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                        </div>

                        <!-- Evidence Count -->
                        <div>
                            <label for="evidence_count" class="block text-sm font-medium text-gray-700 mb-2">
                                Jumlah Bukti Awal
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
                                Deskripsi Kasus <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      required
                                      rows="4"
                                      placeholder="Deskripsi detail kasus forensik, termasuk latar belakang, ruang lingkup, tujuan, dan temuan awal..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors"></textarea>
                        </div>
                    </div>

                    <!-- Case Guidelines by Type -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>
                            Pedoman Forensik Berdasarkan Tipe Kasus
                        </h3>
                        
                        <div id="case-guidelines">
                            <!-- Malware Analysis -->
                            <div class="case-guideline bg-red-50 border border-red-200 rounded-lg p-4 mb-4" data-type="Malware Analysis" style="display: none;">
                                <h4 class="font-semibold text-red-900 mb-2">Pedoman Analisis Malware</h4>
                                <ul class="text-sm text-red-800 space-y-1">
                                    <li>• Segera isolasi sistem yang diduga terinfeksi</li>
                                    <li>• Kumpulkan dump memori dan snapshot sistem</li>
                                    <li>• Dokumentasikan perilaku malware dan indikatornya</li>
                                    <li>• Analisis komunikasi jaringan dan server C&C</li>
                                    <li>• Pertahankan integritas bukti dengan hashing yang tepat</li>
                                </ul>
                            </div>

                            <!-- Network Forensics -->
                            <div class="case-guideline bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4" data-type="Network Forensics" style="display: none;">
                                <h4 class="font-semibold text-blue-900 mb-2">Pedoman Forensik Jaringan</h4>
                                <ul class="text-sm text-blue-800 space-y-1">
                                    <li>• Tangkap dan simpan log lalu lintas jaringan</li>
                                    <li>• Analisis log firewall dan IDS/IPS</li>
                                    <li>• Dokumentasikan topologi dan konfigurasi jaringan</li>
                                    <li>• Identifikasi koneksi dan aliran data yang mencurigakan</li>
                                    <li>• Korelasikan linimasa peristiwa jaringan</li>
                                </ul>
                            </div>

                            <!-- Disk Forensics -->
                            <div class="case-guideline bg-green-50 border border-green-200 rounded-lg p-4 mb-4" data-type="Disk Forensics" style="display: none;">
                                <h4 class="font-semibold text-green-900 mb-2">Pedoman Forensik Disk</h4>
                                <ul class="text-sm text-green-800 space-y-1">
                                    <li>• Buat citra disk forensik bit-for-bit</li>
                                    <li>• Dokumentasikan lacak balak (chain of custody) dengan cermat</li>
                                    <li>• Analisis sistem file dan pulihkan file yang dihapus</li>
                                    <li>• Periksa metadata dan bukti stempel waktu</li>
                                    <li>• Gunakan perangkat keras write-blocking untuk menjaga bukti</li>
                                </ul>
                            </div>

                            <!-- Mobile Forensics -->
                            <div class="case-guideline bg-purple-50 border border-purple-200 rounded-lg p-4 mb-4" data-type="Mobile Forensics" style="display: none;">
                                <h4 class="font-semibold text-purple-900 mb-2">Pedoman Forensik Seluler</h4>
                                <ul class="text-sm text-purple-800 space-y-1">
                                    <li>• Tempatkan perangkat dalam mode pesawat atau tas Faraday</li>
                                    <li>• Dokumentasikan status perangkat dan kondisi fisiknya</li>
                                    <li>• Ekstrak data menggunakan alat forensik yang sesuai</li>
                                    <li>• Analisis data aplikasi, pesan, dan log panggilan</li>
                                    <li>• Pertahankan bukti sinkronisasi cloud</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Chain of Custody -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-link text-blue-600 mr-2"></i>
                            Persyaratan Lacak Balak (Chain of Custody)
                        </h3>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mt-1 mr-3"></i>
                                <div>
                                    <p class="text-sm text-yellow-800 mb-2">
                                        <strong>Penting:</strong> Semua bukti yang dikumpulkan untuk kasus ini harus mematuhi lacak balak yang tepat agar dapat diterima dalam proses hukum.
                                    </p>
                                    <ul class="text-xs text-yellow-700 space-y-1">
                                        <li>• Dokumentasikan siapa, apa, kapan, di mana, dan mengapa untuk semua penanganan bukti</li>
                                        <li>• Gunakan segel tahan kerusakan dan penyimpanan aman</li>
                                        <li>• Simpan log rinci semua akses dan transfer</li>
                                        <li>• Dapatkan otorisasi yang tepat sebelum pengumpulan bukti</li>
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
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                                <i class="fas fa-save mr-2"></i>
                                Buat Kasus Forensik
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
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Membuat Kasus...';
        submitBtn.disabled = true;
    });
    
    // Validate evidence count
    const evidenceCountInput = document.getElementById('evidence_count');
    evidenceCountInput.addEventListener('input', function() {
        if (this.value < 0) {
            this.setCustomValidity('Jumlah bukti tidak bisa negatif');
        } else {
            this.setCustomValidity('');
        }
    });
});
</script>

<?= $this->endSection() ?>