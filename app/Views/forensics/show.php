<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-search text-indigo-600 mr-3"></i>
                    Detail Kasus Forensik
                </h1>
                <p class="text-gray-600 mt-1">Kasus #<?= $case['case_number'] ?> - <?= $case['case_name'] ?></p>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportCase('pdf')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Ekspor PDF
                </button>
                <a href="/forensics/edit/<?= $case['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Kasus
                </a>
                <a href="/forensics" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Semua Kasus
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Ringkasan Kasus -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
                <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-200">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-indigo-900">Ringkasan Kasus</h3>
                        <div class="flex items-center space-x-4">
                            <?php
                            $statusColors = [
                                'Active' => 'bg-green-100 text-green-800',
                                'In Progress' => 'bg-blue-100 text-blue-800',
                                'On Hold' => 'bg-yellow-100 text-yellow-800',
                                'Completed' => 'bg-gray-100 text-gray-800',
                                'Archived' => 'bg-gray-100 text-gray-600'
                            ];
                            $priorityColors = [
                                'Low' => 'bg-green-100 text-green-800',
                                'Medium' => 'bg-yellow-100 text-yellow-800',
                                'High' => 'bg-orange-100 text-orange-800',
                                'Critical' => 'bg-red-100 text-red-800'
                            ];
                            ?>
                            <span class="px-3 py-1 rounded-full text-xs font-medium <?= $statusColors[$case['status']] ?>">
                                <?= $case['status'] ?>
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-medium <?= $priorityColors[$case['priority']] ?>">
                                Prioritas <?= $case['priority'] ?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 mb-1"><?= $case['case_type'] ?></div>
                            <div class="text-sm text-gray-600">Jenis Kasus</div>
                        </div>

                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 mb-1"><?= $case['evidence_count'] ?: 0 ?></div>
                            <div class="text-sm text-gray-600">Barang Bukti</div>
                        </div>

                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 mb-1">
                                <?php
                                $createdDate = new DateTime($case['created_at']);
                                $now = new DateTime();
                                $diff = $createdDate->diff($now);
                                echo $diff->days;
                                ?>
                            </div>
                            <div class="text-sm text-gray-600">Hari Aktif</div>
                        </div>

                        <div class="text-center p-4 bg-orange-50 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600 mb-1">
                                <?= $case['assigned_investigator'] ? '1' : '0' ?>
                            </div>
                            <div class="text-sm text-gray-600">Investigator</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informasi Kasus -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-clipboard-list mr-2 text-gray-600"></i>
                                Informasi Kasus
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Kasus</label>
                                    <p class="text-gray-900 font-mono"><?= $case['case_number'] ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Kasus</label>
                                    <p class="text-gray-900"><?= $case['case_name'] ?></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Investigator yang Ditugaskan</label>
                                    <p class="text-gray-900 flex items-center">
                                        <i class="fas fa-user-tie mr-2 text-gray-400"></i>
                                        <?= $case['assigned_investigator'] ?>
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Kejadian</label>
                                    <p class="text-gray-900">
                                        <?= $case['incident_date'] ? date('d M Y H:i', strtotime($case['incident_date'])) : 'Tidak ditentukan' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Kasus -->
                    <?php if ($case['description']): ?>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                                    Deskripsi Kasus
                                </h3>
                            </div>
                            <div class="p-6">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= $case['description'] ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Temuan Investigasi -->
                    <?php if ($case['findings']): ?>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-search mr-2 text-gray-600"></i>
                                    Temuan Investigasi
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= $case['findings'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Rekomendasi -->
                    <?php if ($case['recommendations']): ?>
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-lightbulb mr-2 text-gray-600"></i>
                                    Rekomendasi
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?= $case['recommendations'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Rantai Barang Bukti -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-archive mr-2 text-gray-600"></i>
                                    Rantai Barang Bukti
                                </h3>
                                <button onclick="addEvidence()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm">
                                    <i class="fas fa-plus mr-1"></i>Tambah Bukti
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div id="evidenceList" class="space-y-4">
                                <!-- Contoh Barang Bukti -->
                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">System Memory Dump</h4>
                                            <p class="text-sm text-gray-600 mt-1">Gambar RAM lengkap dari workstation yang terdampak</p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span><i class="fas fa-calendar mr-1"></i>Dikumpulkan: <?= date('d M Y H:i') ?></span>
                                                <span><i class="fas fa-file-alt mr-1"></i>Ukuran: 8.2 GB</span>
                                                <span><i class="fas fa-shield-alt mr-1"></i>Hash: SHA256</span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Terverifikasi</span>
                                    </div>
                                </div>

                                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-900">Network Packet Capture</h4>
                                            <p class="text-sm text-gray-600 mt-1">File PCAP berisi lalu lintas jaringan mencurigakan</p>
                                            <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                <span><i class="fas fa-calendar mr-1"></i>Dikumpulkan: <?= date('d M Y H:i', strtotime('-2 hours')) ?></span>
                                                <span><i class="fas fa-file-alt mr-1"></i>Ukuran: 152 MB</span>
                                                <span><i class="fas fa-shield-alt mr-1"></i>Hash: SHA256</span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded">Terverifikasi</span>
                                    </div>
                                </div>

                                <div class="text-center py-8 text-gray-500" id="noEvidence" style="display: none;">
                                    <i class="fas fa-archive text-4xl mb-2 opacity-50"></i>
                                    <p>Belum ada barang bukti yang dicatat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Aksi Cepat -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-bolt mr-2 text-gray-600"></i>
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="p-6 space-y-3">
                            <button onclick="updateStatus()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-flag mr-2"></i>Perbarui Status
                            </button>
                            <button onclick="assignInvestigator()" class="w-full bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-user-plus mr-2"></i>Tugaskan Investigator
                            </button>
                            <button onclick="generateReport()" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-file-alt mr-2"></i>Generate Laporan
                            </button>
                            <button onclick="closeCase()" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                                <i class="fas fa-archive mr-2"></i>Tutup Kasus
                            </button>
                        </div>
                    </div>

                    <!-- Timeline Kasus -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-timeline mr-2 text-gray-600"></i>
                                Linimasa Kasus
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <!-- Timeline Items -->
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-blue-600 text-xs"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Kasus Dibuat</p>
                                        <p class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($case['created_at'])) ?></p>
                                    </div>
                                </div>

                                <?php if ($case['incident_date']): ?>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation text-red-600 text-xs"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Insiden Terjadi</p>
                                            <p class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($case['incident_date'])) ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($case['updated_at'] !== $case['created_at']): ?>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-edit text-yellow-600 text-xs"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Kasus Diperbarui</p>
                                            <p class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($case['updated_at'])) ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($case['closed_date']): ?>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-check text-gray-600 text-xs"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900">Kasus Ditutup</p>
                                            <p class="text-xs text-gray-500"><?= date('d M Y H:i', strtotime($case['closed_date'])) ?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Kasus Terkait -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-link mr-2 text-gray-600"></i>
                                Kasus Terkait
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="font-medium text-sm text-gray-900">CASE-2024-001</div>
                                    <div class="text-xs text-gray-600">Intrusi Jaringan</div>
                                </a>
                                <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="font-medium text-sm text-gray-900">CASE-2024-003</div>
                                    <div class="text-xs text-gray-600">Eksfiltrasi Data</div>
                                </a>
                                <div class="text-center py-4 text-gray-500 text-sm" id="noRelated" style="display: none;">
                                    Tidak ada kasus terkait
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi Aksi Cepat
    function updateStatus() {
        Swal.fire({
            title: 'Perbarui Status',
            input: 'text',
            inputLabel: 'Masukkan status baru (Active, In Progress, On Hold, Completed, Archived):',
            inputPlaceholder: 'Masukkan status...',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Perbarui',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                showSuccessAlert('Status Diperbarui', `Status kasus diperbarui menjadi: ${result.value} (Demo Mode)`);
            }
        });
    }

    function assignInvestigator() {
        Swal.fire({
            title: 'Tugaskan Investigator',
            input: 'text',
            inputLabel: 'Masukkan nama investigator:',
            inputPlaceholder: 'Masukkan nama investigator...',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Tugaskan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed && result.value) {
                showSuccessAlert('Investigator Ditugaskan', `Kasus ditugaskan kepada: ${result.value} (Demo Mode)`);
            }
        });
    }

    function generateReport() {
        window.location.href = '/forensics/report/<?= $case['id'] ?>';
    }

    function closeCase() {
        showConfirmAlert('Tutup Kasus', 'Apakah Anda yakin ingin menutup kasus ini? Tindakan ini tidak dapat dibatalkan.', () => {
            window.location.href = '/forensics/close/<?= $case['id'] ?>';
        });
    }

    function addEvidence() {
        window.location.href = '/forensics/add-evidence/<?= $case['id'] ?>';
    }

    function exportCase(format) {
        if (format === 'pdf') {
            showInfoAlert('Ekspor Kasus', 'Mengekspor kasus ke format PDF (Demo Mode)\n\nLaporan akan mencakup semua detail kasus, linimasa, dan rantai barang bukti.');
        }
    }

    setInterval(function() {
        console.log('Menyegarkan status kasus... (Demo Mode)');
    }, 300000);
</script>

<?= $this->endSection() ?>