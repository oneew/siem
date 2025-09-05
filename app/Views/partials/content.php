<!-- Enhanced Main Content -->
<main class="main-content bg-gray-50 flex-1 overflow-auto">
  <section class="page-content p-6">
    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center space-x-3 animate-fade-in">
        <i class="fas fa-check-circle text-lg"></i>
        <div>
          <p class="font-medium">Success!</p>
          <p class="text-sm opacity-90"><?= session()->getFlashdata('success') ?></p>
        </div>
        <button class="ml-auto text-green-700/70 hover:text-green-700" onclick="this.parentElement.remove()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center space-x-3 animate-fade-in">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <div>
          <p class="font-medium">Error!</p>
          <p class="text-sm opacity-90"><?= session()->getFlashdata('error') ?></p>
        </div>
        <button class="ml-auto text-red-700/70 hover:text-red-700" onclick="this.parentElement.remove()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('warning')): ?>
      <div class="alert alert-warning mb-6 p-4 bg-yellow-50 border border-yellow-200 text-yellow-700 rounded-lg flex items-center space-x-3 animate-fade-in">
        <i class="fas fa-exclamation-triangle text-lg"></i>
        <div>
          <p class="font-medium">Warning!</p>
          <p class="text-sm opacity-90"><?= session()->getFlashdata('warning') ?></p>
        </div>
        <button class="ml-auto text-yellow-700/70 hover:text-yellow-700" onclick="this.parentElement.remove()">
          <i class="fas fa-times"></i>
        </button>
      </div>
    <?php endif; ?>
    
    <?= $this->renderSection('content') ?>
  </section>
</main>