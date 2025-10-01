<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Hero Section with Key Metrics -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg text-white p-4 sm:p-6 md:p-8 mb-4 sm:mb-6 relative overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>

        <div class="relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 sm:mb-6">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-2xl sm:text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold">Pusat Operasi Keamanan</h1>
                        <p class="text-blue-200 mt-1 text-sm sm:text-base">Pemantauan real-time & intelijen ancaman</p>
                        <div class="flex flex-wrap items-center space-x-3 sm:space-x-4 text-xs text-blue-200 mt-2">
                            <span><i class="far fa-clock mr-1"></i>Sinkron terakhir: <?= date('H:i:s') ?></span>
                            <span><i class="far fa-calendar-alt mr-1"></i><?= date('j M Y') ?></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <div class="bg-black/20 rounded-lg px-3 py-1 sm:px-4 sm:py-2 text-center">
                        <p class="font-bold text-base sm:text-lg">99.9%</p>
                        <p class="text-xs text-blue-200">Waktu Aktif</p>
                    </div>
                    <div class="bg-black/20 rounded-lg px-3 py-1 sm:px-4 sm:py-2 text-center">
                        <p class="font-bold text-base sm:text-lg text-yellow-300">RENDAH</p>
                        <p class="text-xs text-blue-200">Ancaman</p>
                    </div>
                    <button class="w-8 h-8 sm:w-10 sm:h-10 bg-black/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
            </div>

            <div class="border-t border-white/20 pt-3 sm:pt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center text-sm gap-2">
                <div class="flex flex-wrap gap-3 sm:gap-6">
                    <span><i class="fas fa-desktop mr-1 sm:mr-2"></i><?= $totalIncidents ?> Insiden</span>
                    <span><i class="fas fa-bell mr-1 sm:mr-2"></i><?= $totalAlerts ?> Peringatan</span>
                    <span><i class="fas fa-virus mr-1 sm:mr-2"></i><?= $totalThreats ?> Ancaman</span>
                </div>
                <div>
                    <span class="font-semibold">Skor Keamanan: A+</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-4 sm:mb-6">
        <!-- Incidents Card -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-5 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Total Insiden</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800"><?= $totalIncidents ?></p>
                    <p class="text-xs text-gray-400"><?= $openIncidents ?> terbuka, <?= $criticalIncidents ?> kritis</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-blue-100 rounded-lg text-blue-500 text-lg sm:text-xl">
                    <i class="fas fa-shield-alt"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-blue-600 h-1.5 rounded-full" style="width: <?= $totalIncidents > 0 ? min(100, ($openIncidents / $totalIncidents) * 100) : 0 ?>%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Tingkat insiden terbuka</p>
            </div>
        </div>

        <!-- Alerts Card -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-5 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Peringatan Aktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800"><?= $activeAlerts ?></p>
                    <p class="text-xs text-gray-400"><?= $criticalAlerts ?> kritis</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-orange-100 rounded-lg text-orange-500 text-lg sm:text-xl">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-orange-500 h-1.5 rounded-full" style="width: <?= $totalAlerts > 0 ? min(100, ($activeAlerts / $totalAlerts) * 100) : 0 ?>%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Tingkat peringatan aktif</p>
            </div>
        </div>

        <!-- Threats Card -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-5 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Ancaman Aktif</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800"><?= $activeThreats ?></p>
                    <p class="text-xs text-gray-400"><?= $highSeverityThreats ?> tingkat tinggi</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-red-100 rounded-lg text-red-500 text-lg sm:text-xl">
                    <i class="fas fa-virus"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-red-500 h-1.5 rounded-full" style="width: <?= $totalThreats > 0 ? min(100, ($activeThreats / $totalThreats) * 100) : 0 ?>%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Tingkat ancaman aktif</p>
            </div>
        </div>

        <!-- Resolved Card -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg p-4 sm:p-5 hover:shadow-xl transition-shadow">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Diselesaikan</p>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-800"><?= $closedIncidents ?></p>
                    <p class="text-xs text-green-500 font-semibold">+<?= $resolutionRate ?>% tingkat penyelesaian</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center bg-green-100 rounded-lg text-green-500 text-lg sm:text-xl">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="mt-3">
                <div class="w-full bg-gray-200 rounded-full h-1.5">
                    <div class="bg-green-500 h-1.5 rounded-full" style="width: <?= $resolutionRate ?>%"></div>
                </div>
                <p class="text-xs text-gray-500 mt-1">Tingkat penyelesaian</p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
        <!-- Recent Incidents -->
        <div class="lg:col-span-2 bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-1.5 sm:mr-2 text-gray-600"></i>
                    Insiden Terbaru
                </h3>
                <a href="/incidents" class="text-blue-600 hover:text-blue-800 text-xs sm:text-sm">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs sm:text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Insiden</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Tingkat Keparahan</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Status</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($latestIncidents)): ?>
                            <?php foreach ($latestIncidents as $incident): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-3 sm:px-6 py-2 sm:py-4 font-medium text-gray-900 max-w-[120px] sm:max-w-xs truncate" title="<?= esc($incident['title']) ?>">
                                        <?= esc($incident['title']) ?>
                                    </th>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                                        <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                        <?php
                                        switch ($incident['severity']) {
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
                                            <?= esc($incident['severity']) ?>
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                                        <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                        <?php
                                        switch ($incident['status']) {
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
                                            <?= esc($incident['status']) ?>
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                        <?= date('j M, H:i', strtotime($incident['created_at'])) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                                    <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                                    <p>Belum ada insiden yang tercatat</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Severity Distribution -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-chart-pie mr-1.5 sm:mr-2 text-gray-600"></i>
                    Tingkat Keparahan Insiden
                </h3>
            </div>
            <div class="p-3 sm:p-6">
                <canvas id="severityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Secondary Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mt-4 sm:mt-6">
        <!-- Recent Alerts -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bell mr-1.5 sm:mr-2 text-gray-600"></i>
                    Peringatan Terbaru
                </h3>
                <a href="/alerts" class="text-blue-600 hover:text-blue-800 text-xs sm:text-sm">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs sm:text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Peringatan</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Prioritas</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($latestAlerts)): ?>
                            <?php foreach ($latestAlerts as $alert): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-3 sm:px-6 py-2 sm:py-4 font-medium text-gray-900 max-w-[100px] sm:max-w-xs truncate" title="<?= esc($alert['alert_name']) ?>">
                                        <?= esc($alert['alert_name']) ?>
                                    </th>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                                        <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
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
                                    </td>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                                        <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                        <?php
                                        switch ($alert['status']) {
                                            case 'Active':
                                                echo 'bg-red-100 text-red-800';
                                                break;
                                            case 'Investigating':
                                                echo 'bg-yellow-100 text-yellow-800';
                                                break;
                                            case 'Closed':
                                                echo 'bg-green-100 text-green-800';
                                                break;
                                            case 'False Positive':
                                                echo 'bg-gray-100 text-gray-800';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800';
                                                break;
                                        }
                                        ?>">
                                            <?= esc($alert['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                    <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                                    <p>Belum ada peringatan yang tercatat</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Alert Priority Distribution -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-chart-bar mr-1.5 sm:mr-2 text-gray-600"></i>
                    Prioritas Peringatan
                </h3>
            </div>
            <div class="p-3 sm:p-6">
                <canvas id="priorityChart"></canvas>
            </div>
        </div>

        <!-- Threat Severity Distribution -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-biohazard mr-1.5 sm:mr-2 text-gray-600"></i>
                    Tingkat Keparahan Ancaman
                </h3>
            </div>
            <div class="p-3 sm:p-6">
                <canvas id="threatSeverityChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Tertiary Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 mt-4 sm:mt-6">
        <!-- Recent Threats -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-skull-crossbones mr-1.5 sm:mr-2 text-gray-600"></i>
                    Ancaman Terbaru
                </h3>
                <a href="/threats" class="text-blue-600 hover:text-blue-800 text-xs sm:text-sm">
                    Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs sm:text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Ancaman</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Tipe</th>
                            <th scope="col" class="px-3 sm:px-6 py-2 sm:py-3">Tingkat Keparahan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($latestThreats)): ?>
                            <?php foreach ($latestThreats as $threat): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-3 sm:px-6 py-2 sm:py-4 font-medium text-gray-900 max-w-[100px] sm:max-w-xs truncate" title="<?= esc($threat['ioc_value']) ?>">
                                        <?= esc($threat['ioc_value']) ?>
                                    </th>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                                        <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            <?= esc($threat['ioc_type']) ?>
                                        </span>
                                    </td>
                                    <td class="px-3 sm:px-6 py-2 sm:py-4">
                                        <span class="inline-flex px-1.5 py-0.5 sm:px-2 sm:py-1 text-xs font-medium rounded-full
                                        <?php
                                        switch ($threat['severity']) {
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
                                            <?= esc($threat['severity']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                    <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                                    <p>Belum ada ancaman yang tercatat</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Top Source IPs -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-network-wired mr-1.5 sm:mr-2 text-gray-600"></i>
                    IP Sumber Teratas
                </h3>
            </div>
            <div class="p-3 sm:p-6">
                <?php if (!empty($topIncidentIPs)): ?>
                    <div class="space-y-3">
                        <?php foreach ($topIncidentIPs as $ip): ?>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700"><?= esc($ip['source_ip']) ?></span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?= $ip['count'] ?> insiden
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: <?= ($ip['count'] / max(array_column($topIncidentIPs, 'count')) * 100) ?>%"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6 text-gray-500">
                        <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                        <p>Belum ada IP sumber yang tercatat</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Top Threat Types -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-virus mr-1.5 sm:mr-2 text-gray-600"></i>
                    Tipe Ancaman Teratas
                </h3>
            </div>
            <div class="p-3 sm:p-6">
                <?php if (!empty($topThreatTypes)): ?>
                    <div class="space-y-3">
                        <?php foreach ($topThreatTypes as $threat): ?>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700"><?= esc($threat['threat_type']) ?></span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <?= $threat['count'] ?> ancaman
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-600 h-2 rounded-full" style="width: <?= ($threat['count'] / max(array_column($topThreatTypes, 'count')) * 100) ?>%"></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-6 text-gray-500">
                        <i class="fas fa-info-circle text-gray-400 text-xl mb-2"></i>
                        <p>Belum ada tipe ancaman yang tercatat</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Incident Severity Distribution Chart
        const severityCtx = document.getElementById('severityChart').getContext('2d');
        new Chart(severityCtx, {
            type: 'doughnut',
            data: {
                labels: <?= $severityLabels ?>,
                datasets: [{
                    label: 'Insiden berdasarkan Tingkat Keparahan',
                    data: <?= $severityCounts ?>,
                    backgroundColor: [
                        '#60a5fa', // Rendah
                        '#facc15', // Sedang
                        '#f97316', // Tinggi
                        '#ef4444' // Kritis
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

        // Alert Priority Distribution Chart
        const priorityCtx = document.getElementById('priorityChart').getContext('2d');
        new Chart(priorityCtx, {
            type: 'bar',
            data: {
                labels: <?= $priorityLabels ?>,
                datasets: [{
                    label: 'Peringatan berdasarkan Prioritas',
                    data: <?= $priorityCounts ?>,
                    backgroundColor: [
                        '#60a5fa', // Rendah
                        '#facc15', // Sedang
                        '#f97316', // Tinggi
                        '#ef4444' // Kritis
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Threat Severity Distribution Chart
        const threatSeverityCtx = document.getElementById('threatSeverityChart').getContext('2d');
        new Chart(threatSeverityCtx, {
            type: 'pie',
            data: {
                labels: <?= $threatSeverityLabels ?>,
                datasets: [{
                    label: 'Ancaman berdasarkan Tingkat Keparahan',
                    data: <?= $threatSeverityCounts ?>,
                    backgroundColor: [
                        '#60a5fa', // Rendah
                        '#facc15', // Sedang
                        '#f97316', // Tinggi
                        '#ef4444' // Kritis
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