<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa-solid fa-user-plus"></i>
            Tambah Pengguna Baru
        </h3>
    </div>
    <div class="card-content">
        <form method="post" action="/users/store" class="space-y-4">
            <div class="form-group required">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-input" required 
                       placeholder="Masukkan username" minlength="3" maxlength="50">
                <small class="text-gray-600">Username harus unik dan minimal 3 karakter</small>
            </div>
            
            <div class="form-group required">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required 
                       placeholder="Masukkan password" minlength="6">
                <small class="text-gray-600">Password minimal 6 karakter</small>
            </div>
            
            <div class="form-group required">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">Pilih Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Analyst">Analyst</option>
                    <option value="Operator">Operator</option>
                </select>
                <small class="text-gray-600">Admin memiliki akses penuh, Analyst dapat mengelola incident, Operator hanya bisa melihat</small>
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i>
                    Simpan
                </button>
                <a href="/users" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>