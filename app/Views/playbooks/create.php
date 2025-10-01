<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
    <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-arrow-left"></i> Kembali ke Playbook
    </a>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="<?= base_url('/playbooks/store') ?>" method="post">
        <?= csrf_field() ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
                <input type="text" name="name" id="name" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                <input type="text" name="category" id="category" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe *</label>
                <select name="type" id="type" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Manual">Manual</option>
                    <option value="Automated">Otomatis</option>
                    <option value="Semi-Automated">Semi-Otomatis</option>
                </select>
            </div>
            
            <div>
                <label for="severity_level" class="block text-sm font-medium text-gray-700 mb-1">Tingkat Keparahan *</label>
                <select name="severity_level" id="severity_level" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Low">Rendah</option>
                    <option value="Medium">Sedang</option>
                    <option value="High">Tinggi</option>
                    <option value="Critical">Kritis</option>
                </select>
            </div>
        </div>
        
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mb-6">
            <label for="trigger_conditions" class="block text-sm font-medium text-gray-700 mb-1">Kondisi Pemicu</label>
            <textarea name="trigger_conditions" id="trigger_conditions" rows="2"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mb-6">
            <label for="required_tools" class="block text-sm font-medium text-gray-700 mb-1">Alat yang Diperlukan</label>
            <textarea name="required_tools" id="required_tools" rows="2"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>
        
        <div class="mb-6">
            <label for="estimated_time" class="block text-sm font-medium text-gray-700 mb-1">Perkiraan Waktu</label>
            <input type="text" name="estimated_time" id="estimated_time"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="contoh: 2-4 jam">
        </div>
        
        <div class="mb-6">
            <label for="steps" class="block text-sm font-medium text-gray-700 mb-1">Langkah-langkah (format JSON)</label>
            <textarea name="steps" id="steps" rows="6"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                placeholder='[{"step": 1, "action": "Deskripsi langkah 1", "estimated_time": "15 menit"}, {"step": 2, "action": "Deskripsi langkah 2", "estimated_time": "30 menit"}]'></textarea>
            <p class="mt-1 text-sm text-gray-500">Masukkan langkah-langkah dalam format JSON. Setiap langkah harus memiliki "step", "action", dan opsional "estimated_time".</p>
        </div>
        
        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('/playbooks') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Buat Playbook
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>