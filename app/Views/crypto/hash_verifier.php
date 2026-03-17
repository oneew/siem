<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <div class="dashboard-card p-6">
        <h3 class="text-lg font-bold text-gray-800 border-b border-gray-200 pb-3 mb-4">
            <i class="fas fa-file-check mr-2 text-emerald-500"></i> Verifikasi Integritas File
        </h3>
        
        <form id="hashForm" class="space-y-5" onsubmit="event.preventDefault(); verifyHash();">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload File Berkas</label>
                <input type="file" id="fileInput" class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-md file:border-0
                    file:text-sm file:font-semibold
                    file:bg-emerald-50 file:text-emerald-700
                    hover:file:bg-emerald-100 border border-gray-300 rounded-lg p-2 bg-gray-50
                " required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Masukkan Hash SHA256 Asli (Expected)</label>
                <input type="text" id="expectedHash" placeholder="Contoh: e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 font-mono text-sm" required>
            </div>
            
            <button type="submit" id="verifyBtn" class="w-full bg-emerald-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-emerald-700 transition shadow flex justify-center items-center">
                <span>Mulai Verifikasi (Client-Side)</span>
            </button>
        </form>
    </div>

    <!-- Result Area -->
    <div class="dashboard-card p-6 flex flex-col items-center justify-center min-h-[300px]" id="resultContainer">
        <i class="fas fa-shield-alt text-6xl text-gray-200 mb-4"></i>
        <h4 class="text-gray-500 font-semibold">Menunggu Input Berkas...</h4>
        <p class="text-xs text-gray-400 mt-2 text-center">Hasil kalkulasi hash AJAX akan muncul di sini tanpa mereload halaman.</p>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script>
    async function verifyHash() {
        const fileInput = document.getElementById('fileInput');
        const expectedHash = document.getElementById('expectedHash').value.trim().toLowerCase();
        const verifyBtn = document.getElementById('verifyBtn');
        const resultContainer = document.getElementById('resultContainer');
        
        if (fileInput.files.length === 0) {
            alert("Harap pilih file terlebih dahulu.");
            return;
        }

        const file = fileInput.files[0];
        verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menghitung Hash...';
        verifyBtn.disabled = true;

        // Use FileReader to read as ArrayBuffer for CryptoJS
        const reader = new FileReader();

        reader.onload = function(event) {
            const arrayBuffer = event.target.result;
            
            // To ensure browser doesn't block UI entirely for huge files, 
            // a timeout is used to decouple UI update from blocking hashing logic
            setTimeout(() => {
                let calculatedHash = '';
                try {
                    // CryptoJS WordArray from ArrayBuffer
                    const wordArray = CryptoJS.lib.WordArray.create(arrayBuffer);
                    calculatedHash = CryptoJS.SHA256(wordArray).toString(CryptoJS.enc.Hex).toLowerCase();
                    
                    const isMatch = (calculatedHash === expectedHash);
                    
                    // Render UI via JS (Asynchronous feel)
                    let resultHTML = '';
                    if (isMatch) {
                        resultHTML = `
                            <div class="text-center w-full animate-pulse">
                                <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-lg">
                                    <i class="fas fa-check-circle text-4xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-green-600 mb-2">MATCH (TERVERIFIKASI)</h2>
                                <p class="text-sm text-gray-600">Integritas file terjaga. Hash sama dengan dokumen asli.</p>
                            </div>
                        `;
                    } else {
                        resultHTML = `
                            <div class="text-center w-full animate-bounce">
                                <div class="w-20 h-20 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-white shadow-lg">
                                    <i class="fas fa-times-circle text-4xl"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-red-600 mb-2">TAMPERED (DIMANIPULASI)</h2>
                                <p class="text-sm text-red-500 font-semibold mb-2">PERINGATAN! File mungkin telah diubah!</p>
                            </div>
                        `;
                    }

                    resultHTML += `
                        <div class="mt-6 w-full text-left bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-xs text-gray-500 mb-1">Calculated SHA-256 (Berkas Anda):</p>
                            <code class="text-xs \${isMatch ? 'text-green-600' : 'text-red-600'} break-all font-bold block mb-3">\${calculatedHash}</code>
                            
                            <p class="text-xs text-gray-500 mb-1">Expected SHA-256 (Asli):</p>
                            <code class="text-xs text-gray-800 break-all font-bold block">\${expectedHash}</code>
                        </div>
                    `;
                    
                    resultContainer.innerHTML = resultHTML;
                } catch (e) {
                    console.error("Hashing error:", e);
                    resultContainer.innerHTML = `<p class="text-red-500 text-sm">Terjadi kesalahan pada saat menghitung hash file: \${e.message}</p>`;
                } finally {
                    verifyBtn.innerHTML = '<span>Mulai Verifikasi (Client-Side)</span>';
                    verifyBtn.disabled = false;
                }
            }, 50);
        };

        reader.onerror = function() {
            resultContainer.innerHTML = `<p class="text-red-500 text-sm">Gagal membaca berkas.</p>`;
            verifyBtn.innerHTML = '<span>Mulai Verifikasi (Client-Side)</span>';
            verifyBtn.disabled = false;
        };

        reader.readAsArrayBuffer(file);
    }
</script>
<?= $this->endSection() ?>
