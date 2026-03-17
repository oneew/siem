<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Role Badge -->
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            <i class="fas fa-user-ninja text-red-500 mr-2"></i> <?= esc($title) ?>
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tampilan Red Team — Status target, kerentanan, dan aktivitas pentest aktif.</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300 text-sm font-bold border border-red-200 dark:border-red-700">
            <i class="fas fa-crosshairs animate-pulse"></i> Red Team View
        </span>
        <a href="/dashboard/switch-role" class="text-xs text-gray-400 hover:text-blue-500 dark:text-gray-500 dark:hover:text-blue-400 transition">Switch Role (Demo)</a>
    </div>
</div>

<!-- TOP STATS ROW -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="dashboard-card border-l-4 border-red-500 p-6">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Target Aktif</p>
        <div class="text-4xl font-black text-red-500"><?= $openPentests ?></div>
        <p class="text-xs text-gray-400 mt-1"><a href="/redteam/targets" class="text-red-400 hover:underline">Kelola Target →</a></p>
    </div>
    <div class="dashboard-card border-l-4 border-orange-500 p-6">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Total Temuan</p>
        <div class="text-4xl font-black text-orange-500"><?= count($recentVulnerabilities) ?></div>
        <p class="text-xs text-gray-400 mt-1"><a href="/redteam/vulnerabilities" class="text-orange-400 hover:underline">Lihat Findings →</a></p>
    </div>
    <div class="dashboard-card border-l-4 border-yellow-500 p-6">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Severity Critical</p>
        <div class="text-4xl font-black text-yellow-500">
            <?= count(array_filter($recentVulnerabilities, fn($v) => $v['severity'] === 'Critical')) ?>
        </div>
        <p class="text-xs text-red-400 mt-1 font-semibold">Memerlukan prioritas tinggi!</p>
    </div>
    <div class="dashboard-card border-l-4 border-purple-500 p-6">
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Laporan Dibuat</p>
        <div class="text-4xl font-black text-purple-500">1</div>
        <p class="text-xs text-gray-400 mt-1"><a href="/pentest-reports" class="text-purple-400 hover:underline">Buat PDF Report →</a></p>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Vulnerabilities List -->
    <div class="lg:col-span-2 dashboard-card overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 dark:border-siem-darkborder flex justify-between items-center">
            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                <i class="fas fa-bug text-red-500"></i> Temuan Kerentanan Terbaru
            </h3>
            <a href="/redteam/vulnerabilities" class="text-xs font-semibold text-blue-500 hover:underline">Semua Findings</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800/60">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Target</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Severity</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-siem-darkborder">
                    <?php foreach ($recentVulnerabilities as $v): ?>
                    <?php
                        $sev = match($v['severity']) {
                            'Critical' => 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400',
                            'High'     => 'bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400',
                            'Medium'   => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400',
                            default    => 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400',
                        };
                    ?>
                    <tr class="hover:bg-red-50 dark:hover:bg-siem-darkbg transition-colors">
                        <td class="px-6 py-4 font-mono text-gray-500 dark:text-gray-400 text-xs"><?= esc($v['id']) ?></td>
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white"><?= esc($v['target']) ?></td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300"><?= esc($v['type']) ?></td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-[10px] font-bold uppercase rounded-full <?= $sev ?>"><?= esc($v['severity']) ?></span>
                        </td>
                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 text-xs"><?= date('d M Y', strtotime($v['date'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="lg:col-span-1 space-y-4">
        <div class="dashboard-card p-6">
            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2 mb-4">
                <i class="fas fa-bolt text-yellow-500"></i> Quick Actions
            </h3>
            <div class="space-y-2">
                <a href="/redteam/targets" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-siem-darkbg hover:bg-red-50 dark:hover:bg-red-900/20 border border-gray-100 dark:border-siem-darkborder transition text-sm text-gray-700 dark:text-gray-300 group">
                    <i class="fas fa-plus-circle text-red-400 group-hover:text-red-500 w-5 text-center"></i>
                    Tambah Target Baru
                    <i class="fas fa-arrow-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition"></i>
                </a>
                <a href="/redteam/vulnerabilities" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-siem-darkbg hover:bg-orange-50 dark:hover:bg-orange-900/20 border border-gray-100 dark:border-siem-darkborder transition text-sm text-gray-700 dark:text-gray-300 group">
                    <i class="fas fa-bug text-orange-400 group-hover:text-orange-500 w-5 text-center"></i>
                    Input Temuan Baru
                    <i class="fas fa-arrow-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition"></i>
                </a>
                <a href="/redteam/playbooks-v2" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-siem-darkbg hover:bg-purple-50 dark:hover:bg-purple-900/20 border border-gray-100 dark:border-siem-darkborder transition text-sm text-gray-700 dark:text-gray-300 group">
                    <i class="fas fa-book-open text-purple-400 group-hover:text-purple-500 w-5 text-center"></i>
                    Buka Playbook
                    <i class="fas fa-arrow-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition"></i>
                </a>
                <a href="/pentest-reports" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-siem-darkbg hover:bg-blue-50 dark:hover:bg-blue-900/20 border border-gray-100 dark:border-siem-darkborder transition text-sm text-gray-700 dark:text-gray-300 group">
                    <i class="fas fa-file-pdf text-blue-400 group-hover:text-blue-500 w-5 text-center"></i>
                    Generate PDF Report
                    <i class="fas fa-arrow-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition"></i>
                </a>
                <a href="/ai/log-analyzer" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 dark:bg-siem-darkbg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 border border-gray-100 dark:border-siem-darkborder transition text-sm text-gray-700 dark:text-gray-300 group">
                    <i class="fas fa-robot text-indigo-400 group-hover:text-indigo-500 w-5 text-center"></i>
                    AI Log Analyzer
                    <i class="fas fa-arrow-right ml-auto text-xs opacity-0 group-hover:opacity-100 transition"></i>
                </a>
            </div>
        </div>

        <!-- Severity Distribution Chart -->
        <div class="dashboard-card p-6">
            <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2 mb-4">
                <i class="fas fa-chart-bar text-orange-400"></i> Distribusi Severity
            </h3>
            <canvas id="sevChart" height="140"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const sevCtx = document.getElementById('sevChart').getContext('2d');
new Chart(sevCtx, {
    type: 'bar',
    data: {
        labels: ['Critical', 'High', 'Medium', 'Low'],
        datasets: [{
            data: [
                <?= count(array_filter($recentVulnerabilities, fn($v) => $v['severity'] === 'Critical')) ?>,
                <?= count(array_filter($recentVulnerabilities, fn($v) => $v['severity'] === 'High')) ?>,
                <?= count(array_filter($recentVulnerabilities, fn($v) => $v['severity'] === 'Medium')) ?>,
                <?= count(array_filter($recentVulnerabilities, fn($v) => $v['severity'] === 'Low')) ?>
            ],
            backgroundColor: ['#ef4444', '#f97316', '#eab308', '#22c55e'],
            borderRadius: 8,
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { display: false } },
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(200,200,200,0.1)' } }
        }
    }
});
</script>

<?= $this->endSection() ?>
