<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex flex-col lg:flex-row gap-6">

    <div class="lg:w-2/3 w-full">
        <div class="card mb-6">
            <div class="card-content p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-sm font-semibold text-blue-600">Incident #<?= esc($incident['id']) ?></span>
                        <h1 class="text-2xl font-bold text-gray-800 mt-1"><?= esc($incident['title']) ?></h1>
                        <p class="text-gray-500 mt-2"><?= esc($incident['description']) ?></p>
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <a href="/incidents/edit/<?= $incident['id'] ?>" class="btn btn-secondary text-sm">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                        <a href="#" class="tab active" id="tab-timeline" onclick="switchTab('timeline')">
                            <i class="fas fa-history mr-2"></i> Timeline & Comments
                        </a>
                        <a href="#" class="tab" id="tab-tasks" onclick="switchTab('tasks')">
                            <i class="fas fa-check-circle mr-2"></i> Tasks
                        </a>
                        <a href="#" class="tab" id="tab-evidence" onclick="switchTab('evidence')">
                            <i class="fas fa-paperclip mr-2"></i> Evidence
                        </a>
                    </nav>
                </div>
            </div>
            <div class="card-content">
                <div id="content-timeline" class="tab-content">
                    <div class="mb-6">
                        <textarea class="form-input w-full" rows="3" placeholder="Add a comment or update..."></textarea>
                        <button class="btn btn-primary mt-2">Post Comment</button>
                    </div>
                    <div class="space-y-6">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="text-sm">
                                    <span class="font-semibold text-gray-800">Admin</span> changed status to <span class="font-semibold">In Progress</span>.
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
                <div id="content-tasks" class="tab-content hidden">
                    <p>Fitur manajemen tugas akan muncul di sini.</p>
                </div>
                <div id="content-evidence" class="tab-content hidden">
                    <p>Fitur lampiran bukti akan muncul di sini.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:w-1/3 w-full space-y-6">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Details</h3></div>
            <div class="card-content text-sm space-y-3">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Severity</span>
                    <span class="font-semibold text-red-500"><?= esc($incident['severity']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Status</span>
                    <span class="font-semibold text-yellow-500"><?= esc($incident['status']) ?></span>
                </div>
                 <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Source IP</span>
                    <span class="font-mono"><?= esc($incident['source_ip']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Created</span>
                    <span><?= date('M j, Y H:i', strtotime($incident['created_at'])) ?></span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Affected Assets</h3></div>
            <div class="card-content">
                <p class="text-sm text-center text-gray-500">No assets linked.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Related Alerts</h3></div>
            <div class="card-content">
                 <p class="text-sm text-center text-gray-500">No alerts linked.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h3 class="card-title">Suggested Playbook</h3></div>
            <div class="card-content">
                <button class="btn btn-secondary w-full"><i class="fas fa-book mr-2"></i>Run Ransomware Playbook</button>
            </div>
        </div>
    </div>

</div>

<style>
.tab {
    padding: 0.5rem 1rem;
    border-bottom: 2px solid transparent;
    font-weight: 500;
    color: var(--text-secondary);
    transition: all 0.2s;
}
.tab:hover {
    color: var(--primary-color);
}
.tab.active {
    color: var(--primary-color);
    border-bottom-color: var(--primary-color);
}
</style>

<script>
function switchTab(tabName) {
    // Sembunyikan semua konten tab
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    // Hapus kelas aktif dari semua tab
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });

    // Tampilkan konten tab yang dipilih
    document.getElementById('content-' + tabName).classList.remove('hidden');
    // Tambahkan kelas aktif ke tab yang dipilih
    document.getElementById('tab-' + tabName).classList.add('active');
}
</script>

<?= $this->endSection() ?>