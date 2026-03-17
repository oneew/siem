<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Buat Insiden Baru</h1>
        <p class="text-sm text-gray-500">Laporkan insiden keamanan baru untuk dilacak dan ditangani.</p>
    </div>
    <div>
        <a href="/incidents" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg shadow-sm text-sm font-medium transition-colors flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="font-semibold text-gray-900"><i class="fas fa-edit text-blue-500 mr-2"></i> Form Insiden</h3>
    </div>
    
    <div class="p-6">
        <form method="post" action="/incidents/store" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Insiden <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: Serangan DDoS pada Web Utama">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">IP Sumber</label>
                    <input type="text" name="source_ip" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: 192.168.1.100">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Jelaskan detail insiden secara kronologis..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tingkat Keparahan</label>
                    <select name="severity" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white">
                        <option value="Low">Rendah (Low)</option>
                        <option value="Medium">Sedang (Medium)</option>
                        <option value="High">Tinggi (High)</option>
                        <option value="Critical">Kritis (Critical)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Awal</label>
                    <select name="status" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white">
                        <option value="Open">Terbuka (Open)</option>
                        <option value="In Progress">Sedang Diproses (In Progress)</option>
                        <option value="Closed">Ditutup (Closed)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Diselesaikan</label>
                    <input type="datetime-local" name="resolved_at" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-600">
                    <p class="text-xs text-gray-400 mt-1">Isi jika status "Ditutup"</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Penyelesaian</label>
                <textarea name="resolution_notes" rows="3" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Tindakan yang diambil untuk menyelesaikan insiden..."></textarea>
            </div>

            <div class="pt-4 border-t border-gray-200 flex justify-end space-x-3">
                <a href="/incidents" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i> Simpan Insiden
                </button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
