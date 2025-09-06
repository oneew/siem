<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-circle text-blue-600 mr-3"></i>
                User Profile
            </h1>
            <p class="text-gray-600 mt-1">Manage your profile information and settings</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-user mr-2 text-gray-600"></i>
                    Profile Information
                </h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col items-center">
                    <!-- Profile Picture -->
                    <div class="mb-4">
                        <?php if (!empty($user['profile_picture'])): ?>
                            <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile Picture" class="w-24 h-24 rounded-full object-cover">
                        <?php else: ?>
                            <div class="w-24 h-24 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-3xl">
                                <?= substr(esc($user['username']), 0, 1) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- User Info -->
                    <h3 class="text-xl font-bold text-gray-900"><?= esc($user['username']) ?></h3>
                    <p class="text-gray-600 mt-1"><?= esc($user['role']) ?></p>
                    
                    <div class="mt-6 w-full">
                        <div class="flex justify-between py-2 border-b border-gray-200">
                            <span class="text-gray-500">Member Since</span>
                            <span class="font-medium">
                                <?= isset($user['created_at']) ? date('M j, Y', strtotime($user['created_at'])) : 'N/A' ?>
                            </span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-500">Last Updated</span>
                            <span class="font-medium">
                                <?= isset($user['updated_at']) ? date('M j, Y', strtotime($user['updated_at'])) : 'N/A' ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Profile Edit Form -->
    <div class="lg:col-span-2">
        <!-- Profile Update Form -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-user-edit mr-2 text-gray-600"></i>
                    Edit Profile
                </h2>
            </div>
            <div class="p-6">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    <strong>Please correct the following errors:</strong>
                                </p>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    <?= session()->getFlashdata('success') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    <?= session()->getFlashdata('error') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="/profile/update" class="space-y-6" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Profile Picture Field -->
                        <div class="form-group md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Profile Picture
                            </label>
                            <div class="flex items-center space-x-6">
                                <?php if (!empty($user['profile_picture'])): ?>
                                    <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile Picture" class="w-16 h-16 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-xl">
                                        <?= substr(esc($user['username']), 0, 1) ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <input type="file" 
                                           name="profile_picture" 
                                           class="block w-full text-sm text-gray-500
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-lg file:border-0
                                                  file:text-sm file:font-semibold
                                                  file:bg-blue-50 file:text-blue-700
                                                  hover:file:bg-blue-100">
                                    <p class="mt-1 text-sm text-gray-500">JPG, PNG, or GIF. Max 2MB.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Username Field -->
                        <div class="form-group md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                Username
                            </label>
                            <input type="text" 
                                   name="username" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                                   required 
                                   value="<?= esc($user['username']) ?>" 
                                   placeholder="Enter username" 
                                   minlength="3" 
                                   maxlength="50">
                            <p class="mt-1 text-sm text-gray-500">Username must be unique and at least 3 characters</p>
                        </div>
                        
                        <!-- Role Field (Read-only) -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Role
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" 
                                   value="<?= esc($user['role']) ?>" 
                                   readonly>
                            <p class="mt-1 text-sm text-gray-500">Contact administrator to change your role</p>
                        </div>
                        
                        <!-- Member Since Field (Read-only) -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Member Since
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed" 
                                   value="<?= isset($user['created_at']) ? date('M j, Y', strtotime($user['created_at'])) : 'N/A' ?>" 
                                   readonly>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                            <i class="fas fa-save mr-2"></i>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Change Password Form -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-key mr-2 text-gray-600"></i>
                    Change Password
                </h2>
            </div>
            <div class="p-6">
                <?php if (session()->getFlashdata('password_errors')): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    <strong>Please correct the following errors:</strong>
                                </p>
                                <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                    <?php foreach (session()->getFlashdata('password_errors') as $field => $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('password_success')): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    <?= session()->getFlashdata('password_success') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('password_error')): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    <?= session()->getFlashdata('password_error') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <form method="post" action="/profile/change-password" class="space-y-6">
                    <div class="space-y-4">
                        <!-- Old Password Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                Current Password
                            </label>
                            <input type="password" 
                                   name="old_password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                                   required 
                                   placeholder="Enter your current password">
                        </div>
                        
                        <!-- New Password Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                New Password
                            </label>
                            <input type="password" 
                                   name="new_password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                                   required 
                                   placeholder="Enter your new password" 
                                   minlength="6">
                            <p class="mt-1 text-sm text-gray-500">Password must be at least 6 characters</p>
                        </div>
                        
                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2 required">
                                Confirm New Password
                            </label>
                            <input type="password" 
                                   name="confirm_password" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                                   required 
                                   placeholder="Confirm your new password">
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                            <i class="fas fa-save mr-2"></i>
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Admin Reset Password (Only visible to Admin users) -->
        <?php if (session()->get('role') === 'Admin' && $user['id'] != session()->get('user_id')): ?>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mt-6">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-sync-alt mr-2 text-gray-600"></i>
                    Admin Password Reset
                </h2>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Reset User Password</h3>
                        <p class="text-sm text-gray-500 mt-1">Reset this user's password to the default value</p>
                    </div>
                    <a href="/users/reset/<?= $user['id'] ?>" 
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors shadow-md"
                       onclick="return confirm('Reset password for <?= esc($user['username']) ?> to default (password123)?')">
                        <i class="fas fa-undo mr-2"></i>
                        Reset Password
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>