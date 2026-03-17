<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex justify-between items-end">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 leading-tight"><?= esc($title) ?></h1>
    </div>
</div>

<!-- TIER 1: Top Cards (4 Kolom) -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  
  <!-- Security Posture Score -->
  <div class="dashboard-card border-l-4 <?= $securityScore >= 80 ? 'border-green-500' : ($securityScore >= 50 ? 'border-yellow-500' : 'border-red-500') ?>">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Security Posture Score</p>
        <div class="flex items-baseline space-x-2">
            <p class="text-3xl font-bold <?= $securityScore >= 80 ? 'text-green-600' : ($securityScore >= 50 ? 'text-yellow-600' : 'text-red-600') ?>">
                <?= $securityScore ?>%
            </p>
        </div>
        <p class="text-xs text-gray-400 mt-1">Berdasarkan kalkulasi metrik aktif</p>
      </div>
      <div class="w-12 h-12 <?= $securityScore >= 80 ? 'bg-green-100 text-green-600' : ($securityScore >= 50 ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') ?> rounded-lg flex items-center justify-center">
        <i class="fas fa-shield-alt text-xl"></i>
      </div>
    </div>
  </div>

  <!-- Active Critical Alerts -->
  <div class="dashboard-card border-l-4 border-red-500 <?= $criticalAlerts > 0 ? 'animate-pulse' : '' ?>">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Active Critical Alerts</p>
        <div class="flex items-baseline space-x-2">
            <p class="text-3xl font-bold <?= $criticalAlerts > 0 ? 'text-red-600' : 'text-gray-900' ?>">
                <?= $criticalAlerts ?>
            </p>
        </div>
        <p class="text-xs text-red-500 mt-1 font-semibold">
           <?= $criticalAlerts > 0 ? 'Segera lakukan mitigasi!' : 'Sistem aman saat ini' ?>
        </p>
      </div>
      <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
      </div>
    </div>
  </div>

  <!-- Open Pentest Projects -->
  <div class="dashboard-card border-l-4 border-purple-500">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Open Pentest Projects</p>
        <div class="flex items-baseline space-x-2">
            <p class="text-3xl font-bold text-gray-900"><?= $openPentests ?></p>
        </div>
        <p class="text-xs text-gray-400 mt-1">Proyek Red Team berjalan</p>
      </div>
      <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center shadow-inner">
        <i class="fas fa-user-ninja text-purple-600 text-xl"></i>
      </div>
    </div>
  </div>

  <!-- Malicious Files Detected -->
  <div class="dashboard-card border-l-4 border-amber-500">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Malicious Files Detected</p>
        <div class="flex items-baseline space-x-2">
            <p class="text-3xl font-bold text-amber-600"><?= $maliciousFiles ?></p>
        </div>
        <p class="text-xs text-gray-400 mt-1">DFIR Stats (Bulan ini)</p>
      </div>
      <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
        <i class="fas fa-biohazard text-amber-600 text-xl"></i>
      </div>
    </div>
  </div>

</div>

<!-- TIER 2: Middle Section (2 Kolom) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
  
  <!-- Kiri: Insiden & Kasus Aktif -->
  <div class="dashboard-card flex flex-col h-full">
    <div class="px-6 py-4 border-b border-gray-200">
      <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
          <i class="fas fa-ticket-alt mr-2 text-blue-500"></i>
          Insiden & Kasus Aktif
        </h3>
        <a href="/incidents-v2" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Lihat Semua</a>
      </div>
    </div>
    <div class="flex-1 overflow-x-auto">
      <table class="w-full modern-table">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Kasus</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keparahan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php if(!empty($activeIncidents)): ?>
            <?php foreach($activeIncidents as $i): ?>
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">#<?= $i['id'] ?></td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= esc($i['title']) ?></td>
              <td class="px-6 py-4 whitespace-nowrap">
                <?php
                $severityColors = [
                  'Low' => 'bg-green-100 text-green-800',
                  'Medium' => 'bg-yellow-100 text-yellow-800', 
                  'High' => 'bg-orange-100 text-orange-800',
                  'Critical' => 'bg-red-100 text-red-800'
                ];
                ?>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= $severityColors[$i['severity']] ?? 'bg-gray-100' ?>">
                  <?= esc($i['severity']) ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                  <?= esc($i['status']) ?>
                </span>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">Tidak ada kasus aktif saat ini.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Kanan: Live Threat Feed & SSE -->
  <div class="dashboard-card bg-gradient-to-br from-gray-900 to-slate-900 border border-slate-700 flex flex-col h-full relative overflow-hidden text-white">
    <div class="px-6 py-4 border-b border-slate-700 flex justify-between items-center z-10">
      <h3 class="text-lg font-semibold text-white flex items-center">
        <i class="fas fa-satellite-dish mr-2 text-red-500 animate-pulse"></i>
        Live Global Threats (SSE)
      </h3>
      <span class="flex h-3 w-3 relative">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
      </span>
    </div>
    <div class="p-0 flex-1 flex flex-col relative z-10">
      <!-- Radar Map Background -->
      <div class="absolute inset-0 z-0 flex items-center justify-center opacity-20 pointer-events-none">
        <div class="w-64 h-64 border border-green-500 rounded-full animate-[ping_3s_linear_infinite]"></div>
        <div class="w-48 h-48 border border-green-500 rounded-full absolute"></div>
        <div class="w-32 h-32 border border-green-500 rounded-full absolute"></div>
      </div>
      
      <!-- Feed Container -->
      <div id="liveThreatFeed" class="flex-1 overflow-y-auto p-4 space-y-3 z-10 font-mono text-xs max-h-[300px]">
        <div class="text-green-500 text-center py-4">Menunggu stream intelijen ancaman...</div>
      </div>
    </div>
  </div>

</div>

<!-- TIER 3: Bottom Section (Temuan Kerentanan) -->
<div class="dashboard-card mb-8">
  <div class="px-6 py-4 border-b border-gray-200">
    <div class="flex items-center justify-between">
      <h3 class="text-lg font-semibold text-gray-900 flex items-center">
        <i class="fas fa-spider mr-2 text-red-500"></i>
        Temuan Kerentanan (Vulnerabilities) Terbaru dari Red Team
      </h3>
      <a href="/vulnerabilities" class="text-sm text-blue-600 hover:text-blue-800 font-medium">Buka Red Team Deck</a>
    </div>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full modern-table">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">VUL-ID</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Target Aset</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kerentanan</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keparahan</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Ditemukan</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <?php foreach($recentVulnerabilities as $v): ?>
        <tr class="hover:bg-red-50 transition-colors">
          <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500"><?= esc($v['id']) ?></td>
          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= esc($v['target']) ?></td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= esc($v['type']) ?></td>
          <td class="px-6 py-4 whitespace-nowrap">
            <?php
            $sevBadge = $v['severity'] === 'Critical' ? 'bg-red-100 text-red-800 font-bold' : 
                       ($v['severity'] === 'High' ? 'bg-orange-100 text-orange-800' : 
                       ($v['severity'] === 'Medium' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'));
            ?>
            <span class="inline-flex px-2 py-1 text-xs rounded-full <?= $sevBadge ?>">
              <?= esc($v['severity']) ?>
            </span>
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('d F Y', strtotime($v['date'])) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
/* Enhanced Dashboard Header Styles */
.bg-grid-pattern {
  background-image: 
    linear-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
  background-size: 20px 20px;
}

/* Glass morphism effect */
.backdrop-blur-sm {
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

/* Enhanced animations */
@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-10px) rotate(2deg); }
}

.float-animation {
  animation: float 6s ease-in-out infinite;
}

/* Pulse animation for status indicators */
@keyframes statusPulse {
  0%, 100% { 
    opacity: 1;
    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
  }
  50% { 
    opacity: 0.8;
    box-shadow: 0 0 0 8px rgba(34, 197, 94, 0);
  }
}

.animate-status-pulse {
  animation: statusPulse 2s infinite;
}

/* Header card hover effects */
.header-card {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.header-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Quick menu animation */
.quick-menu-slide {
  animation: slideDown 0.2s ease-out;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .dashboard-header {
    padding: 1rem;
  }
  
  .dashboard-header h1 {
    font-size: 1.5rem;
  }
  
  .header-stats {
    flex-direction: column;
    gap: 0.75rem;
  }
}
</style>
<script>
// Header system status updates for new UI
function updateSystemStatus() {
  const statusIndicators = document.querySelectorAll('.animate-pulse');
  statusIndicators.forEach(indicator => {
    indicator.style.opacity = '0.7';
    setTimeout(() => {
      indicator.style.opacity = '1';
    }, 200);
  });
}

setInterval(updateSystemStatus, 5000);

// Basic entrance animations for UI
function initializeHeaderAnimations() {
  const headerElements = document.querySelectorAll('.dashboard-card');
  headerElements.forEach((element, index) => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(-10px)';
    
    setTimeout(() => {
      element.style.transition = 'all 0.5s ease';
      element.style.opacity = '1';
      element.style.transform = 'translateY(0)';
    }, index * 100);
  });
}

// Smooth loading state for action links
document.querySelectorAll('a[href^="/"]').forEach(link => {
  link.addEventListener('click', function(e) {
    if (this.classList.contains('btn-primary') || 
        this.classList.contains('btn-secondary') || 
        this.classList.contains('btn-success')) {
      
      const originalText = this.innerHTML;
      this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
      this.style.pointerEvents = 'none';
      
      setTimeout(() => {
        this.innerHTML = originalText;
        this.style.pointerEvents = 'auto';
      }, 1500);
    }
  });
});

// Set IDs for updating values dynamically
document.querySelectorAll('.text-3xl.font-bold').forEach((el, index) => {
    if(index === 0) el.id = 'secScoreTxt';
});

// Real-time SSE Logic
function initSSE() {
  if (typeof(EventSource) !== "undefined") {
    // Only subscribe if we are on the dashboard
    const source = new EventSource("/dashboard/stream");
    const feedContainer = document.getElementById("liveThreatFeed");
    
    source.onmessage = function(event) {
      if(feedContainer.innerHTML.includes('Menunggu')) {
          feedContainer.innerHTML = '';
      }
      
      const payload = JSON.parse(event.data);
      
      // Update UI elements from payload
      const scoreTxt = document.getElementById('secScoreTxt');
      if(scoreTxt && payload.security_score) {
          scoreTxt.innerHTML = payload.security_score + '%';
          if(payload.security_score < 60) scoreTxt.className = 'text-3xl font-bold text-red-600';
          else if(payload.security_score < 80) scoreTxt.className = 'text-3xl font-bold text-yellow-600';
          else scoreTxt.className = 'text-3xl font-bold text-green-600';
      }
      
      const threat = payload.threat_map;
      
      // Build Threat Feed Item
      const severityColor = threat.severity === 'Critical' ? 'text-red-500' : (threat.severity === 'High' ? 'text-orange-500' : 'text-yellow-400');
      const timeStr = new Date(threat.timestamp).toLocaleTimeString();
      
      const logEntry = document.createElement('div');
      logEntry.className = `p-2 rounded bg-black/40 border-l-2 ${threat.severity === 'Critical' ? 'border-red-500' : 'border-orange-500'} animate-fade-in`;
      logEntry.innerHTML = `
        <div class="flex justify-between items-center mb-1">
            <span class="text-[10px] text-gray-400">[${timeStr}]</span>
            <span class="text-[10px] font-bold ${severityColor} uppercase">${threat.severity}</span>
        </div>
        <div class="flex items-center text-sm">
            <i class="fas fa-crosshairs text-green-400 mr-2"></i>
            <span class="text-gray-200">Attack deteksi dari <span class="font-bold text-white">${threat.source}</span></span>
        </div>
        <div class="text-[10px] text-gray-400 mt-1">Proto: ${threat.protocol} | Lat: ${threat.lat}, Lon: ${threat.lon}</div>
      `;
      
      feedContainer.insertBefore(logEntry, feedContainer.firstChild);
      
      // Keep only last 10 entries
      if (feedContainer.children.length > 10) {
          feedContainer.removeChild(feedContainer.lastChild);
      }
    };
  } else {
    document.getElementById("liveThreatFeed").innerHTML = "Browser Anda tidak mendukung Server-Sent Events.";
  }
}

document.addEventListener('DOMContentLoaded', function() {
  initializeHeaderAnimations();
  updateSystemStatus();
  initSSE();
  console.log('New Integrated SIEM Dashboard initialized successfully');
});
</script>

<style>
@keyframes fadeInSlide {
    from { opacity: 0; transform: translateY(-5px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fadeInSlide 0.3s ease-out forwards;
}
</style>

<?= $this->endSection() ?>