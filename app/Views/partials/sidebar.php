<!-- Enhanced Sidebar -->
<aside 
  class="sidebar fixed inset-y-0 left-0 z-30 bg-white border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-medium lg:shadow-none"
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
    <ul class="space-y-1">
      <!-- Dashboard -->
      <li>
        <a href="<?= base_url('dashboard') ?>" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('dashboard')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
          <i class="fas fa-home w-5 mr-3 <?= (current_url() == base_url('dashboard')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- APPS & PAGES -->
      <li>
        <div class="nav-section mt-6 mb-2">
          <h3 class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">APPS & PAGES</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('certificates') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('certificates')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-envelope-open-text w-5 mr-3 <?= (current_url() == base_url('certificates')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Sertifikat Elektronik</span>
              <i class="fas fa-chevron-right ml-auto text-xs opacity-50"></i>
            </a>
          </li>
          <li>
            <a href="<?= base_url('signatures') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('signatures')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-key w-5 mr-3 <?= (current_url() == base_url('signatures')) ? 'text-white' : 'text-gray-400 group-hover:text-amber-500' ?> transition-colors"></i>
              <span>Tanda Tangan</span>
              <i class="fas fa-chevron-right ml-auto text-xs opacity-50"></i>
            </a>
          </li>
          <li>
            <a href="<?= base_url('jamming') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('jamming')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-broadcast-tower w-5 mr-3 <?= (current_url() == base_url('jamming')) ? 'text-white' : 'text-gray-400 group-hover:text-red-500' ?> transition-colors"></i>
              <span>Jamming</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('pentest') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('pentest')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-shield-alt w-5 mr-3 <?= (current_url() == base_url('pentest')) ? 'text-white' : 'text-gray-400 group-hover:text-green-500' ?> transition-colors"></i>
              <span>Penetration Testing</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('incidents') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('incidents')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-unlock-alt w-5 mr-3 <?= (current_url() == base_url('incidents')) ? 'text-white' : 'text-gray-400 group-hover:text-red-500' ?> transition-colors"></i>
              <span>Incident Handling</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('alerts') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('alerts')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-bell w-5 mr-3 <?= (current_url() == base_url('alerts')) ? 'text-white' : 'text-gray-400 group-hover:text-amber-500' ?> transition-colors"></i>
              <span>Alerts</span>
              <span class="ml-auto bg-amber-500 text-white text-xs px-2 py-0.5 rounded-full">12</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('threats') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('threats')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-bug w-5 mr-3 <?= (current_url() == base_url('threats')) ? 'text-white' : 'text-gray-400 group-hover:text-red-600' ?> transition-colors"></i>
              <span>Threat Detection</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- PARAMETER -->
      <li>
        <div class="nav-section mt-6 mb-2">
          <h3 class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">PARAMETER</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('master-data') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('master-data')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-database w-5 mr-3 <?= (current_url() == base_url('master-data')) ? 'text-white' : 'text-gray-400 group-hover:text-indigo-500' ?> transition-colors"></i>
              <span>Data Master</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- ANALYTICS & REPORTS -->
      <li>
        <div class="nav-section mt-6 mb-2">
          <h3 class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">ANALYTICS & REPORTS</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('analytics') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('analytics')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-chart-line w-5 mr-3 <?= (current_url() == base_url('analytics')) ? 'text-white' : 'text-gray-400 group-hover:text-green-500' ?> transition-colors"></i>
              <span>Analytics</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('reports') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('reports')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-file-chart-line w-5 mr-3 <?= (current_url() == base_url('reports')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Reports</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('compliance') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('compliance')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-shield-check w-5 mr-3 <?= (current_url() == base_url('compliance')) ? 'text-white' : 'text-gray-400 group-hover:text-green-600' ?> transition-colors"></i>
              <span>Compliance</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- LOG -->
      <li>
        <div class="nav-section mt-6 mb-2">
          <h3 class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">LOG</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('web-monitor') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('web-monitor')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-search w-5 mr-3 <?= (current_url() == base_url('web-monitor')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Monitoring Website</span>
              <i class="fas fa-chevron-right ml-auto text-xs opacity-50"></i>
            </a>
          </li>
            <li>
              <a href="<?= base_url('logs') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('logs')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
                <i class="fas fa-file-alt w-5 mr-3 <?= (current_url() == base_url('logs')) ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' ?> transition-colors"></i>
                <span>Security Logs</span>
              </a>
            </li>
        </ul>
      </li>

      <!-- SISTEM & AKUN -->
      <li>
        <div class="nav-section mt-6 mb-2">
          <h3 class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">SISTEM & AKUN</h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('settings') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('settings')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-cog w-5 mr-3 <?= (current_url() == base_url('settings')) ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' ?> transition-colors"></i>
              <span>Pengaturan Sistem</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('integrations') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('integrations')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-plug w-5 mr-3 <?= (current_url() == base_url('integrations')) ? 'text-white' : 'text-gray-400 group-hover:text-purple-500' ?> transition-colors"></i>
              <span>Integrasi (API)</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('users') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('users')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="far fa-user w-5 mr-3 <?= (current_url() == base_url('users')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Manajemen Pengguna</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('logout') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group text-gray-600 hover:bg-red-50 hover:text-red-600">
              <i class="fas fa-sign-out-alt w-5 mr-3 text-gray-400 group-hover:text-red-500 transition-colors"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>

  </nav>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div 
  class="sidebar-overlay fixed inset-0 bg-black bg-opacity-50 z-20 lg:hidden hidden"
  id="sidebarOverlay"
  aria-hidden="true"
></div>