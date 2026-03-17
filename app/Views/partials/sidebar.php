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
      <!-- Command Center -->
      <li>
        <a href="<?= base_url('dashboard') ?>" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('dashboard')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
          <i class="fas fa-satellite-dish w-5 mr-3 <?= (current_url() == base_url('dashboard')) ? 'text-white' : 'text-indigo-500 group-hover:text-blue-500' ?> transition-colors"></i>
          <span>Command Center</span>
        </a>
      </li>

      <!-- BLUE TEAM -->
      <li>
        <div class="nav-section mt-6 mb-2">
          <h3 class="px-4 text-xs font-bold text-blue-500 uppercase tracking-wider flex items-center">
            <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span> 🔵 Blue Team (SIEM & SOC)
          </h3>
        </div>
        <ul class="space-y-1">
          <li>
            <a href="<?= base_url('alerts') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('alerts')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-bell w-5 mr-3 <?= (current_url() == base_url('alerts')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Security Alerts</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('incidents-v2') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('incidents-v2')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-ticket-alt w-5 mr-3 <?= (current_url() == base_url('incidents-v2')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Incident Management</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('threats') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('threats')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-bug w-5 mr-3 <?= (current_url() == base_url('threats')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
              <span>Threat Intelligence Feed</span>
      <?php $role = session()->get('role') ?? 'admin'; // 'admin', 'blue_team', 'red_team', 'c_level' ?>

      <ul class="space-y-1 mt-6">
        <!-- Main Dashboard -->
        <li>
          <a href="<?= base_url('dashboard') ?>" class="nav-link flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('dashboard')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <span class="p-1.5 rounded-lg mr-3 <?= (current_url() == base_url('dashboard')) ? 'bg-blue-600' : 'bg-gray-100 dark:bg-gray-800 group-hover:bg-white dark:group-hover:bg-gray-700' ?> transition-colors shadow-sm">
              <i class="fas fa-home w-4 text-center <?= (current_url() == base_url('dashboard')) ? 'text-white' : 'text-blue-500' ?>"></i>
            </span>
            <span class="flex-1">Command Center</span>
          </a>
        </li>
      </ul>

      <?php if (in_array($role, ['admin', 'blue_team'])): ?>
      <!-- SIEM & SOC (Blue Team) -->
      <div class="mt-8 mb-2 px-4">
        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center">
          <i class="fas fa-shield-alt mr-2 text-blue-500"></i> Blue Team (SIEM)
        </h3>
      </div>
      <ul class="space-y-1">
        <!-- Incidents List -->
        <li>
          <a href="<?= base_url('incidents-v2') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('incidents-v2')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-ticket-alt w-5 mr-3 <?= (current_url() == base_url('incidents-v2')) ? 'text-white' : 'text-gray-400 group-hover:text-blue-500' ?> transition-colors"></i>
            <span>Incident Management</span>
            <span class="ml-auto bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-400 py-0.5 px-2 rounded-full text-xs font-bold">12</span>
          </a>
        </li>
      </ul>
      <?php endif; ?>

      <?php if (in_array($role, ['admin', 'red_team'])): ?>
      <!-- Pentesting (Red Team) -->
      <div class="mt-8 mb-2 px-4">
        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center">
          <i class="fas fa-user-ninja mr-2 text-red-500"></i> Red Team (Pentest)
        </h3>
      </div>
      <ul class="space-y-1">
        <li>
          <a href="<?= base_url('redteam/targets') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('redteam/targets')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-bullseye w-5 mr-3 <?= (current_url() == base_url('redteam/targets')) ? 'text-white' : 'text-gray-400 group-hover:text-red-500' ?> transition-colors"></i>
            <span>Target Management</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('redteam/vulnerabilities') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('redteam/vulnerabilities')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-bug w-5 mr-3 <?= (current_url() == base_url('redteam/vulnerabilities')) ? 'text-white' : 'text-gray-400 group-hover:text-red-500' ?> transition-colors"></i>
            <span>Vulnerabilities</span>
            <span class="ml-auto bg-red-100 text-red-600 py-0.5 px-2 rounded-full text-xs font-bold">5</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('redteam/playbooks-v2') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('redteam/playbooks-v2')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-book-open w-5 mr-3 <?= (current_url() == base_url('redteam/playbooks-v2')) ? 'text-white' : 'text-gray-400 group-hover:text-red-500' ?> transition-colors"></i>
            <span>Playbooks</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('pentest-reports') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('pentest-reports')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-file-pdf w-5 mr-3 <?= (current_url() == base_url('pentest-reports')) ? 'text-white' : 'text-gray-400 group-hover:text-red-500' ?> transition-colors"></i>
            <span>Laporan (Reports)</span>
          </a>
        </li>
      </ul>
      <?php endif; ?>

      <?php if (in_array($role, ['admin', 'blue_team'])): ?>
      <!-- DFIR (Forensics) -->
      <div class="mt-8 mb-2 px-4">
        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center">
          <i class="fas fa-microscope mr-2 text-amber-500"></i> DFIR
        </h3>
      </div>
      <ul class="space-y-1">
        <li>
          <a href="<?= base_url('dfir/analyzer') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('dfir/analyzer')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-spider w-5 mr-3 <?= (current_url() == base_url('dfir/analyzer')) ? 'text-white' : 'text-gray-400 group-hover:text-amber-500' ?> transition-colors"></i>
            <span>Malware AI Analyzer</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('dfir/evidence') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('dfir/evidence')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-box-open w-5 mr-3 <?= (current_url() == base_url('dfir/evidence')) ? 'text-white' : 'text-gray-400 group-hover:text-amber-500' ?> transition-colors"></i>
            <span>Evidence Locker</span>
          </a>
        </li>
      </ul>
      <?php endif; ?>

      <?php if (in_array($role, ['admin', 'blue_team'])): ?>
      <!-- Persandian & Kripto -->
      <div class="mt-8 mb-2 px-4">
        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center">
          <i class="fas fa-key mr-2 text-emerald-500"></i> Persandian & Kripto
        </h3>
      </div>
      <ul class="space-y-1">
        <li>
          <a href="<?= base_url('crypto/certificate') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('crypto/certificate')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-file-signature w-5 mr-3 <?= (current_url() == base_url('crypto/certificate')) ? 'text-white' : 'text-gray-400 group-hover:text-emerald-500' ?> transition-colors"></i>
            <span>Sertifikat TTE</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('crypto/stegano') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('crypto/stegano')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-eye-slash w-5 mr-3 <?= (current_url() == base_url('crypto/stegano')) ? 'text-white' : 'text-gray-400 group-hover:text-emerald-500' ?> transition-colors"></i>
            <span>Steganography</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('hash-verifier') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('hash-verifier')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-hashtag w-5 mr-3 <?= (current_url() == base_url('hash-verifier')) ? 'text-white' : 'text-gray-400 group-hover:text-emerald-500' ?> transition-colors"></i>
            <span>Hash Verifier</span>
          </a>
        </li>
      </ul>
      <?php endif; ?>

      <?php if (in_array($role, ['admin', 'blue_team'])): ?>
      <!-- AI Nexus -->
      <div class="mt-8 mb-2 px-4">
        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center">
          <i class="fas fa-brain mr-2 text-indigo-500"></i> AI Nexus
        </h3>
      </div>
      <ul class="space-y-1">
        <li>
          <a href="<?= base_url('ai/log-analyzer') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('ai/log-analyzer')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-file-code w-5 mr-3 <?= (current_url() == base_url('ai/log-analyzer')) ? 'text-white' : 'text-gray-400 group-hover:text-indigo-500' ?> transition-colors"></i>
            <span>Log Analyzer</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('ai/remediation') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('ai/remediation')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-magic w-5 mr-3 <?= (current_url() == base_url('ai/remediation')) ? 'text-white' : 'text-gray-400 group-hover:text-indigo-500' ?> transition-colors"></i>
            <span>Automated Remediation</span>
          </a>
        </li>
      </ul>
      <?php endif; ?>

      <?php if (in_array($role, ['admin', 'blue_team', 'c_level'])): ?>
      <!-- Monitoring -->
      <div class="mt-8 mb-2 px-4">
        <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center">
          <i class="fas fa-tv mr-2 text-teal-500"></i> Monitoring
        </h3>
      </div>
      <ul class="space-y-1 mb-8">
        <li>
          <a href="<?= base_url('website-monitor') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('website-monitor')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-globe w-5 mr-3 <?= (current_url() == base_url('website-monitor')) ? 'text-white' : 'text-gray-400 group-hover:text-teal-500' ?> transition-colors"></i>
            <span>Defacement Monitor</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('osint') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('osint')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-search-location w-5 mr-3 <?= (current_url() == base_url('osint')) ? 'text-white' : 'text-gray-400 group-hover:text-teal-500' ?> transition-colors"></i>
            <span>OSINT (Threat Intel)</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('assets') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('assets')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' ?>">
            <i class="fas fa-network-wired w-5 mr-3 <?= (current_url() == base_url('assets')) ? 'text-white' : 'text-gray-400 group-hover:text-teal-500' ?> transition-colors"></i>
            <span>Manajemen Aset (Scan)</span>
          </a>
        </li>
      </ul>
      <?php endif; ?>
      <!-- PENGATURAN SISTEM -->
      <li>
        <div class="nav-section mt-6 mb-2 border-t border-gray-200 pt-6">
          <h3 class="px-4 text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center">
            <i class="fas fa-cog mr-2"></i> Pengaturan
          </h3>
        </div>
        <ul class="space-y-1 pb-4">
          <li>
            <a href="<?= base_url('master-data') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('master-data')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-database w-5 mr-3 <?= (current_url() == base_url('master-data')) ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' ?> transition-colors"></i>
              <span>Data Master</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('users') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('users')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-users-cog w-5 mr-3 <?= (current_url() == base_url('users')) ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' ?> transition-colors"></i>
              <span>Manajemen Pengguna & RBAC</span>
            </a>
          </li>
          <li>
            <a href="<?= base_url('integrations') ?>" class="nav-link flex items-center px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 group <?= (current_url() == base_url('integrations')) ? 'active bg-blue-500 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' ?>">
              <i class="fas fa-network-wired w-5 mr-3 <?= (current_url() == base_url('integrations')) ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' ?> transition-colors"></i>
              <span>API Integrations</span>
            </a>
          </li>
          
          <li class="mt-4">
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