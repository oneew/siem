<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
        <p class="text-sm text-gray-500 mt-1">Unggah file mencurigakan (.php, .txt, .zip) ke lingkungan karantina untuk analisis statis AI.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Upload Section -->
    <div class="dashboard-card p-6">
        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4">
            <i class="fas fa-upload mr-2 text-indigo-500"></i> Dropzone AI Analyzer
        </h3>
        
        <form id="analyzerForm" enctype="multipart/form-data" class="space-y-4">
            <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:bg-gray-50 transition cursor-pointer" id="dropzone" onclick="document.getElementById('suspect_file').click()">
                <i class="fas fa-file-archive text-4xl text-gray-400 mb-3 block"></i>
                <p class="text-sm text-gray-600 font-medium mb-1">Pilih File atau Drag & Drop ke sini</p>
                <p class="text-xs text-gray-400">Pastikan Anda memiliki otorisasi untuk mengunggah sampel malware.</p>
                <input type="file" id="suspect_file" name="suspect_file" class="hidden" required onchange="showFileName()">
                
                <div id="fileNameDisplay" class="mt-4 hidden p-2 bg-indigo-50 text-indigo-700 text-sm rounded font-mono border border-indigo-100">
                    <!-- Filename will be shown here -->
                </div>
            </div>
            
            <button type="submit" id="analyzeBtn" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition shadow flex justify-center items-center">
                <i class="fas fa-microscope mr-2"></i> Eksekusi Analisis Statis
            </button>
        </form>
    </div>

    <!-- AI Result Section -->
    <div class="dashboard-card p-6 flex flex-col">
        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4">
            <i class="fas fa-brain mr-2 text-purple-500"></i> Insight / Hasil Pemindaian AI
        </h3>
        
        <div id="resultContainer" class="flex-1 flex flex-col items-center justify-center min-h-[250px] bg-gray-50 rounded-xl border border-gray-100 p-6">
            <i class="fas fa-shield-virus text-6xl text-gray-200 mb-4"></i>
            <h4 class="text-gray-500 font-semibold mb-1">Menunggu File Sampel</h4>
            <p class="text-xs text-gray-400 text-center">Hasil heuristik model pendeteksi malware akan muncul di sini.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showFileName() {
    const fileInput = document.getElementById('suspect_file');
    const display = document.getElementById('fileNameDisplay');
    if (fileInput.files.length > 0) {
        display.innerHTML = `<i class="fas fa-file mr-2"></i> \${fileInput.files[0].name}`;
        display.classList.remove('hidden');
    }
}

document.getElementById('analyzerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('analyzeBtn');
    const resultBox = document.getElementById('resultContainer');
    const fileInput = document.getElementById('suspect_file');

    if (fileInput.files.length === 0) {
        Swal.fire('Peringatan', 'Harap pilih file sampel terlebih dahulu.', 'warning');
        return;
    }

    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menganalisis Payload...';
    btn.disabled = true;
    
    // UI Mock Loading state
    resultBox.innerHTML = `
        <div class="flex flex-col items-center animate-pulse">
            <i class="fas fa-cogs text-4xl text-indigo-400 mb-3 fa-spin"></i>
            <p class="text-sm font-bold text-indigo-600">Model AI SEDANG MEMBEDAH HEADER FILE...</p>
        </div>
    `;

    const formData = new FormData(this);

    fetch('/dfir/analyze-malware', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const isHigh = data.analysis.threatLevel === 'High';
            
            resultBox.innerHTML = `
                <div class="w-full text-left">
                    <div class="flex items-center justify-between mb-4 border-b pb-3">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Nama File Asli</p>
                            <p class="text-sm font-mono text-gray-800">\${data.fileName}</p>
                        </div>
                        <span class="px-3 py-1 rounded border font-bold text-xs \${isHigh ? 'bg-red-100 text-red-800 border-red-200' : 'bg-green-100 text-green-800 border-green-200'}">
                            \${data.analysis.threatLevel.toUpperCase()} THREAT
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">AI Heuristic Finding (\${data.analysis.confidence} Confidence)</p>
                        <p class="text-sm text-gray-700 bg-white p-3 rounded border border-gray-200">\${data.analysis.description}</p>
                    </div>
                    
                    <div class="bg-red-50 p-3 rounded border border-red-100">
                        <p class="text-xs text-red-800 uppercase tracking-wider font-bold mb-1"><i class="fas fa-exclamation-circle"></i> Recommended Action</p>
                        <p class="text-sm text-red-700 font-medium">\${data.analysis.recommendedAction}</p>
                    </div>
                    
                    <div class="mt-4 flex justify-end">
                        <p class="text-[10px] text-gray-400 font-mono">Quarantine Hash ID: \${data.quarantineName}</p>
                    </div>
                </div>
            `;
            
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'File sukses di-dump ke karantina.',
                showConfirmButton: false,
                timer: 3000
            });
            
            // Reset form
            this.reset();
            document.getElementById('fileNameDisplay').classList.add('hidden');
        } else {
            Swal.fire('Gagal', data.message, 'error');
            resetResultBox();
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Kesalahan server.', 'error');
        resetResultBox();
    })
    .finally(() => {
        btn.innerHTML = '<i class="fas fa-microscope mr-2"></i> Eksekusi Analisis Statis';
        btn.disabled = false;
    });
});

function resetResultBox() {
    document.getElementById('resultContainer').innerHTML = `
        <i class="fas fa-shield-virus text-6xl text-gray-200 mb-4"></i>
        <h4 class="text-gray-500 font-semibold mb-1">Menunggu File Sampel</h4>
        <p class="text-xs text-gray-400 text-center">Hasil heuristik model pendeteksi malware akan muncul di sini.</p>
    `;
}
</script>

<?= $this->endSection() ?>
