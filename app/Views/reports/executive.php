<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex-1 flex flex-col overflow-hidden">
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-chart-line text-purple-600 mr-3"></i>
                    <?= $title ?>
                </h1>
                <p class="text-gray-600 mt-1">High-level security metrics and organizational cybersecurity posture</p>
            </div>
            <div class="flex space-x-3">
                <button onclick="scheduleReport()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-calendar mr-2"></i>
                    Schedule Report
                </button>
                <button onclick="exportExecutive('pdf')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center shadow-md transition-colors">
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
            <!-- Executive Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-red-100 text-sm font-medium">Security Incidents</h3>
                            <p class="text-3xl font-bold"><?= $metrics['security_incidents'] ?></p>
                            <p class="text-red-100 text-xs mt-1">Last 30 days</p>
                        </div>
                        <div class="bg-red-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-orange-100 text-sm font-medium">Critical Alerts</h3>
                            <p class="text-3xl font-bold"><?= $metrics['critical_alerts'] ?></p>
                            <p class="text-orange-100 text-xs mt-1">Active alerts</p>
                        </div>
                        <div class="bg-orange-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-bell text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-green-100 text-sm font-medium">Resolved Issues</h3>
                            <p class="text-3xl font-bold"><?= $metrics['resolved_incidents'] ?></p>
                            <p class="text-green-100 text-xs mt-1">This month</p>
                        </div>
                        <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-blue-100 text-sm font-medium">Response Time</h3>
                            <p class="text-3xl font-bold"><?= $metrics['avg_response_time'] ?></p>
                            <p class="text-blue-100 text-xs mt-1">Average</p>
                        </div>
                        <div class="bg-blue-400 bg-opacity-30 p-3 rounded-lg">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Risk Assessment & Security Posture -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Security Posture Score -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-gray-600"></i>
                            Security Posture Score
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-center mb-6">
                            <div class="relative w-32 h-32">
                                <canvas id="postureScore" width="128" height="128"></canvas>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-green-600">85</div>
                                        <div class="text-xs text-gray-500">Score</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Risk Level:</span>
                                <span class="font-medium text-green-600">Low</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Compliance:</span>
                                <span class="font-medium text-blue-600">92%</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Vulnerabilities:</span>
                                <span class="font-medium text-orange-600">12 Active</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly Trends -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-gray-600"></i>
                            Security Trends (6 Months)
                        </h3>
                    </div>
                    <div class="p-6">
                        <canvas id="trendsChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Key Performance Indicators -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-tachometer-alt mr-2 text-gray-600"></i>
                        Key Performance Indicators
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Mean Time to Detection -->
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-3xl font-bold text-blue-600 mb-2">1.2h</div>
                            <div class="text-sm font-medium text-gray-700">Mean Time to Detection</div>
                            <div class="text-xs text-gray-500 mt-1">↓ 15% from last month</div>
                        </div>

                        <!-- Mean Time to Response -->
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-3xl font-bold text-green-600 mb-2">2.3h</div>
                            <div class="text-sm font-medium text-gray-700">Mean Time to Response</div>
                            <div class="text-xs text-gray-500 mt-1">↓ 8% from last month</div>
                        </div>

                        <!-- Mean Time to Recovery -->
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            <div class="text-3xl font-bold text-yellow-600 mb-2">4.7h</div>
                            <div class="text-sm font-medium text-gray-700">Mean Time to Recovery</div>
                            <div class="text-xs text-gray-500 mt-1">↑ 3% from last month</div>
                        </div>

                        <!-- False Positive Rate -->
                        <div class="text-center p-4 bg-purple-50 rounded-lg">
                            <div class="text-3xl font-bold text-purple-600 mb-2">5.2%</div>
                            <div class="text-sm font-medium text-gray-700">False Positive Rate</div>
                            <div class="text-xs text-gray-500 mt-1">↓ 22% from last month</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Risk Summary & Recommendations -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Top Security Risks -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-exclamation-circle mr-2 text-gray-600"></i>
                            Top Security Risks
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                                    <div>
                                        <div class="font-medium text-gray-900">Unpatched Vulnerabilities</div>
                                        <div class="text-sm text-gray-600">12 critical vulnerabilities</div>
                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded">Critical</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-orange-50 rounded-lg border border-orange-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                                    <div>
                                        <div class="font-medium text-gray-900">Phishing Attempts</div>
                                        <div class="text-sm text-gray-600">Increased by 25% this month</div>
                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 bg-orange-100 text-orange-800 rounded">High</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                                    <div>
                                        <div class="font-medium text-gray-900">Weak Authentication</div>
                                        <div class="text-sm text-gray-600">23 accounts without MFA</div>
                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded">Medium</span>
                            </div>

                            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                    <div>
                                        <div class="font-medium text-gray-900">Network Misconfigurations</div>
                                        <div class="text-sm text-gray-600">5 devices with default passwords</div>
                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded">Medium</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Executive Recommendations -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-lightbulb mr-2 text-gray-600"></i>
                            Strategic Recommendations
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                                <div class="font-medium text-green-900 mb-1">Immediate Action Required</div>
                                <div class="text-sm text-green-800">Deploy security patches for critical vulnerabilities within 48 hours</div>
                                <div class="text-xs text-green-600 mt-2">Priority: Critical</div>
                            </div>

                            <div class="p-4 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                                <div class="font-medium text-blue-900 mb-1">Security Awareness Training</div>
                                <div class="text-sm text-blue-800">Implement quarterly phishing simulation and security training program</div>
                                <div class="text-xs text-blue-600 mt-2">Priority: High</div>
                            </div>

                            <div class="p-4 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                                <div class="font-medium text-purple-900 mb-1">Multi-Factor Authentication</div>
                                <div class="text-sm text-purple-800">Enforce MFA for all user accounts and privileged access</div>
                                <div class="text-xs text-purple-600 mt-2">Priority: High</div>
                            </div>

                            <div class="p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                                <div class="font-medium text-yellow-900 mb-1">Security Investment</div>
                                <div class="text-sm text-yellow-800">Consider additional SIEM tools for enhanced threat detection</div>
                                <div class="text-xs text-yellow-600 mt-2">Priority: Medium</div>
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
// Security Posture Score (Gauge Chart)
const postureCtx = document.getElementById('postureScore').getContext('2d');
const postureChart = new Chart(postureCtx, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [85, 15],
            backgroundColor: ['#22c55e', '#f3f4f6'],
            borderWidth: 0,
            cutout: '80%'
        }]
    },
    options: {
        responsive: false,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                enabled: false
            }
        }
    }
});

// Security Trends Chart
const trendsCtx = document.getElementById('trendsChart').getContext('2d');
new Chart(trendsCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [
            {
                label: 'Security Incidents',
                data: [45, 38, 42, 35, 29, 23],
                borderColor: '#ef4444',
                backgroundColor: '#ef4444' + '20',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Resolved',
                data: [42, 36, 40, 33, 28, 22],
                borderColor: '#22c55e',
                backgroundColor: '#22c55e' + '20',
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
                ticks: {
                    stepSize: 10
                }
            }
        }
    }
});

// Executive functions
function scheduleReport() {
    showInfoAlert('Schedule Report', 'Executive report scheduling configured (Demo Mode)\n\nReports will be automatically generated and sent to executives monthly.');
}

function exportExecutive(type) {
    if (type === 'pdf') {
        showInfoAlert('Export Dashboard', 'Exporting executive dashboard to PDF format (Demo Mode)');
        // In production: window.location.href = '/reports/executive/export/pdf';
    }
}

// Auto-refresh dashboard every 15 minutes
setInterval(function() {
    console.log('Executive dashboard would be refreshed with latest data');
}, 900000);

// Display current timestamp
function updateTimestamp() {
    const now = new Date();
    const timeString = now.toLocaleString();
    console.log('Dashboard last updated:', timeString);
}

updateTimestamp();
setInterval(updateTimestamp, 300000); // Update every 5 minutes
</script>

<?= $this->endSection() ?>