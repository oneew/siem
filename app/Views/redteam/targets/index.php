<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    </div>
    <button onclick="openFormModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow flex items-center transition">
        <i class="fas fa-bullseye mr-2"></i> Tambah Target
    </button>
</div>

<div class="dashboard-card p-6">
    <div class="overflow-x-auto">
        <table id="targetTable" class="w-full modern-table">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Target</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP / URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lingkungan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kritikalitas</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white text-sm">
                <!-- DataTables AJAX Content -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Target Modal -->
<div id="targetModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg overflow-hidden transform transition-all">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 id="modalTitle" class="font-bold text-lg text-gray-800"><i class="fas fa-bullseye text-red-500 mr-2"></i> Tambah Target Baru</h3>
            <button onclick="closeFormModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="targetForm" onsubmit="saveTarget(event)" class="p-6 space-y-4">
            <input type="hidden" id="target_id" name="id">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Target Aset</label>
                <input type="text" id="target_name" name="target_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">IPv4 / IPv6 / Domain URL</label>
                <input type="text" id="ip_address_or_url" name="ip_address_or_url" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:ring-red-500 focus:border-red-500" required>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Environment</label>
                    <select id="environment" name="environment" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                        <option value="prod">Production</option>
                        <option value="staging">Staging</option>
                        <option value="dev">Development</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level Kritikalitas</label>
                    <select id="criticality_level" name="criticality_level" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low" selected>Low</option>
                    </select>
                </div>
            </div>
            
            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeFormModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">Batal</button>
                <button type="submit" id="saveBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow font-medium text-sm border-0 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let dtTable;

$(document).ready(function() {
    // Initialize DataTables
    dtTable = $('#targetTable').DataTable({
        ajax: {
            url: "/targets/get_all",
            dataSrc: "data"
        },
        columns: [
            { data: "id", className: "font-mono text-gray-500" },
            { data: "target_name", className: "font-medium text-gray-900" },
            { data: "ip_address_or_url", className: "font-mono text-blue-600" },
            { 
                data: "environment",
                render: function(data) {
                    const colors = {
                        'prod': 'bg-red-100 text-red-800',
                        'staging': 'bg-yellow-100 text-yellow-800',
                        'dev': 'bg-green-100 text-green-800'
                    };
                    return `<span class="px-2 py-1 text-xs rounded-full \${colors[data] || 'bg-gray-100'}">\${data.toUpperCase()}</span>`;
                }
            },
            { 
                data: "criticality_level",
                render: function(data) {
                    const colors = {
                        'Critical': 'bg-red-100 text-red-800 font-bold',
                        'High': 'bg-orange-100 text-orange-800 font-medium',
                        'Medium': 'bg-yellow-100 text-yellow-800',
                        'Low': 'bg-green-100 text-green-800'
                    };
                    return `<span class="px-2 py-1 text-xs rounded-full \${colors[data] || 'bg-gray-100'}">\${data}</span>`;
                }
            },
            {
                data: null,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <div class="flex justify-center space-x-2">
                            <button onclick="editTarget(\${row.id})" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-1.5 rounded transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteTarget(\${row.id})" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-1.5 rounded transition" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            emptyTable: "Belum ada data target.",
            search: "Cari Target:"
        },
        dom: '<"flex justify-between items-center mb-4"f>rt<"flex justify-between items-center mt-4"ip>',
        pageLength: 10
    });
});

function openFormModal() {
    document.getElementById('targetForm').reset();
    document.getElementById('target_id').value = '';
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-bullseye text-red-500 mr-2"></i> Tambah Target Baru';
    document.getElementById('targetModal').classList.remove('hidden');
}

function closeFormModal() {
    document.getElementById('targetModal').classList.add('hidden');
}

function editTarget(id) {
    fetch(`/targets/get/\${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('target_id').value = data.data.id;
                document.getElementById('target_name').value = data.data.target_name;
                document.getElementById('ip_address_or_url').value = data.data.ip_address_or_url;
                document.getElementById('environment').value = data.data.environment;
                document.getElementById('criticality_level').value = data.data.criticality_level;
                
                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit text-blue-500 mr-2"></i> Edit Target';
                document.getElementById('targetModal').classList.remove('hidden');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
}

function saveTarget(e) {
    e.preventDefault();
    const saveBtn = document.getElementById('saveBtn');
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
    saveBtn.disabled = true;

    const formData = new FormData(document.getElementById('targetForm'));
    const isEdit = formData.get('id') !== '';
    const url = isEdit ? '/targets/update' : '/targets/store';

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            closeFormModal();
            dtTable.ajax.reload(null, false); // Reload without resetting pagination
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success', 
                title: data.message, showConfirmButton: false, timer: 3000
            });
        } else {
            Swal.fire('Gagal', data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Kesalahan koneksi ke server.', 'error');
    })
    .finally(() => {
        saveBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Data';
        saveBtn.disabled = false;
    });
}

function deleteTarget(id) {
    Swal.fire({
        title: 'Hapus Target ini?',
        text: "Anda tidak akan bisa mengembalikannya!",
        icon: 'warning',
        showCancelButton: true,
        confirmColor: '#d33',
        cancelColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/targets/delete/\${id}`, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    dtTable.ajax.reload(null, false);
                    Swal.fire('Terhapus!', data.message, 'success');
                } else {
                    Swal.fire('Gagal', data.message, 'error');
                }
            });
        }
    })
}
</script>
<?= $this->endSection() ?>
