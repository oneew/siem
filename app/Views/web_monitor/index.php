<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
  <div>
    <h1 class="text-2xl font-bold text-gray-900 mb-1">Monitoring Website</h1>
    <p class="text-sm text-gray-500">Pantau status uptime dan deteksi indikasi defacement (judul/konten ilegal) berturut-turut.</p>
  </div>
  <div class="flex space-x-2">
    <a href="/web-monitor/check" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm text-sm font-medium transition-colors flex items-center">
      <i class="fas fa-radar mr-2"></i> Pindai Semua Sekarang
    </a>
  </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
<div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md shadow-sm">
  <div class="flex">
    <div class="flex-shrink-0">
      <i class="fas fa-check-circle text-green-500"></i>
    </div>
    <div class="ml-3">
      <p class="text-sm text-green-700"><?= session()->getFlashdata('success') ?></p>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
<div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md shadow-sm">
  <div class="flex">
    <div class="flex-shrink-0">
      <i class="fas fa-exclamation-circle text-red-500"></i>
    </div>
    <div class="ml-3">
      <ul class="list-disc pl-5 text-sm text-red-700">
        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Stats Overview -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
    <div class="p-3 rounded-lg bg-blue-50 text-blue-600 mr-4">
      <i class="fas fa-globe text-xl"></i>
    </div>
    <div>
      <p class="text-sm font-medium text-gray-500">Total Website</p>
      <p class="text-2xl font-bold text-gray-900"><?= $stats['total'] ?></p>
    </div>
  </div>
  
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
    <div class="p-3 rounded-lg bg-green-50 text-green-600 mr-4">
      <i class="fas fa-shield-check text-xl"></i>
    </div>
    <div>
      <p class="text-sm font-medium text-gray-500">Status Aman</p>
      <p class="text-2xl font-bold text-gray-900"><?= $stats['aman'] ?></p>
    </div>
  </div>
  
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
    <div class="p-3 rounded-lg bg-red-50 text-red-600 mr-4">
      <i class="fas fa-exclamation-triangle text-xl"></i>
    </div>
    <div>
      <p class="text-sm font-medium text-gray-500">Terindikasi Deface</p>
      <p class="text-2xl font-bold text-gray-900"><?= $stats['terindikasi'] ?></p>
    </div>
  </div>
  
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 flex items-center">
    <div class="p-3 rounded-lg bg-orange-50 text-orange-600 mr-4">
      <i class="fas fa-wifi-slash text-xl"></i>
    </div>
    <div>
      <p class="text-sm font-medium text-gray-500">Tidak Bisa Diakses</p>
      <p class="text-2xl font-bold text-gray-900"><?= $stats['tidak_bisa_diakses'] ?></p>
    </div>
  </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
  <!-- Add Website Form -->
  <div class="lg:col-span-1">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="font-semibold text-gray-900"><i class="fas fa-plus-circle text-blue-500 mr-2"></i> Tambah Website</h3>
      </div>
      <div class="p-5">
        <form action="/web-monitor/store" method="post">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Website</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Contoh: Portal Utama" required value="<?= old('name') ?>">
          </div>
          <div class="mb-5">
            <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL / Domain</label>
            <input type="text" id="url" name="url" class="w-full border border-gray-300 rounded-lg py-2 px-3 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="https://example.com" required value="<?= old('url') ?>">
            <p class="mt-1 text-xs text-gray-500">Sertakan http:// atau https://</p>
          </div>
          <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow-sm text-sm font-medium transition-colors">
            Simpan Website
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Monitored Websites List -->
  <div class="lg:col-span-2">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="px-5 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
        <h3 class="font-semibold text-gray-900"><i class="fas fa-list text-gray-500 mr-2"></i> Daftar Monitoring</h3>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
              <th class="p-4">Website</th>
              <th class="p-4">Status</th>
              <th class="p-4">Respon</th>
              <th class="p-4">Pemeriksaan Terakhir</th>
              <th class="p-4 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
            <?php if (empty($websites)): ?>
              <tr>
                <td colspan="5" class="p-8 text-center text-gray-500">
                  <i class="fas fa-search mb-3 text-3xl text-gray-300"></i>
                  <p>Belum ada website yang dimonitor.</p>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($websites as $site): ?>
                <tr class="hover:bg-gray-50 transition-colors">
                  <td class="p-4">
                    <div class="font-medium text-gray-900"><?= esc($site['name']) ?></div>
                    <a href="<?= esc($site['url']) ?>" target="_blank" class="text-sm text-blue-600 hover:underline inline-flex items-center">
                      <?= esc($site['url']) ?> <i class="fas fa-external-link-alt ml-1 text-[10px]"></i>
                    </a>
                  </td>
                  <td class="p-4">
                    <?php if ($site['status'] === 'aman'): ?>
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i> Aman
                      </span>
                    <?php elseif ($site['status'] === 'terindikasi'): ?>
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800" title="<?= esc($site['indicators_found']) ?>">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Terindikasi Deface
                      </span>
                    <?php elseif ($site['status'] === 'tidak_bisa_diakses'): ?>
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                        <i class="fas fa-wifi-slash mr-1"></i> Down / Error
                      </span>
                    <?php else: ?>
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-clock mr-1"></i> Belum Diperiksa
                      </span>
                    <?php endif; ?>
                  </td>
                  <td class="p-4 text-sm text-gray-700">
                    <?php if ($site['response_time'] !== null): ?>
                      <span class="<?= $site['response_time'] > 1000 ? 'text-orange-600' : 'text-green-600' ?>">
                        <?= $site['response_time'] ?> ms
                      </span>
                    <?php else: ?>
                      -
                    <?php endif; ?>
                  </td>
                  <td class="p-4 text-sm text-gray-500">
                    <?= $site['last_checked'] ? date('d M Y, H:i', strtotime($site['last_checked'])) : '-' ?>
                  </td>
                  <td class="p-4 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="/web-monitor/check/<?= $site['id'] ?>" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-1.5 rounded" title="Pindai Sekarang">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                        <form action="/web-monitor/delete/<?= $site['id'] ?>" method="post" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus website ini dari daftar?')">
                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-1.5 rounded" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('form[action="/web-monitor/store"]');
  if (form) {
    form.addEventListener('submit', function(e) {
      if (this.getAttribute('data-submitting') === 'true') {
        e.preventDefault();
        return;
      }
      this.setAttribute('data-submitting', 'true');
      const btn = this.querySelector('button[type="submit"]');
      if (btn) {
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
        btn.classList.add('opacity-75', 'cursor-not-allowed');
      }
    });
  }

  const scanBtn = document.querySelector('a[href="/web-monitor/check"]');
  if (scanBtn) {
    scanBtn.addEventListener('click', function(e) {
      if (!this.classList.contains('scanning')) {
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sedang Memindai...';
        this.classList.add('opacity-75', 'cursor-not-allowed', 'scanning');
      } else {
        e.preventDefault();
      }
    });
  }

  const checkBtns = document.querySelectorAll('a[href^="/web-monitor/check/"]');
  checkBtns.forEach(btn => {
    btn.addEventListener('click', function(e) {
      if (!this.classList.contains('scanning')) {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        this.classList.add('opacity-75', 'cursor-not-allowed', 'scanning');
      } else {
        e.preventDefault();
      }
    });
  });
});
</script>

<?= $this->endSection() ?>
