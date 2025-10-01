<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-bell text-orange-600 mr-3"></i>
                    Detail Peringatan Keamanan
                </h1>
                <p class="text-gray-600 mt-1">Informasi peringatan lengkap dan tindakan respons</p>
            </div>
            <div class="flex space-x-3">
                <a href="/alerts/edit/<?= $alert['id'] ?>" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Peringatan
                </a>
                <a href="/alerts" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Peringatan
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Header Peringatan -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gradient-to-r 
                    <?php
                    switch ($alert['priority']) {
                        case 'Critical':
                            echo 'from-red-600 to-red-700';
                            break;
                        case 'High':
                            echo 'from-orange-600 to-orange-700';
                            break;
                        case 'Medium':
                            echo 'from-yellow-600 to-yellow-700';
                            break;
                        case 'Low':
                            echo 'from-blue-600 to-blue-700';
                            break;
                        default:
                            echo 'from-gray-600 to-gray-700';
                            break;
                    }
                    ?> text-white p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold"><?= esc($alert['alert_name']) ?></h2>
                            <p class="text-white text-opacity-90 mt-1">Peringatan <?= esc($alert['alert_type']) ?></p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full
                                <?php
                                switch ($alert['status']) {
                                    case 'Active':
                                        echo 'bg-red-500 text-white';
                                        break;
                                    case 'Investigating':
                                        echo 'bg-yellow-500 text-white';
                                        break;
                                    case 'Closed':
                                        echo 'bg-green-500 text-white';
                                        break;
                                    case 'False Positive':
                                        echo 'bg-gray-500 text-white';
                                        break;
                                    default:
                                        echo 'bg-gray-500 text-white';
                                        break;
                                }
                                ?>">
                                <i class="fas fa-circle text-xs mr-2"></i>
                                <?= esc($alert['status']) ?>
                            </span>
                            <div class="text-sm text-white text-opacity-80 mt-2">
                                Peringatan #<?= $alert['id'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Informasi Peringatan -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                            Informasi Peringatan
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Jenis Peringatan:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($alert['alert_type']) {
                                        case 'Authentication':
                                            echo 'bg-blue-100 text-blue-800';
                                            break;
                                        case 'Network':
                                            echo 'bg-green-100 text-green-800';
                                            break;
                                        case 'Malware':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        case 'Data Breach':
                                            echo 'bg-purple-100 text-purple-800';
                                            break;
                                        case 'Intrusion':
                                            echo 'bg-orange-100 text-orange-800';
                                            break;
                                        case 'System':
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                    }
                                    ?>">
                                    <?= esc($alert['alert_type']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Prioritas:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php
                                    switch ($alert['priority']) {
                                        case 'Critical':
                                            echo 'bg-red-100 text-red-800';
                                            break;
                                        case 'High':
                                            echo 'bg-orange-100 text-orange-800';
                                            break;
                                        case 'Medium':
                                            echo 'bg-yellow-100 text-yellow-800';
                                            break;
                                        case 'Low':
                                            echo 'bg-blue-100 text-blue-800';
                                            break;
                                        default:
                                            echo 'bg-gray-100 text-gray-800';
                                            break;
                                    }
                                    ?>">
                                    <?= esc($alert['priority']) ?>
                                </span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">IP Sumber:</span>
                                <span class="font-mono text-gray-900"><?= esc($alert['source_ip']) ?: 'Tidak Ada' ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="font-medium text-gray-600">Aturan Deteksi:</span>
                                <span class="text-gray-900"><?= esc($alert['rule_name']) ?: 'Peringatan Manual' ?></span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="font-medium text-gray-600">Dikonfirmasi:</span>
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full <?= $alert['acknowledged'] ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' ?>">
                                    <i class="fas <?= $alert['acknowledged'] ? 'fa-check' : 'fa-clock' ?> text-xs mr-1"></i>
                                    <?= $alert['acknowledged'] ? 'Terkonfirmasi' : 'Menunggu' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Garis Waktu -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-clock mr-2 text-gray-600"></i>
                            Garis Waktu & Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-6">
                            <!-- Peringatan Dibuat -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-plus text-blue-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Peringatan Dibuat</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($alert['created_at']) ?
                                            date('d M Y \p\u\k\u l H:i', strtotime($alert['created_at'])) : 'Tidak diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Terakhir Diperbarui -->
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-edit text-purple-600 text-sm"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Terakhir Diperbarui</p>
                                    <p class="text-xs text-gray-500">
                                        <?= isset($alert['updated_at']) ?
                                            date('d M Y \p\u\k\u l H:i', strtotime($alert['updated_at'])) : 'Tidak diketahui' ?>
                                    </p>
                                </div>
                            </div>

                            <!-- Status Penyelesaian -->
                            <?php if (isset($alert['resolved_at']) && $alert['resolved_at']): ?>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-check text-green-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Terselesaikan</p>
                                        <p class="text-xs text-gray-500">
                                            <?= date('d M Y \p\u\k\u l H:i', strtotime($alert['resolved_at'])) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-exclamation text-orange-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Status: Aktif</p>
                                        <p class="text-xs text-gray-500">
                                            <?php
                                            $createdTime = strtotime($alert['created_at']);
                                            $now = time();
                                            $diff = $now - $createdTime;

                                            if ($diff < 3600) {
                                                echo floor($diff / 60) . ' menit yang lalu';
                                            } elseif ($diff < 86400) {
                                                echo floor($diff / 3600) . ' jam yang lalu';
                                            } else {
                                                echo floor($diff / 86400) . ' hari yang lalu';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Peringatan -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-gray-600"></i>
                        Deskripsi Peringatan
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed"><?= nl2br(esc($alert['description'])) ?></p>
                </div>
            </div>

            <!-- Tindakan Respons -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-shield-alt mr-2 text-gray-600"></i>
                        Tindakan Respons
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="/alerts/acknowledge/<?= $alert['id'] ?>"
                            class="bg-blue-50 hover:bg-blue-100 border border-blue-200 text-blue-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center <?= $alert['acknowledged'] ? 'opacity-50 cursor-not-allowed' : '' ?>"
                            <?= $alert['acknowledged'] ? 'aria-disabled="true" tabindex="-1"' : '' ?>>
                            <i class="fas fa-check text-xl mb-2"></i>
                            <span class="text-sm font-medium"><?= $alert['acknowledged'] ? 'Terkonfirmasi' : 'Konfirmasi' ?></span>
                        </a>

                        <a href="/alerts/escalate/<?= $alert['id'] ?>"
                            onclick="return confirm('Naikkan prioritas peringatan ini?')"
                            class="bg-orange-50 hover:bg-orange-100 border border-orange-200 text-orange-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-arrow-up text-xl mb-2"></i>
                            <span class="text-sm font-medium">Eskalasi</span>
                        </a>

                        <a href="/alerts/create-incident/<?= $alert['id'] ?>"
                            onclick="return confirm('Buat insiden baru berdasarkan peringatan ini?')"
                            class="bg-red-50 hover:bg-red-100 border border-red-200 text-red-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-exclamation-triangle text-xl mb-2"></i>
                            <span class="text-sm font-medium">Buat Insiden</span>
                        </a>

                        <a href="/alerts/close/<?= $alert['id'] ?>"
                            onclick="return confirm('Apakah Anda yakin ingin menutup peringatan ini?')"
                            class="bg-green-50 hover:bg-green-100 border border-green-200 text-green-700 py-3 px-4 rounded-lg transition-colors flex flex-col items-center">
                            <i class="fas fa-times-circle text-xl mb-2"></i>
                            <span class="text-sm font-medium">Tutup Peringatan</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Informasi Tambahan -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-database mr-2 text-gray-600"></i>
                        Informasi Tambahan
                    </h3>
                </div>
                <div class="p-6">
                    <?php if (!empty($alert['metadata'])): ?>
                        <pre class="bg-gray-50 p-4 rounded-lg text-sm text-gray-700 overflow-x-auto"><?= esc(json_encode(json_decode($alert['metadata']), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)) ?></pre>
                    <?php else: ?>
                        <p class="text-gray-500 italic">Tidak ada informasi tambahan</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Rekomendasi Tindakan -->
            <div class="mt-8 bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-lightbulb mr-2 text-gray-600"></i>
                        Rekomendasi Tindakan
                    </h3>
                </div>
                <div class="p-6">
                    <?php if (!empty($alert['recommendations'])): ?>
                        <ul class="list-disc pl-6 space-y-2 text-gray-700">
                            <?php foreach (explode("\n", $alert['recommendations']) as $rec): ?>
                                <li><?= esc($rec) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-gray-500 italic">Tidak ada rekomendasi yang tersedia</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>