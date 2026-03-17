<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
        <p class="text-sm text-gray-500 mt-1">Deteksi anomali *Least Significant Bit* (LSB) dan susupan data (Payload) pada citra gambar.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Upload Section -->
    <div class="dashboard-card p-6 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4">
                <i class="fas fa-eye mr-2 text-indigo-500"></i> Dropzone Analisis LSB
            </h3>
            
            <form id="stegoForm" enctype="multipart/form-data">
                <div class="border-2 border-dashed border-indigo-200 bg-indigo-50/50 rounded-xl p-10 text-center hover:bg-indigo-50 transition cursor-pointer relative" id="dropArea" onclick="document.getElementById('image_file').click()">
                    
                    <div id="uploadPrompt">
                        <i class="fas fa-image text-5xl text-indigo-300 mb-4 block"></i>
                        <p class="text-gray-700 font-bold mb-1">Drag & Drop Gambar Kemari</p>
                        <p class="text-xs text-gray-500 mb-4">Mendukung format JPG, PNG, GIF, BMP.</p>
                        <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-semibold pointer-events-none">Atau Browse File</span>
                    </div>

                    <input type="file" id="image_file" name="image_file" accept="image/*" class="hidden" required onchange="handleFileSelect(event)">
                    
                    <!-- Image Preview Placeholder -->
                    <div id="imagePreviewContainer" class="hidden flex flex-col items-center">
                        <img id="imagePreview" src="#" alt="Preview" class="max-h-40 rounded-lg shadow-sm border border-gray-200 mb-3">
                        <p id="fileNameDisplay" class="text-xs font-mono text-gray-600 bg-white px-2 py-1 rounded border border-gray-200"></p>
                    </div>

                </div>
                
                <button type="submit" id="analyzeBtn" class="w-full mt-5 bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition shadow flex justify-center items-center">
                    <i class="fas fa-search-plus mr-2"></i> Eksekusi Dekoder Steganografi
                </button>
            </form>
        </div>
        
        <div class="mt-4 bg-yellow-50 p-3 rounded-lg border border-yellow-200 text-xs text-yellow-800 flex items-start">
            <i class="fas fa-exclamation-triangle mt-0.5 mr-2"></i>
            <p>Alat ini menganalisis noise pada level piksel. Beberapa gambar yang telah dikompresi berulang kali mungkin menghasilkan *False Positive*. Pastikan menggunakan gambar mentah jika memungkinkan.</p>
        </div>
    </div>

    <!-- Results Section -->
    <div class="dashboard-card p-6 flex flex-col">
        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4">
            <i class="fas fa-poll-h mr-2 text-teal-500"></i> Hasil Inspeksi
        </h3>
        
        <div id="resultContainer" class="flex-1 flex flex-col items-center justify-center min-h-[300px] bg-gray-50 rounded-xl border border-gray-100 p-6">
            <i class="fas fa-fingerprint text-6xl text-gray-200 mb-4"></i>
            <h4 class="text-gray-500 font-semibold mb-1">Menunggu Input Citra</h4>
            <p class="text-xs text-gray-400 text-center">Data bitmap dan persebaran LSB akan ditampilkan di sini.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Drag and drop mechanics
const dropArea = document.getElementById('dropArea');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false);
});
function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.add('bg-indigo-100', 'border-indigo-400'), false);
});
['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, () => dropArea.classList.remove('bg-indigo-100', 'border-indigo-400'), false);
});

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    document.getElementById('image_file').files = files;
    handleFileSelect({target: {files: files}});
}

function handleFileSelect(e) {
    const file = e.target.files[0];
    if (file) {
        document.getElementById('uploadPrompt').classList.add('hidden');
        document.getElementById('imagePreviewContainer').classList.remove('hidden');
        document.getElementById('fileNameDisplay').innerText = file.name;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}

document.getElementById('stegoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const fileInput = document.getElementById('image_file');
    if(fileInput.files.length === 0) {
        Swal.fire('Peringatan', 'Harap unggah gambar terlebih dahulu.', 'warning');
        return;
    }

    const btn = document.getElementById('analyzeBtn');
    const resultBox = document.getElementById('resultContainer');
    
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengekstrak Bit...';
    btn.disabled = true;

    resultBox.innerHTML = `
        <div class="flex flex-col items-center animate-pulse">
            <i class="fas fa-microchip text-5xl text-teal-400 mb-4 fa-spin"></i>
            <p class="text-sm font-bold text-teal-600">MENINJAU SPEKTRUM WARNA...</p>
        </div>
    `;

    fetch('/steganography/analyze', {
        method: 'POST',
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        if(data.status === 'success') {
            const dangerTheme = data.hasPayload;
            const bgClass = dangerTheme ? 'bg-red-50' : 'bg-green-50';
            const iconClass = dangerTheme ? 'fa-bug text-red-500' : 'fa-check text-green-500';
            const textClass = dangerTheme ? 'text-red-700' : 'text-green-700';
            const progClass = dangerTheme ? 'bg-red-500' : 'bg-green-500';

            resultBox.innerHTML = `
                <div class="w-full h-full flex flex-col justify-start text-left">
                    <div class="flex justify-between items-center border-b border-gray-200 pb-3 mb-4">
                        <div class="flex items-center space-x-3">
                            <i class="fas \${iconClass} text-2xl"></i>
                            <div>
                                <h4 class="\${textClass} font-bold text-lg">\${dangerTheme ? 'SUSPICIOUS (Payload Terdeteksi)' : 'CLEAN (Citra Normal)'}</h4>
                                <p class="text-xs text-gray-500 font-mono">\${data.fileName} (\${data.size})</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1">
                            <span>LSB Anomaly Probability</span>
                            <span>\${data.probability}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="\${progClass} h-2.5 rounded-full" style="width: \${data.probability}"></div>
                        </div>
                    </div>

                    <div class="\${bgClass} rounded-lg p-4 border \${dangerTheme ? 'border-red-200' : 'border-green-200'} mb-4">
                        <p class="text-sm \${textClass} font-medium">\${data.details}</p>
                    </div>
                    
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-400 font-bold mb-1">Rekomendasi Aksi</p>
                        <p class="text-sm text-gray-700">\${data.recommendedAction}</p>
                    </div>
                </div>
            `;
            
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success', 
                title: 'Analisis Steganografi Selesai', showConfirmButton: false, timer: 3000
            });
        } else {
            Swal.fire('Error', data.message, 'error');
            resetResult();
        }
    })
    .catch(err => {
        Swal.fire('Error', 'Gagal memproses gambar.', 'error');
        resetResult();
    })
    .finally(() => {
        btn.innerHTML = '<i class="fas fa-search-plus mr-2"></i> Eksekusi Dekoder Steganografi';
        btn.disabled = false;
    });
});

function resetResult() {
    document.getElementById('resultContainer').innerHTML = `
        <i class="fas fa-fingerprint text-6xl text-gray-200 mb-4"></i>
        <h4 class="text-gray-500 font-semibold mb-1">Menunggu Input Citra</h4>
        <p class="text-xs text-gray-400 text-center">Data bitmap dan persebaran LSB akan ditampilkan di sini.</p>
    `;
}
</script>

<?= $this->endSection() ?>
