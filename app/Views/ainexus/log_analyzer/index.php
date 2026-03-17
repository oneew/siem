<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight">
            <i class="fas fa-robot text-purple-600 mr-2"></i> <?= esc($title) ?>
        </h1>
        <p class="text-sm text-gray-500 mt-1">Tempelkan (Paste) log mentah dari Apache, Nginx, AWS CloudTrail, atau Syslog untuk dianalisis oleh Asisten AI.</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    <!-- Input Section -->
    <div class="lg:col-span-7 bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col">
        <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800"><i class="fas fa-terminal text-gray-500 mr-2"></i> Input Raw Logs</h3>
            <button onclick="document.getElementById('raw_logs').value=''" class="text-xs text-red-500 hover:underline">Bersihkan</button>
        </div>
        
        <form id="logAnalyzerForm" class="flex-1 flex flex-col p-4">
            <div class="flex-1 mb-4">
                <textarea id="raw_logs" name="raw_logs" class="w-full h-[400px] border border-gray-300 rounded-lg p-4 font-mono text-xs text-gray-300 bg-gray-900 focus:ring-purple-500 focus:border-purple-500 leading-relaxed" placeholder="Contoh:
192.168.1.100 - - [10/Oct/2026:13:55:36 -0700] &quot;GET /search?q=' UNION SELECT null, username, password FROM users-- HTTP/1.1&quot; 200 2326
192.168.1.100 - - [10/Oct/2026:13:56:10 -0700] &quot;GET /profile?id=<script>alert(document.cookie)</script> HTTP/1.1&quot; 200 511" required></textarea>
            </div>
            
            <button type="submit" id="analyzeBtn" class="bg-purple-600 text-white font-bold py-3 pt-3 px-4 rounded-lg hover:bg-purple-700 transition shadow flex justify-center items-center group relative overflow-hidden">
                <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-purple-400 to-indigo-500 opacity-0 group-hover:opacity-20 transition duration-300"></div>
                <i class="fas fa-bolt mr-2 text-yellow-300"></i> Ekstrak & Analisis dengan AI Nexus
            </button>
        </form>
    </div>

    <!-- Output Section -->
    <div class="lg:col-span-5 flex flex-col">
        <div class="bg-gray-50 border border-gray-200 rounded-xl shadow-sm flex-1 flex flex-col p-1 overflow-hidden">
            <div class="p-3 border-b border-gray-200 bg-white rounded-t-lg">
                <h3 class="font-bold text-gray-800"><i class="fas fa-brain text-purple-500 mr-2"></i> AI Insights Feed</h3>
            </div>
            
            <div id="aiResponseContainer" class="flex-1 p-5 overflow-y-auto bg-gray-50 min-h-[400px]">
                
                <!-- Placeholder Wait State -->
                <div id="waitState" class="h-full flex flex-col items-center justify-center text-center opacity-60">
                    <img src="https://cdn-icons-png.flaticon.com/512/8636/8636915.png" class="w-24 h-24 mb-4 grayscale opacity-40">
                    <h4 class="text-gray-600 font-bold">Menunggu Input Log</h4>
                    <p class="text-sm text-gray-400 mt-1 max-w-[250px]">Asisten AI sedang dalam mode siaga menunggu log pemantauan jaringan Anda.</p>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('logAnalyzerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('analyzeBtn');
    const container = document.getElementById('aiResponseContainer');
    
    const logs = document.getElementById('raw_logs').value.trim();
    if(!logs) return;

    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sedang Memproses Big Data...';
    btn.disabled = true;

    // Set Loading UI
    container.innerHTML = `
        <div class="h-full flex flex-col items-center justify-center">
            <div class="flex space-x-2 animate-pulse mb-4">
                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
            </div>
            <p class="text-sm font-bold text-purple-700">Mencocokkan pola ancaman global...</p>
        </div>
    `;

    fetch('/ainexus/log-analyzer/analyze', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'raw_logs=' + encodeURIComponent(logs)
    })
    .then(r => r.json())
    .then(data => {
        if(data.status === 'success') {
            const analysis = data.analysis;
            
            let threatBadge = '';
            let borderClass = 'border-purple-200';
            if(analysis.threat_level === 'Critical') {
                threatBadge = '<span class="bg-red-500 text-white px-3 py-1 text-xs rounded-full font-bold shadow-sm animate-pulse">CRITICAL THREAT</span>';
                borderClass = 'border-red-300 ring-2 ring-red-100';
            } else if (analysis.threat_level === 'High') {
                threatBadge = '<span class="bg-orange-500 text-white px-3 py-1 text-xs rounded-full font-bold shadow-sm">HIGH RISK</span>';
                borderClass = 'border-orange-300';
            } else {
                threatBadge = '<span class="bg-green-500 text-white px-3 py-1 text-xs rounded-full font-bold shadow-sm">NORMAL / LOW</span>';
                borderClass = 'border-green-300';
            }

            let insightsHtml = '';
            analysis.insights.forEach(item => {
                insightsHtml += `
                    <div class="bg-white p-3 rounded-lg border border-gray-100 shadow-sm mb-3">
                        <div class="flex items-center text-sm font-bold text-gray-800 mb-1 border-b pb-1">
                            <i class="fas fa-crosshairs text-purple-500 mr-2"></i> \${item.type}
                        </div>
                        <p class="text-xs text-gray-600 leading-relaxed">\${item.description}</p>
                    </div>
                `;
            });

            container.innerHTML = `
                <div class="bg-white rounded-xl p-5 mb-4 border \${borderClass} shadow-sm transition-all">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-gray-800">Assessed Threat Level</h4>
                        \${threatBadge}
                    </div>
                    
                    <div class="space-y-3 mb-5">
                        \${insightsHtml}
                    </div>
                    
                    <div class="bg-indigo-50 p-4 rounded-lg border border-indigo-100">
                        <h5 class="text-xs font-bold uppercase tracking-wider text-indigo-800 mb-2"><i class="fas fa-shield-alt mr-1"></i> Rekomendasi Mitigasi AI</h5>
                        <p class="text-sm font-medium text-indigo-700 leading-relaxed">
                            \${analysis.recommended_actions}
                        </p>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-gray-100 text-right">
                        <button class="text-xs font-bold text-gray-400 hover:text-purple-600 transition flex items-center justify-end w-full" onclick="document.getElementById('raw_logs').value=''; document.getElementById('logAnalyzerForm').dispatchEvent(new Event('submit'));">
                            <i class="fas fa-redo mr-1"></i> Analisis Ulang Pola
                        </button>
                    </div>
                </div>
            `;
            
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success', 
                title: 'Analisis Logs Selesai', showConfirmButton: false, timer: 3000
            });
        } else {
            Swal.fire('Gagal', data.message, 'error');
            resetUI();
        }
    })
    .catch(err => {
        Swal.fire('Error', 'Gagal memproses ke Engine AI.', 'error');
        resetUI();
    })
    .finally(() => {
        btn.innerHTML = '<i class="fas fa-bolt mr-2 text-yellow-300"></i> Ekstrak & Analisis dengan AI Nexus';
        btn.disabled = false;
    });
});

function resetUI() {
    document.getElementById('aiResponseContainer').innerHTML = `
        <div id="waitState" class="h-full flex flex-col items-center justify-center text-center opacity-60">
            <i class="fas fa-exclamation-triangle text-5xl text-gray-300 mb-4"></i>
            <h4 class="text-gray-600 font-bold">Koneksi Mesin AI Terputus</h4>
            <p class="text-sm text-gray-400 mt-1 max-w-[250px]">Silakan coba kirim utilitas log sedikit demi sedikit.</p>
        </div>
    `;
}
</script>

<?= $this->endSection() ?>
