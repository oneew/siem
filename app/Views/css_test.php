<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6">
  <h1 class="text-3xl font-bold text-gray-900 mb-2">CSS Test Page</h1>
  <p class="text-gray-600">This page tests the enhanced CSS styling.</p>
</div>

<!-- Test Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
  <!-- Card 1 -->
  <div class="dashboard-card">
    <div class="p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Dashboard Card</h3>
        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
          <i class="fas fa-chart-bar text-blue-600"></i>
        </div>
      </div>
      <p class="text-gray-600 mb-4">This card should have enhanced styling with hover effects.</p>
      <button class="btn btn-primary">Primary Button</button>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="dashboard-card">
    <div class="p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Interactive Card</h3>
        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
          <i class="fas fa-mouse-pointer text-green-600"></i>
        </div>
      </div>
      <p class="text-gray-600 mb-4">This card should have hover effects and animations.</p>
      <button class="btn btn-secondary">Secondary Button</button>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="dashboard-card">
    <div class="p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">Styled Components</h3>
        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
          <i class="fas fa-palette text-purple-600"></i>
        </div>
      </div>
      <p class="text-gray-600 mb-4">Using the enhanced color palette and component styles.</p>
      <button class="btn btn-danger">Danger Button</button>
    </div>
  </div>
</div>

<!-- Test Table -->
<div class="dashboard-card mb-8">
  <div class="px-6 py-4 border-b border-gray-200">
    <h3 class="text-lg font-semibold text-gray-900">Sample Data Table</h3>
  </div>
  <div class="overflow-x-auto">
    <table class="w-full modern-table">
      <thead>
        <tr>
          <th class="px-6 py-3">ID</th>
          <th class="px-6 py-3">Name</th>
          <th class="px-6 py-3">Status</th>
          <th class="px-6 py-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="px-6 py-4">1</td>
          <td class="px-6 py-4">John Doe</td>
          <td class="px-6 py-4">
            <span class="status-badge bg-green-100 text-green-800">Active</span>
          </td>
          <td class="px-6 py-4">
            <button class="btn btn-secondary btn-sm mr-2">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
        <tr>
          <td class="px-6 py-4">2</td>
          <td class="px-6 py-4">Jane Smith</td>
          <td class="px-6 py-4">
            <span class="status-badge bg-yellow-100 text-yellow-800">Pending</span>
          </td>
          <td class="px-6 py-4">
            <button class="btn btn-secondary btn-sm mr-2">
              <i class="fas fa-edit"></i>
            </button>
            <button class="btn btn-danger btn-sm">
              <i class="fas fa-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>