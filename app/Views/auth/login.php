<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SIEM Security Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/enhanced-style.css') ?>">
  <style>
    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }
    .login-card {
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
    }
    .login-logo {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .login-logo img {
      display: block;
      margin: 0 auto;
      max-width: 120px;
      height: auto;
      transition: all 0.3s ease;
      opacity: 0.9;
    }
    .input-group {
      position: relative;
    }
    .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6B7280;
      z-index: 10;
    }
    .form-input {
      padding-left: 40px;
      transition: all 0.3s ease;
      border: 2px solid #e2e8f0;
    }
    .form-input:focus {
      transform: translateY(-1px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
      border-color: #3b82f6;
    }
    .btn-login {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transition: all 0.3s ease;
      font-weight: 600;
      position: relative;
      overflow: hidden;
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    }
    .btn-login::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transition: left 0.5s ease;
    }
    .btn-login:hover::before {
      left: 100%;
    }
    .floating-shapes {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 1;
    }
    .shape {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }
    .shape:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 20%; animation-delay: 0s; }
    .shape:nth-child(2) { width: 60px; height: 60px; top: 70%; left: 80%; animation-delay: 2s; }
    .shape:nth-child(3) { width: 100px; height: 100px; top: 40%; right: 10%; animation-delay: 4s; }
    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }
    
    /* Alert styles */
    .alert {
      border-radius: 0.5rem;
      padding: 1rem;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      animation: fadeIn 0.3s ease-out;
    }
    
    .alert-success {
      background-color: #dcfce7;
      border: 1px solid #bbf7d0;
      color: #166534;
    }
    
    .alert-error {
      background-color: #fee2e2;
      border: 1px solid #fecaca;
      color: #991b1b;
    }
    
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateX(20px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative">
  <!-- Floating background shapes -->
  <div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
  </div>

  <div class="login-card w-full max-w-md p-8 rounded-2xl relative z-10">
    <!-- Header -->
    <div class="text-center mb-8">
      <div class="login-logo">
        <img src="<?= base_url('assets/images/LOGO_BSSN.png') ?>" alt="Logo" class="h-16 w-auto mx-auto">
      </div>
      <h1 class="text-3xl font-bold text-gray-800 mb-2 mt-4">SIEM Platform</h1>
      <div class="flex items-center justify-center space-x-4 text-sm text-gray-500">
        <span><i class="fas fa-lock mr-1"></i>Secure</span>
        <span><i class="fas fa-eye mr-1"></i>Monitor</span>
        <span><i class="fas fa-chart-line mr-1"></i>Analyze</span>
      </div>
    </div>

    <!-- Error Message -->
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-error">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <span><?= session()->getFlashdata('error') ?></span>
      </div>
    <?php endif; ?>

    <!-- Success Message -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle mr-2"></i>
        <span><?= session()->getFlashdata('success') ?></span>
      </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="post" action="/login/attempt" class="space-y-6">
      <div class="input-group">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          <i class="fas fa-user mr-2"></i>Username
        </label>
        <div class="relative">
          <input type="text" name="username" 
                 class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:border-blue-500" 
                 placeholder="Enter your username" required autocomplete="username">
        </div>
      </div>

      <div class="input-group">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
          <i class="fas fa-lock mr-2"></i>Password
        </label>
        <div class="relative">
          <input type="password" name="password" id="password"
                 class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 focus:outline-none focus:border-blue-500" 
                 placeholder="Enter your password" required autocomplete="current-password">
          <button type="button" onclick="togglePassword()" 
                  class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
            <i class="fas fa-eye" id="toggleIcon"></i>
          </button>
        </div>
      </div>

      <button type="submit" 
              class="btn-login w-full text-white font-semibold py-3 px-4 rounded-lg transition duration-300 ease-in-out flex items-center justify-center">
        <i class="fas fa-sign-in-alt mr-2"></i>
        Sign In
      </button>
    </form>

    <!-- Footer -->
    <div class="text-center mt-8 pt-6 border-t border-gray-200">
      <p class="text-xs text-gray-500">
        <i class="fas fa-shield-alt mr-1"></i>
        Authorized access only
      </p>
      <p class="text-xs text-gray-400 mt-2">
        © 2025 SIEM Platform. All rights reserved.
      </p>
    </div>
  </div>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.className = 'fas fa-eye-slash';
      } else {
        passwordInput.type = 'password';
        toggleIcon.className = 'fas fa-eye';
      }
    }

    // Add loading animation on form submit
    document.querySelector('form').addEventListener('submit', function(e) {
      const submitBtn = e.target.querySelector('button[type="submit"]');
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
      submitBtn.disabled = true;
    });

    // Auto-hide alert messages
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        alert.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        alert.style.opacity = '0';
        alert.style.transform = 'translateX(20px)';
        setTimeout(function() {
          alert.style.display = 'none';
        }, 500);
      });
    }, 5000);
  </script>
</body>
</html>