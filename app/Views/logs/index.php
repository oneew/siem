<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-8">
  <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 rounded-2xl shadow-xl overflow-hidden p-8">
    <h1 class="text-3xl font-bold text-white mb-2"><?= esc($title) ?></h1>
    <p class="text-blue-100">Secure log management and monitoring.</p>
  </div>
</div>

<div class="dashboard-card p-12 text-center text-gray-500 flex flex-col items-center justify-center min-h-[400px]">
  <i class="fas fa-tools text-6xl mb-6 text-gray-300 animate-pulse"></i>
  <h2 class="text-2xl font-bold text-gray-800 mb-2">Module Under Development</h2>
  <p class="text-gray-500 max-w-md mx-auto">The <?= esc($title) ?> feature is currently being built and will be available in the next system update.</p>
  <button class="mt-6 px-6 py-2 bg-blue-100 text-blue-700 font-semibold rounded-lg hover:bg-blue-200 transition-colors" onclick="window.history.back()">Go Back</button>
</div>

<?= $this->endSection() ?>
