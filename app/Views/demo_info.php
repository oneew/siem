<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIEM Platform - Demo Information</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-gray-50">
  <div class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
      <!-- Header -->
      <div class="bg-white rounded-t-xl p-6 border-b border-gray-200">
        <div class="flex items-center justify-center mb-4">
          <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
            <i class="fas fa-shield-alt text-2xl text-white"></i>
          </div>
        </div>
        <h1 class="text-2xl font-bold text-center text-gray-900">SIEM Platform Demo</h1>
        <p class="text-center text-gray-600 mt-2">Security Information & Event Management System</p>
      </div>

      <!-- Demo Information -->
      <div class="bg-white p-6 space-y-6">
        <!-- Login Credentials -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <h3 class="text-lg font-semibold text-blue-900 mb-3">
            <i class="fas fa-key mr-2"></i>Demo Login Credentials
          </h3>
          <div class="space-y-2">
            <div class="flex justify-between items-center p-3 bg-white rounded border">
              <div>
                <span class="font-medium text-gray-900">Username:</span>
                <code class="ml-2 px-2 py-1 bg-gray-100 rounded text-sm">admin</code>
              </div>
              <div>
                <span class="font-medium text-gray-900">Password:</span>
                <code class="ml-2 px-2 py-1 bg-gray-100 rounded text-sm">admin123</code>
              </div>
            </div>
          </div>
        </div>

        <!-- Features -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
          <h3 class="text-lg font-semibold text-green-900 mb-3">
            <i class="fas fa-check-circle mr-2"></i>Available Features
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="flex items-center space-x-2">
              <i class="fas fa-tachometer-alt text-green-600"></i>
              <span>Security Dashboard</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-exclamation-triangle text-green-600"></i>
              <span>Incident Management</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-virus text-green-600"></i>
              <span>Threat Intelligence</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-bell text-green-600"></i>
              <span>Security Alerts</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-server text-green-600"></i>
              <span>Asset Management</span>
            </div>
            <div class="flex items-center space-x-2">
              <i class="fas fa-chart-line text-green-600"></i>
              <span>Reports & Analytics</span>
            </div>
          </div>
        </div>

        <!-- Demo Note -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
          <h3 class="text-lg font-semibold text-yellow-900 mb-3">
            <i class="fas fa-info-circle mr-2"></i>Demo Mode Information
          </h3>
          <ul class="space-y-2 text-sm text-yellow-800">
            <li class="flex items-start space-x-2">
              <i class="fas fa-circle text-xs mt-2"></i>
              <span>This demo runs without a database connection for easy testing</span>
            </li>
            <li class="flex items-start space-x-2">
              <i class="fas fa-circle text-xs mt-2"></i>
              <span>Sample data is used to demonstrate functionality</span>
            </li>
            <li class="flex items-start space-x-2">
              <i class="fas fa-circle text-xs mt-2"></i>
              <span>To use with a real database, configure the .env file properly</span>
            </li>
            <li class="flex items-start space-x-2">
              <i class="fas fa-circle text-xs mt-2"></i>
              <span>All changes are temporary and will not be saved</span>
            </li>
          </ul>
        </div>

        <!-- Setup Instructions -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
          <h3 class="text-lg font-semibold text-gray-900 mb-3">
            <i class="fas fa-cog mr-2"></i>Production Setup
          </h3>
          <div class="text-sm text-gray-700 space-y-2">
            <p><strong>1. Database Setup:</strong> Configure MySQL/MariaDB connection in .env file</p>
            <p><strong>2. Run Migrations:</strong> <code class="bg-gray-200 px-2 py-1 rounded">php spark migrate</code></p>
            <p><strong>3. Seed Data:</strong> <code class="bg-gray-200 px-2 py-1 rounded">php spark db:seed UserSeeder</code></p>
            <p><strong>4. Configure Environment:</strong> Update security keys and settings in .env</p>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="bg-white rounded-b-xl p-6 border-t border-gray-200">
        <div class="flex flex-col sm:flex-row gap-3 justify-center">
          <a href="/login" class="btn bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Access Demo
          </a>
          <a href="/login" class="btn bg-gray-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-700 transition-colors flex items-center justify-center">
            <i class="fas fa-book mr-2"></i>
            View Documentation
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>