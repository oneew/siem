<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
        <p class="text-sm text-gray-500 mt-1">Layanan Tanda Tangan Elektronik (TTE) Tersertifikasi dan Verifikasi Keabsahan Dokumen.</p>
    </div>
</div>

<div class="dashboard-card overflow-hidden">
    <!-- Tabs Header -->
    <div class="flex border-b border-gray-200 bg-gray-50">
        <button onclick="switchTab('sign')" id="tab-btn-sign" class="flex-1 py-4 text-center font-bold text-sm border-b-2 border-indigo-600 text-indigo-600 focus:outline-none transition">
            <i class="fas fa-file-signature mr-2"></i> Tanda Tangani Dokumen
        </button>
        <button onclick="switchTab('verify')" id="tab-btn-verify" class="flex-1 py-4 text-center font-bold text-sm border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-100 focus:outline-none transition">
            <i class="fas fa-check-double mr-2"></i> Verifikasi Dokumen TTE
        </button>
    </div>

    <div class="p-8">
        <!-- Sign Tab Content -->
        <div id="tab-content-sign" class="tab-content block pb-4">
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-6">
                    <i class="fas fa-stamp text-5xl text-gray-300 mb-3 block"></i>
                    <h3 class="text-xl font-bold text-gray-800">Pembubuhan TTE</h3>
                    <p class="text-gray-500 text-sm mt-1">Unggah dokumen format PDF untuk dibubuhi Tanda Tangan Elektronik.</p>
                </div>
                
                <form id="signForm" class="space-y-5 bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Pilih File PDF</label>
                        <input type="file" id="documentToSign" name="document" accept="application/pdf" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg p-1" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Passphrase (PIN Sertifikat)</label>
                        <div class="relative">
                            <input type="password" name="passphrase" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="••••••••" required>
                            <i class="fas fa-lock absolute right-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Posisi Visual TTE (Opsional)</label>
                        <select name="visual_position" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="invisible">Invisible Signature (Tidak Tampak)</option>
                            <option value="bottom-right">Kanan Bawah (Halaman Terakhir)</option>
                            <option value="bottom-left">Kiri Bawah (Halaman Terakhir)</option>
                        </select>
                    </div>

                    <button type="submit" id="signBtn" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition shadow flex justify-center items-center mt-2">
                        <i class="fas fa-signature mr-2"></i> Tanda Tangani Dokumen
                    </button>
                    
                    <div class="bg-blue-50 text-blue-800 p-3 rounded text-xs border border-blue-100 flex items-start">
                        <i class="fas fa-info-circle mt-0.5 mr-2"></i>
                        <p>Pastikan Anda tidak membagikan Passphrase kepada siapapun. Pembubuhan bersifat sah dan memiliki kekuatan hukum sesuai UU ITE (Placeholder).</p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Verify Tab Content -->
        <div id="tab-content-verify" class="tab-content hidden pb-4">
            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-6">
                    <i class="fas fa-shield-check text-5xl text-green-400 mb-3 block"></i>
                    <h3 class="text-xl font-bold text-gray-800">Verifikasi Dokumen</h3>
                    <p class="text-gray-500 text-sm mt-1">Periksa validitas dan integritas Tanda Tangan Elektronik pada dokumen PDF.</p>
                </div>
                
                <form id="verifyForm" class="space-y-5 bg-white border border-gray-200 p-6 rounded-xl shadow-sm">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('documentToVerify').click()">
                        <i class="fas fa-file-pdf text-4xl text-gray-400 mb-2 block"></i>
                        <p class="text-sm text-gray-600 font-medium">Unggah Dokumen PDF TTE</p>
                        <input type="file" id="documentToVerify" name="signed_document" accept="application/pdf" class="hidden" required onchange="showVerifyName()">
                        <div id="verifyFileName" class="mt-2 text-xs text-indigo-600 font-bold hidden"></div>
                    </div>

                    <button type="submit" id="verifyBtn" class="w-full bg-green-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-green-700 transition shadow flex justify-center items-center">
                        <i class="fas fa-search mr-2"></i> Verifikasi Sekarang
                    </button>
                </form>
                
                <div id="verifyResult" class="hidden mt-6 bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <div class="flex items-center mb-4 border-b pb-3">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                            <i class="fas fa-check"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-green-700 text-lg">Tanda Tangan Valid</h4>
                            <p class="text-xs text-gray-500">Integritas dokumen terjamin.</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500">Subject (Signer)</span>
                            <span class="font-bold text-gray-800" id="resSigner">John Doe</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-2">
                            <span class="text-gray-500">Waktu Tanda Tangan</span>
                            <span class="font-bold text-gray-800" id="resTime">2026-03-17 14:00:00</span>
                        </div>
                        <div class="flex justify-between pb-1">
                            <span class="text-gray-500">Status Integritas</span>
                            <span class="text-green-600 font-medium" id="resInteg">Verified</span>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function switchTab(tabId) {
    // Hide all
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('[id^=tab-btn-]').forEach(el => {
        el.classList.remove('border-indigo-600', 'text-indigo-600');
        el.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show active
    document.getElementById(`tab-content-\${tabId}`).classList.remove('hidden');
    const activeBtn = document.getElementById(`tab-btn-\${tabId}`);
    activeBtn.classList.remove('border-transparent', 'text-gray-500');
    activeBtn.classList.add('border-indigo-600', 'text-indigo-600');
}

function showVerifyName() {
    const file = document.getElementById('documentToVerify').files[0];
    if(file) {
        document.getElementById('verifyFileName').innerText = file.name;
        document.getElementById('verifyFileName').classList.remove('hidden');
    }
}

// Handle Sign Submission
document.getElementById('signForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('signBtn');
    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-2"></i> Memproses TTE...';
    btn.disabled = true;

    fetch('/certificate/sign', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if(data.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message,
                confirmButtonColor: '#4f46e5'
            });
            this.reset();
        } else {
            Swal.fire('Error', data.message, 'error');
        }
    })
    .catch(err => Swal.fire('Error', 'Server Error', 'error'))
    .finally(() => {
        btn.innerHTML = '<i class="fas fa-signature mr-2"></i> Tanda Tangani Dokumen';
        btn.disabled = false;
    });
});

// Handle Verify Submission
document.getElementById('verifyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('verifyBtn');
    btn.innerHTML = '<i class="fas fa-cog fa-spin mr-2"></i> Menganalisis...';
    btn.disabled = true;
    document.getElementById('verifyResult').classList.add('hidden');

    fetch('/certificate/verify', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if(data.status === 'success') {
            document.getElementById('resSigner').innerText = data.details.signer;
            document.getElementById('resTime').innerText = data.details.timestamp;
            document.getElementById('resInteg').innerText = data.details.integrity;
            document.getElementById('verifyResult').classList.remove('hidden');
            
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success', 
                title: data.message, showConfirmButton: false, timer: 3000
            });
        } else {
            Swal.fire('Gagal', data.message, 'error');
        }
    })
    .catch(err => Swal.fire('Error', 'Server Error', 'error'))
    .finally(() => {
        btn.innerHTML = '<i class="fas fa-search mr-2"></i> Verifikasi Sekarang';
        btn.disabled = false;
    });
});
</script>

<?= $this->endSection() ?>
