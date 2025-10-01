<!-- Flash Messages Component -->
<?php if (session()->getFlashdata('success')): ?>
  <div class="flash-message mb-4 px-4 py-3 rounded bg-green-100 text-green-800 border border-green-300 shadow-sm">
    <div class="flex items-center">
      <i class="fas fa-check-circle mr-2 text-green-600"></i>
      <div>
        <strong>Berhasil:</strong> <?= session()->getFlashdata('success') ?>
      </div>
      <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-green-600 hover:text-green-800">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
  <div class="flash-message mb-4 px-4 py-3 rounded bg-red-100 text-red-800 border border-red-300 shadow-sm">
    <div class="flex items-center">
      <i class="fas fa-exclamation-circle mr-2 text-red-600"></i>
      <div>
        <strong>Kesalahan:</strong> <?= session()->getFlashdata('error') ?>
      </div>
      <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')): ?>
  <div class="flash-message mb-4 px-4 py-3 rounded bg-yellow-100 text-yellow-800 border border-yellow-300 shadow-sm">
    <div class="flex items-center">
      <i class="fas fa-exclamation-triangle mr-2 text-yellow-600"></i>
      <div>
        <strong>Peringatan:</strong> <?= session()->getFlashdata('warning') ?>
      </div>
      <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-yellow-600 hover:text-yellow-800">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('info')): ?>
  <div class="flash-message mb-4 px-4 py-3 rounded bg-blue-100 text-blue-800 border border-blue-300 shadow-sm">
    <div class="flex items-center">
      <i class="fas fa-info-circle mr-2 text-blue-600"></i>
      <div>
        <strong>Info:</strong> <?= session()->getFlashdata('info') ?>
      </div>
      <button onclick="this.parentElement.parentElement.remove()" class="ml-auto text-blue-600 hover:text-blue-800">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
<?php endif; ?>