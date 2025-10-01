<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-plus-circle text-purple-600 mr-2 sm:mr-3"></i>
                    Buat Kasus Forensik Baru
                </h1>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Memulai kasus investigasi forensik digital baru</p>
            </div>
            <a href="/forensics" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
                Kembali ke Forensik
            </a>
        </div>
    </div>

    <div class="flex-1 p-2 sm:p-4 md:p-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                    <h2 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-search mr-1.5 sm:mr-2 text-gray-600"></i>
                        Informasi Kasus Forensik
                    </h2>
                </div>

                <form action="/forensics/store" method="POST" class="p-3 sm:p-4 md:p-6">
                    <!-- Two-column layout: form on left, guidelines on right -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
                        <!-- Left column: Main form inputs -->
                        <div class="lg:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Jenis Kasus -->
                                <div class="md:col-span-2">
                                    <label for="case_type" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Jenis Kasus <span class="text-red-500">*</span>
                                    </label>
                                    <select id="case_type"
                                        name="case_type"
                                        required
                                        onchange="updateCaseGuidelines()"
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                        <option value="">Pilih Jenis Kasus</option>
                                        <option value="Malware Analysis">Analisis Malware</option>
                                        <option value="Network Forensics">Forensik Jaringan</option>
                                        <option value="Disk Forensics">Forensik Disk</option>
                                        <option value="Mobile Forensics">Forensik Mobile</option>
                                        <option value="Memory Forensics">Forensik Memori</option>
                                        <option value="Email Forensics">Forensik Email</option>
                                        <option value="Database Forensics">Forensik Database</option>
                                        <option value="Cloud Forensics">Forensik Cloud</option>
                                        <option value="Other">Lainnya</option>
                                    </select>
                                </div>
                                <!-- Nama Kasus -->
                                <div>
                                    <label for="case_name" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Nama Kasus <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        id="case_name"
                                        name="case_name"
                                        required
                                        placeholder="Contoh: Analisis Malware - Laptop Eksekutif, Investigasi Intrusi Jaringan"
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                </div>

                                <!-- Nomor Kasus -->
                                <div>
                                    <label for="case_number" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Nomor Kasus
                                    </label>
                                    <input type="text"
                                        id="case_number"
                                        name="case_number"
                                        value="FOR-<?= date('Y') ?>-<?= str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) ?>"
                                        placeholder="Otomatis atau entri manual"
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                </div>



                                <!-- Prioritas -->
                                <div>
                                    <label for="priority" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Prioritas <span class="text-red-500">*</span>
                                    </label>
                                    <select id="priority"
                                        name="priority"
                                        required
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                        <option value="">Pilih Prioritas</option>
                                        <option value="Low">Rendah</option>
                                        <option value="Medium">Sedang</option>
                                        <option value="High">Tinggi</option>
                                        <option value="Critical">Kritis</option>
                                    </select>
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status"
                                        name="status"
                                        required
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                        <option value="">Pilih Status</option>
                                        <option value="Active" selected>Aktif</option>
                                        <option value="In Progress">Sedang Berjalan</option>
                                        <option value="On Hold">Ditunda</option>
                                        <option value="Completed">Selesai</option>
                                        <option value="Archived">Diarsipkan</option>
                                    </select>
                                </div>

                                <!-- Investigator -->
                                <div>
                                    <label for="assigned_investigator" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Investigator yang Ditugaskan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        id="assigned_investigator"
                                        name="assigned_investigator"
                                        required
                                        placeholder="Contoh: Budi Santoso, Tim Forensik Digital"
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                </div>

                                <!-- Tanggal Insiden -->
                                <div>
                                    <label for="incident_date" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Tanggal Insiden
                                    </label>
                                    <input type="datetime-local"
                                        id="incident_date"
                                        name="incident_date"
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                </div>

                                <!-- Jumlah Bukti -->
                                <div>
                                    <label for="evidence_count" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Jumlah Bukti Awal
                                    </label>
                                    <input type="number"
                                        id="evidence_count"
                                        name="evidence_count"
                                        min="0"
                                        value="0"
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm">
                                </div>

                                <!-- Deskripsi -->
                                <div class="md:col-span-2">
                                    <label for="description" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">
                                        Deskripsi Kasus <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="description"
                                        name="description"
                                        required
                                        rows="4"
                                        placeholder="Deskripsi detail kasus forensik, termasuk latar belakang, ruang lingkup, tujuan, dan temuan awal..."
                                        class="w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors text-sm"></textarea>
                                </div>
                            </div>

                            <!-- Aksi Form -->
                            <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200">
                                <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-4">
                                    <a href="/forensics"
                                        class="px-3 py-1.5 sm:px-4 sm:py-2 md:px-6 md:py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm text-center">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="px-3 py-1.5 sm:px-4 sm:py-2 md:px-6 md:py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center justify-center text-sm">
                                        <i class="fas fa-save mr-1 sm:mr-2"></i>
                                        Buat Kasus Forensik
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Right column: Guidelines -->
                        <div>
                            <!-- Pedoman Kasus -->
                            <div class="sticky top-4">
                                <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4 flex items-center">
                                    <i class="fas fa-lightbulb text-yellow-600 mr-1.5 sm:mr-2"></i>
                                    Pedoman Forensik
                                </h3>

                                <div id="case-guidelines" class="space-y-3 sm:space-y-4">
                                    <!-- Malware Analysis -->
                                    <div class="case-guideline bg-red-50 border border-red-200 rounded-lg p-3 sm:p-4" data-type="Malware Analysis" style="display: none;">
                                        <h4 class="font-semibold text-red-900 mb-2 text-sm">Analisis Malware</h4>
                                        <ul class="text-xs text-red-800 space-y-1">
                                            <li>• Isolasi sistem yang dicurigai terinfeksi segera</li>
                                            <li>• Kumpulkan dump memori dan snapshot sistem</li>
                                            <li>• Dokumentasikan perilaku malware dan indikator</li>
                                            <li>• Analisis komunikasi jaringan dan server C&C</li>
                                            <li>• Jaga integritas bukti dengan hashing yang tepat</li>
                                        </ul>
                                    </div>

                                    <!-- Network Forensics -->
                                    <div class="case-guideline bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4" data-type="Network Forensics" style="display: none;">
                                        <h4 class="font-semibold text-blue-900 mb-2 text-sm">Forensik Jaringan</h4>
                                        <ul class="text-xs text-blue-800 space-y-1">
                                            <li>• Tangkap dan simpan log lalu lintas jaringan</li>
                                            <li>• Analisis log firewall dan IDS/IPS</li>
                                            <li>• Dokumentasikan topologi dan konfigurasi jaringan</li>
                                            <li>• Identifikasi koneksi dan aliran data mencurigakan</li>
                                            <li>• Korelasikan timeline peristiwa jaringan</li>
                                        </ul>
                                    </div>

                                    <!-- Disk Forensics -->
                                    <div class="case-guideline bg-green-50 border border-green-200 rounded-lg p-3 sm:p-4" data-type="Disk Forensics" style="display: none;">
                                        <h4 class="font-semibold text-green-900 mb-2 text-sm">Forensik Disk</h4>
                                        <ul class="text-xs text-green-800 space-y-1">
                                            <li>• Buat image disk forensik bit-per-bit</li>
                                            <li>• Dokumentasikan rantai kepemilikan dengan teliti</li>
                                            <li>• Analisis file system dan pulihkan file terhapus</li>
                                            <li>• Periksa metadata dan bukti timestamp</li>
                                            <li>• Gunakan hardware write-blocking untuk menjaga bukti</li>
                                        </ul>
                                    </div>

                                    <!-- Mobile Forensics -->
                                    <div class="case-guideline bg-purple-50 border border-purple-200 rounded-lg p-3 sm:p-4" data-type="Mobile Forensics" style="display: none;">
                                        <h4 class="font-semibold text-purple-900 mb-2 text-sm">Forensik Mobile</h4>
                                        <ul class="text-xs text-purple-800 space-y-1">
                                            <li>• Tempatkan perangkat pada mode pesawat atau Faraday bag</li>
                                            <li>• Dokumentasikan kondisi fisik dan status perangkat</li>
                                            <li>• Ekstrak data dengan alat forensik yang sesuai</li>
                                            <li>• Analisis data aplikasi, pesan, dan log panggilan</li>
                                            <li>• Amankan bukti sinkronisasi cloud</li>
                                        </ul>
                                    </div>

                                    <!-- Memory Forensics -->
                                    <div class="case-guideline bg-indigo-50 border border-indigo-200 rounded-lg p-3 sm:p-4" data-type="Memory Forensics" style="display: none;">
                                        <h4 class="font-semibold text-indigo-900 mb-2 text-sm">Forensik Memori</h4>
                                        <ul class="text-xs text-indigo-800 space-y-1">
                                            <li>• Kumpulkan dump memori volatile segera</li>
                                            <li>• Analisis struktur data kernel dan proses</li>
                                            <li>• Identifikasi rootkit dan malware dalam memori</li>
                                            <li>• Ekstrak koneksi jaringan dan proses mencurigakan</li>
                                            <li>• Gunakan alat khusus untuk analisis memori</li>
                                        </ul>
                                    </div>

                                    <!-- Email Forensics -->
                                    <div class="case-guideline bg-pink-50 border border-pink-200 rounded-lg p-3 sm:p-4" data-type="Email Forensics" style="display: none;">
                                        <h4 class="font-semibold text-pink-900 mb-2 text-sm">Forensik Email</h4>
                                        <ul class="text-xs text-pink-800 space-y-1">
                                            <li>• Amankan header email dan metadata</li>
                                            <li>• Analisis server mail dan log pengiriman</li>
                                            <li>• Periksa lampiran dan tautan mencurigakan</li>
                                            <li>• Identifikasi alamat IP pengirim palsu</li>
                                            <li>• Dokumentasikan rantai pengiriman email</li>
                                        </ul>
                                    </div>

                                    <!-- Database Forensics -->
                                    <div class="case-guideline bg-teal-50 border border-teal-200 rounded-lg p-3 sm:p-4" data-type="Database Forensics" style="display: none;">
                                        <h4 class="font-semibold text-teal-900 mb-2 text-sm">Forensik Database</h4>
                                        <ul class="text-xs text-teal-800 space-y-1">
                                            <li>• Amankan log transaksi database</li>
                                            <li>• Analisis query SQL mencurigakan</li>
                                            <li>• Periksa akses tidak sah dan privilege escalation</li>
                                            <li>• Pulihkan data yang dihapus atau dimodifikasi</li>
                                            <li>• Dokumentasikan jejak aktivitas database</li>
                                        </ul>
                                    </div>

                                    <!-- Cloud Forensics -->
                                    <div class="case-guideline bg-cyan-50 border border-cyan-200 rounded-lg p-3 sm:p-4" data-type="Cloud Forensics" style="display: none;">
                                        <h4 class="font-semibold text-cyan-900 mb-2 text-sm">Forensik Cloud</h4>
                                        <ul class="text-xs text-cyan-800 space-y-1">
                                            <li>• Amankan log aktivitas cloud provider</li>
                                            <li>• Analisis akses API dan credential abuse</li>
                                            <li>• Periksa konfigurasi dan kebijakan keamanan</li>
                                            <li>• Identifikasi data eksfiltrasi ke cloud</li>
                                            <li>• Koordinasi dengan penyedia layanan cloud</li>
                                        </ul>
                                    </div>

                                    <!-- Default message when no type selected -->
                                    <div id="default-guideline" class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                        <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                                        <p class="text-gray-600 text-sm">Pilih jenis kasus untuk melihat pedoman forensik yang relevan</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Chain of Custody -->
                            <div class="mt-4 sm:mt-6 pt-4 sm:pt-6 border-t border-gray-200">
                                <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-3 sm:mb-4 flex items-center">
                                    <i class="fas fa-link text-blue-600 mr-1.5 sm:mr-2"></i>
                                    Persyaratan Rantai Kepemilikan
                                </h3>

                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 sm:p-4">
                                    <div class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-2 text-sm"></i>
                                        <div>
                                            <p class="text-xs sm:text-sm text-yellow-800 mb-2">
                                                <strong>Penting:</strong> Semua bukti yang dikumpulkan untuk kasus ini harus menjaga rantai kepemilikan yang benar agar sah di pengadilan.
                                            </p>
                                            <ul class="text-xs text-yellow-700 space-y-1">
                                                <li>• Dokumentasikan siapa, apa, kapan, dimana, dan mengapa untuk setiap penanganan bukti</li>
                                                <li>• Gunakan segel tahan rusak dan penyimpanan aman</li>
                                                <li>• Simpan log detail semua akses dan transfer</li>
                                                <li>• Dapatkan otorisasi resmi sebelum pengumpulan bukti</li>
                                            </ul>
                                        </div>
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
    // Sama seperti aslinya, teks di JS juga diterjemahkan
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const caseTypeSelect = document.getElementById('case_type');
        const incidentDateInput = document.getElementById('incident_date');
        const defaultGuideline = document.getElementById('default-guideline');

        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        incidentDateInput.value = now.toISOString().slice(0, 16);

        window.updateCaseGuidelines = function() {
            const selectedType = caseTypeSelect.value;
            const guidelines = document.querySelectorAll('.case-guideline');

            // Show/hide the default guideline
            defaultGuideline.style.display = selectedType ? 'none' : 'block';

            guidelines.forEach(guideline => {
                guideline.style.display = (guideline.dataset.type === selectedType) ? 'block' : 'none';
            });

            const caseNameInput = document.getElementById('case_name');
            if (!caseNameInput.value && selectedType) {
                const suggestions = {
                    'Malware Analysis': 'Analisis Malware - Dugaan Infeksi',
                    'Network Forensics': 'Investigasi Intrusi Jaringan',
                    'Disk Forensics': 'Kasus Pemulihan Bukti Digital',
                    'Mobile Forensics': 'Investigasi Perangkat Mobile',
                    'Memory Forensics': 'Analisis Dump Memori',
                    'Email Forensics': 'Investigasi Komunikasi Email',
                    'Database Forensics': 'Analisis Pelanggaran Keamanan Database',
                    'Cloud Forensics': 'Investigasi Infrastruktur Cloud'
                };
                caseNameInput.placeholder = suggestions[selectedType] || caseNameInput.placeholder;
            }
        };

        const prioritySelect = document.getElementById('priority');
        prioritySelect.addEventListener('change', function() {
            this.className = 'w-full px-2 py-1.5 sm:px-3 sm:py-2 md:px-4 md:py-3 border border-gray-300 rounded-lg focus:ring-2 transition-colors text-sm ' +
                (this.value === 'Critical' ? 'focus:ring-red-500 focus:border-red-500 bg-red-50' :
                    this.value === 'High' ? 'focus:ring-orange-500 focus:border-orange-500 bg-orange-50' :
                    this.value === 'Medium' ? 'focus:ring-yellow-500 focus:border-yellow-500 bg-yellow-50' :
                    this.value === 'Low' ? 'focus:ring-blue-500 focus:border-blue-500 bg-blue-50' :
                    'focus:ring-purple-500 focus:border-purple-500');
        });

        const caseNumberInput = document.getElementById('case_number');
        form.addEventListener('submit', function(e) {
            if (!caseNumberInput.value.trim()) {
                const year = new Date().getFullYear();
                const random = Math.floor(Math.random() * 9000) + 1000;
                caseNumberInput.value = `FOR-${year}-${random}`;
            }

            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1 sm:mr-2"></i> Membuat Kasus...';
            submitBtn.disabled = true;
        });

        const evidenceCountInput = document.getElementById('evidence_count');
        evidenceCountInput.addEventListener('input', function() {
            if (this.value < 0) {
                this.setCustomValidity('Jumlah bukti tidak boleh negatif');
            } else {
                this.setCustomValidity('');
            }
        });
    });
</script>

<?= $this->endSection() ?>
```