<aside class="sidebar flex flex-col h-screen fixed top-0 left-0 z-100 transition-transform duration-300 ease-in-out lg:translate-x-0 bg-white shadow-xl" id="sidebar">
    <!-- Add toggle button at the top -->
    <div class="sidebar-toggle absolute top-4 -right-3 bg-white rounded-full shadow-lg p-1 cursor-pointer hidden lg:block z-50" id="sidebarToggle">
        <i class="fas fa-chevron-left text-gray-600 text-sm"></i>
    </div>

    <div class="sidebar-header py-6 px-5 border-b border-gray-200 flex items-center gap-3 flex-shrink-0">
        <div class="sidebar-logo-icon w-10 h-10 rounded-lg flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-700 shadow-md">
            <i class="fas fa-shield-alt text-white text-xl"></i>
        </div>
        <span class="sidebar-logo-text text-gray-800 text-lg font-bold truncate">Platform SIEM</span>
    </div>

    <nav class="sidebar-nav flex-grow overflow-y-auto py-4 px-3 custom-scrollbar">
        <ul>
            <li>
                <a href="/dashboard" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'dashboard') ? 'active bg-blue-100 text-blue-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                    <i class="fas fa-tachometer-alt icon w-5 text-center"></i>
                    <span class="font-medium">Dasbor</span>
                </a>
            </li>

            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center justify-between">
                    <span>Pemantauan 24/7</span>
                    <span class="bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full font-semibold">LANGSUNG</span>
                </h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/incidents" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'incidents') ? 'active bg-red-50 text-red-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-exclamation-triangle icon w-5 text-center text-red-500"></i>
                            <span class="font-medium">Insiden</span>
                        </a>
                    </li>
                    <li>
                        <a href="/alerts" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'alerts') ? 'active bg-orange-50 text-orange-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-bell icon w-5 text-center text-orange-500"></i>
                            <span class="font-medium">Peringatan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/threats" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'threats') ? 'active bg-purple-50 text-purple-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-virus icon w-5 text-center text-purple-500"></i>
                            <span class="font-medium">Ancaman Aktif</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500 flex items-center justify-between">
                    <span>Analisis & Respons</span>
                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-0.5 rounded-full font-semibold">TINDAKAN</span>
                </h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/reports" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'reports') ? 'active bg-blue-50 text-blue-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-chart-line icon w-5 text-center text-blue-500"></i>
                            <span class="font-medium">Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/forensics" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'forensics') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-search icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Forensik</span>
                        </a>
                    </li>
                    <li>
                        <a href="/playbooks" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'playbooks') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-book icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Playbook</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="mt-6">
                <h3 class="nav-section-title px-4 py-2 text-xs font-semibold uppercase tracking-wider text-gray-500">Manajemen Sistem</h3>
                <ul class="space-y-1 mt-1">
                    <li>
                        <a href="/asset-management" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'asset-management') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                            <i class="fas fa-server icon w-5 text-center text-gray-500"></i>
                            <span class="font-medium">Aset</span>
                        </a>
                    </li>
                    <?php if (session()->get('role') === 'Administrator'): ?>
                        <li>
                            <a href="/users" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'users') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                                <i class="fas fa-users-cog icon w-5 text-center text-gray-500"></i>
                                <span class="font-medium">Pengguna</span>
                                <?php
                                // Count total users for badge
                                $userModel = new \App\Models\UserModel();
                                $userCount = $userModel->countAll();
                                ?>
                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-blue-500 rounded-full"><?= $userCount ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="/settings" class="nav-link flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 <?= (current_url(true)->getSegment(1) == 'settings') ? 'active bg-gray-100 text-gray-700 shadow-sm font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' ?>">
                                <i class="fas fa-cog icon w-5 text-center text-gray-500"></i>
                                <span class="font-medium">Pengaturan</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer p-4 border-t border-gray-200 bg-gray-50 text-center text-xs text-gray-500">
        SIEM Platform v2.1.0
    </div>
</aside>