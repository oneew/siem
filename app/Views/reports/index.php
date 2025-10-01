<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 mr-2 sm:mr-3"></i>
                    Laporan & Analitik
                </h1>
                <p class="text-gray-600 mt-1 text-sm">Laporan keamanan dan analitik data yang komprehensif</p>
            </div>
            <div class="flex flex-wrap gap-2 sm:gap-3">
                <a href="/reports/incidentsExcel" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                    <i class="fas fa-file-excel mr-1 sm:mr-2"></i>
                    Ekspor Excel
                </a>
                <a href="/reports/generate" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded-lg flex items-center shadow-md transition-colors text-sm">
                    <i class="fas fa-plus mr-1 sm:mr-2"></i>
                    Buat Laporan
                </a>
            </div>
        </div>
    </div>

    <!-- Analytics Overview -->
    <div class="flex-1 p-2 sm:p-4 md:p-6">
        <div class="max-w-6xl mx-auto">
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-4 sm:mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-blue-100 text-xs sm:text-sm font-medium">Total Laporan</h3>
                            <p class="text-xl sm:text-3xl font-bold"><?= isset($executive_summary['total_incidents']) ? $executive_summary['total_incidents'] : (isset($incidents) ? count($incidents) : 0) ?></p>
                        </div>
                        <div class="bg-blue-400 bg-opacity-30 p-2 sm:p-3 rounded-lg">
                            <i class="fas fa-chart-bar text-lg sm:text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-green-100 text-xs sm:text-sm font-medium">Insiden Terbuka</h3>
                            <p class="text-xl sm:text-3xl font-bold"><?= isset($executive_summary['open_incidents']) ? $executive_summary['open_incidents'] : 0 ?></p>
                        </div>
                        <div class="bg-green-400 bg-opacity-30 p-2 sm:p-3 rounded-lg">
                            <i class="fas fa-exclamation-circle text-lg sm:text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-purple-100 text-xs sm:text-sm font-medium">Peristiwa Kritis</h3>
                            <p class="text-xl sm:text-3xl font-bold"><?= isset($executive_summary['critical_incidents']) ? $executive_summary['critical_incidents'] : (isset($incidents) ? count(array_filter($incidents, fn($i) => $i['severity'] === 'Critical')) : 0) ?></p>
                        </div>
                        <div class="bg-purple-400 bg-opacity-30 p-2 sm:p-3 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-lg sm:text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-orange-100 text-xs sm:text-sm font-medium">Alert Aktif</h3>
                            <p class="text-xl sm:text-3xl font-bold"><?= isset($executive_summary['active_alerts']) ? $executive_summary['active_alerts'] : 0 ?></p>
                        </div>
                        <div class="bg-orange-400 bg-opacity-30 p-2 sm:p-3 rounded-lg">
                            <i class="fas fa-bell text-lg sm:text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Categories -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-6 mb-4 sm:mb-8">
                <!-- Incident Trends -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Tren Insiden (7 Hari Terakhir)</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                    </div>
                    <div class="h-48 sm:h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <canvas id="incidentTrendsChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Severity Distribution -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Distribusi Tingkat Keparahan</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                    </div>
                    <div class="h-48 sm:h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <canvas id="severityChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Additional Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-6 mb-4 sm:mb-8">
                <!-- Status Distribution -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Distribusi Status Insiden</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                    </div>
                    <div class="h-48 sm:h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <canvas id="statusChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Monthly Incidents -->
                <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-3 sm:p-6">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Insiden per Bulan</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </button>
                    </div>
                    <div class="h-48 sm:h-64 bg-gray-50 rounded-lg flex items-center justify-center">
                        <canvas id="monthlyChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Reports Table -->
            <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                    <h2 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-list mr-1.5 sm:mr-2 text-gray-600"></i>
                        Laporan Insiden Keamanan
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Detail Laporan</th>
                                <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tingkat Keparahan</th>
                                <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Dibuat</th>
                                <th class="px-3 py-2 sm:px-6 sm:py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (isset($incidents) && !empty($incidents)): ?>
                                <?php foreach ($incidents as $i): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-3 py-2 sm:px-6 sm:py-4 max-w-[120px] sm:max-w-xs">
                                            <div>
                                                <div class="font-medium text-gray-900 text-sm truncate"><?= esc($i['title']) ?></div>
                                                <div class="text-xs text-gray-500">ID: INC-<?= str_pad($i['id'], 6, '0', STR_PAD_LEFT) ?></div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4">
                                            <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                            <?php
                                            switch ($i['severity']) {
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
                                                <?= esc($i['severity']) ?>
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4">
                                            <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                            <?php
                                            switch ($i['status']) {
                                                case 'Open':
                                                    echo 'bg-red-100 text-red-800';
                                                    break;
                                                case 'In Progress':
                                                    echo 'bg-yellow-100 text-yellow-800';
                                                    break;
                                                case 'Closed':
                                                    echo 'bg-green-100 text-green-800';
                                                    break;
                                                default:
                                                    echo 'bg-gray-100 text-gray-800';
                                                    break;
                                            }
                                            ?>">
                                                <?= esc($i['status']) ?>
                                            </span>
                                        </td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4">
                                            <div class="text-xs sm:text-sm text-gray-900">
                                                <?= date('j M Y', strtotime($i['created_at'])) ?>
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                <?= date('H:i', strtotime($i['created_at'])) ?>
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 sm:px-6 sm:py-4">
                                            <div class="flex space-x-1 sm:space-x-2">
                                                <a href="/incidents/show/<?= $i['id'] ?>"
                                                    class="text-blue-600 hover:text-blue-800 transition-colors p-1"
                                                    title="Lihat Insiden">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (!isset($incidents) || empty($incidents)): ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-8 sm:px-6 sm:py-12 text-center">
                                        <div class="text-gray-400">
                                            <i class="fas fa-chart-line text-3xl sm:text-4xl mb-3"></i>
                                            <p class="text-base sm:text-lg font-medium">Tidak ada laporan tersedia</p>
                                            <p class="text-xs sm:text-sm">Laporan akan muncul di sini saat insiden dibuat</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize charts
    document.addEventListener('DOMContentLoaded', function() {
        // Prepare data for charts
        <?php
        // Severity distribution data
        $severityData = [
            'Critical' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['severity'] === 'Critical')) : 0,
            'High' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['severity'] === 'High')) : 0,
            'Medium' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['severity'] === 'Medium')) : 0,
            'Low' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['severity'] === 'Low')) : 0
        ];

        // Status distribution data
        $statusData = [
            'Open' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['status'] === 'Open')) : 0,
            'In Progress' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['status'] === 'In Progress')) : 0,
            'Closed' => isset($incidents) ? count(array_filter($incidents, fn($i) => $i['status'] === 'Closed')) : 0
        ];

        // Monthly incidents data (last 6 months)
        $monthlyData = [];
        $monthlyLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $monthlyLabels[] = date('M Y', strtotime("-$i months"));
            $monthlyData[] = isset($incidents) ? count(array_filter($incidents, fn($incident) => date('Y-m', strtotime($incident['created_at'])) === $month)) : 0;
        }
        ?>

        // Incident Trends Chart (7 days)
        const trendsCtx = document.getElementById('incidentTrendsChart').getContext('2d');
        <?php if (isset($trend_data)): ?>
            new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: <?= $trend_data['dates'] ?>,
                    datasets: [{
                        label: 'Insiden',
                        data: <?= $trend_data['incidents_trend'] ?>,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Alert',
                        data: <?= $trend_data['alerts_trend'] ?>,
                        borderColor: 'rgb(245, 158, 11)',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        <?php else: ?>
            // Fallback data if trend_data is not available
            new Chart(trendsCtx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [{
                        label: 'Insiden',
                        data: [12, 19, 8, 15, 25, 18, 22],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                }
            });
        <?php endif; ?>

        // Severity Distribution Chart
        const severityCtx = document.getElementById('severityChart').getContext('2d');
        new Chart(severityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Kritis', 'Tinggi', 'Sedang', 'Rendah'],
                datasets: [{
                    data: [<?= $severityData['Critical'] ?>, <?= $severityData['High'] ?>, <?= $severityData['Medium'] ?>, <?= $severityData['Low'] ?>],
                    backgroundColor: [
                        'rgb(239, 68, 68)',
                        'rgb(245, 158, 11)',
                        'rgb(34, 197, 94)',
                        'rgb(59, 130, 246)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Status Distribution Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'bar',
            data: {
                labels: ['Terbuka', 'Dalam Proses', 'Ditutup'],
                datasets: [{
                    label: 'Jumlah Insiden',
                    data: [<?= $statusData['Open'] ?>, <?= $statusData['In Progress'] ?>, <?= $statusData['Closed'] ?>],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(34, 197, 94, 0.7)'
                    ],
                    borderColor: [
                        'rgb(239, 68, 68)',
                        'rgb(245, 158, 11)',
                        'rgb(34, 197, 94)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Monthly Incidents Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: [<?= '"' . implode('","', $monthlyLabels) . '"' ?>],
                datasets: [{
                    label: 'Insiden per Bulan',
                    data: [<?= implode(',', $monthlyData) ?>],
                    borderColor: 'rgb(139, 92, 246)',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>
```