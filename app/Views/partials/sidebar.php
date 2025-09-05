<!-- Enhanced Sidebar -->
<aside 
  class="sidebar fixed lg:static inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-medium lg:shadow-none"
  id="sidebar"
  role="navigation"
  aria-label="Main navigation"
>
  <!-- Sidebar Header -->
  <div class="sidebar-header flex items-center justify-between p-4 border-b border-gray-200 lg:hidden">
    <div class="flex items-center space-x-3">
      <div class="w-8 h-8 bg-gradient-to-br from-siem-primary to-siem-accent rounded-lg flex items-center justify-center">
        <i class="fas fa-shield-alt text-white text-sm"></i>
      </div>
      <span class="font-bold text-gray-900">SIEM Platform</span>
    </div>
    <button 
      class="sidebar-close p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors"
      id="sidebarClose"
      aria-label="Close navigation menu"
    >
      <i class="fas fa-times"></i>
    </button>
  </div>

  <!-- Navigation Menu -->
  <nav class="sidebar-nav flex-1 overflow-y-auto scrollbar-hide p-4">
    <ul class="space-y-2">
      <!-- Dashboard -->
      <li>
        <a href="<?= base_url('dashboard') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group <?= (current_url() == base_url('dashboard')) ? 'active' : '' ?>">
          <i class="fas fa-tachometer-alt w-5 mr-3 text-gray-400 group-hover:text-siem-primary transition-colors"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- Security Monitoring -->
      <li>
        <div class="nav-section mt-6 mb-3">
          <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Security Monitoring</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('incidents') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-exclamation-triangle w-5 mr-3 text-gray-400 group-hover:text-siem-warning transition-colors"></i>
              <span>Incidents</span>
              <span class="ml-auto bg-siem-danger text-white text-xs px-2 py-0.5 rounded-full">5</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('alerts') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-bell w-5 mr-3 text-gray-400 group-hover:text-siem-warning transition-colors"></i>
              <span>Alerts</span>
              <span class="ml-auto bg-siem-warning text-white text-xs px-2 py-0.5 rounded-full">12</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('logs') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-file-alt w-5 mr-3 text-gray-400 group-hover:text-siem-info transition-colors"></i>
              <span>Security Logs</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('threats') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-bug w-5 mr-3 text-gray-400 group-hover:text-siem-danger transition-colors"></i>
              <span>Threat Detection</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Analytics & Reports -->
      <li>
        <div class="nav-section mt-6 mb-3">
          <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Analytics & Reports</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('analytics') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-chart-line w-5 mr-3 text-gray-400 group-hover:text-siem-success transition-colors"></i>
              <span>Analytics</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('reports') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-file-chart-line w-5 mr-3 text-gray-400 group-hover:text-siem-info transition-colors"></i>
              <span>Reports</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('compliance') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-shield-check w-5 mr-3 text-gray-400 group-hover:text-siem-success transition-colors"></i>
              <span>Compliance</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- System Management -->
      <li>
        <div class="nav-section mt-6 mb-3">
          <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">System Management</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('users') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-users w-5 mr-3 text-gray-400 group-hover:text-siem-primary transition-colors"></i>
              <span>User Management</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('settings') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-cog w-5 mr-3 text-gray-400 group-hover:text-gray-600 transition-colors"></i>
              <span>System Settings</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('integrations') ?>" class="nav-link flex items-center px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 hover:text-gray-900 transition-all duration-200 group">
              <i class="fas fa-plug w-5 mr-3 text-gray-400 group-hover:text-siem-accent transition-colors"></i>
              <span>Integrations</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>

    <!-- System Status Card -->
    <div class="mt-8 p-4 bg-gradient-to-br from-siem-primary/5 to-siem-accent/5 rounded-lg border border-siem-primary/10">
      <div class="flex items-center space-x-3 mb-3">
        <div class="w-8 h-8 bg-siem-success rounded-full flex items-center justify-center">
          <i class="fas fa-check text-white text-sm"></i>
        </div>
        <div>
          <h4 class="text-sm font-semibold text-gray-900">System Status</h4>
          <p class="text-xs text-gray-500">All systems operational</p>
        </div>
      </div>
      <div class="space-y-2">
        <div class="flex justify-between text-xs">
          <span class="text-gray-600">CPU Usage</span>
          <span class="font-medium text-gray-900">45%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-1.5">
          <div class="bg-siem-success h-1.5 rounded-full" style="width: 45%"></div>
        </div>
        <div class="flex justify-between text-xs">
          <span class="text-gray-600">Memory</span>
          <span class="font-medium text-gray-900">62%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-1.5">
          <div class="bg-siem-info h-1.5 rounded-full" style="width: 62%"></div>
        </div>
      </div>
    </div>
  </nav>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div 
  class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"
  id="sidebarOverlay"
  aria-hidden="true"
></div>