<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-search text-indigo-600 mr-3"></i>
                    Edit Kasus Forensik
                </h1>
                <p class="text-gray-600 mt-1">Ubah detail kasus forensik dan perkembangan investigasi</p>
            </div>
            <div class="flex space-x-3">
                <a href="/forensics/show/<?= $case['id'] ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-eye mr-2"></i>
                    Lihat Kasus
                </a>
                <a href="/forensics" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Daftar Kasus
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-4xl mx-auto">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Informasi Kasus -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-indigo-900">Informasi Kasus</h3>
                        <div class="flex items-center space-x-4 text-sm text-indigo-700">
                            <span><i class="fas fa-calendar mr-1"></i> Dibuat: <?= date('j M Y', strtotime($case['created_at'])) ?></span>
                            <span><i class="fas fa-clock mr-1"></i> Terakhir Diperbarui: <?= date('j M Y H:i', strtotime($case['updated_at'])) ?></span>
                        </div>
                    </div>
                </div>

                <form id="editCaseForm" action="/forensics/<?= $case['id'] ?>" method="POST" class="p-6">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Identifikasi Kasus -->
                        <div class="space-y-4">
                            <div>
                                <label for="case_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kasus</label>
                                <input type="text" id="case_number" name="case_number"
                                    value="<?= $case['case_number'] ?>" readonly
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                                <p class="text-xs text-gray-500 mt-1">Nomor kasus tidak dapat diubah</p>
                            </div>

                            <div>
                                <label for="case_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Kasus <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="case_name" name="case_name"
                                    value="<?= $case['case_name'] ?>" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="case_type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Kasus <span class="text-red-500">*</span>
                                </label>
                                <select id="case_type" name="case_type" required
                                    onchange="updateCaseTypeInfo()"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="">Pilih jenis kasus...</option>
                                    <option value="Malware Analysis" <?= $case['case_type'] == 'Malware Analysis' ? 'selected' : '' ?>>Analisis Malware</option>
                                    <option value="Network Forensics" <?= $case['case_type'] == 'Network Forensics' ? 'selected' : '' ?>>Forensik Jaringan</option>
                                    <option value="Disk Forensics" <?= $case['case_type'] == 'Disk Forensics' ? 'selected' : '' ?>>Forensik Disk</option>
                                    <option value="Mobile Forensics" <?= $case['case_type'] == 'Mobile Forensics' ? 'selected' : '' ?>>Forensik Mobile</option>
                                    <option value="Memory Forensics" <?= $case['case_type'] == 'Memory Forensics' ? 'selected' : '' ?>>Forensik Memori</option>
                                    <option value="Email Forensics" <?= $case['case_type'] == 'Email Forensics' ? 'selected' : '' ?>>Forensik Email</option>
                                    <option value="Database Forensics" <?= $case['case_type'] == 'Database Forensics' ? 'selected' : '' ?>>Forensik Database</option>
                                    <option value="Cloud Forensics" <?= $case['case_type'] == 'Cloud Forensics' ? 'selected' : '' ?>>Forensik Cloud</option>
                                    <option value="Other" <?= $case['case_type'] == 'Other' ? 'selected' : '' ?>>Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                                    Prioritas <span class="text-red-500">*</span>
                                </label>
                                <select id="priority" name="priority" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="Low" <?= $case['priority'] == 'Low' ? 'selected' : '' ?>>Rendah</option>
                                    <option value="Medium" <?= $case['priority'] == 'Medium' ? 'selected' : '' ?>>Sedang</option>
                                    <option value="High" <?= $case['priority'] == 'High' ? 'selected' : '' ?>>Tinggi</option>
                                    <option value="Critical" <?= $case['priority'] == 'Critical' ? 'selected' : '' ?>>Kritis</option>
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <select id="status" name="status" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="Active" <?= $case['status'] == 'Active' ? 'selected' : '' ?>>Aktif</option>
                                    <option value="In Progress" <?= $case['status'] == 'In Progress' ? 'selected' : '' ?>>Sedang Berjalan</option>
                                    <option value="On Hold" <?= $case['status'] == 'On Hold' ? 'selected' : '' ?>>Ditunda</option>
                                    <option value="Completed" <?= $case['status'] == 'Completed' ? 'selected' : '' ?>>Selesai</option>
                                    <option value="Archived" <?= $case['status'] == 'Archived' ? 'selected' : '' ?>>Diarsipkan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Detail Investigasi -->
                        <div class="space-y-4">
                            <div>
                                <label for="assigned_investigator" class="block text-sm font-medium text-gray-700 mb-1">
                                    Investigator yang Ditugaskan <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="assigned_investigator" name="assigned_investigator"
                                    value="<?= $case['assigned_investigator'] ?>" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="incident_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Insiden</label>
                                <input type="datetime-local" id="incident_date" name="incident_date"
                                    value="<?= $case['incident_date'] ? date('Y-m-d\TH:i', strtotime($case['incident_date'])) : '' ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="evidence_count" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Barang Bukti</label>
                                <input type="number" id="evidence_count" name="evidence_count"
                                    value="<?= $case['evidence_count'] ?>" min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="closed_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Ditutup</label>
                                <input type="datetime-local" id="closed_date" name="closed_date"
                                    value="<?= $case['closed_date'] ? date('Y-m-d\TH:i', strtotime($case['closed_date'])) : '' ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                <p class="text-xs text-gray-500 mt-1">Diisi saat kasus selesai</p>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kasus</label>
                        <textarea id="description" name="description" rows="4"
                            placeholder="Deskripsi rinci kasus dan temuan awal..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"><?= $case['description'] ?></textarea>
                    </div>

                    <!-- Temuan -->
                    <div class="mt-6">
                        <label for="findings" class="block text-sm font-medium text-gray-700 mb-1">Temuan Investigasi</label>
                        <textarea id="findings" name="findings" rows="4"
                            placeholder="Temuan utama, hasil analisis barang bukti, dan kesimpulan..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"><?= $case['findings'] ?></textarea>
                    </div>

                    <!-- Rekomendasi -->
                    <div class="mt-6">
                        <label for="recommendations" class="block text-sm font-medium text-gray-700 mb-1">Rekomendasi</label>
                        <textarea id="recommendations" name="recommendations" rows="3"
                            placeholder="Rekomendasi keamanan dan langkah perbaikan..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"><?= $case['recommendations'] ?></textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                        <a href="/forensics" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="button" onclick="resetForm()" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-undo mr-2"></i>Reset
                        </button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-save mr-2"></i>Perbarui Kasus
                        </button>
                    </div>
                </form>
            </div>

            <!-- Panduan Jenis Kasus -->
            <div id="caseTypeInfo" class="bg-blue-50 rounded-xl border border-blue-200 p-6 mb-6" style="display: none;">
                <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Panduan Jenis Kasus
                </h4>
                <div id="caseTypeContent" class="text-blue-800 text-sm"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const caseTypeGuidelines = {
        'Malware Analysis': 'Fokus pada analisis statis dan dinamis file mencurigakan. Dokumentasikan IOC, pola perilaku, dan strategi mitigasi.',
        'Network Forensics': 'Analisis lalu lintas jaringan, packet capture, dan pola komunikasi. Cari indikasi eksfiltrasi data dan pergerakan lateral.',
        'Disk Forensics': 'Periksa sistem file, file yang dihapus, dan artefak disk. Pastikan rantai bukti tetap terjaga.',
        'Mobile Forensics': 'Ekstraksi dan analisis data dari perangkat mobile. Pertimbangkan enkripsi perangkat dan sinkronisasi cloud.',
        'Memory Forensics': 'Analisis dump RAM untuk proses yang berjalan, koneksi jaringan, dan artefak malware.',
        'Email Forensics': 'Investigasi header email, lampiran, dan pola komunikasi. Cari indikator phishing.',
        'Database Forensics': 'Periksa log database, akses tidak sah, dan pola modifikasi data.',
        'Cloud Forensics': 'Investigasi infrastruktur cloud, log akses, dan bukti terdistribusi di berbagai platform.',
        'Other': 'Ikuti prosedur forensik standar dan dokumentasikan semua langkah investigasi secara rinci.'
    };

    function updateCaseTypeInfo() {
        const caseType = document.getElementById('case_type').value;
        const infoDiv = document.getElementById('caseTypeInfo');
        const contentDiv = document.getElementById('caseTypeContent');

        if (caseType && caseTypeGuidelines[caseType]) {
            contentDiv.textContent = caseTypeGuidelines[caseType];
            infoDiv.style.display = 'block';
        } else {
            infoDiv.style.display = 'none';
        }
    }

    function resetForm() {
        if (confirm('Apakah Anda yakin ingin mereset semua perubahan? Tindakan ini akan mengembalikan nilai kasus ke kondisi awal.')) {
            document.getElementById('editCaseForm').reset();
            <?php foreach ($case as $key => $value): ?>
                <?php if ($key !== 'id' && $key !== 'case_number'): ?>
                    const <?= $key ?>Field = document.querySelector('[name="<?= $key ?>"]');
                    if (<?= $key ?>Field) {
                        <?= $key ?>Field.value = <?= json_encode($value) ?>;
                    }
                <?php endif; ?>
            <?php endforeach; ?>
            updateCaseTypeInfo();
        }
    }

    // Validasi form
    document.getElementById('editCaseForm').addEventListener('submit', function(e) {
        const requiredFields = ['case_name', 'case_type', 'priority', 'status', 'assigned_investigator'];
        let isValid = true;

        requiredFields.forEach(fieldName => {
            const field = document.querySelector(`[name="${fieldName}"]`);
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'bg-red-50');
                isValid = false;
            } else {
                field.classList.remove('border-red-500', 'bg-red-50');
            }
        });

        if (!isValid) {
            e.preventDefault();
            showErrorAlert('Kesalahan Validasi', 'Harap isi semua field yang wajib diisi.');
            return false;
        }

        // Konfirmasi update (demo)
        e.preventDefault();
        showConfirmAlert('Perbarui Kasus Forensik', 'Perbarui kasus forensik? (Demo Mode - Tidak ada perubahan nyata pada database)', () => {
            showSuccessAlert('Kasus Diperbarui', 'Kasus forensik berhasil diperbarui (Demo Mode)');
        });
    });

    // Inisialisasi info jenis kasus
    updateCaseTypeInfo();

    // Auto-save draft (demo)
    let autoSaveTimer;
    document.getElementById('editCaseForm').addEventListener('input', function() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(function() {
            console.log('Menyimpan draft kasus secara otomatis... (Demo Mode)');
        }, 5000);
    });
</script>

<?= $this->endSection() ?>