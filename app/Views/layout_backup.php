<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'SIEM Platform - Security Management Dashboard') ?></title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'siem-primary': '#1e40af',
            'siem-secondary': '#3b82f6',
            'siem-dark': '#0f172a',
            'siem-danger': '#dc2626',
            'siem-warning': '#f59e0b',
            'siem-success': '#059669',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-50 font-sans">
  <div class="admin-layout">
    <!-- Enhanced Sidebar -->
    <aside class="sidebar bg-siem-dark text-white flex flex-col" id="sidebar">
      <div class="sidebar-header border-b border-gray-700 p-6 flex-shrink-0">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
            <i class="fas fa-shield-alt text-lg"></i>
          </div>
          <div>
            <span class="sidebar-logo text-xl font-bold">SIEM Platform</span>
            <p class="text-xs text-gray-400 mt-1">Security Management</p>
          </div>
        </div>
      </div>
      
      <nav class="sidebar-nav p-4 space-y-2 flex-1 overflow-y-auto">
        <!-- Security Status Dashboard -->
        <div class="bg-gray-800 rounded-lg p-3 mb-4 border border-gray-700">
          <div class="flex items-center justify-between mb-2">
            <h4 class="text-xs font-semibold text-gray-300 uppercase tracking-wider">Security Status</h4>
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
          </div>
          <div class="grid grid-cols-2 gap-2 text-xs">
            <div class="bg-red-900 bg-opacity-50 px-2 py-1 rounded text-red-300 text-center">
              <div class="font-bold">3</div>
              <div>Critical</div>
            </div>
            <div class="bg-orange-900 bg-opacity-50 px-2 py-1 rounded text-orange-300 text-center">
              <div class="font-bold">7</div>
              <div>Alerts</div>
            </div>
            <div class="bg-yellow-900 bg-opacity-50 px-2 py-1 rounded text-yellow-300 text-center">
              <div class="font-bold">12</div>
              <div>Threats</div>
            </div>
            <div class="bg-purple-900 bg-opacity-50 px-2 py-1 rounded text-purple-300 text-center">
              <div class="font-bold">2</div>
              <div>Cases</div>
            </div>
          </div>
        </div>
        <!-- Dashboard -->
        <a href="/dashboard" class="nav-link group <?= (current_url() == base_url('/dashboard')) ? 'active' : '' ?>">
          <i class="fas fa-tachometer-alt w-5"></i>
          <span>Dashboard</span>
          <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
            <i class="fas fa-chevron-right text-xs"></i>
          </div>
        </a>
        
        <!-- Security Operations -->
        <div class="nav-section">
          <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3 flex items-center">
            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse mr-2"></div>
            Security Operations
            <span class="ml-auto text-red-400 text-xs">24/7</span>
          </h4>
          
          <a href="/incidents" class="nav-link group <?= (strpos(current_url(), 'incidents') !== false) ? 'active' : '' ?>">
            <div class="relative">
              <i class="fas fa-exclamation-triangle w-5"></i>
              <div class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
            </div>
            <span>Incident Management</span>
            <div class="ml-auto flex items-center space-x-2">
              <span class="text-xs px-1.5 py-0.5 bg-red-500 text-white rounded-full font-medium opacity-0 group-hover:opacity-100 transition-opacity">CRITICAL</span>
              <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </div>
          </a>
          
          <a href="/alerts" class="nav-link group <?= (strpos(current_url(), 'alerts') !== false) ? 'active' : '' ?>">
            <div class="relative">
              <i class="fas fa-bell w-5"></i>
              <div class="absolute -top-1 -right-1 w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
            </div>
            <span>Security Alerts</span>
            <div class="ml-auto flex items-center space-x-2">
              <span class="text-xs px-1.5 py-0.5 bg-orange-500 text-white rounded-full font-medium">LIVE</span>
              <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">New</span>
            </div>
          </a>
          
          <a href="/threats" class="nav-link group <?= (strpos(current_url(), 'threats') !== false) ? 'active' : '' ?>">
            <div class="relative">
              <i class="fas fa-virus w-5"></i>
              <div class="absolute -top-1 -right-1 w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
            </div>
            <span>Threat Intelligence</span>
            <div class="ml-auto flex items-center space-x-2">
              <span class="text-xs px-1.5 py-0.5 bg-yellow-500 text-black rounded-full font-medium opacity-0 group-hover:opacity-100 transition-opacity">ACTIVE</span>
              <i class="fas fa-chevron-right text-xs opacity-0 group-hover:opacity-100 transition-opacity"></i>
            </div>
          </a>
          
          <a href="/asset-management" class="nav-link group <?= (strpos(current_url(), 'asset-management') !== false) ? 'active' : '' ?>">
            <i class="fas fa-server w-5"></i>
            <span>Asset Management</span>
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
              <i class="fas fa-chevron-right text-xs"></i>
            </div>
          </a>
        </div>
        
        <!-- Analysis & Reporting -->
        <div class="nav-section">
          <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3 flex items-center">
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse mr-2"></div>
            Analysis & Reporting
            <span class="ml-auto text-blue-400 text-xs">ACTIVE</span>
          </h4>
          
          <a href="/reports" class="nav-link group <?= (strpos(current_url(), 'reports') !== false) ? 'active' : '' ?>">
            <i class="fas fa-chart-line w-5"></i>
            <span>Reports & Analytics</span>
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
              <i class="fas fa-chevron-right text-xs"></i>
            </div>
          </a>
          
          <a href="/forensics" class="nav-link group <?= (strpos(current_url(), 'forensics') !== false) ? 'active' : '' ?>">
            <div class="relative">
              <i class="fas fa-search w-5"></i>
              <div class="absolute -top-1 -right-1 w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
            </div>
            <span>Digital Forensics</span>
            <div class="ml-auto flex items-center space-x-2">
              <span class="text-xs px-1.5 py-0.5 bg-purple-500 text-white rounded-full font-medium opacity-0 group-hover:opacity-100 transition-opacity">READY</span>
              <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">Beta</span>
            </div>
          </a>
          
          <!-- Playbook Management -->
          <a href="/playbooks" class="nav-link group <?= (strpos(current_url(), 'playbooks') !== false) ? 'active' : '' ?>">
            <div class="relative">
              <i class="fas fa-book w-5"></i>
              <div class="absolute -top-1 -right-1 w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            </div>
            <span>Incident Playbooks</span>
            <div class="ml-auto flex items-center space-x-2">
              <span class="text-xs px-1.5 py-0.5 bg-green-500 text-white rounded-full font-medium opacity-0 group-hover:opacity-100 transition-opacity">ACTIVE</span>
              <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">New</span>
            </div>
          </a>
        </div>
        
        <!-- Administration -->
        <?php if (session()->get('role') === 'Admin'): ?>
        <div class="nav-section">
          <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 px-3 flex items-center">
            <i class="fas fa-shield-check mr-2 text-green-500"></i>
            Administration
          </h4>
          
          <a href="/users" class="nav-link group <?= (strpos(current_url(), 'users') !== false) ? 'active' : '' ?>">
            <i class="fas fa-users w-5"></i>
            <span>User Management</span>
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
              <i class="fas fa-chevron-right text-xs"></i>
            </div>
          </a>
          
          <a href="/settings" class="nav-link group <?= (strpos(current_url(), 'settings') !== false) ? 'active' : '' ?>">
            <i class="fas fa-cog w-5"></i>
            <span>System Settings</span>
            <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity">
              <i class="fas fa-chevron-right text-xs"></i>
            </div>
          </a>
        </div>
        <?php endif; ?>
      </nav>
      
      <!-- Sidebar Footer -->
      <div class="p-4 border-t border-gray-700 flex-shrink-0">
        <div class="text-xs text-gray-400 text-center">
          <div class="flex items-center justify-center gap-2 mb-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span>System Online</span>
          </div>
          <p>Version 2.0.1</p>
        </div>
      </div>
    </aside>

    <!-- Enhanced Main Content -->
    <main class="main-content bg-gray-50">
      <!-- Enhanced Header -->
      <header class="header bg-white shadow-sm border-b border-gray-200 sticky top-0 z-20">
        <div class="flex items-center justify-between px-6 py-4">
          <!-- Left Side - Page Title & Breadcrumb -->
          <div class="flex items-center space-x-4">
            <!-- Mobile Menu Toggle -->
            <button class="sidebar-toggle lg:hidden text-gray-600 hover:text-gray-900" id="sidebarToggle">
              <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div>
              <h1 class="text-2xl font-bold text-gray-900"><?= esc($title ?? 'Dashboard') ?></h1>
              <div class="flex items-center text-sm text-gray-500 mt-1">
                <i class="fas fa-home mr-1"></i>
                <span>SIEM Platform</span>
                <?php if (isset($title) && $title !== 'Dashboard'): ?>
                  <i class="fas fa-chevron-right mx-2 text-xs"></i>
                  <span><?= esc($title) ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Right Side - Quick Actions & Profile -->
          <div class="flex items-center space-x-4">
            <!-- Quick Actions -->
            <div class="hidden md:flex items-center space-x-3">
              <!-- Security Status -->
              <div class="flex items-center space-x-2 px-3 py-2 bg-green-50 border border-green-200 rounded-lg">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium text-green-700">Secure</span>
              </div>
              
              <!-- Notification Bell -->
              <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
              </button>
              
              <!-- Quick Add -->
              <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors" title="Quick Add Incident">
                <i class="fas fa-plus text-lg"></i>
              </button>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
              <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors" id="profileMenuButton">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                  <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                </div>
                <div class="hidden md:block text-left">
                  <p class="text-sm font-semibold text-gray-900"><?= esc(session()->get('username')) ?></p>
                  <p class="text-xs text-gray-500"><?= esc(session()->get('role')) ?></p>
                </div>
                <i class="fas fa-chevron-down text-sm text-gray-400"></i>
              </button>

              <!-- Enhanced Dropdown Menu -->
              <div id="profileMenuDropdown" 
                   class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-xl z-50">
                <!-- Profile Info -->
                <div class="px-4 py-3 border-b border-gray-100">
                  <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                      <?= strtoupper(substr(session()->get('username'), 0, 1)) ?>
                    </div>
                    <div>
                      <p class="font-semibold text-gray-900"><?= esc(session()->get('username')) ?></p>
                      <p class="text-sm text-gray-500"><?= esc(session()->get('role')) ?></p>
                      <p class="text-xs text-gray-400">Last login: Today</p>
                    </div>
                  </div>
                </div>
                
                <!-- Menu Items -->
                <div class="py-2">
                  <a href="/change-password" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-key w-5 mr-3 text-gray-400"></i>
                    <span>Change Password</span>
                  </a>
                  <a href="/profile" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-user w-5 mr-3 text-gray-400"></i>
                    <span>Profile Settings</span>
                  </a>
                  <a href="/activity-log" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-history w-5 mr-3 text-gray-400"></i>
                    <span>Activity Log</span>
                  </a>
                </div>
                
                <!-- Logout -->
                <div class="border-t border-gray-100 py-2">
                  <a href="/logout" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                    <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                    <span>Sign Out</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
<!-- Flash Messages -->
<?php if(session()->getFlashdata('success')): ?>
  <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300">
    <strong>Sukses:</strong> <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
  <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800 border border-red-300">
    <strong>Error:</strong> <?= session()->getFlashdata('error') ?>
  </div>
<?php endif; ?>

      <!-- Dynamic Content -->
      <section class="page-content p-6">
        <?= $this->renderSection('content') ?>
      </section>
    </main>
  </div>



<!-- Toast Container -->
<div id="toast-container" class="fixed top-4 right-4 space-y-2 z-50"></div>

  <!-- Enhanced JavaScript -->
  <script>
    // Enhanced profile dropdown functionality
    document.addEventListener('DOMContentLoaded', () => {
      const profileBtn = document.getElementById('profileMenuButton');
      const profileMenu = document.getElementById('profileMenuDropdown');
      const sidebarToggle = document.getElementById('sidebarToggle');
      const sidebar = document.getElementById('sidebar');
      
      // Profile dropdown toggle
      if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', (e) => {
          e.stopPropagation();
          profileMenu.classList.toggle('hidden');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
          if (!profileBtn.contains(e.target) && !profileMenu.contains(e.target)) {
            profileMenu.classList.add('hidden');
          }
        });
      }
      
      // Sidebar toggle for mobile
      if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', () => {
          sidebar.classList.toggle('open');
        });
      }
      
      // Auto-hide flash messages
      const flashMessages = document.querySelectorAll('.mb-4');
      if (flashMessages.length) {
        setTimeout(() => {
          flashMessages.forEach(msg => {
            if (msg.classList.contains('bg-green-100') || msg.classList.contains('bg-red-100')) {
              msg.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
              msg.style.opacity = '0';
              msg.style.transform = 'translateY(-10px)';
              setTimeout(() => msg.remove(), 500);
            }
          });
        }, 5000);
      }
      
      // Active navigation highlighting
      const navLinks = document.querySelectorAll('.nav-link');
      const currentPath = window.location.pathname;
      
      navLinks.forEach(link => {
        const linkPath = new URL(link.href).pathname;
        if (currentPath === linkPath || (linkPath !== '/' && currentPath.startsWith(linkPath))) {
          link.classList.add('active');
        }
      });
      
      // Enhanced toast notifications
      window.showAdvancedToast = function(type, title, message, duration = 5000) {
        const container = document.getElementById('toast-container') || createToastContainer();
        
        const toast = document.createElement('div');
        toast.className = `toast-notification ${getToastClasses(type)} transform transition-all duration-500 translate-x-full opacity-0`;
        
        toast.innerHTML = `
          <div class="flex items-start space-x-3">
            <div class="flex-shrink-0">
              <i class="${getToastIcon(type)} text-lg"></i>
            </div>
            <div class="flex-1">
              <h4 class="font-semibold">${title}</h4>
              <p class="text-sm mt-1">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 opacity-70 hover:opacity-100">
              <i class="fas fa-times"></i>
            </button>
          </div>
        `;
        
        container.appendChild(toast);
        
        // Trigger animation
        setTimeout(() => {
          toast.classList.remove('translate-x-full', 'opacity-0');
        }, 50);
        
        // Auto remove
        setTimeout(() => {
          toast.classList.add('translate-x-full', 'opacity-0');
          setTimeout(() => toast.remove(), 500);
        }, duration);
      };
      
      function createToastContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed top-4 right-4 space-y-3 z-50 max-w-sm';
        document.body.appendChild(container);
        return container;
      }
      
      function getToastClasses(type) {
        const classes = {
          success: 'bg-green-500 text-white',
          error: 'bg-red-500 text-white',
          warning: 'bg-yellow-500 text-white',
          info: 'bg-blue-500 text-white'
        };
        return `${classes[type] || classes.info} px-6 py-4 rounded-lg shadow-lg max-w-sm`;
      }
      
      function getToastIcon(type) {
        const icons = {
          success: 'fas fa-check-circle',
          error: 'fas fa-exclamation-circle',
          warning: 'fas fa-exclamation-triangle',
          info: 'fas fa-info-circle'
        };
        return icons[type] || icons.info;
      }
    });
    
    // Legacy support for existing toast function
    function showToast(type, message) {
      window.showAdvancedToast(type, type.charAt(0).toUpperCase() + type.slice(1), message);
    }
  </script>

</body>
</html>
