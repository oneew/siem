<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
    <div class="flex space-x-2">
        <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left"></i> Kembali ke Playbook
        </a>
        <a href="<?= base_url('/playbooks/show/' . $playbook['id']) ?>" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-eye"></i> Lihat Detail
        </a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2"><?= esc($playbook['name']) ?></h2>
            <p class="text-gray-600 mb-4"><?= esc($playbook['description']) ?></p>
            
            <div class="space-y-3">
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Kategori:</span>
                    <span class="text-gray-900"><?= esc($playbook['category']) ?></span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Tipe:</span>
                    <span class="px-2 py-1 rounded text-sm font-medium 
                        <?= $playbook['type'] == 'Automated' ? 'bg-green-100 text-green-800' : 
                           ($playbook['type'] == 'Manual' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') ?>">
                        <?= $playbook['type'] === 'Automated' ? 'Otomatis' : ($playbook['type'] === 'Manual' ? 'Manual' : 'Semi-Otomatis') ?>
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-700 w-32">Keparahan:</span>
                    <span class="px-2 py-1 rounded text-sm font-medium 
                        <?= $playbook['severity_level'] == 'Critical' ? 'bg-red-100 text-red-800' : 
                           ($playbook['severity_level'] == 'High' ? 'bg-orange-100 text-orange-800' : 
                           ($playbook['severity_level'] == 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')) ?>">
                        <?= $playbook['severity_level'] === 'Critical' ? 'Kritis' : ($playbook['severity_level'] === 'High' ? 'Tinggi' : ($playbook['severity_level'] === 'Medium' ? 'Sedang' : ($playbook['severity_level'] === 'Low' ? 'Rendah' : esc($playbook['severity_level'])))) ?>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="space-y-3">
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Perkiraan Waktu:</span>
                <span class="text-gray-900"><?= esc($playbook['estimated_time']) ?></span>
            </div>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Dibuat Oleh:</span>
                <span class="text-gray-900"><?= esc($playbook['created_by'] ?? 'System') ?></span>
            </div>
            <div class="flex items-center">
                <span class="font-medium text-gray-700 w-32">Dibuat Pada:</span>
                <span class="text-gray-900"><?= date('M j, Y H:i', strtotime($playbook['created_at'])) ?></span>
            </div>
        </div>
    </div>
    
    <div class="border-t border-gray-200 pt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Kondisi Pemicu</h3>
        <p class="text-gray-700"><?= esc($playbook['trigger_conditions']) ?></p>
    </div>
    
    <div class="border-t border-gray-200 pt-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Alat yang Diperlukan</h3>
        <p class="text-gray-700"><?= esc($playbook['required_tools']) ?></p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Langkah-langkah Eksekusi</h3>
    
    <?php if (!empty($playbook['steps'])): ?>
        <?php 
        $steps = json_decode($playbook['steps'], true);
        if (is_array($steps)): 
        ?>
            <div class="space-y-4">
                <?php foreach ($steps as $index => $step): ?>
                    <div class="flex items-start border border-gray-200 rounded-lg p-4">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold mr-3 mt-1">
                            <?= $index + 1 ?>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900"><?= esc($step['action'] ?? '') ?></h4>
                            <?php if (!empty($step['estimated_time'])): ?>
                                <p class="text-sm text-gray-600 mt-1">Perkiraan waktu: <?= esc($step['estimated_time']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="flex-shrink-0 ml-4">
                            <input type="checkbox" id="step_<?= $index ?>" class="h-5 w-5 text-blue-600 rounded">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-700"><?= esc($playbook['steps']) ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p class="text-gray-500 italic">Tidak ada langkah yang didefinisikan untuk playbook ini.</p>
    <?php endif; ?>
    
    <div class="mt-6 flex justify-between items-center">
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" id="confirm_execution" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <span class="ml-2 text-sm text-gray-600">Saya konfirmasi bahwa saya telah meninjau semua langkah dan siap untuk menjalankan playbook ini</span>
            </label>
        </div>
        <button id="execute_btn" disabled class="bg-green-500 text-white font-bold py-2 px-4 rounded opacity-50 cursor-not-allowed">
            <i class="fas fa-play"></i> Jalankan Playbook
        </button>
    </div>
</div>

<script>
document.getElementById('confirm_execution').addEventListener('change', function() {
    const executeBtn = document.getElementById('execute_btn');
    if (this.checked) {
        executeBtn.disabled = false;
        executeBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        executeBtn.classList.add('hover:bg-green-700');
    } else {
        executeBtn.disabled = true;
        executeBtn.classList.add('opacity-50', 'cursor-not-allowed');
        executeBtn.classList.remove('hover:bg-green-700');
    }
});

document.getElementById('execute_btn').addEventListener('click', function() {
    showConfirmAlert('Jalankan Playbook', 'Apakah Anda yakin ingin menjalankan playbook ini?', () => {
        // In a real implementation, this would trigger the actual playbook execution
        showInfoAlert('Eksekusi Playbook', 'Eksekusi playbook dimulai. Dalam implementasi nyata, ini akan memicu langkah-langkah otomatis.');
        
        // Update execution count and last executed time
        fetch(`<?= base_url('/playbooks/execute/' . $playbook['id']) ?>`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '<?= base_url('/playbooks/show/' . $playbook['id']) ?>';
            } else {
                showErrorAlert('Error', 'Error menjalankan playbook: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorAlert('Error', 'Terjadi kesalahan saat menjalankan playbook.');
        });
    });
});
</script>

<?= $this->endSection() ?>