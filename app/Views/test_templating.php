<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="mb-6">
  <h1 class="text-3xl font-bold text-gray-900 mb-2">Templating System Test</h1>
  <p class="text-gray-600">This page demonstrates the enhanced templating system with modern styling.</p>
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
      <p class="text-gray-600 mb-4">This is a sample card using the enhanced dashboard card styling.</p>
      <button class="btn btn-primary">Action Button</button>
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
      <p class="text-gray-600 mb-4">This card demonstrates hover effects and animations.</p>
      <button class="btn btn-secondary">Secondary Action</button>
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
      <button class="btn btn-success">Success Action</button>
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
        <tr>
          <td class="px-6 py-4">3</td>
          <td class="px-6 py-4">Robert Johnson</td>
          <td class="px-6 py-4">
            <span class="status-badge bg-red-100 text-red-800">Inactive</span>
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

<!-- Test Form -->
<div class="dashboard-card">
  <div class="px-6 py-4 border-b border-gray-200">
    <h3 class="text-lg font-semibold text-gray-900">Sample Form</h3>
  </div>
  <div class="p-6">
    <form class="space-y-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="form-label">First Name</label>
          <input type="text" class="form-input" placeholder="Enter first name">
        </div>
        <div>
          <label class="form-label">Last Name</label>
          <input type="text" class="form-input" placeholder="Enter last name">
        </div>
      </div>
      <div>
        <label class="form-label">Email Address</label>
        <input type="email" class="form-input" placeholder="Enter email address">
      </div>
      <div>
        <label class="form-label">Message</label>
        <textarea class="form-textarea" rows="4" placeholder="Enter your message"></textarea>
      </div>
      <div class="flex items-center justify-end space-x-4">
        <button type="button" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>