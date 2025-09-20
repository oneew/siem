<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Header Section -->
    <div class="bg-white shadow-sm border-b border-gray-200 p-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-book text-green-600 mr-3"></i>
                    Incident Playbooks
                </h1>
                <p class="text-gray-600 mt-1">Automated and manual response procedures for security incidents</p>
            </div>
            <div class="flex space-x-3">
                <a href="/playbooks/create" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Create Playbook
                </a>
                <a href="/playbooks/import" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                    <i class="fas fa-upload mr-2"></i>
                    Import
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-green-100 text-sm font-medium">Total Playbooks</h3>
                        <p class="text-3xl font-bold"><?= $stats['total_playbooks'] ?></p>
                    </div>
                    <div class="bg-green-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-blue-100 text-sm font-medium">Active Playbooks</h3>
                        <p class="text-3xl font-bold"><?= $stats['active_playbooks'] ?></p>
                    </div>
                    <div class="bg-blue-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-play-circle text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-purple-100 text-sm font-medium">Automated</h3>
                        <p class="text-3xl font-bold"><?= $stats['automated_playbooks'] ?></p>
                    </div>
                    <div class="bg-purple-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-robot text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-orange-100 text-sm font-medium">Manual</h3>
                        <p class="text-3xl font-bold"><?= $stats['manual_playbooks'] ?></p>
                    </div>
                    <div class="bg-orange-400 bg-opacity-30 p-3 rounded-lg">
                        <i class="fas fa-user text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Playbooks Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-list mr-2 text-gray-600"></i>
                    Response Playbooks
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Playbook Details</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Severity</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Usage</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($playbooks as $playbook): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="font-medium text-gray-900"><?= esc($playbook['name']) ?></div>
                                    <div class="text-sm text-gray-500"><?= esc(substr($playbook['description'], 0, 80)) ?>...</div>
                                    <div class="text-xs text-gray-400">Est. Time: <?= esc($playbook['estimated_time']) ?: 'N/A' ?></div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($playbook['type']) {
                                        case 'Automated': echo 'bg-purple-100 text-purple-800'; break;
                                        case 'Manual': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Semi-Automated': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <i class="fas <?= $playbook['type'] === 'Automated' ? 'fa-robot' : ($playbook['type'] === 'Manual' ? 'fa-user' : 'fa-cogs') ?> text-xs mr-1"></i>
                                    <?= esc($playbook['type']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-900"><?= esc($playbook['category']) ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($playbook['severity_level']) {
                                        case 'Critical': echo 'bg-red-100 text-red-800'; break;
                                        case 'High': echo 'bg-orange-100 text-orange-800'; break;
                                        case 'Medium': echo 'bg-yellow-100 text-yellow-800'; break;
                                        case 'Low': echo 'bg-blue-100 text-blue-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    <?= esc($playbook['severity_level']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                    <?php 
                                    switch($playbook['status']) {
                                        case 'Active': echo 'bg-green-100 text-green-800'; break;
                                        case 'Inactive': echo 'bg-red-100 text-red-800'; break;
                                        case 'Draft': echo 'bg-gray-100 text-gray-800'; break;
                                        default: echo 'bg-gray-100 text-gray-800'; break;
                                    }
                                    ?>">
                                    <i class="fas fa-circle text-xs mr-1"></i>
                                    <?= esc($playbook['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    <?= $playbook['execution_count'] ?? 0 ?> executions
                                </div>
                                <div class="text-xs text-gray-500">
                                    <?= $playbook['success_rate'] ?? 0 ?>% success rate
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="/playbooks/<?= $playbook['id'] ?>" 
                                       class="text-blue-600 hover:text-blue-800 transition-colors" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="/playbooks/<?= $playbook['id'] ?>/execute" 
                                       class="text-green-600 hover:text-green-800 transition-colors" 
                                       title="Execute Playbook">
                                        <i class="fas fa-play"></i>
                                    </a>
                                    <a href="/playbooks/<?= $playbook['id'] ?>/edit" 
                                       class="text-yellow-600 hover:text-yellow-800 transition-colors" 
                                       title="Edit Playbook">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="if(confirm('Are you sure you want to delete this playbook?')) { 
                                                window.location.href='/playbooks/delete/<?= $playbook['id'] ?>' 
                                            }"
                                            class="text-red-600 hover:text-red-800 transition-colors" 
                                            title="Delete Playbook">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($playbooks)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-book text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">No playbooks found</p>
                                    <p class="text-sm">Start by creating your first incident response playbook</p>
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
// Auto-refresh playbook status every 60 seconds
setInterval(function() {
    // In a real implementation, this would update playbook status via AJAX
    console.log('Playbook status refresh triggered');
}, 60000);
</script>

<?= $this->endSection() ?>