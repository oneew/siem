<!-- Toast Container -->
<div id="toast-container" class="fixed top-4 right-4 space-y-2 z-50"></div>

<!-- Enhanced JavaScript -->
<script src="<?= base_url('assets/js/enhanced-app.js') ?>"></script>
<script>
  // Enhanced profile dropdown functionality
  document.addEventListener('DOMContentLoaded', () => {
    // Auto-hide flash messages after 5 seconds
    const flashMessages = document.querySelectorAll('.alert');
    if (flashMessages.length) {
      setTimeout(() => {
        flashMessages.forEach(msg => {
          msg.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
          msg.style.opacity = '0';
          msg.style.transform = 'translateY(-10px)';
          setTimeout(() => msg.remove(), 500);
        });
      }, 5000);
    }

    // Active navigation highlighting
    const navLinks = document.querySelectorAll('.nav-item');
    const currentPath = window.location.pathname;

    navLinks.forEach(link => {
      const linkPath = new URL(link.href).pathname;
      if (currentPath === linkPath || (linkPath !== '/' && currentPath.startsWith(linkPath))) {
        link.classList.add('bg-siem-primary/10', 'text-siem-primary', 'border-r-2', 'border-siem-primary');
      }
    });

    // Enhanced toast notifications
    window.showAdvancedToast = function(type, title, message, duration = 5000) {
      const container = document.getElementById('toast-container') || createToastContainer();

      const toast = document.createElement('div');
      toast.className = `toast-notification ${getToastClasses(type)} transform transition-all duration-500 translate-x-full opacity-0`;

      toast.innerHTML = `
        <div class="flex items-start space-x-3">
          <div class="flex-shrink-0">
            <i class="${getToastIcon(type)} text-lg"></i>
          </div>
          <div class="flex-1">
            <h4 class="font-semibold">${title}</h4>
            <p class="text-sm mt-1">${message}</p>
          </div>
          <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 opacity-70 hover:opacity-100">
            <i class="fas fa-times"></i>
          </button>
        </div>
      `;

      container.appendChild(toast);

      // Trigger animation
      setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
      }, 50);

      // Auto remove
      setTimeout(() => {
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => toast.remove(), 500);
      }, duration);
    };

    function createToastContainer() {
      const container = document.createElement('div');
      container.id = 'toast-container';
      container.className = 'fixed top-4 right-4 space-y-3 z-50 max-w-sm';
      document.body.appendChild(container);
      return container;
    }

    function getToastClasses(type) {
      const classes = {
        success: 'bg-green-500 text-white',
        error: 'bg-red-500 text-white',
        warning: 'bg-yellow-500 text-white',
        info: 'bg-blue-500 text-white'
      };
      return `${classes[type] || classes.info} px-6 py-4 rounded-lg shadow-lg max-w-sm`;
    }

    function getToastIcon(type) {
      const icons = {
        success: 'fas fa-check-circle',
        error: 'fas fa-exclamation-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-info-circle'
      };
      return icons[type] || icons.info;
    }
  });

  // Legacy support for existing toast function
  function showToast(type, message) {
    window.showAdvancedToast(type, type.charAt(0).toUpperCase() + type.slice(1), message);
  }
</script>

<!-- Enhanced Footer -->
<footer class="footer bg-white border-t border-gray-200 mt-auto" role="contentinfo">
  <div class="footer-container max-w-full mx-auto px-6 py-6">
    <div class="flex flex-col lg:flex-row justify-between items-center space-y-4 lg:space-y-0">
      <!-- Left Side - Copyright & Links -->
      <div class="flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-6">
        <p class="text-sm text-gray-600">
          &copy; <?= date('Y') ?> SIEM Platform. All rights reserved.
        </p>
        <div class="flex items-center space-x-4 text-sm">
          <a href="<?= base_url('privacy') ?>" class="text-gray-500 hover:text-siem-primary transition-colors">Privacy Policy</a>
          <span class="text-gray-300">|</span>
          <a href="<?= base_url('terms') ?>" class="text-gray-500 hover:text-siem-primary transition-colors">Terms of Service</a>
          <span class="text-gray-300">|</span>
          <a href="<?= base_url('support') ?>" class="text-gray-500 hover:text-siem-primary transition-colors">Support</a>
        </div>
      </div>

      <!-- Right Side - System Info & Status -->
      <div class="flex items-center space-x-6">
        <!-- System Version -->
        <div class="text-sm text-gray-500">
          <span>Version 2.1.0</span>
        </div>
        
        <!-- System Status Indicator -->
        <div class="flex items-center space-x-2">
          <div class="w-2 h-2 bg-siem-success rounded-full animate-pulse-slow"></div>
          <span class="text-sm text-gray-600">System Operational</span>
        </div>
        
        <!-- Last Update -->
        <div class="text-sm text-gray-500">
          <i class="fas fa-clock mr-1"></i>
          <span>Updated: <?= date('M j, g:i A') ?></span>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Back to Top Button -->
<button 
  id="backToTop" 
  class="fixed bottom-6 right-6 w-12 h-12 bg-siem-primary text-white rounded-full shadow-medium hover:bg-siem-secondary transition-all duration-300 transform translate-y-16 opacity-0 z-30"
  aria-label="Back to top"
>
  <i class="fas fa-chevron-up"></i>
</button>

<!-- Loading Overlay -->
<div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
  <div class="bg-white rounded-lg p-6 flex flex-col items-center">
    <i class="fas fa-spinner fa-spin text-3xl text-siem-primary mb-4"></i>
    <p class="text-gray-700">Loading...</p>
  </div>
</div>

</body>
</html>