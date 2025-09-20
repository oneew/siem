<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">Comprehensive analysis of security incidents and trends</p>
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
            <!-- Report Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-blue-100 text-sm font-medium">Total Incidents</h3>
                            <p class="text-3xl font-bold"><?= array_sum($stats['by_severity']) ?></p>
                        </div>
                        <div class="bg-blue-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-red-100 text-sm font-medium">Critical Incidents</h3>
                            <p class="text-3xl font-bold"><?= $stats['by_severity']['Critical'] ?></p>
                        </div>
                        <div class="bg-red-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-fire text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-yellow-100 text-sm font-medium">In Progress</h3>
                            <p class="text-3xl font-bold"><?= $stats['by_status']['In Progress'] ?></p>
                        </div>
                        <div class="bg-yellow-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-cog text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-green-100 text-sm font-medium">Resolved</h3>
                            <p class="text-3xl font-bold"><?= $stats['by_status']['Closed'] ?></p>
                        </div>
                        <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Severity Distribution Chart -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-pie mr-2 text-gray-600"></i>
                            Incidents by Severity
                        </h3>
                    </div>
                    <div class="p-6">
                        <canvas id="severityChart" width="400" height="300"></canvas>
                    </div>
                </div>

                <!-- Status Distribution Chart -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-donut mr-2 text-gray-600"></i>
                            Incidents by Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <canvas id="statusChart" width="400" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detailed Incidents Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list mr-2 text-gray-600"></i>
                        Recent Incidents Details
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Incident</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Severity</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Attack Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($incidents as $incident): ?>
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-medium text-gray-900"><?= esc($incident['title']) ?></div>
                                        <div class="text-sm text-gray-500">#<?= $incident['id'] ?></div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($incident['severity']) {
                                            case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                            case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                            case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($incident['severity']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                        <?php 
                                        switch($incident['status']) {
                                            case 'New': echo 'bg-blue-100 text-blue-800'; break;
                                            case 'In Progress': echo 'bg-yellow-100 text-yellow-800'; break;
                                            case 'Closed': echo 'bg-green-100 text-green-800'; break;
                                            default: echo 'bg-gray-100 text-gray-800'; break;
                                        }
                                        ?>">
                                        <?= esc($incident['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-sm text-gray-900"><?= esc($incident['attack_type']) ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">
                                        <?= date('M j, Y', strtotime($incident['created_at'])) ?>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        <?= date('H:i', strtotime($incident['created_at'])) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/incidents/<?= $incident['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors" 
                                       title="View Incident">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Trend Analysis -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                        Incident Trends (Last 30 Days)
                    </h3>
                </div>
                <div class="p-6">
                    <canvas id="trendChart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart configurations
const chartColors = {
    critical: '#ef4444',
    high: '#f97316',
    medium: '#eab308',
    low: '#3b82f6',
    new: '#3b82f6',
    inProgress: '#eab308',
    closed: '#22c55e'
};

// Severity Distribution Chart
const severityCtx = document.getElementById('severityChart').getContext('2d');
new Chart(severityCtx, {
    type: 'doughnut',
    data: {
        labels: ['Critical', 'High', 'Medium', 'Low'],
        datasets: [{
            data: [
                <?= $stats['by_severity']['Critical'] ?>,
                <?= $stats['by_severity']['High'] ?>,
                <?= $stats['by_severity']['Medium'] ?>,
                <?= $stats['by_severity']['Low'] ?>
            ],
            backgroundColor: [
                chartColors.critical,
                chartColors.high,
                chartColors.medium,
                chartColors.low
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

// Status Distribution Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'pie',
    data: {
        labels: ['New', 'In Progress', 'Closed'],
        datasets: [{
            data: [
                <?= $stats['by_status']['New'] ?>,
                <?= $stats['by_status']['In Progress'] ?>,
                <?= $stats['by_status']['Closed'] ?>
            ],
            backgroundColor: [
                chartColors.new,
                chartColors.inProgress,
                chartColors.closed
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

// Trend Chart (Demo data)
const trendCtx = document.getElementById('trendChart').getContext('2d');
new Chart(trendCtx, {
    type: 'line',
    data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [
            {
                label: 'Critical',
                data: [2, 4, 1, 3],
                borderColor: chartColors.critical,
                backgroundColor: chartColors.critical + '20',
                tension: 0.4
            },
            {
                label: 'High',
                data: [5, 7, 4, 6],
                borderColor: chartColors.high,
                backgroundColor: chartColors.high + '20',
                tension: 0.4
            },
            {
                label: 'Medium',
                data: [8, 12, 9, 11],
                borderColor: chartColors.medium,
                backgroundColor: chartColors.medium + '20',
                tension: 0.4
            },
            {
                label: 'Low',
                data: [3, 5, 2, 4],
                borderColor: chartColors.low,
                backgroundColor: chartColors.low + '20',
                tension: 0.4
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
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Export functions
function exportReport(type) {
    if (type === 'excel') {
        showInfoAlert('Export Report', 'Exporting incident report to Excel format (Demo Mode)');
        // In production: window.location.href = '/reports/incidents/export/excel';
    } else if (type === 'pdf') {
        showInfoAlert('Export Report', 'Exporting incident report to PDF format (Demo Mode)');
        // In production: window.location.href = '/reports/incidents/export/pdf';
    }
}

// Auto-refresh charts every 5 minutes
setInterval(function() {
    console.log('Charts would be refreshed with new data');
}, 300000);
</script>

<?= $this->endSection() ?>