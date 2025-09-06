<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Header Section -->
<div class="bg-white shadow-sm border-b border-gray-200 p-6 mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-users-cog text-blue-600 mr-3"></i>
                User Management
            </h1>
            <p class="text-gray-600 mt-1">Manage user accounts, roles, and permissions</p>
        </div>
        <div class="flex space-x-3">
            <a href="/users/create" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center shadow-md transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Add User
            </a>
        </div>
    </div>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-list mr-2 text-gray-600"></i>
            All Users
        </h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($users)): ?>
                    <?php foreach($users as $user): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <?php if (!empty($user['profile_picture'])): ?>
                                    <img src="<?= base_url('uploads/profile_pictures/' . $user['profile_picture']) ?>" alt="Profile Picture" class="w-10 h-10 rounded-full object-cover mr-3">
                                <?php else: ?>
                                    <div class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold mr-3">
                                        <?= substr(esc($user['username']), 0, 1) ?>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="font-medium text-gray-900"><?= esc($user['username']) ?></div>
                                    <div class="text-sm text-gray-500">ID: <?= esc($user['id']) ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full
                                <?php 
                                switch($user['role']) {
                                    case 'Admin': echo 'bg-purple-100 text-purple-800'; break;
                                    case 'Analyst': echo 'bg-blue-100 text-blue-800'; break;
                                    case 'Operator': echo 'bg-green-100 text-green-800'; break;
                                    default: echo 'bg-gray-100 text-gray-800'; break;
                                }
                                ?>">
                                <?= esc($user['role']) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <?= isset($user['created_at']) ? date('M j, Y', strtotime($user['created_at'])) : 'N/A' ?>
                            </div>
                            <div class="text-xs text-gray-500">
                                <?= isset($user['created_at']) ? date('H:i', strtotime($user['created_at'])) : '' ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="/users/edit/<?= $user['id'] ?>" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors" 
                                   title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/users/reset/<?= $user['id'] ?>" 
                                   class="text-yellow-600 hover:text-yellow-800 transition-colors" 
                                   title="Reset Password"
                                   onclick="return confirm('Reset password for <?= esc($user['username']) ?> to default (password123)?')">
                                    <i class="fas fa-key"></i>
                                </a>
                                <button onclick="if(confirm('Are you sure you want to delete user <?= esc($user['username']) ?>?')) { 
                                            window.location.href='/users/delete/<?= $user['id'] ?>' 
                                        }"
                                        class="text-red-600 hover:text-red-800 transition-colors" 
                                        title="Delete User">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-users text-4xl mb-4"></i>
                                <p class="text-lg font-medium">No users found</p>
                                <p class="text-sm">Create your first user to get started</p>
                                <a href="/users/create" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                    <i class="fas fa-plus mr-1"></i> Add User
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>