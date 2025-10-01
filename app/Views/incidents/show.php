<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                Insiden #<?= esc($incident['id']) ?>
            </h1>
            <p class="text-gray-600 mt-1"><?= esc($incident['title']) ?></p>
        </div>
        <div class="flex space-x-3">
            <a href="/incidents" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Insiden
            </a>
            <a href="/incidents/edit/<?= $incident['id'] ?>" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors shadow-md">
                <i class="fas fa-edit mr-2"></i>
                Edit Insiden
            </a>
        </div>
    </div>
</div>

<!-- Pesan Flash -->
<?= $this->include('components/flash_messages') ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Konten Utama -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Ringkasan Insiden -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                    Ringkasan Insiden
                </h2>
            </div>
            <div class="p-6">
                <div class="prose max-w-none">
                    <p class="text-gray-700"><?= esc($incident['description'] ?? '') ?></p>
                </div>
            </div>
        </div>

        <!-- Berkas Bukti -->
        <?php if (!empty($incident['evidence_collected'])): ?>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-paperclip mr-2 text-gray-600"></i>
                        Berkas Bukti
                    </h2>
                </div>
                <div class="p-6">
                    <?php
                    $evidenceFiles = json_decode($incident['evidence_collected'], true);
                    if (!empty($evidenceFiles) && is_array($evidenceFiles)): ?>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <?php foreach ($evidenceFiles as $file): ?>
                                <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                                    <?php
                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                    ?>
                                    <?php if ($isImage): ?>
                                        <img src="<?= base_url('uploads/incidents/' . $file) ?>"
                                            alt="Bukti"
                                            class="w-full h-32 object-cover rounded mb-2">
                                    <?php else: ?>
                                        <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                                            <i class="fas fa-file-alt text-3xl text-gray-400"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="text-xs text-gray-600 truncate"><?= esc($file) ?></div>
                                    <a href="<?= base_url('uploads/incidents/' . $file) ?>"
                                        target="_blank"
                                        class="text-blue-600 hover:text-blue-800 text-xs mt-1 inline-block">
                                        Lihat Berkas
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-500">Tidak ada berkas bukti.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Garis Waktu & Komentar -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history mr-2 text-gray-600"></i>
                    Garis Waktu & Komentar
                </h2>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <form id="comment-form" class="comment-form">
                        <input type="hidden" name="incident_id" value="<?= $incident['id'] ?>">
                        <textarea name="comment"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                            rows="3"
                            placeholder="Tambahkan komentar atau pembaruan..."></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Kirim Komentar
                        </button>
                    </form>
                </div>
                <div id="comments-container" class="space-y-6">
                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="flex space-x-3 comment-item">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                    <?php if (!empty($comment['profile_picture'])): ?>
                                        <img src="<?= base_url('uploads/profile_pictures/' . $comment['profile_picture']) ?>"
                                            alt="Profil"
                                            class="w-10 h-10 rounded-full object-cover">
                                    <?php else: ?>
                                        <i class="fas fa-user"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-sm">
                                        <span class="font-semibold text-gray-800"><?= esc($comment['username']) ?></span>
                                        <span class="text-gray-600">berkomentar</span>
                                    </p>
                                    <p class="text-gray-700 mt-1"><?= esc($comment['comment']) ?></p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        <?= isset($comment['created_at']) ? date('d M Y H:i', strtotime($comment['created_at'])) : 'Baru saja' ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-comment-alt text-3xl mb-3"></i>
                            <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Tugas Terkait -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-tasks mr-2 text-gray-600"></i>
                    Tugas Terkait
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center py-8">
                    <i class="fas fa-tasks text-3xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Fitur manajemen tugas akan tersedia pada pembaruan berikutnya.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Detail Insiden -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-clipboard-list mr-2 text-gray-600"></i>
                    Detail Insiden
                </h2>
            </div>
            <div class="p-6 text-sm space-y-4">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Tingkat Keparahan</span>
                    <span class="font-semibold"><?= esc($incident['severity']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Status</span>
                    <span class="font-semibold"><?= esc($incident['status']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Alamat IP Sumber</span>
                    <span class="font-mono text-gray-800"><?= esc($incident['source_ip'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Dibuat</span>
                    <span class="text-gray-800"><?= isset($incident['created_at']) ? date('d M Y H:i', strtotime($incident['created_at'])) : 'N/A' ?></span>
                </div>
                <?php if (!empty($incident['resolved_at'])): ?>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-500">Selesai</span>
                        <span class="text-gray-800"><?= date('d M Y H:i', strtotime($incident['resolved_at'])) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bolt mr-2 text-gray-600"></i>
                    Aksi Cepat
                </h2>
            </div>
            <div class="p-6 space-y-3">
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-share-alt mr-2 text-gray-500"></i>
                    Bagikan Insiden
                </button>
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-print mr-2 text-gray-500"></i>
                    Cetak Laporan
                </button>
                <button class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-file-export mr-2 text-gray-500"></i>
                    Ekspor Data
                </button>
                <hr class="my-2">
                <a href="/incidents/edit/<?= $incident['id'] ?>" class="w-full text-left px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-50 rounded-lg transition-colors flex items-center">
                    <i class="fas fa-edit mr-2 text-yellow-500"></i>
                    Edit Insiden
                </a>
                <button class="w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-50 rounded-lg transition-colors flex items-center"
                    onclick="confirmDelete(<?= $incident['id'] ?>)">
                    <i class="fas fa-trash-alt mr-2 text-red-500"></i>
                    Hapus Insiden
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Form tersembunyi untuk hapus -->
<form id="delete-form" method="post" action="">
    <?= csrf_field() ?>
</form>

<script>
    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus insiden ini? Tindakan ini tidak dapat dibatalkan.')) {
            const form = document.getElementById('delete-form');
            form.action = `/incidents/delete/${id}`;
            form.submit();
        }
    }
</script>

<?= $this->endSection() ?>