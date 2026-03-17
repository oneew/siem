<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    <p class="text-gray-500 text-sm mt-1">Hasilkan laporan komprehensif untuk setiap target asesmen keamanan (Pentest).</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php if(!empty($reportsData)): ?>
        <?php foreach($reportsData as $rd): ?>
        <?php $t = $rd['target']; ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col">
            <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold px-2 py-1 bg-gray-200 rounded text-gray-700 uppercase tracking-wider mb-2 inline-block">
                        <?= esc($t['environment']) ?>
                    </span>
                    <h3 class="text-lg font-bold text-gray-800 line-clamp-1" title="<?= esc($t['target_name']) ?>"><?= esc($t['target_name']) ?></h3>
                    <p class="text-sm font-mono text-blue-600 mt-1"><?= esc($t['ip_address_or_url']) ?></p>
                </div>
                <!-- Risk level visual indicator -->
                <?php
                    $borderColors = 'border-gray-200';
                    if ($rd['critical'] > 0) $borderColors = 'border-red-500';
                    elseif ($rd['high'] > 0) $borderColors = 'border-orange-500';
                    elseif ($rd['medium'] > 0) $borderColors = 'border-yellow-500';
                    elseif ($rd['low'] > 0) $borderColors = 'border-green-500';
                ?>
                <div class="w-12 h-12 rounded-full border-4 <?= $borderColors ?> flex items-center justify-center bg-white shadow-sm font-bold text-gray-700">
                    <?= $rd['total_vulns'] ?>
                </div>
            </div>
            
            <div class="p-5 flex-1 bg-white">
                <p class="text-xs text-gray-500 font-semibold mb-3 uppercase tracking-wider">Distribusi Temuan</p>
                
                <div class="grid grid-cols-4 gap-2 mb-4 text-center">
                    <div class="bg-red-50 rounded p-2 border border-red-100">
                        <span class="block text-xl font-bold text-red-600"><?= $rd['critical'] ?></span>
                        <span class="block text-[10px] text-red-800 uppercase">Crit</span>
                    </div>
                    <div class="bg-orange-50 rounded p-2 border border-orange-100">
                        <span class="block text-xl font-bold text-orange-600"><?= $rd['high'] ?></span>
                        <span class="block text-[10px] text-orange-800 uppercase">High</span>
                    </div>
                    <div class="bg-yellow-50 rounded p-2 border border-yellow-100">
                        <span class="block text-xl font-bold text-yellow-600"><?= $rd['medium'] ?></span>
                        <span class="block text-[10px] text-yellow-800 uppercase">Med</span>
                    </div>
                    <div class="bg-green-50 rounded p-2 border border-green-100">
                        <span class="block text-xl font-bold text-green-600"><?= $rd['low'] ?></span>
                        <span class="block text-[10px] text-green-800 uppercase">Low</span>
                    </div>
                </div>
                
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-between space-x-2">
                <button onclick="downloadPdf(<?= $t['id'] ?>)" class="flex-1 bg-red-600 text-white font-medium text-sm py-2 px-3 rounded hover:bg-red-700 transition flex justify-center items-center shadow-sm">
                    <i class="fas fa-file-pdf mr-2"></i> PDF Report
                </button>
                <a href="/vulnerabilities" class="bg-white border border-gray-300 text-gray-700 font-medium text-sm py-2 px-3 rounded hover:bg-gray-100 transition flex justify-center items-center shadow-sm">
                    <i class="fas fa-search"></i>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-500">
            <i class="fas fa-box-open text-4xl mb-3 text-gray-300 block"></i>
            Tidak ada Target Penetrasi. Tambahkan target di menu Target Management terlebih dahulu.
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function downloadPdf(targetId) {
    Swal.fire({
        title: 'Generate PDF Report?',
        text: "Sistem akan mengompilasi semua temuan ke dalam satu dokumen PDF (Placeholder Dummy).",
        icon: 'info',
        showCancelButton: true,
        confirmColor: '#dc2626',
        cancelColor: '#6b7280',
        confirmButtonText: 'Generate Sekarang',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            
            // Show loading state
            Swal.fire({
                title: 'Mengompilasi Laporan...',
                html: 'Mohon tunggu selagi PDF sedang dibentuk.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Call endpoint instead of fetch so the browser handles the download
            window.location.href = `/pentest-reports/generate/${targetId}`;
            
            // Close swal after a short delay
            setTimeout(() => {
                Swal.close();
            }, 3000);
        }
    })
}
</script>

<?= $this->endSection() ?>
