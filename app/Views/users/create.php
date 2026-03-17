<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900">
        <i class="fa-solid fa-user-plus mr-2 text-blue-600"></i>
        Tambah Pengguna Baru
    </h1>
    <a href="/users" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded flex items-center transition-colors">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form method="post" action="/users/store" class="space-y-6">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Username *</label>
            <input type="text" name="username" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Masukkan username" minlength="3" maxlength="50">
            <p class="mt-1 text-sm text-gray-500">Username harus unik dan minimal 3 karakter</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
            <input type="password" name="password" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Masukkan password" minlength="6">
            <p class="mt-1 text-sm text-gray-500">Password minimal 6 karakter</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
            <select name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Pilih Role</option>
                <option value="Admin">Admin</option>
                <option value="Analyst">Analyst</option>
                <option value="Operator">Operator</option>
            </select>
            <p class="mt-1 text-sm text-gray-500">Admin memiliki akses penuh, Analyst dapat mengelola incident, Operator hanya bisa melihat</p>
        </div>
        
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
            <a href="/users" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-colors">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md flex items-center transition-colors">
                <i class="fa-solid fa-save mr-2"></i>
                Simpan
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>