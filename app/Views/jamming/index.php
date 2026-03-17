<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-8">
  <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-white mb-2"><?= esc($title) ?></h1>
    <p class="text-blue-100">Pemantauan Interferensi Sinyal Fisik/Jamming.</p>
  </div>
</div>

<div class="dashboard-card p-12 text-center text-gray-500 flex flex-col items-center justify-center min-h-[400px]">
  <i class="fas fa-broadcast-tower text-6xl mb-6 text-gray-300 animate-pulse"></i>
  <h2 class="text-2xl font-bold text-gray-800 mb-2">Module Under Development</h2>
  <p class="text-gray-500 max-w-md mx-auto">Fitur <?= esc($title) ?> sedang dalam masa pengembangan dan akan segera tersedia pada pembaruan sistem berikutnya.</p>
  <button class="mt-6 px-6 py-2 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-colors" onclick="window.history.back()">Kembali</button>
</div>

<?= $this->endSection() ?>
