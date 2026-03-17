<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    </div>
    <button onclick="document.getElementById('playbookModal').classList.remove('hidden')" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Playbook
    </button>
</div>

<!-- Accordion/Card Layout for Copy-Pastable Commands -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <?php if(!empty($playbooks)): ?>
        <?php foreach($playbooks as $p): ?>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
            <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-red-600 uppercase tracking-wider mb-1 block">
                        <?= esc($p['mitre_attack_id'] ?? 'MITRE_ID') ?>
                    </span>
                    <h3 class="text-lg font-bold text-gray-800"><?= esc($p['tactic_name'] ?? 'Undefined Tactic') ?></h3>
                </div>
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-500">
                    <i class="fas fa-book-dead"></i>
                </div>
            </div>
            <div class="p-5">
                <p class="text-sm text-gray-600 mb-4"><?= esc($p['description']) ?></p>
                <div class="bg-gray-900 rounded-lg p-3 relative group">
                    <pre class="text-green-400 font-mono text-xs overflow-x-auto whitespace-pre-wrap"><code><?= esc($p['command_examples'] ?? '') ?></code></pre>
                    <button class="absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white p-1.5 rounded opacity-0 group-hover:opacity-100 transition shadow"
                            onclick="navigator.clipboard.writeText('<?= addslashes($p['command_examples'] ?? '') ?>'); Swal.fire({toast: true, position: 'top-end', icon: 'success', title: 'Perintah disalin!', showConfirmButton: false, timer: 1500});">
                        <i class="fas fa-copy text-xs"></i>
                    </button>
                    <button class="absolute top-2 right-10 bg-red-900 hover:bg-red-800 text-white p-1.5 rounded opacity-0 group-hover:opacity-100 transition shadow"
                            onclick="deletePlaybook(<?= $p['id'] ?>)">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-1 md:col-span-3 text-center py-12 text-gray-500">
            <i class="fas fa-folder-open text-4xl mb-3 text-gray-300 block"></i>
            Tidak ada Playbook Red Team.
        </div>
    <?php endif; ?>

</div>

<!-- Add Playbook Modal -->
<div id="playbookModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-lg text-gray-800"><i class="fas fa-plus-circle text-red-500 mr-2"></i> Tambah Playbook Red Team</h3>
            <button onclick="document.getElementById('playbookModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6">
            <form id="playbookForm" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">MITRE ATT&CK ID</label>
                        <input type="text" name="mitre_attack_id" placeholder="T1059.001" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Taktik / Teknik</label>
                        <input type="text" name="tactic_name" placeholder="PowerShell Execution" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                    <input type="text" name="description" placeholder="Penjelasan singkat mengenai taktik ini..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contoh Perintah (Command Examples)</label>
                    <textarea name="command_examples" rows="4" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono text-green-700 bg-gray-50 focus:ring-red-500 focus:border-red-500" placeholder="powershell -ep bypass -c..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Gunakan baris baru untuk beberapa perintah.</p>
                </div>
                <div class="pt-4 flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('playbookModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow font-medium text-sm border-0 flex items-center">
                        <i class="fas fa-save mr-2"></i> Simpan Playbook
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('playbookForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/playbooks-v2/store', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location.reload();
            });
        } else {
            Swal.fire('Gagal', data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Terjadi kesalahan sistem.', 'error');
    });
});

function deletePlaybook(id) {
    Swal.fire({
        title: 'Hapus Playbook ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmColor: '#d33',
        cancelColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/playbooks-v2/delete/${id}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire('Terhapus!', data.message, 'success')
                    .then(() => window.location.reload());
                } else {
                    Swal.fire('Gagal', data.message, 'error');
                }
            });
        }
    })
}
</script>
<?= $this->endSection() ?>
