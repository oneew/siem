<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                    Incident Management
                </h1>
                <p class="text-gray-600 mt-1">Monitor, manage and resolve security incidents</p>
            </div>
            <div class="flex space-x-3">
                <a href="/incidents/create" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Create Incident
                </a>
                <a href="/reports/incidentsExcel?start=<?= esc($_GET['start'] ?? '') ?>&end=<?= esc($_GET['end'] ?? '') ?>" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-file-excel mr-2"></i>
                    Export Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-gray-50 p-6 border-b border-gray-200">
        <form method="get" action="/incidents" class="flex flex-wrap items-center gap-4">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">From:</label>
                <input type="date" name="start" value="<?= esc($_GET['start'] ?? '') ?>" class="form-input border-gray-300 rounded-lg shadow-sm">
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700">To:</label>
                <input type="date" name="end" value="<?= esc($_GET['end'] ?? '') ?>" class="form-input border-gray-300 rounded-lg shadow-sm">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <i class="fas fa-filter mr-2"></i>
                Filter
            </button>
            <a href="/incidents" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <i class="fas fa-refresh mr-2"></i>
                Reset
            </a>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-red-100 text-sm font-medium">Total Incidents</h3>
                        <p class="text-3xl font-bold"><?= count($incidents) ?></p>
                    </div>
                    <div class="bg-red-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-orange-100 text-sm font-medium">Open Incidents</h3>
                        <p class="text-3xl font-bold"><?= count(array_filter($incidents, fn($i) => $i['status'] === 'Open')) ?></p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-yellow-100 text-sm font-medium">In Progress</h3>
                        <p class="text-3xl font-bold"><?= count(array_filter($incidents, fn($i) => $i['status'] === 'In Progress')) ?></p>
                    </div>
                    <div class="bg-yellow-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-tasks text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-green-100 text-sm font-medium">Resolved</h3>
                        <p class="text-3xl font-bold"><?= count(array_filter($incidents, fn($i) => $i['status'] === 'Closed')) ?></p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Incidents Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-gray-600"></i>
                    Security Incidents
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Incident Details</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Source IP</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Severity</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach($incidents as $i): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-medium text-gray-900"><?= esc($i['title']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc(substr($i['description'] ?? '', 0, 60)) ?>...</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-sm text-gray-900"><?= esc($i['source_ip']) ?: 'N/A' ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($i['severity']) {
                                        case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                        case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    <?= esc($i['severity']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($i['status']) {
                                        case 'Open': echo 'bg-red-100 text-red-800'; break;
                                        case 'In Progress': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Closed': echo 'bg-green-100 text-green-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    <?= esc($i['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <?= date('M j, Y', strtotime($i['created_at'])) ?>
                                </div>
                                <div class="text-xs text-gray-500">
                                    <?= date('H:i', strtotime($i['created_at'])) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="/incidents/show/<?= $i['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/incidents/edit/<?= $i['id'] ?>" 
                                       class="text-yellow-600 hover:text-yellow-800 transition-colors" 
                                       title="Edit Incident">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="if(confirm('Are you sure you want to delete this incident?')) { 
                                                window.location.href='/incidents/delete/<?= $i['id'] ?>' 
                                            }"
                                            class="text-red-600 hover:text-red-800 transition-colors" 
                                            title="Delete Incident">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($incidents)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">No incidents found</p>
                                    <p class="text-sm">Start by creating your first security incident</p>
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

<script>
// Auto-refresh incident status every 30 seconds
setInterval(function() {
    // In a real implementation, this would update incident status via AJAX
    console.log('Incident status refresh triggered');
}, 30000);
</script>

<?= $this->endSection() ?>
