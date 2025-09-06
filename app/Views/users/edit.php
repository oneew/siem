<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-edit text-blue-600 mr-3"></i>
                Edit User
            </h1>
            <p class="text-gray-600 mt-1">Modify user account details and permissions</p>
        </div>
        <div class="flex space-x-3">
            <a href="/users" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users
            </a>
        </div>
    </div>
</div>

<!-- User Edit Form -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-user mr-2 text-gray-600"></i>
            User Profile: <?= esc($user['username']) ?>
        </h2>
    </div>
    <div class="p-6">
        <form method="post" action="/users/update/<?= $user['id'] ?>" class="space-y-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Picture Section -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0">
                            <?php if (!empty($user['profile_picture'])): ?>
                                <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile Picture" class="w-20 h-20 rounded-full object-cover">
                            <?php else: ?>
                                <div class="w-20 h-20 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold text-2xl">
                                    <?= substr(esc($user['username']), 0, 1) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Profile Picture</h3>
                            <input type="file" 
                                   name="profile_picture" 
                                   class="block w-full text-sm text-gray-500 mt-2
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100">
                            <p class="text-sm text-gray-500 mt-1">JPG, PNG, or GIF. Max 2MB.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Username Field -->
                <div class="form-group">
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
                
                <!-- Role Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Role
                    </label>
                    <select name="role" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                            required>
                        <option value="">Select Role</option>
                        <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Analyst" <?= $user['role'] === 'Analyst' ? 'selected' : '' ?>>Analyst</option>
                        <option value="Operator" <?= $user['role'] === 'Operator' ? 'selected' : '' ?>>Operator</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Admin has full access, Analyst can manage incidents, Operator can only view</p>
                </div>
                
                <!-- Password Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           placeholder="Leave blank to keep current password" 
                           minlength="6">
                    <p class="mt-1 text-sm text-gray-500">Leave blank to keep current password. Must be at least 6 characters if changing.</p>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="/users" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reset Password Card -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mt-6">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-key mr-2 text-gray-600"></i>
            Password Management
        </h2>
    </div>
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">Reset User Password</h3>
                <p class="text-sm text-gray-500 mt-1">Reset this user's password to the default value (password123)</p>
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

<?= $this->endSection() ?>