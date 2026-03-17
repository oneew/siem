<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php
    $riskColor = $riskLevel === 'Low' ? 'text-green-500' : ($riskLevel === 'Medium' ? 'text-yellow-500' : 'text-red-500');
    $riskBg    = $riskLevel === 'Low' ? 'bg-green-50 border-green-200 dark:bg-green-900/20 dark:border-green-700' : ($riskLevel === 'Medium' ? 'bg-yellow-50 border-yellow-200 dark:bg-yellow-900/20 dark:border-yellow-700' : 'bg-red-50 border-red-200 dark:bg-red-900/20 dark:border-red-700');
    $scoreColor = $securityScore >= 80 ? 'text-green-600' : ($securityScore >= 60 ? 'text-yellow-600' : 'text-red-600');
?>

<!-- Role Badge -->
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
            <i class="fas fa-chart-pie text-blue-500 mr-2"></i> <?= esc($title) ?>
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Tampilan Eksekutif — Ringkasan keamanan organisasi tingkat tinggi.</p>
    </div>
    <div class="flex items-center gap-3">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300 text-sm font-bold border border-purple-200 dark:border-purple-700">
            <i class="fas fa-crown"></i> C-Level View
        </span>
        <a href="/dashboard/switch-role" class="text-xs text-gray-400 hover:text-blue-500 dark:text-gray-500 dark:hover:text-blue-400 transition">Switch Role (Demo)</a>
    </div>
</div>

<!-- KPI TOP ROW -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Security Posture -->
    <div class="dashboard-card border-l-4 border-blue-500 p-6 flex flex-col justify-between">
        <div class="flex justify-between items-center mb-4">
            <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Security Posture</p>
            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/40 rounded-xl flex items-center justify-center">
                <i class="fas fa-shield-alt text-blue-500"></i>
            </div>
        </div>
        <div>
            <div class="text-5xl font-black <?= $scoreColor ?> mb-1"><?= $securityScore ?>%</div>
            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1.5 mt-2">
                <div class="h-1.5 rounded-full bg-blue-500" style="width: <?= $securityScore ?>%"></div>
            </div>
            <p class="text-xs text-gray-400 mt-2">Kalkulasi dari &nbsp;<?= $criticalAlerts ?>&nbsp; critical alert aktif</p>
        </div>
    </div>

    <!-- Risk Level -->
    <div class="dashboard-card border-l-4 <?= $riskLevel === 'Low' ? 'border-green-500' : ($riskLevel === 'Medium' ? 'border-yellow-500' : 'border-red-500') ?> p-6 flex flex-col justify-between">
        <div class="flex justify-between items-center mb-4">
            <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Tingkat Risiko</p>
            <div class="w-10 h-10 <?= $riskLevel === 'Low' ? 'bg-green-100 dark:bg-green-900/30' : ($riskLevel === 'Medium' ? 'bg-yellow-100 dark:bg-yellow-900/30' : 'bg-red-100 dark:bg-red-900/30') ?> rounded-xl flex items-center justify-center">
                <i class="fas fa-fire <?= $riskColor ?>"></i>
            </div>
        </div>
        <div>
            <div class="text-4xl font-black <?= $riskColor ?>"><?= $riskLevel ?></div>
            <p class="text-xs text-gray-400 mt-2">Risk level organisasi saat ini</p>
        </div>
    </div>

    <!-- Compliance Score -->
    <div class="dashboard-card border-l-4 border-emerald-500 p-6 flex flex-col justify-between">
        <div class="flex justify-between items-center mb-4">
            <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">Compliance Score</p>
            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                <i class="fas fa-check-double text-emerald-500"></i>
            </div>
        </div>
        <div>
            <div class="text-5xl font-black text-emerald-500"><?= $complianceScore ?>%</div>
            <p class="text-xs text-gray-400 mt-2">Kepatuhan terhadap standar keamanan</p>
        </div>
    </div>

    <!-- MTTR -->
    <div class="dashboard-card border-l-4 border-purple-500 p-6 flex flex-col justify-between">
        <div class="flex justify-between items-center mb-4">
            <p class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-widest">MTTR</p>
            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                <i class="fas fa-stopwatch text-purple-500"></i>
            </div>
        </div>
        <div>
            <div class="text-4xl font-black text-purple-500"><?= $mttr ?></div>
            <p class="text-xs text-gray-400 mt-2">Mean Time to Respond (rata-rata)</p>
        </div>
    </div>
</div>

<!-- MIDDLE ROW: Charts + Summary -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Incident Summary Card -->
    <div class="lg:col-span-1 dashboard-card p-6">
        <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4 flex items-center gap-2">
            <i class="fas fa-ticket-alt text-blue-400"></i> Ringkasan Insiden
        </h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-3 rounded-xl bg-gray-50 dark:bg-siem-darkbg">
                <span class="text-sm text-gray-600 dark:text-gray-400">Total Insiden</span>
                <span class="text-xl font-bold text-gray-900 dark:text-white"><?= $totalIncidents ?></span>
            </div>
            <div class="flex justify-between items-center p-3 rounded-xl bg-red-50 dark:bg-red-900/20">
                <span class="text-sm text-red-600 dark:text-red-400">Masih Terbuka</span>
                <span class="text-xl font-bold text-red-600"><?= $openIncidents ?></span>
            </div>
            <div class="flex justify-between items-center p-3 rounded-xl bg-amber-50 dark:bg-amber-900/20">
                <span class="text-sm text-amber-600 dark:text-amber-400">Critical Alert</span>
                <span class="text-xl font-bold text-amber-600"><?= $criticalAlerts ?></span>
            </div>
            <div class="flex justify-between items-center p-3 rounded-xl bg-purple-50 dark:bg-purple-900/20">
                <span class="text-sm text-purple-600 dark:text-purple-400">Pentest Project</span>
                <span class="text-xl font-bold text-purple-600"><?= $openPentests ?></span>
            </div>
        </div>
    </div>

    <!-- Monthly Security Trend (Chart) -->
    <div class="lg:col-span-2 dashboard-card p-6">
        <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4 flex items-center gap-2">
            <i class="fas fa-chart-line text-blue-400"></i> Tren Insiden (6 Bulan)
        </h3>
        <canvas id="trendChart" height="120"></canvas>
    </div>
</div>

<!-- BOTTOM: Risk Breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Risk by Category -->
    <div class="dashboard-card p-6">
        <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4 flex items-center gap-2">
            <i class="fas fa-layer-group text-amber-400"></i> Breakdown Risiko per Kategori
        </h3>
        <canvas id="riskChart" height="160"></canvas>
    </div>

    <!-- Executive Action Items -->
    <div class="dashboard-card p-6">
        <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-4 flex items-center gap-2">
            <i class="fas fa-tasks text-red-400"></i> Item Tindakan Prioritas
        </h3>
        <div class="space-y-3">
            <?php $items = [
                ['Perbarui kebijakan akses privileged (PAM)', 'Critical', 'fas fa-key'],
                ['Tinjau laporan pentest Q1 2026', 'High', 'fas fa-file-pdf'],
                ['Validasi log DFIR server utama', 'High', 'fas fa-search'],
                ['Review patch management schedule', 'Medium', 'fas fa-tools'],
                ['Audit akun admin yang tidak aktif', 'Low', 'fas fa-user-lock'],
            ]; ?>
            <?php foreach ($items as $item): ?>
            <?php
                $badgeClass = $item[1] === 'Critical' ? 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400' :
                             ($item[1] === 'High'     ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/40 dark:text-orange-400' :
                             ($item[1] === 'Medium'   ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400' :
                                                        'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400'));
            ?>
            <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 dark:border-siem-darkborder hover:bg-gray-50 dark:hover:bg-siem-darkbg transition">
                <div class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-300">
                    <i class="<?= $item[2] ?> text-gray-400 w-4 text-center"></i>
                    <?= esc($item[0]) ?>
                </div>
                <span class="text-[10px] font-bold uppercase px-2 py-1 rounded-full <?= $badgeClass ?>"><?= $item[1] ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Trend Chart
const trendCtx = document.getElementById('trendChart').getContext('2d');
new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: ['Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret'],
        datasets: [
            {
                label: 'Insiden Dibuka',
                data: [12, 19, 8, 14, 11, <?= $openIncidents ?>],
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239,68,68,0.1)',
                tension: 0.4,
                fill: true,
                pointStyle: 'circle',
                pointRadius: 5,
            },
            {
                label: 'Insiden Ditutup',
                data: [10, 15, 7, 12, 10, <?= max(0, $openIncidents - 1) ?>],
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.1)',
                tension: 0.4,
                fill: true,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: true, position: 'top' } },
        scales: {
            x: { grid: { color: 'rgba(200,200,200,0.1)' } },
            y: { beginAtZero: true, grid: { color: 'rgba(200,200,200,0.1)' } }
        }
    }
});

// Risk Breakdown Donut Chart
const riskCtx = document.getElementById('riskChart').getContext('2d');
new Chart(riskCtx, {
    type: 'doughnut',
    data: {
        labels: ['Network', 'Application', 'Data/DB', 'Endpoint', 'Human Factor'],
        datasets: [{
            data: [32, 28, 18, 14, 8],
            backgroundColor: ['#ef4444', '#f97316', '#eab308', '#3b82f6', '#8b5cf6'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: { position: 'right', labels: { usePointStyle: true, pointStyle: 'circle', padding: 16 } }
        }
    }
});
</script>

<?= $this->endSection() ?>
