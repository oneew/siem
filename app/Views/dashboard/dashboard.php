<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg text-white p-6 md:p-8 mb-6 relative overflow-hidden">
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    
    <div class="relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-white/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-shield-alt text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Security Operations Center</h1>
                    <p class="text-blue-200 mt-1">Real-time monitoring & threat intelligence</p>
                    <div class="flex items-center space-x-4 text-xs text-blue-200 mt-2">
                        <span><i class="far fa-clock mr-1"></i>Last sync: <?= date('H:i:s') ?></span>
                        <span><i class="far fa-calendar-alt mr-1"></i><?= date('M j, Y') ?></span>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2 mt-4 md:mt-0">
                <div class="bg-black/20 rounded-lg px-4 py-2 text-center">
                    <p class="font-bold text-lg">99.9%</p>
                    <p class="text-xs text-blue-200">Uptime</p>
                </div>
                <div class="bg-black/20 rounded-lg px-4 py-2 text-center">
                    <p class="font-bold text-lg text-yellow-300">LOW</p>
                    <p class="text-xs text-blue-200">Threat</p>
                </div>
                 <button class="w-10 h-10 bg-black/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
            </div>
        </div>

        <div class="border-t border-white/20 pt-4 flex justify-between items-center text-sm">
            <div class="flex space-x-6">
                <span><i class="fas fa-desktop mr-2"></i>12 Endpoints</span>
                <span><i class="fas fa-network-wired mr-2"></i>3 Networks</span>
                <span><i class="fas fa-crosshairs mr-2"></i><?= $totalIncidents ?> Incidents Monitored</span>
            </div>
            <div>
                <span class="font-semibold">Security Score: A+</span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="card p-5">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Total Incidents</p>
                <p class="text-3xl font-bold text-gray-800"><?= $totalIncidents ?></p>
                <p class="text-xs text-gray-400">All time</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg text-blue-500 text-xl">
                <i class="fas fa-shield-alt"></i>
            </div>
        </div>
    </div>
    <div class="card p-5">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Open Incidents</p>
                <p class="text-3xl font-bold text-gray-800"><?= $openIncidents ?></p>
                <p class="text-xs text-gray-400">Active</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-orange-100 rounded-lg text-orange-500 text-xl">
                <i class="fas fa-folder-open"></i>
            </div>
        </div>
    </div>
    <div class="card p-5">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Resolved</p>
                <p class="text-3xl font-bold text-gray-800"><?= $closedIncidents ?></p>
                <p class="text-xs text-green-500 font-semibold">+12% this week</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-green-100 rounded-lg text-green-500 text-xl">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="card p-5">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-sm text-gray-500">Critical</p>
                <p class="text-3xl font-bold text-gray-800"><?= $criticalIncidents ?></p>
                <p class="text-xs text-red-500 font-semibold">Needs attention</p>
            </div>
            <div class="w-12 h-12 flex items-center justify-center bg-red-100 rounded-lg text-red-500 text-xl">
                <i class="fas fa-fire-alt"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 card">
        <div class="card-header">
            <h3 class="card-title">Recent Incidents</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Incident</th>
                        <th scope="col" class="px-6 py-3">Severity</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($latestIncidents as $incident): ?>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <?= esc($incident['title']) ?>
                        </th>
                        <td class="px-6 py-4"><?= esc($incident['severity']) ?></td>
                        <td class="px-6 py-4"><?= esc($incident['status']) ?></td>
                        <td class="px-6 py-4"><?= date('M j, H:i', strtotime($incident['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Severity Distribution</h3>
        </div>
        <div class="card-content">
            <canvas id="severityChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('severityChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?= $severityLabels ?>,
            datasets: [{
                label: 'Incidents by Severity',
                data: <?= $severityCounts ?>,
                backgroundColor: [
                    '#60a5fa', // Low
                    '#facc15', // Medium
                    '#f97316', // High
                    '#ef4444'  // Critical
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
});
</script>

<?= $this->endSection() ?>