<!-- Top Navigation Bar -->
<nav class="navbar bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex items-center justify-between">
    <!-- Left Side - Mobile Menu Toggle and Page Title -->
    <div class="flex items-center space-x-4">
        <!-- Mobile Menu Toggle -->
        <button id="mobile-menu-toggle" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Page Title -->
        <h1 class="text-xl font-semibold text-gray-800"><?= esc($title ?? 'SIEM Platform') ?></h1>
    </div>

    <!-- Right Side - User Profile Dropdown -->
    <div class="flex items-center space-x-4">
        <!-- Security Status Indicator -->
        <div class="hidden md:flex items-center space-x-2 px-3 py-1.5 bg-red-50 text-red-700 rounded-full text-sm font-medium">
            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
            <span>Live Monitoring</span>
        </div>

        <!-- Notification Bell -->
        <button class="relative p-2 text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100">
            <i class="fas fa-bell text-lg"></i>
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
        </button>

        <!-- User Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <?php
                // Get user data to display profile picture
                $userModel = new \App\Models\UserModel();
                $user = $userModel->find(session()->get('user_id'));
                ?>
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile" class="w-8 h-8 rounded-full object-cover border border-gray-300">
                <?php else: ?>
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                        <?= substr(session()->get('username'), 0, 1) ?>
                    </div>
                <?php endif; ?>
                <span class="hidden md:inline text-gray-700 font-medium"><?= session()->get('username') ?></span>
                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50" x-cloak>
                <div class="px-4 py-3 border-b border-gray-100">
                    <p class="text-sm font-medium text-gray-900"><?= session()->get('username') ?></p>
                    <p class="text-xs text-gray-500"><?= session()->get('role') ?></p>
                </div>

                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-2"></i>
                    Profil Saya
                </a>

                <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-cog mr-2"></i>
                    Pengaturan
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <a href="/logout" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    Keluar
                </a>
            </div>
        </div>
    </div>
</nav>