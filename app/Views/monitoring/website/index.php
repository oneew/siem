<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
            <i class="fas fa-globe text-blue-500 mr-2"></i> Eksternal Website Monitor
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pemantauan *Uptime* dan Penugasan Deteksi *Defacement* (Integritas Halaman HTML) Otomatis.</p>
    </div>
    <div class="flex gap-2">
        <button onclick="checkAllMonitors()" id="checkAllBtn" class="btn btn-secondary text-sm">
            <i class="fas fa-sync-alt"></i> Pindai Ulang Semua
        </button>
        <button onclick="openAddMonitorModal()" class="btn btn-primary text-sm shadow-sm">
            <i class="fas fa-plus"></i> Tambah Target
        </button>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="monitorGrid">
    <?php if(!empty($websites)): ?>
        <?php foreach($websites as $site): ?>
            <?php 
                $statusColor = 'text-green-600 bg-green-100 dark:bg-green-900/30 dark:text-green-400';
                $borderClass = 'border-gray-200 dark:border-siem-darkborder';
                $icon = 'fa-check-circle';
                $isDefaced = false;

                if ($site['last_status'] === 'Offline') {
                    $statusColor = 'text-red-600 bg-red-100 dark:bg-red-900/30 dark:text-red-400';
                    $borderClass = 'border-red-300 dark:border-red-500/50';
                    $icon = 'fa-times-circle';
                } elseif (strpos($site['last_status'], 'Defaced') !== false) {
                    $statusColor = 'text-yellow-600 bg-yellow-100 dark:bg-yellow-900/30 dark:text-yellow-400';
                    $borderClass = 'border-yellow-400 dark:border-yellow-500/50 animate-pulse';
                    $icon = 'fa-exclamation-triangle';
                    $isDefaced = true;
                } elseif ($site['last_status'] === 'Pending') {
                    $statusColor = 'text-gray-600 bg-gray-100 dark:bg-gray-800 dark:text-gray-400';
                    $icon = 'fa-clock';
                }
            ?>
            <div class="card <?= $borderClass ?> relative" id="monitor-card-<?= $site['id'] ?>">
                <?php if($isDefaced): ?>
                    <div class="absolute inset-0 bg-yellow-500/10 pointer-events-none z-0"></div>
                <?php endif; ?>
                
                <div class="p-5 border-b border-gray-100 dark:border-siem-darkborder flex items-start justify-between relative z-10">
                    <div>
                        <h3 class="font-bold text-gray-800 dark:text-gray-100 text-lg truncate" title="<?= esc($site['name']) ?>">
                            <?= esc($site['name']) ?>
                        </h3>
                        <a href="<?= esc($site['url']) ?>" target="_blank" class="text-sm text-blue-500 hover:underline inline-flex items-center mt-1 truncate max-w-xs">
                            <?= esc($site['url']) ?> <i class="fas fa-external-link-alt text-[10px] ml-1"></i>
                        </a>
                    </div>
                    <button onclick="confirmDelete(<?= $site['id'] ?>)" class="text-gray-400 hover:text-red-500 transition px-2">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
                
                <div class="p-5 bg-gray-50/50 dark:bg-siem-darkbg/50 relative z-10">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Status Terkini</span>
                        <span class="text-xs font-bold px-2.5 py-1 rounded-full <?= $statusColor ?> flex items-center gap-1.5" id="status-badge-<?= $site['id'] ?>">
                            <i class="fas <?= $icon ?>"></i> <span class="status-text"><?= esc($site['last_status']) ?></span>
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-semibold uppercase tracking-wider">Pengecekan Terakhir</span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300" id="last-checked-<?= $site['id'] ?>">
                            <?= $site['last_checked'] ? date('d M Y, H:i', strtotime($site['last_checked'])) : 'Belum pernah' ?>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-white dark:bg-siem-darkcard rounded-xl border border-gray-200 dark:border-siem-darkborder shadow-sm">
            <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-search-location text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Belum ada target pantauan</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md mx-auto">Tambahkan target URL publik (Front-end Web) Anda untuk dipantau secara berkala dari serangan Defacement dan Downtime.</p>
            <button onclick="openAddMonitorModal()" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Target Pertama
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Add Monitor Modal -->
<div id="addMonitorModal" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center pointer-events-none opacity-0 transition-opacity duration-300">
    <div class="bg-white dark:bg-siem-darkcard rounded-xl shadow-2xl w-full max-w-md mx-4 transform scale-95 transition-transform duration-300 pointer-events-auto">
        <div class="flex justify-between items-center p-5 border-b border-gray-100 dark:border-siem-darkborder">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tambah Target Monitor</h3>
            <button onclick="closeAddMonitorModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>
        <form id="addMonitorForm" onsubmit="submitMonitor(event)">
            <div class="p-5 space-y-4">
                <div class="form-group required">
                    <label class="form-label text-gray-700 dark:text-gray-300 text-sm">Nama Alias Target</label>
                    <input type="text" name="name" id="monitorName" required class="form-input" placeholder="Web Portal Utama">
                </div>
                <div class="form-group required">
                    <label class="form-label text-gray-700 dark:text-gray-300 text-sm">URL Lengkap</label>
                    <input type="url" name="url" id="monitorUrl" required class="form-input" placeholder="https://www.example.com">
                    <p class="text-xs text-gray-500 mt-2"><i class="fas fa-info-circle"></i> Sistem akan melakukan kalkulasi hash HTML saat pertama kali URL ditambahkan sebagai baseline integritas.</p>
                </div>
            </div>
            <div class="p-5 border-t border-gray-100 dark:border-siem-darkborder bg-gray-50 dark:bg-gray-800/50 flex justify-end gap-3 rounded-b-xl">
                <button type="button" onclick="closeAddMonitorModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" id="submitMonitorBtn" class="btn btn-primary">Simpan Target</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const modal = document.getElementById('addMonitorModal');
    const modalInner = modal.querySelector('div');

    function openAddMonitorModal() {
        modal.classList.remove('hidden');
        // Trigger reflow
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        modalInner.classList.remove('scale-95');
        modalInner.classList.add('scale-100');
    }

    function closeAddMonitorModal() {
        modal.classList.add('opacity-0');
        modalInner.classList.remove('scale-100');
        modalInner.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.getElementById('addMonitorForm').reset();
        }, 300);
    }

    function submitMonitor(e) {
        e.preventDefault();
        const btn = document.getElementById('submitMonitorBtn');
        const form = document.getElementById('addMonitorForm');
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengkalkulasi Hash...';
        btn.disabled = true;

        const formData = new FormData(form);

        fetch('/website-monitor/store', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: data.message, showConfirmButton: false, timer: 2000 });
                setTimeout(() => window.location.reload(), 1500);
            } else {
                Swal.fire('Error', data.message || 'Gagal menambahkan target', 'error');
                btn.innerHTML = 'Simpan Target';
                btn.disabled = false;
            }
        });
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Target?',
            text: "Target tidak akan dipantau lagi.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('/website-monitor/delete/' + id, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        document.getElementById('monitor-card-' + id).remove();
                        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Terhapus', showConfirmButton: false, timer: 1500 });
                    }
                });
            }
        });
    }

    function checkAllMonitors() {
        const btn = document.getElementById('checkAllBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyelidiki...';
        btn.disabled = true;

        // Apply skeleton loading animation visually to cards to show activity
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => card.classList.add('skeleton'));

        fetch('/website-monitor/check-all', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                // If we want smooth UI without reload, we theoretically map the IDs. Reload is safer for MVP.
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Pemindaian Selesai', showConfirmButton: false, timer: 2000 });
                setTimeout(() => window.location.reload(), 1500);
            } else {
                Swal.fire('Error', 'Gagal memindai', 'error');
                btn.innerHTML = '<i class="fas fa-sync-alt mr-2"></i> Pindai Ulang Semua';
                btn.disabled = false;
                cards.forEach(card => card.classList.remove('skeleton'));
            }
        })
        .catch(err => {
            cards.forEach(card => card.classList.remove('skeleton'));
            btn.innerHTML = '<i class="fas fa-sync-alt mr-2"></i> Pindai Ulang Semua';
            btn.disabled = false;
        });
    }
</script>

<?= $this->endSection() ?>
