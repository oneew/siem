<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Enhanced Dashboard Header -->
<div class="mb-8">
  <!-- Main Header Card -->
  <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="relative px-8 py-6">
      <!-- Background Pattern -->
      <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
      <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full transform translate-x-32 -translate-y-32"></div>
      
      <!-- Header Content -->
      <div class="relative flex flex-col lg:flex-row items-center justify-between gap-6">
        <div class="flex items-center space-x-6">
          <!-- Logo/Icon -->
          <div class="w-16 h-16 bg-white bg-opacity-20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
            <i class="fas fa-shield-alt text-2xl text-white"></i>
          </div>
          
          <!-- Title Section -->
          <div>
            <h1 class="text-3xl font-bold text-white mb-1 tracking-tight">
              Security Operations Center
            </h1>
            <p class="text-blue-100 text-lg font-medium">
              Real-time monitoring & threat intelligence
            </p>
            <div class="flex flex-wrap items-center gap-4 mt-2">
              <div class="flex items-center space-x-2 text-blue-200 text-sm">
                <i class="fas fa-clock w-4"></i>
                <span>Last sync: <span id="lastUpdated" class="font-medium"><?= date('H:i:s') ?></span></span>
              </div>
              <div class="flex items-center space-x-2 text-blue-200 text-sm">
                <i class="fas fa-calendar w-4"></i>
                <span><?= date('M j, Y') ?></span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Status Indicators -->
        <div class="flex flex-wrap items-center gap-4">
          <!-- System Status -->
          <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white border-opacity-20">
            <div class="flex items-center space-x-3">
              <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse shadow-lg"></div>
                <span class="text-white font-semibold text-sm">System Online</span>
              </div>
              <div class="w-px h-6 bg-white bg-opacity-30"></div>
              <div class="text-right">
                <div class="text-white font-bold text-lg">99.9%</div>
                <div class="text-blue-200 text-xs">Uptime</div>
              </div>
            </div>
          </div>
          
          <!-- Alert Level -->
          <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-xl px-4 py-3 border border-white border-opacity-20">
            <div class="flex items-center space-x-3">
              <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse shadow-lg"></div>
                <span class="text-white font-semibold text-sm">Alert Level</span>
              </div>
              <div class="w-px h-6 bg-white bg-opacity-30"></div>
              <div class="text-right">
                <div class="text-white font-bold text-lg">LOW</div>
                <div class="text-blue-200 text-xs">Threat</div>
              </div>
            </div>
          </div>
          
          <!-- Quick Access Menu -->
          <div class="relative">
            <button class="w-12 h-12 bg-white bg-opacity-10 backdrop-blur-sm hover:bg-opacity-20 rounded-xl border border-white border-opacity-20 flex items-center justify-center transition-all duration-200 group" onclick="toggleQuickMenu()">
              <i class="fas fa-ellipsis-v text-white group-hover:scale-110 transition-transform"></i>
            </button>
            
            <!-- Quick Menu Dropdown -->
            <div id="quickMenu" class="hidden absolute right-0 top-14 w-48 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden z-50">
              <div class="p-2">
                <a href="/incidents/create" class="flex items-center space-x-3 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                  <i class="fas fa-plus w-4 text-blue-600"></i>
                  <span>New Incident</span>
                </a>
                <a href="/alerts" class="flex items-center space-x-3 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                  <i class="fas fa-bell w-4 text-orange-600"></i>
                  <span>View Alerts</span>
                </a>
                <a href="/reports" class="flex items-center space-x-3 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                  <i class="fas fa-chart-line w-4 text-green-600"></i>
                  <span>Generate Report</span>
                </a>
                <div class="border-t border-gray-200 my-2"></div>
                <a href="/settings" class="flex items-center space-x-3 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                  <i class="fas fa-cog w-4 text-gray-600"></i>
                  <span>Settings</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bottom Stats Bar -->
    <div class="bg-black bg-opacity-20 px-8 py-4">
      <div class="flex flex-wrap items-center justify-between gap-4 text-sm">
        <div class="flex flex-wrap items-center gap-6">
          <div class="flex items-center space-x-2 text-blue-200">
            <i class="fas fa-server w-4"></i>
            <span>12 Endpoints</span>
          </div>
          <div class="flex items-center space-x-2 text-blue-200">
            <i class="fas fa-network-wired w-4"></i>
            <span>3 Networks</span>
          </div>
          <div class="flex items-center space-x-2 text-blue-200">
            <i class="fas fa-eye w-4"></i>
            <span><?= $totalIncidents ?> Incidents Monitored</span>
          </div>
        </div>
        <div class="text-blue-200">
          <span>Security Score: </span>
          <span class="text-white font-bold">A+</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Security Metrics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
  <!-- Total Incidents -->
  <div class="dashboard-card">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Total Incidents</p>
        <p class="text-3xl font-bold text-gray-900"><?= $totalIncidents ?></p>
        <p class="text-xs text-gray-400 mt-1">All time</p>
      </div>
      <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
        <i class="fas fa-exclamation-triangle text-blue-600 text-xl"></i>
      </div>
    </div>
  </div>

  <!-- Open Incidents -->
  <div class="dashboard-card">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Open Incidents</p>
        <p class="text-3xl font-bold text-orange-600"><?= $openIncidents ?></p>
        <p class="text-xs text-gray-400 mt-1">Active</p>
      </div>
      <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
        <i class="fas fa-clock text-orange-600 text-xl"></i>
      </div>
    </div>
    <div class="px-6 pb-6">
      <div class="w-full bg-gray-200 rounded-full h-2">
        <div class="bg-orange-500 h-2 rounded-full" style="width: <?= $totalIncidents > 0 ? ($openIncidents / $totalIncidents * 100) : 0 ?>%"></div>
      </div>
    </div>
  </div>

  <!-- Resolved Incidents -->
  <div class="dashboard-card">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Resolved</p>
        <p class="text-3xl font-bold text-green-600"><?= $closedIncidents ?></p>
        <p class="text-xs text-green-500 mt-1">+12% this week</p>
      </div>
      <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
        <i class="fas fa-check-circle text-green-600 text-xl"></i>
      </div>
    </div>
    <div class="px-6 pb-6">
      <div class="w-full bg-gray-200 rounded-full h-2">
        <div class="bg-green-500 h-2 rounded-full" style="width: <?= $totalIncidents > 0 ? ($closedIncidents / $totalIncidents * 100) : 0 ?>%"></div>
      </div>
    </div>
  </div>

  <!-- Critical Incidents -->
  <div class="dashboard-card">
    <div class="flex items-center justify-between p-6">
      <div>
        <p class="text-sm font-medium text-gray-500 mb-1">Critical</p>
        <p class="text-3xl font-bold text-red-600"><?= $criticalIncidents ?></p>
        <p class="text-xs text-red-500 mt-1">Needs attention</p>
      </div>
      <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
        <i class="fas fa-fire text-red-600 text-xl"></i>
      </div>
    </div>
    <?php if ($criticalIncidents > 0): ?>
    <div class="px-6 pb-6 flex items-center space-x-2">
      <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
      <span class="text-xs text-red-600 font-medium">Immediate action required</span>
    </div>
    <?php endif; ?>
  </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  <!-- Recent Incidents Table -->
  <div class="lg:col-span-2">
    <div class="dashboard-card">
      <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-list-alt mr-2 text-gray-500"></i>
            Recent Incidents
          </h3>
          <a href="/incidents" class="text-sm text-blue-600 hover:text-blue-800 font-medium">View all</a>
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table class="w-full modern-table">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Incident</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Severity</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach($latestIncidents as $i): ?>
            <tr class="hover:bg-gray-50 transition-colors">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900"><?= esc($i['title']) ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-600 font-mono"><?= esc($i['source_ip']) ?></div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <?php
                $severityColors = [
                  'Low' => 'bg-green-100 text-green-800',
                  'Medium' => 'bg-yellow-100 text-yellow-800', 
                  'High' => 'bg-orange-100 text-orange-800',
                  'Critical' => 'bg-red-100 text-red-800'
                ];
                ?>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= $severityColors[$i['severity']] ?? 'bg-gray-100 text-gray-800' ?>">
                  <?= esc($i['severity']) ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <?php
                $statusColors = [
                  'Open' => 'bg-blue-100 text-blue-800',
                  'In Progress' => 'bg-yellow-100 text-yellow-800',
                  'Resolved' => 'bg-green-100 text-green-800',
                  'Closed' => 'bg-gray-100 text-gray-800'
                ];
                ?>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full <?= $statusColors[$i['status']] ?? 'bg-gray-100 text-gray-800' ?>">
                  <?= esc($i['status']) ?>
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?= date('M j, H:i', strtotime($i['created_at'])) ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      
      <?php if (empty($latestIncidents)): ?>
      <div class="text-center py-12">
        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
        <p class="text-gray-500">No recent incidents</p>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Sidebar Charts & Info -->
  <div class="space-y-6">
    <!-- Severity Distribution Chart -->
    <div class="dashboard-card">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
          <i class="fas fa-chart-pie mr-2 text-gray-500"></i>
          Severity Distribution
        </h3>
      </div>
      <div class="p-6">
        <div class="relative">
          <canvas id="severityChart" height="200"></canvas>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="dashboard-card">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
          <i class="fas fa-bolt mr-2 text-gray-500"></i>
          Quick Actions
        </h3>
      </div>
      <div class="p-6 space-y-3">
        <a href="/incidents/create" class="w-full btn btn-primary">
          <i class="fas fa-plus mr-2"></i>
          New Incident
        </a>
        <a href="/alerts" class="w-full btn btn-secondary">
          <i class="fas fa-bell mr-2"></i>
          View Alerts
        </a>
        <a href="/reports" class="w-full btn btn-success">
          <i class="fas fa-chart-line mr-2"></i>
          Generate Report
        </a>
      </div>
    </div>

    <!-- System Health -->
    <div class="dashboard-card">
      <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
          <i class="fas fa-heart mr-2 text-gray-500"></i>
          System Health
        </h3>
      </div>
      <div class="p-6 space-y-3">
        <div class="flex items-center justify-between">
          <span class="text-sm text-gray-600">Database</span>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <span class="text-sm font-medium text-green-600">Healthy</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-sm text-gray-600">API Services</span>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <span class="text-sm font-medium text-green-600">Online</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-sm text-gray-600">Monitoring</span>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span class="text-sm font-medium text-green-600">Active</span>
          </div>
        </div>
        <div class="flex items-center justify-between">
          <span class="text-sm text-gray-600">Last Backup</span>
          <span class="text-sm text-gray-500">2 hours ago</span>
        </div>
      </div>
    </div>
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
// Enhanced Dashboard Header Functions
function toggleQuickMenu() {
  const menu = document.getElementById('quickMenu');
  const isHidden = menu.classList.contains('hidden');
  
  if (isHidden) {
    menu.classList.remove('hidden');
    menu.classList.add('quick-menu-slide');
    // Close menu when clicking outside
    setTimeout(() => {
      document.addEventListener('click', closeQuickMenuOnOutside);
    }, 100);
  } else {
    menu.classList.add('hidden');
    menu.classList.remove('quick-menu-slide');
    document.removeEventListener('click', closeQuickMenuOnOutside);
  }
}

function closeQuickMenuOnOutside(event) {
  const menu = document.getElementById('quickMenu');
  const button = event.target.closest('button');
  
  if (!menu.contains(event.target) && !button) {
    menu.classList.add('hidden');
    menu.classList.remove('quick-menu-slide');
    document.removeEventListener('click', closeQuickMenuOnOutside);
  }
}

// Header status updates
function updateSystemStatus() {
  // Simulate real-time status updates
  const statusIndicators = document.querySelectorAll('.animate-pulse');
  statusIndicators.forEach(indicator => {
    // Add subtle color changes to indicate activity
    indicator.style.opacity = '0.7';
    setTimeout(() => {
      indicator.style.opacity = '1';
    }, 200);
  });
}

// Auto-update system status every 5 seconds
setInterval(updateSystemStatus, 5000);

// Enhanced header animations on load
function initializeHeaderAnimations() {
  const headerElements = document.querySelectorAll('.header-card, .bg-gradient-to-r');
  headerElements.forEach((element, index) => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(-20px)';
    
    setTimeout(() => {
      element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
      element.style.opacity = '1';
      element.style.transform = 'translateY(0)';
    }, index * 150);
  });
}

// Enhanced Severity Distribution Chart
const ctx = document.getElementById('severityChart');
const severityChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: <?= $severityLabels ?>,
    datasets: [{
      data: <?= $severityCounts ?>,
      backgroundColor: [
        '#10B981', // Green for Low
        '#F59E0B', // Yellow for Medium  
        '#F97316', // Orange for High
        '#EF4444'  // Red for Critical
      ],
      borderWidth: 0,
      hoverBorderWidth: 2,
      hoverBorderColor: '#ffffff'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    cutout: '60%',
    plugins: {
      legend: {
        position: 'bottom',
        labels: {
          padding: 20,
          usePointStyle: true,
          pointStyle: 'circle',
          font: {
            size: 12
          }
        }
      },
      tooltip: {
        backgroundColor: 'rgba(0, 0, 0, 0.8)',
        titleColor: '#ffffff',
        bodyColor: '#ffffff',
        borderColor: '#e5e7eb',
        borderWidth: 1,
        cornerRadius: 8,
        displayColors: false
      }
    },
    interaction: {
      intersect: false,
      mode: 'index'
    },
    animation: {
      animateRotate: true,
      animateScale: true,
      duration: 1000
    }
  }
});

// Auto-refresh functionality
let lastUpdateTime = new Date();

function updateLastUpdatedTime() {
  const now = new Date();
  const timeString = now.toLocaleTimeString('en-US', { 
    hour12: false,
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  });
  document.getElementById('lastUpdated').textContent = timeString;
  lastUpdateTime = now;
}

// Update time every second
setInterval(updateLastUpdatedTime, 1000);

// Auto-refresh dashboard data every 30 seconds
setInterval(function() {
  console.log('Dashboard would refresh data from server');
  // In production: fetch('/dashboard/data').then(data => updateDashboard(data));
}, 30000);

// Smooth scroll for quick action links
document.querySelectorAll('a[href^="/"]').forEach(link => {
  link.addEventListener('click', function(e) {
    // Add loading state for better UX
    const button = this;
    const originalText = button.innerHTML;
    
    if (button.classList.contains('btn-primary') || 
        button.classList.contains('btn-secondary') || 
        button.classList.contains('btn-success')) {
      
      button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...';
      button.style.pointerEvents = 'none';
      
      setTimeout(() => {
        button.innerHTML = originalText;
        button.style.pointerEvents = 'auto';
      }, 1500);
    }
  });
});

// Initialize dashboard
document.addEventListener('DOMContentLoaded', function() {
  updateLastUpdatedTime();
  initializeHeaderAnimations();
  
  // Add entrance animations for cards
  const cards = document.querySelectorAll('.grid > div');
  cards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
      card.style.transition = 'all 0.5s ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, (index * 100) + 600); // Delay after header animation
  });
  
  // Initialize header status pulse animation
  updateSystemStatus();
  
  console.log('Enhanced SIEM Dashboard initialized successfully');
});

// Responsive chart resize
window.addEventListener('resize', function() {
  if (severityChart) {
    severityChart.resize();
  }
});
</script>

<?= $this->endSection() ?>