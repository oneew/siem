<aside class="sidebar flex flex-col h-screen fixed top-0 left-0 z-100 transition-transform duration-300 ease-in-out lg:translate-x-0 bg-white shadow-xl" id="sidebar">
    <div class="sidebar-header py-6 px-5 border-b border-gray-200 flex items-center gap-3 flex-shrink-0">
        <div class="sidebar-logo-icon w-10 h-10 rounded-lg flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-700 shadow-md">
            <i class="fas fa-shield-alt text-white text-xl"></i>
        </div>
        <span class="sidebar-logo-text text-gray-800 text-lg font-bold truncate">SIEM Platform</span>
    </div>

    <nav class="sidebar-nav flex-grow overflow-y-auto py-4 px-3 custom-scrollbar">
        <ul>
            <li>
                <a href="/dashboard" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'dashboard') ? 'active bg-blue-100 text-blue-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                    <i class="fas fa-tachometer-alt icon w-5 text-center"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
            </li>

            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center justify-between">
                    <span>24/7 Monitoring</span>
                    <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full font-semibold">LIVE</span>
                </h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/incidents" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'incidents') ? 'active bg-red-50 text-red-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-exclamation-triangle icon w-5 text-center text-red-500"></i>
                            <span class="font-medium">Incidents</span>
                        </a>
                    </li>
                    <li>
                        <a href="/alerts" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'alerts') ? 'active bg-orange-50 text-orange-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-bell icon w-5 text-center text-orange-500"></i>
                            <span class="font-medium">Alerts</span>
                        </a>
                    </li>
                    <li>
                        <a href="/threats" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'threats') ? 'active bg-purple-50 text-purple-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-virus icon w-5 text-center text-purple-500"></i>
                            <span class="font-medium">Active Threats</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center justify-between">
                    <span>Analysis & Response</span>
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full font-semibold">ACTION</span>
                </h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/reports" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'reports') ? 'active bg-blue-50 text-blue-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-chart-line icon w-5 text-center text-blue-500"></i>
                            <span class="font-medium">Reports</span>
                        </a>
                    </li>
                    <li>
                        <a href="/forensics" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'forensics') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-search icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Forensics</span>
                        </a>
                    </li>
                    <li>
                        <a href="/playbooks" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'playbooks') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-book icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Playbooks</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500">System Management</h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/asset-management" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'asset-management') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-server icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Assets</span>
                        </a>
                    </li>
                    <?php if (session()->get('role') === 'Admin'): ?>
                        <li>
                            <a href="/users" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'users') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                                <i class="fas fa-users-cog icon w-5 text-center text-gray-500"></i>
                                <span class="font-medium">Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'settings') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                                <i class="fas fa-cog icon w-5 text-center text-gray-500"></i>
                                <span class="font-medium">Settings</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
            
            <!-- User Management and Logout Section -->
            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500">User Management</h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/profile" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'profile') ? 'active bg-blue-50 text-blue-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-user-circle icon w-5 text-center text-blue-500"></i>
                            <span class="font-medium">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="/logout" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <i class="fas fa-sign-out-alt icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <!-- User Profile Section at Bottom -->
    <div class="sidebar-footer p-4 border-t border-gray-200 flex items-center gap-3 bg-gray-50">
        <?php
        // Get user data to display profile picture
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));
        ?>
        <?php if (!empty($user['profile_picture'])): ?>
            <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile Picture" class="w-10 h-10 rounded-full object-cover border-2 border-gray-300">
        <?php else: ?>
            <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold border-2 border-white shadow">
                <?= substr(session()->get('username'), 0, 1) ?>
            </div>
        <?php endif; ?>
        <div class="flex-1 min-w-0">
            <p class="text-gray-800 font-medium truncate"><?= session()->get('username') ?></p>
            <p class="text-gray-600 text-sm truncate"><?= session()->get('role') ?></p>
        </div>
        <!-- Theme Toggle Button -->
        <button id="theme-toggle" class="theme-toggle bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-full p-2 transition-colors duration-200" title="Toggle theme">
            <i class="fas fa-moon"></i>
        </button>
    </div>
</aside>