<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="flex-1 flex flex-col overflow-hidden">
  <div class="bg-white shadow-sm border-b border-gray-200 p-6">
    <div class="flex justify-between items-center">
      <div>
        <h1 class="text-3xl font-bold text-gray-900 flex items-center">
          <i class="fas fa-cog text-blue-600 mr-3"></i>
          Pengaturan Sistem
        </h1>
        <p class="text-gray-600 mt-1">Kelola konfigurasi sistem dan preferensi aplikasi</p>
      </div>
    </div>
  </div>

  <div class="flex-1 p-6">
    <div class="max-w-4xl mx-auto">
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="fas fa-sliders-h mr-2 text-gray-600"></i>
            Konfigurasi Sistem
          </h2>
        </div>

        <form method="post" action="/settings/update" class="p-6 space-y-6">
          <?php if (!empty($settings)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <?php foreach ($settings as $s): ?>
                <div class="form-group">
                  <label class="block text-sm font-medium text-gray-700 mb-2">
                    <?= esc(ucwords(str_replace('_', ' ', $s['key']))) ?>
                  </label>
                  <input type="text"
                    name="<?= esc($s['key']) ?>"
                    value="<?= esc($s['value']) ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
              <?php endforeach; ?>
            </div>

            <div class="flex justify-end pt-6 border-t border-gray-200">
              <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md flex items-center">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
              </button>
            </div>
          <?php else: ?>
            <div class="text-center py-12">
              <i class="fas fa-info-circle text-gray-400 text-4xl mb-4"></i>
              <p class="text-gray-500">Tidak ada pengaturan yang ditemukan.</p>
            </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>