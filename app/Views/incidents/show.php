<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-600 mr-3"></i>
                Incident #<?= esc($incident['id']) ?>
            </h1>
            <p class="text-gray-600 mt-1"><?= esc($incident['title']) ?></p>
        </div>
        <div class="flex space-x-3">
            <a href="/incidents" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Incidents
            </a>
            <a href="/incidents/edit/<?= $incident['id'] ?>" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors shadow-md">
                <i class="fas fa-edit mr-2"></i>
                Edit Incident
            </a>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Incident Overview -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-gray-600"></i>
                    Incident Overview
                </h2>
            </div>
            <div class="p-6">
                <div class="prose max-w-none">
                    <p class="text-gray-700"><?= esc($incident['description'] ?? '') ?></p>
                </div>
            </div>
        </div>

        <!-- Evidence Files -->
        <?php if (!empty($incident['evidence_collected'])): ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-paperclip mr-2 text-gray-600"></i>
                    Evidence Files
                </h2>
            </div>
            <div class="p-6">
                <?php 
                $evidenceFiles = json_decode($incident['evidence_collected'], true);
                if (!empty($evidenceFiles) && is_array($evidenceFiles)): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        <?php foreach ($evidenceFiles as $file): ?>
                            <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                                <?php 
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                ?>
                                <?php if ($isImage): ?>
                                    <img src="<?= base_url('uploads/incidents/' . $file) ?>" 
                                         alt="Evidence" 
                                         class="w-full h-32 object-cover rounded mb-2">
                                <?php else: ?>
                                    <div class="w-full h-32 bg-gray-100 rounded mb-2 flex items-center justify-center">
                                        <i class="fas fa-file-alt text-3xl text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="text-xs text-gray-600 truncate"><?= esc($file) ?></div>
                                <a href="<?= base_url('uploads/incidents/' . $file) ?>" 
                                   target="_blank" 
                                   class="text-blue-600 hover:text-blue-800 text-xs mt-1 inline-block">
                                    View File
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No evidence files available.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Timeline & Comments -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-history mr-2 text-gray-600"></i>
                    Timeline & Comments
                </h2>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                              rows="3" 
                              placeholder="Add a comment or update..."></textarea>
                    <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Post Comment
                    </button>
                </div>
                <div class="space-y-6">
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="text-sm">
                                <span class="font-semibold text-gray-800">Admin</span> changed status to <span class="font-semibold"><?= esc($incident['status'] ?? 'Unknown') ?></span>.
                            </p>
                            <p class="text-xs text-gray-500">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-cogs text-gray-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-800">
                                Incident created automatically from Alert #451.
                            </p>
                            <p class="text-xs text-gray-500">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-tasks mr-2 text-gray-600"></i>
                    Related Tasks
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center py-8">
                    <i class="fas fa-tasks text-3xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">Task management features will be available in future updates.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Incident Details -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-clipboard-list mr-2 text-gray-600"></i>
                    Incident Details
                </h2>
            </div>
            <div class="p-6 text-sm space-y-4">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Severity</span>
                    <span class="font-semibold 
                        <?php 
                        $severity = $incident['severity'] ?? 'Low';
                        switch($severity) {
                            case 'Critical': echo 'text-red-600'; break;
                            case 'High': echo 'text-orange-600'; break;
                            case 'Medium': echo 'text-yellow-600'; break;
                            case 'Low': echo 'text-blue-600'; break;
                            default: echo 'text-gray-600'; break;
                        }
                        ?>">
                        <?= esc($severity) ?>
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Status</span>
                    <span class="font-semibold 
                        <?php 
                        $status = $incident['status'] ?? 'Open';
                        switch($status) {
                            case 'Closed': echo 'text-green-600'; break;
                            case 'In Progress': echo 'text-yellow-600'; break;
                            case 'Open': echo 'text-red-600'; break;
                            default: echo 'text-gray-600'; break;
                        }
                        ?>">
                        <?= esc($status) ?>
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Source IP</span>
                    <span class="font-mono text-gray-800"><?= esc($incident['source_ip'] ?? 'N/A') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Created</span>
                    <span class="text-gray-800"><?= isset($incident['created_at']) ? date('M j, Y H:i', strtotime($incident['created_at'])) : 'N/A' ?></span>
                </div>
                <?php if (!empty($incident['resolved_at'])): ?>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Resolved</span>
                    <span class="text-gray-800"><?= date('M j, Y H:i', strtotime($incident['resolved_at'])) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($incident['resolution_notes'])): ?>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Resolution Notes</span>
                    <span class="text-gray-800"><?= esc($incident['resolution_notes']) ?></span>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Affected Assets -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-server mr-2 text-gray-600"></i>
                    Affected Assets
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center py-4">
                    <i class="fas fa-server text-2xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500 text-sm">No assets linked to this incident.</p>
                </div>
            </div>
        </div>

        <!-- Related Alerts -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-bell mr-2 text-gray-600"></i>
                    Related Alerts
                </h2>
            </div>
            <div class="p-6">
                <div class="text-center py-4">
                    <i class="fas fa-bell-slash text-2xl text-gray-300 mb-2"></i>
                    <p class="text-gray-500 text-sm">No alerts linked to this incident.</p>
                </div>
            </div>
        </div>

        <!-- Suggested Playbook -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-book mr-2 text-gray-600"></i>
                    Suggested Playbook
                </h2>
            </div>
            <div class="p-6">
                <button class="w-full px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center justify-center">
                    <i class="fas fa-book-open mr-2"></i>
                    Run Incident Response Playbook
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>