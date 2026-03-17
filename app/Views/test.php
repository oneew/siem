<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-lg shadow-md p-6">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">Test Page</h2>
  <p class="text-gray-600">This is a test page to verify that the templating system is working correctly.</p>
  
  <div class="mt-6">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Current Configuration</h3>
    <ul class="list-disc pl-5 space-y-1 text-gray-600">
      <li>Header partial: Loaded</li>
      <li>Sidebar partial: Loaded</li>
      <li>Navbar partial: Loaded</li>
      <li>Content partial: Loaded</li>
      <li>Footer partial: Loaded</li>
      <li>CSS styles: Loaded</li>
      <li>JavaScript functionality: Loaded</li>
    </ul>
  </div>
  
  <div class="mt-6">
    <button class="btn btn-primary" onclick="showToast('success', 'Templating system is working correctly!')">
      <i class="fas fa-check-circle mr-2"></i>Test Notification
    </button>
  </div>
</div>
<?= $this->endSection() ?>