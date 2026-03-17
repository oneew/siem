<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    </div>
    <a href="/incidents-v2/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow">
        <i class="fas fa-plus mr-2"></i> Buat Kasus Baru
    </a>
</div>

<!-- Kanban / Board Style Skeleton -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <!-- OPEN -->
    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-sm min-h-[500px]">
        <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">
            <i class="fas fa-folder-open text-blue-500 mr-2"></i> Terbuka (Open)
            <span class="float-right bg-gray-200 text-xs px-2 py-1 rounded-full">--</span>
        </h3>
        
        <?php foreach($incidents as $inc): ?>
            <?php if($inc['status'] == 'Open'): ?>
            <div class="bg-white p-4 rounded-lg shadow border-l-4 border-blue-500 mb-3 hover:shadow-md transition cursor-pointer">
                <div class="flex justify-between items-start mb-2">
                    <span class="text-xs font-mono text-gray-500">#<?= esc($inc['id']) ?></span>
                    <span class="text-xs px-2 py-1 rounded bg-red-100 text-red-800 font-bold"><?= esc($inc['severity']) ?></span>
                </div>
                <h4 class="font-semibold text-sm mb-1"><?= esc($inc['case_title'] ?? 'Undefined Title') ?></h4>
                <p class="text-xs text-gray-500 line-clamp-2"><?= esc($inc['description']) ?></p>
                <div class="mt-3 text-right">
                    <a href="/incidents-v2/view/<?= $inc['id'] ?>" class="text-xs text-blue-600 hover:underline">Detail</a>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- IN PROGRESS -->
    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-sm min-h-[500px]">
        <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">
            <i class="fas fa-spinner text-yellow-500 mr-2"></i> Sedang Diproses
            <span class="float-right bg-gray-200 text-xs px-2 py-1 rounded-full">--</span>
        </h3>
        <!-- Insert cases here where status = In Progress -->
    </div>

    <!-- CLOSED -->
    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200 shadow-sm min-h-[500px]">
        <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">
            <i class="fas fa-check-circle text-green-500 mr-2"></i> Ditutup (Closed)
            <span class="float-right bg-gray-200 text-xs px-2 py-1 rounded-full">--</span>
        </h3>
        <!-- Insert cases here where status = Closed -->
    </div>

</div>

<?= $this->endSection() ?>
