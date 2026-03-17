<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
        <i class="fas fa-search-location text-blue-500 mr-2"></i> Threat Intelligence (OSINT)
    </h1>
    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Lakukan pencarian reputasi IP atau Domain ke database intelijen ancaman global (Simulasi).</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
        <div class="card p-6 border border-gray-200 dark:border-siem-darkborder rounded-xl bg-white dark:bg-siem-darkcard shadow-sm">
            <form id="osintForm" onsubmit="runLookup(event)">
                <div class="mb-4">
                    <label class="form-label text-sm text-gray-700 dark:text-gray-300">Jenis Target</label>
                    <select name="type" class="form-select bg-gray-50 dark:bg-siem-darkbg border border-gray-300 dark:border-siem-darkborder w-full p-2.5 rounded-lg text-sm text-gray-800 dark:text-gray-200">
                        <option value="ip">IP Address</option>
                        <option value="domain">Domain / URL</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label text-sm text-gray-700 dark:text-gray-300">Nilai Target</label>
                    <input type="text" name="target" required class="form-input bg-gray-50 dark:bg-siem-darkbg border border-gray-300 dark:border-siem-darkborder w-full p-2.5 rounded-lg text-sm text-gray-800 dark:text-gray-200" placeholder="e.g. 192.168.1.1 or example.com">
                </div>
                <button type="submit" id="lookupBtn" class="btn btn-primary w-full justify-center">
                    <i class="fas fa-search"></i> Mulai Analisis
                </button>
            </form>
        </div>
    </div>
    <div class="lg:col-span-2">
        <div id="resultContainer" class="card p-8 border border-gray-200 dark:border-siem-darkborder rounded-xl bg-white dark:bg-siem-darkcard shadow-sm h-full flex flex-col justify-center items-center text-center">
            <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 text-blue-500 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-satellite-dish text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Menunggu Kueri</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Hasil lookup repositori OSINT akan muncul di panel ini.</p>
        </div>
    </div>
</div>

<script>
    function runLookup(e) {
        e.preventDefault();
        const form = document.getElementById('osintForm');
        const btn = document.getElementById('lookupBtn');
        const resultContainer = document.getElementById('resultContainer');
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        btn.disabled = true;

        resultContainer.innerHTML = '<div class="w-full h-full flex flex-col justify-center items-center"><div class="w-12 h-12 border-4 border-blue-200 border-t-blue-500 rounded-full animate-spin"></div><p class="mt-4 text-gray-500 text-sm">Menghubungi Repositori Eksternal...</p></div>';

        const formData = new FormData(form);

        fetch('/osint/lookup', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            btn.innerHTML = '<i class="fas fa-search"></i> Mulai Analisis';
            btn.disabled = false;

            if (data.status === 'success') {
                const repColor = data.reputation === 'Malicious' ? 'text-red-600 bg-red-100 dark:bg-red-900/40 dark:text-red-400' : 'text-green-600 bg-green-100 dark:bg-green-900/40 dark:text-green-400';
                const repIcon = data.reputation === 'Malicious' ? 'fa-skull-crossbones' : 'fa-check-circle';

                let geoHtml = '';
                if(data.type === 'ip') {
                     geoHtml = `
                     <div class="mt-4 pt-4 border-t border-gray-100 dark:border-siem-darkborder">
                        <div class="text-xs text-gray-400 uppercase font-bold mb-1">Geolokasi</div>
                        <div class="text-sm text-gray-800 dark:text-gray-200">${data.geo.city}, ${data.geo.country}</div>
                     </div>`;
                }

                resultContainer.classList.remove('justify-center', 'items-center', 'text-center');
                resultContainer.innerHTML = `
                    <div class="w-full animate-fade-in">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wider font-bold mb-1">Target Analysis</div>
                                <h2 class="text-2xl font-bold font-mono text-gray-900 dark:text-white">${data.target}</h2>
                                <div class="text-sm text-gray-500 mt-1">Provider: ${data.provider}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-[10px] uppercase font-bold text-gray-400 mb-1">Reputasi</div>
                                <div class="px-4 py-2 rounded-lg font-bold ${repColor} flex items-center gap-2">
                                    <i class="fas ${repIcon}"></i> ${data.reputation}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 dark:bg-siem-darkbg p-4 rounded-xl border border-gray-100 dark:border-siem-darkborder">
                                <span class="text-xs text-gray-500 dark:text-gray-400 block font-semibold mb-1">Confidence Score</span>
                                <span class="text-xl font-bold ${data.reputation === 'Malicious' ? 'text-red-500' : 'text-gray-700 dark:text-gray-300'}">${data.score}/100</span>
                            </div>
                            <div class="bg-gray-50 dark:bg-siem-darkbg p-4 rounded-xl border border-gray-100 dark:border-siem-darkborder">
                                <span class="text-xs text-gray-500 dark:text-gray-400 block font-semibold mb-1">Total Laporan Aktif</span>
                                <span class="text-xl font-bold ${data.reports > 0 ? 'text-orange-500' : 'text-gray-700 dark:text-gray-300'}">${data.reports}</span>
                            </div>
                        </div>
                        
                        ${geoHtml}

                        <div class="mt-4 text-xs text-gray-400 text-right">
                            Pengecekan Terakhir: ${data.last_analysis}
                        </div>
                    </div>
                `;
            }
        });
    }
</script>

<?= $this->endSection() ?>
