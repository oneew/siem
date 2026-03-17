<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
        <p class="text-sm text-gray-500 mt-1">Sistem manajemen barang bukti digital dengan jaminan integritas hash SHA-256 otomatis.</p>
    </div>
    <button onclick="openFormModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 shadow flex items-center transition">
        <i class="fas fa-lock mr-2"></i> Input Barang Bukti Baru
    </button>
</div>

<div class="dashboard-card p-6 border-t-4 border-indigo-600">
    <div class="overflow-x-auto">
        <table id="evidenceTable" class="w-full modern-table">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Case ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang Bukti</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SHA-256 Checksum (Immutable)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Akuisisi</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white text-sm">
                <!-- DataTables AJAX Content -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Evidence Modal -->
<div id="evidenceModal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl overflow-hidden transform transition-all">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 id="modalTitle" class="font-bold text-lg text-gray-800"><i class="fas fa-lock text-indigo-500 mr-2"></i> Kunci Bukti ke Vault</h3>
            <button onclick="closeFormModal()" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <form id="evidenceForm" onsubmit="saveEvidence(event)" class="p-6 space-y-4" enctype="multipart/form-data">
            <input type="hidden" id="evidence_id" name="id">
            
            <div class="bg-indigo-50 border border-indigo-100 p-3 rounded-lg mb-4 text-sm text-indigo-800 flex items-start">
                <i class="fas fa-info-circle mt-0.5 mr-2"></i>
                <p>Hash SHA-256 akan digenerasi otomatis oleh server pada saat upload untuk memastikan integritas (Chain of Custody). Anda tidak dapat mengubah hash setelah data tersimpan.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">ID Kasus (Case ID) <span class="text-red-500">*</span></label>
                    <input type="text" id="case_id" name="case_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="DFIR-2026-X01" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal & Waktu Akuisisi <span class="text-red-500">*</span></label>
                    <input type="datetime-local" id="acquired_date" name="acquired_date" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama / Deskripsi Bukti <span class="text-red-500">*</span></label>
                <input type="text" id="evidence_name" name="evidence_name" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="e.g. Memory Dump Server Prod DB" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Petugas (Uploader) <span class="text-red-500">*</span></label>
                <input type="text" id="uploaded_by" name="uploaded_by" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" value="John Doe (Forensic Analyst)" required>
            </div>

            <div id="fileUploadContainer">
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload File Arsip Bukti <span class="text-red-500">*</span></label>
                <input type="file" id="evidence_file" name="evidence_file" class="w-full border border-gray-300 text-sm p-1 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
            </div>

            <div id="hashDisplaySection" class="hidden opacity-50">
                <label class="block text-sm font-medium text-gray-700 mb-1">SHA-256 Hash <i class="fas fa-lock text-xs ml-1"></i></label>
                <input type="text" id="file_hash_sha256" readonly class="w-full border border-gray-200 bg-gray-100 rounded-lg px-3 py-2 text-xs font-mono text-gray-500 cursor-not-allowed">
            </div>
            
            <div class="pt-4 flex justify-end space-x-3">
                <button type="button" onclick="closeFormModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-sm">Batal</button>
                <button type="submit" id="saveBtn" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow font-medium text-sm border-0 flex items-center">
                    <i class="fas fa-save mr-2"></i> Simpan ke Vault
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
    dtTable = $('#evidenceTable').DataTable({
        ajax: {
            url: "/evidence-locker/get_all",
            dataSrc: "data"
        },
        columns: [
            { data: "id", className: "font-mono text-gray-500 text-xs" },
            { 
                data: "case_id", 
                className: "font-bold text-gray-800",
                render: function(data) {
                    return `<span class="bg-gray-100 px-2 py-1 rounded border border-gray-200">\${data}</span>`;
                }
            },
            { data: "evidence_name", className: "font-medium text-gray-700" },
            { 
                data: "file_hash_sha256", 
                className: "font-mono text-[10px] text-green-700 cursor-pointer hover:font-bold",
                render: function(data) {
                    return `
                        <div class="flex items-center space-x-2" onclick="navigator.clipboard.writeText('\${data}'); Swal.fire({toast:true, position:'top-end', icon:'success', title:'Hash disalin!', showConfirmButton:false, timer:1500})">
                            <i class="fas fa-shield-alt text-green-500"></i>
                            <span class="truncate w-48 block">\${data}</span>
                            <i class="fas fa-copy text-gray-400"></i>
                        </div>
                    `;
                }
            },
            { data: "acquired_date", className: "text-xs text-gray-600" },
            {
                data: null,
                className: "text-center",
                render: function(data, type, row) {
                    return `
                        <div class="flex justify-center space-x-1">
                            <button onclick="editEvidence(\${row.id})" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded transition" title="Edit Meta">
                                <i class="fas fa-edit"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        language: {
            emptyTable: "Belum ada barang bukti tercatat dalam Vault.",
            search: "Cari Bukti:"
        },
        dom: '<"flex justify-between items-center mb-4"f>rt<"flex justify-between items-center mt-4"ip>',
        pageLength: 10
    });
});

function openFormModal() {
    document.getElementById('evidenceForm').reset();
    document.getElementById('evidence_id').value = '';
    
    // Default to current time loosely
    document.getElementById('acquired_date').value = new Date().toISOString().slice(0, 16);
    
    // Show File Input, Hide Hash Display for NEW
    document.getElementById('fileUploadContainer').classList.remove('hidden');
    document.getElementById('evidence_file').setAttribute('required', 'true');
    document.getElementById('hashDisplaySection').classList.add('hidden');
    
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-lock text-indigo-500 mr-2"></i> Kunci Bukti ke Vault';
    document.getElementById('evidenceModal').classList.remove('hidden');
}

function closeFormModal() {
    document.getElementById('evidenceModal').classList.add('hidden');
}

function editEvidence(id) {
    fetch(`/evidence-locker/get/\${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const e = data.data;
                document.getElementById('evidence_id').value = e.id;
                document.getElementById('case_id').value = e.case_id;
                document.getElementById('evidence_name').value = e.evidence_name;
                
                // Format datetime-local requires YYYY-MM-DDThh:mm
                const tDate = e.acquired_date ? e.acquired_date.replace(' ', 'T') : '';
                document.getElementById('acquired_date').value = tDate;
                document.getElementById('uploaded_by').value = e.uploaded_by;
                
                // Hide File input (immutable), show Hash Readonly
                document.getElementById('fileUploadContainer').classList.add('hidden');
                document.getElementById('evidence_file').removeAttribute('required');
                
                const hashSection = document.getElementById('hashDisplaySection');
                hashSection.classList.remove('hidden');
                document.getElementById('file_hash_sha256').value = e.file_hash_sha256;
                
                document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit text-indigo-500 mr-2"></i> Edit Metadata Bukti (Tanpa Merusak Hash)';
                document.getElementById('evidenceModal').classList.remove('hidden');
            } else {
                Swal.fire('Error', data.message, 'error');
            }
        });
}

function saveEvidence(e) {
    e.preventDefault();
    const saveBtn = document.getElementById('saveBtn');
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengenkripsi & Menyimpan...';
    saveBtn.disabled = true;

    const formData = new FormData(document.getElementById('evidenceForm'));
    const isEdit = formData.get('id') !== '';
    const url = isEdit ? '/evidence-locker/update' : '/evidence-locker/store';

    fetch(url, {
        method: 'POST',
        body: formData,
        // Don't set XMLHttpRequest header if you send files via fetch without it explicitly handled correctly, 
        // though CI4 usually needs it to detect AJAX natively. For raw file upload, it's fine.
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            closeFormModal();
            dtTable.ajax.reload(null, false);
            
            // Show custom alert if new with hash
            if(!isEdit && data.hash) {
                Swal.fire({
                    icon: 'success', 
                    title: 'Vault Terkunci!',
                    html: `Bukti tersimpan secara integritas.<br><br><span class="text-xs bg-gray-100 p-2 font-mono break-all">\${data.hash}</span>`
                });
            } else {
                Swal.fire({
                    toast: true, position: 'top-end', icon: 'success', 
                    title: data.message, showConfirmButton: false, timer: 3000
                });
            }
        } else {
            Swal.fire('Gagal', data.message, 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Kesalahan koneksi ke server vault.', 'error');
    })
    .finally(() => {
        saveBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Simpan ke Vault';
        saveBtn.disabled = false;
    });
}
</script>
<?= $this->endSection() ?>
