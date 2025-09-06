<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-user-plus text-blue-600 mr-3"></i>
                Add New User
            </h1>
            <p class="text-gray-600 mt-1">Create a new user account with appropriate permissions</p>
        </div>
        <div class="flex space-x-3">
            <a href="/users" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users
            </a>
        </div>
    </div>
</div>

<!-- User Creation Form -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-user mr-2 text-gray-600"></i>
            User Details
        </h2>
    </div>
    <div class="p-6">
        <form method="post" action="/users/store" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Username Field -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Username
                    </label>
                    <input type="text" 
                           name="username" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           required 
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
                        <option value="Admin">Admin</option>
                        <option value="Analyst">Analyst</option>
                        <option value="Operator">Operator</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Admin has full access, Analyst can manage incidents, Operator can only view</p>
                </div>
                
                <!-- Password Field -->
                <div class="form-group md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2 required">
                        Password
                    </label>
                    <input type="password" 
                           name="password" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" 
                           required 
                           placeholder="Enter password" 
                           minlength="6">
                    <p class="mt-1 text-sm text-gray-500">Password must be at least 6 characters</p>
                </div>
            </div>
            
            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <a href="/users" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>