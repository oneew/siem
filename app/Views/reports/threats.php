<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-shield-alt text-red-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Comprehensive analysis of threat intelligence and IOCs</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="exportReport('excel')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-file-excel mr-2"></i>
                    Export Excel
                </button>
                <button onclick="exportReport('pdf')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Export PDF
                </button>
                <a href="/reports" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    All Reports
                </a>
            </div>
        </div>
    </div>

    <div class="flex-1 p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Threat Intelligence Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-red-100 text-sm font-medium">Total IOCs</h3>
                            <p class="text-3xl font-bold"><?= array_sum($stats['by_type']) ?></p>
                        </div>
                        <div class="bg-red-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-blue-100 text-sm font-medium">IP Addresses</h3>
                            <p class="text-3xl font-bold"><?= $stats['by_type']['IP'] ?></p>
                        </div>
                        <div class="bg-blue-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-network-wired text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-green-100 text-sm font-medium">Domains</h3>
                            <p class="text-3xl font-bold"><?= $stats['by_type']['Domain'] ?></p>
                        </div>
                        <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-globe text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-purple-100 text-sm font-medium">File Hashes</h3>
                            <p class="text-3xl font-bold"><?= $stats['by_type']['Hash'] ?></p>
                        </div>
                        <div class="bg-purple-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-fingerprint text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- IOC Types Distribution -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-pie mr-2 text-gray-600"></i>
                            IOC Types Distribution
                        </h3>
                    </div>
                    <div class="p-6">
                        <canvas id="iocTypesChart" width="400" height="300"></canvas>
                    </div>
                </div>

                <!-- Threat Severity Trends -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                            Threat Severity Trends
                        </h3>
                    </div>
                    <div class="p-6">
                        <canvas id="severityTrendsChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Top Threats Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list mr-2 text-gray-600"></i>
                        Recent Threat Intelligence
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IOC Value</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Threat Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Severity</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Source</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($threats as $threat): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-mono text-sm text-gray-900 break-all"><?= esc($threat['ioc_value']) ?></div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($threat['ioc_type']) {
                                            case 'IP': echo 'bg-blue-100 text-blue-800'; break;
                                            case 'Domain': echo 'bg-green-100 text-green-800'; break;
                                            case 'Hash': echo 'bg-purple-100 text-purple-800'; break;
                                            case 'URL': echo 'bg-orange-100 text-orange-800'; break;
                                            case 'Email': echo 'bg-red-100 text-red-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($threat['ioc_type']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900"><?= esc($threat['threat_type']) ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($threat['severity']) {
                                            case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                            case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                            case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($threat['severity']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900"><?= esc($threat['source'] ?? 'Internal') ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/threats/<?= $threat['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors" 
                                       title="View Threat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Threat Intelligence Analytics -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Confidence Levels -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-bar mr-2 text-gray-600"></i>
                            Confidence Levels
                        </h3>
                    </div>
                    <div class="p-6">
                        <canvas id="confidenceChart" width="400" height="300"></canvas>
                    </div>
                </div>

                <!-- Geographic Threat Distribution -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-globe-americas mr-2 text-gray-600"></i>
                            Top Threat Sources (Demo)
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-red-500 rounded-full mr-3"></span>
                                    <span class="font-medium">Unknown/Private</span>
                                </div>
                                <span class="text-sm text-gray-600">35%</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-orange-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-orange-500 rounded-full mr-3"></span>
                                    <span class="font-medium">Russia</span>
                                </div>
                                <span class="text-sm text-gray-600">18%</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></span>
                                    <span class="font-medium">China</span>
                                </div>
                                <span class="text-sm text-gray-600">15%</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-blue-500 rounded-full mr-3"></span>
                                    <span class="font-medium">United States</span>
                                </div>
                                <span class="text-sm text-gray-600">12%</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <span class="w-4 h-4 bg-green-500 rounded-full mr-3"></span>
                                    <span class="font-medium">Others</span>
                                </div>
                                <span class="text-sm text-gray-600">20%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart configurations
const chartColors = {
    ip: '#3b82f6',
    domain: '#22c55e',
    hash: '#8b5cf6',
    url: '#f97316',
    email: '#ef4444',
    critical: '#ef4444',
    high: '#f97316',
    medium: '#eab308',
    low: '#3b82f6'
};

// IOC Types Chart
const iocTypesCtx = document.getElementById('iocTypesChart').getContext('2d');
new Chart(iocTypesCtx, {
    type: 'doughnut',
    data: {
        labels: ['IP Address', 'Domain', 'Hash', 'URL'],
        datasets: [{
            data: [
                <?= $stats['by_type']['IP'] ?>,
                <?= $stats['by_type']['Domain'] ?>,
                <?= $stats['by_type']['Hash'] ?>,
                <?= $stats['by_type']['URL'] ?>
            ],
            backgroundColor: [
                chartColors.ip,
                chartColors.domain,
                chartColors.hash,
                chartColors.url
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 20,
                    usePointStyle: true
                }
            }
        }
    }
});

// Severity Trends Chart
const severityTrendsCtx = document.getElementById('severityTrendsChart').getContext('2d');
new Chart(severityTrendsCtx, {
    type: 'line',
    data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [
            {
                label: 'Critical',
                data: [3, 5, 2, 4],
                borderColor: chartColors.critical,
                backgroundColor: chartColors.critical + '20',
                tension: 0.4,
                fill: true
            },
            {
                label: 'High',
                data: [8, 12, 7, 10],
                borderColor: chartColors.high,
                backgroundColor: chartColors.high + '20',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Medium',
                data: [15, 18, 12, 16],
                borderColor: chartColors.medium,
                backgroundColor: chartColors.medium + '20',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Low',
                data: [5, 8, 4, 7],
                borderColor: chartColors.low,
                backgroundColor: chartColors.low + '20',
                tension: 0.4,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                stacked: false,
                ticks: {
                    stepSize: 5
                }
            }
        }
    }
});

// Confidence Levels Chart
const confidenceCtx = document.getElementById('confidenceChart').getContext('2d');
new Chart(confidenceCtx, {
    type: 'bar',
    data: {
        labels: ['High', 'Medium', 'Low'],
        datasets: [{
            label: 'Confidence Levels',
            data: [25, 45, 15], // Demo data
            backgroundColor: [
                '#22c55e',
                '#eab308',
                '#ef4444'
            ],
            borderWidth: 0,
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 10
                }
            }
        }
    }
});

// Export functions
function exportReport(type) {
    if (type === 'excel') {
        showInfoAlert('Export Report', 'Exporting threat intelligence report to Excel format (Demo Mode)');
        // In production: window.location.href = '/reports/threats/export/excel';
    } else if (type === 'pdf') {
        showInfoAlert('Export Report', 'Exporting threat intelligence report to PDF format (Demo Mode)');
        // In production: window.location.href = '/reports/threats/export/pdf';
    }
}

// Auto-refresh data every 10 minutes
setInterval(function() {
    console.log('Threat intelligence data would be refreshed');
}, 600000);
</script>

<?= $this->endSection() ?>