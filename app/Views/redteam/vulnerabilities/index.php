<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    </div>
    <button onclick="openFormModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 shadow flex items-center transition">
        <i class="fas fa-spider mr-2"></i> Input Temuan Baru
    </button>
</div>

<div class="dashboard-card p-6">
    <div class="overflow-x-auto">
        <table id="vulnTable" class="w-full modern-table">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kerentanan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CVSS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Severity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white text-sm">
                <!-- DataTables AJAX Content -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Vulnerability Modal -->
<div id="vulnModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 id="modalTitle" class="font-bold text-lg text-gray-800"><i class="fas fa-spider text-red-500 mr-2"></i> Tambah Kerentanan Baru</h3>
            <button onclick="closeFormModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="vulnForm" onsubmit="saveVuln(event)" class="p-6 space-y-4">
            <input type="hidden" id="vuln_id" name="id">
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Target Aset <span class="text-red-500">*</span></label>
                    <select id="target_id" name="target_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" required>
                        <option value="">-- Pilih Target --</option>
                        <?php foreach($targets as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= esc($t['target_name']) ?> (<?= esc($t['ip_address_or_url']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kerentanan <span class="text-red-500">*</span></label>
                    <input type="text" id="vuln_name" name="vuln_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" placeholder="e.g. SQL Injection in Login Form" required>
                </div>
            </div>
            
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CVSS Score</label>
                    <input type="number" step="0.1" max="10" min="0" id="cvss_score" name="cvss_score" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500" value="0.0">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat Keparahan</label>
                    <select id="severity" name="severity" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low" selected>Low</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Remediasi</label>
                    <select id="status" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500">
                        <option value="Open" selected>Open</option>
                        <option value="Mitigated">Mitigated</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi & PoC (Proof of Concept)</label>
                <textarea id="poc_description" name="poc_description" rows="5" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-red-500 focus:border-red-500 font-mono text-gray-600 bg-gray-50 text-xs" placeholder="Payload: ' OR 1=1 --\nSteps to reproduce:..."></textarea>
            </div>
            
            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeFormModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">Batal</button>
                <button type="submit" id="saveBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow font-medium text-sm border-0 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan Temuan
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
    dtTable = $('#vulnTable').DataTable({
        ajax: {
            url: "/vulnerabilities/get_all",
            dataSrc: "data"
        },
        columns: [
            { data: "id", className: "font-mono text-gray-500 text-xs" },
            { data: "target_name", className: "font-medium text-blue-700 hover:underline cursor-pointer" },
            { data: "vuln_name", className: "font-semibold text-gray-800" },
            { 
                data: "cvss_score", 
                className: "text-center font-mono",
                render: function(data) {
                    return `<span class="bg-gray-100 px-2 py-1 rounded text-xs border border-gray-200">\${data}</span>`;
                }
            },
            { 
                data: "severity",
                render: function(data) {
                    const badges = {
                        'Critical': 'bg-red-100 text-red-800 border-red-200',
                        'High': 'bg-orange-100 text-orange-800 border-orange-200',
                        'Medium': 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'Low': 'bg-green-100 text-green-800 border-green-200'
                    };
                    return `<span class="px-2.5 py-1 text-xs rounded-md border font-bold \${badges[data] || 'bg-gray-100'}">\${data}</span>`;
                }
            },
            { 
                data: "status",
                render: function(data) {
                    const statusColors = {
                        'Open': 'bg-red-50 text-red-600',
                        'Mitigated': 'bg-indigo-50 text-indigo-600',
                        'Closed': 'bg-green-50 text-green-600'
                    };
                    return `<span class="px-2 py-1 text-xs rounded-full \${statusColors[data] || 'bg-gray-100'}"><i class="fas fa-circle text-[8px] mr-1"></i>\${data}</span>`;
                }
            },
            {
                data: null,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <div class="flex justify-center space-x-1">
                            <button onclick="editVuln(\${row.id})" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteVuln(\${row.id})" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-1.5 rounded transition" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            emptyTable: "Belum ada temuan kerentanan dicatat.",
            search: "Filter:"
        },
        dom: '<"flex justify-between items-center mb-4"f>rt<"flex justify-between items-center mt-4"ip>',
        pageLength: 10
    });
});

function openFormModal() {
    document.getElementById('vulnForm').reset();
    document.getElementById('vuln_id').value = '';
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-spider text-red-500 mr-2"></i> Tambah Kerentanan Baru';
    document.getElementById('vulnModal').classList.remove('hidden');
}

function closeFormModal() {
    document.getElementById('vulnModal').classList.add('hidden');
}

function editVuln(id) {
    fetch(`/vulnerabilities/get/\${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const v = data.data;
                document.getElementById('vuln_id').value = v.id;
                document.getElementById('target_id').value = v.target_id;
                document.getElementById('vuln_name').value = v.vuln_name;
                document.getElementById('cvss_score').value = v.cvss_score;
                document.getElementById('severity').value = v.severity;
                document.getElementById('status').value = v.status;
                document.getElementById('poc_description').value = v.poc_description;
                
                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit text-indigo-500 mr-2"></i> Perbarui Kerentanan';
                document.getElementById('vulnModal').classList.remove('hidden');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
}

function saveVuln(e) {
    e.preventDefault();
    const saveBtn = document.getElementById('saveBtn');
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
    saveBtn.disabled = true;

    const formData = new FormData(document.getElementById('vulnForm'));
    const isEdit = formData.get('id') !== '';
    const url = isEdit ? '/vulnerabilities/update' : '/vulnerabilities/store';

    fetch(url, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            closeFormModal();
            dtTable.ajax.reload(null, false);
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
        saveBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan Temuan';
        saveBtn.disabled = false;
    });
}

function deleteVuln(id) {
    Swal.fire({
        title: 'Hapus kerentanan ini?',
        text: "Data yang dihapus akan hilang secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmColor: '#d33',
        cancelColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/vulnerabilities/delete/\${id}`, {
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
