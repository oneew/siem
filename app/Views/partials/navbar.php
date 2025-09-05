<!-- Enhanced Header -->
<header class="header bg-white shadow-sm border-b border-gray-200 sticky top-0 z-20">
  <div class="flex items-center justify-between px-6 py-4">
    <!-- Left Side - Page Title & Breadcrumb -->
    <div class="flex items-center space-x-4">
      <!-- Mobile Menu Toggle -->
      <button class="sidebar-toggle lg:hidden text-gray-600 hover:text-gray-900" id="sidebarToggle">
        <i class="fas fa-bars text-xl"></i>
        <span class="sr-only">Toggle sidebar</span>
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
          <span class="sr-only">Notifications</span>
        </button>
        
        <!-- Quick Add -->
        <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors" title="Quick Add Incident">
          <i class="fas fa-plus text-lg"></i>
          <span class="sr-only">Quick Add</span>
        </button>
      </div>

      <!-- Profile Dropdown -->
      <div class="relative">
        <button class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors" id="profileMenuButton" aria-haspopup="true" aria-expanded="false">
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
<?= $this->include('components/flash_messages') ?>