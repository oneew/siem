<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Pengaturan Sistem</h1>
    <p class="text-sm text-gray-500">Konfigurasi preferensi aplikasi, notifikasi, dan opsi keamanan.</p>
  </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col md:flex-row">
  <!-- Settings Navigation Sidebar (Tabs) -->
  <div class="w-full md:w-64 bg-gray-50 border-r border-gray-200 p-4 shrink-0">
    <nav class="space-y-1">
      <a href="#" class="bg-blue-50 bg-opacity-50 text-blue-700 border-l-4 border-blue-600 group flex items-center px-3 py-3 text-sm font-medium">
        <i class="fas fa-cog text-blue-500 group-hover:text-blue-700 w-6 flex-shrink-0 text-center"></i>
        <span class="truncate ml-2">Umum</span>
      </a>
      <a href="#" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 border-l-4 border-transparent hover:border-gray-300 group flex items-center px-3 py-3 text-sm font-medium">
        <i class="fas fa-shield-alt text-gray-400 group-hover:text-gray-500 w-6 flex-shrink-0 text-center"></i>
        <span class="truncate ml-2">Keamanan</span>
      </a>
      <a href="#" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 border-l-4 border-transparent hover:border-gray-300 group flex items-center px-3 py-3 text-sm font-medium">
        <i class="fas fa-bell text-gray-400 group-hover:text-gray-500 w-6 flex-shrink-0 text-center"></i>
        <span class="truncate ml-2">Notifikasi</span>
      </a>
      <a href="#" class="text-gray-600 hover:bg-gray-100 hover:text-gray-900 border-l-4 border-transparent hover:border-gray-300 group flex items-center px-3 py-3 text-sm font-medium">
        <i class="fas fa-paint-brush text-gray-400 group-hover:text-gray-500 w-6 flex-shrink-0 text-center"></i>
        <span class="truncate ml-2">Penampilan</span>
      </a>
    </nav>
  </div>

  <!-- Settings Content Area -->
  <div class="flex-1 p-6 md:p-8">
    <div class="max-w-3xl">
      <h2 class="text-lg font-medium text-gray-900 mb-6 border-b border-gray-200 pb-2">Pengaturan Umum</h2>
      
      <form method="post" action="/settings/update" class="space-y-6">
        <?php foreach($settings as $index => $s): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
          <label for="<?= esc($s['key']) ?>" class="block text-sm font-medium text-gray-700 md:col-span-1">
            <?= esc(ucwords(str_replace('_',' ',$s['key']))) ?>
          </label>
          <div class="md:col-span-2">
            <input type="text" id="<?= esc($s['key']) ?>" name="<?= esc($s['key']) ?>" value="<?= esc($s['value']) ?>" 
              class="block w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            <?php if(strpos(strtolower($s['key']), 'timeout') !== false): ?>
              <p class="mt-1 text-xs text-gray-500">Waktu sesi sebelum kedaluwarsa otomatis (dalam menit).</p>
            <?php elseif(strpos(strtolower($s['key']), 'retention') !== false): ?>
              <p class="mt-1 text-xs text-gray-500">Durasi penyimpanan log sistem sebelum dibersihkan (dalam hari).</p>
            <?php endif; ?>
          </div>
        </div>
        
        <?php if($index < count($settings) - 1): ?>
        <hr class="border-gray-200 my-4">
        <?php endif; ?>
        
        <?php endforeach; ?>
        
        <div class="pt-6 flex justify-end gap-3 border-t border-gray-200 mt-8">
          <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Batal
          </button>
          <button type="submit" class="bg-blue-600 py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center">
            <i class="fas fa-save mr-2"></i>
            Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Simple script to handle tab clicks visually for the mockup
  document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('nav a');
    tabs.forEach(tab => {
      tab.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Remove active state from all tabs
        tabs.forEach(t => {
          t.className = 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 border-l-4 border-transparent hover:border-gray-300 group flex items-center px-3 py-3 text-sm font-medium';
          const icon = t.querySelector('i');
          icon.className = icon.className.replace('text-blue-500', 'text-gray-400').replace('group-hover:text-blue-700', 'group-hover:text-gray-500');
        });
        
        // Add active state to clicked tab
        this.className = 'bg-blue-50 bg-opacity-50 text-blue-700 border-l-4 border-blue-600 group flex items-center px-3 py-3 text-sm font-medium';
        const icon = this.querySelector('i');
        icon.className = icon.className.replace('text-gray-400', 'text-blue-500').replace('group-hover:text-gray-500', 'group-hover:text-blue-700');
        
        // Update the header title based on clicked tab
        const tabName = this.querySelector('span').innerText;
        document.querySelector('.max-w-3xl h2').innerText = 'Pengaturan ' + tabName;
      });
    });
  });
</script>

<?= $this->endSection() ?>
