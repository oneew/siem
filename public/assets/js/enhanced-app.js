/**
 * Enhanced SIEM Platform - Modern JavaScript Application
 * Handles all interactive functionality and UI enhancements with modern animations and effects
 */

class EnhancedSIEMApp {
  constructor() {
    this.init();
  }

  init() {
    this.setupEventListeners();
    this.initializeComponents();
    this.setupAccessibility();
    this.handleResponsiveDesign();
    this.setupTheme();
  }

  setupEventListeners() {
    // Sidebar Toggle
    this.setupSidebarToggle();
    
    // Profile Dropdown
    this.setupProfileDropdown();
    
    // Back to Top Button
    this.setupBackToTop();
    
    // Form Enhancements
    this.setupFormEnhancements();
    
    // Loading States
    this.setupLoadingStates();
    
    // Keyboard Navigation
    this.setupKeyboardNavigation();
    
    // Card Hover Effects
    this.setupCardHoverEffects();
    
    // Button Ripple Effects
    this.setupButtonRippleEffects();
  }

  setupSidebarToggle() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener('click', () => {
        this.toggleSidebar(true);
      });
    }

    if (sidebarClose && sidebar) {
      sidebarClose.addEventListener('click', () => {
        this.toggleSidebar(false);
      });
    }

    if (sidebarOverlay) {
      sidebarOverlay.addEventListener('click', () => {
        this.toggleSidebar(false);
      });
    }

    // Close sidebar on escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && sidebar && sidebar.classList.contains('open')) {
        this.toggleSidebar(false);
      }
    });
  }

  toggleSidebar(open) {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (!sidebar) return;

    if (open) {
      sidebar.classList.add('open');
      sidebar.style.transform = 'translateX(0)';
      if (sidebarOverlay) {
        sidebarOverlay.classList.remove('hidden');
      }
      if (sidebarToggle) {
        sidebarToggle.setAttribute('aria-expanded', 'true');
      }
      // Focus first navigation item for accessibility
      const firstNavItem = sidebar.querySelector('.nav-item');
      if (firstNavItem) {
        firstNavItem.focus();
      }
      // Prevent body scroll when sidebar is open
      document.body.classList.add('overflow-hidden');
    } else {
      sidebar.classList.remove('open');
      sidebar.style.transform = 'translateX(-100%)';
      if (sidebarOverlay) {
        sidebarOverlay.classList.add('hidden');
      }
      if (sidebarToggle) {
        sidebarToggle.setAttribute('aria-expanded', 'false');
        sidebarToggle.focus(); // Return focus to toggle button
      }
      // Allow body scroll when sidebar is closed
      document.body.classList.remove('overflow-hidden');
    }
  }

  setupProfileDropdown() {
    const profileButton = document.getElementById('profileMenuButton');
    const profileDropdown = document.getElementById('profileMenuDropdown');

    if (profileButton && profileDropdown) {
      profileButton.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = !profileDropdown.classList.contains('hidden');
        
        if (isOpen) {
          this.closeProfileDropdown();
        } else {
          this.openProfileDropdown();
        }
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', (e) => {
        if (!profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
          this.closeProfileDropdown();
        }
      });

      // Close dropdown on escape key
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !profileDropdown.classList.contains('hidden')) {
          this.closeProfileDropdown();
          profileButton.focus();
        }
      });
    }
  }

  openProfileDropdown() {
    const profileButton = document.getElementById('profileMenuButton');
    const profileDropdown = document.getElementById('profileMenuDropdown');
    
    if (profileDropdown) {
      profileDropdown.classList.remove('hidden');
      profileButton.setAttribute('aria-expanded', 'true');
      
      // Focus first menu item
      const firstMenuItem = profileDropdown.querySelector('a');
      if (firstMenuItem) {
        firstMenuItem.focus();
      }
    }
  }

  closeProfileDropdown() {
    const profileButton = document.getElementById('profileMenuButton');
    const profileDropdown = document.getElementById('profileMenuDropdown');
    
    if (profileDropdown) {
      profileDropdown.classList.add('hidden');
      profileButton.setAttribute('aria-expanded', 'false');
    }
  }

  setupBackToTop() {
    const backToTopButton = document.getElementById('backToTop');
    
    if (backToTopButton) {
      // Show/hide button based on scroll position
      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
          backToTopButton.style.transform = 'translateY(0)';
          backToTopButton.style.opacity = '1';
        } else {
          backToTopButton.style.transform = 'translateY(16px)';
          backToTopButton.style.opacity = '0';
        }
      });

      // Smooth scroll to top with easing
      backToTopButton.addEventListener('click', () => {
        this.smoothScrollToTop();
      });
    }
  }

  smoothScrollToTop() {
    const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
    if (currentScroll > 0) {
      window.requestAnimationFrame(() => this.smoothScrollToTop());
      window.scrollTo(0, currentScroll - (currentScroll / 8));
    }
  }

  setupFormEnhancements() {
    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
      textarea.addEventListener('input', () => {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
      });
    });

    // Form validation enhancements
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
      form.addEventListener('submit', (e) => {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
          if (!field.value.trim()) {
            isValid = false;
            field.classList.add('border-red-500');
            this.showFieldError(field, 'This field is required');
          } else {
            field.classList.remove('border-red-500');
            this.hideFieldError(field);
          }
        });

        if (!isValid) {
          e.preventDefault();
          const firstInvalidField = form.querySelector('.border-red-500');
          if (firstInvalidField) {
            firstInvalidField.focus();
            // Scroll to the first invalid field
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
        }
      });
    });

    // Real-time validation
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
      input.addEventListener('blur', () => {
        this.validateField(input);
      });

      input.addEventListener('input', () => {
        if (input.classList.contains('border-red-500')) {
          this.validateField(input);
        }
      });
    });
  }

  validateField(field) {
    const value = field.value.trim();
    const type = field.type;
    let isValid = true;
    let errorMessage = '';

    // Required field validation
    if (field.hasAttribute('required') && !value) {
      isValid = false;
      errorMessage = 'This field is required';
    }

    // Email validation
    if (type === 'email' && value && !this.isValidEmail(value)) {
      isValid = false;
      errorMessage = 'Please enter a valid email address';
    }

    // Password validation
    if (type === 'password' && value && value.length < 8) {
      isValid = false;
      errorMessage = 'Password must be at least 8 characters long';
    }

    if (isValid) {
      field.classList.remove('border-red-500');
      field.classList.add('border-green-500');
      this.hideFieldError(field);
    } else {
      field.classList.remove('border-green-500');
      field.classList.add('border-red-500');
      this.showFieldError(field, errorMessage);
    }
  }

  showFieldError(field, message) {
    this.hideFieldError(field); // Remove existing error
    
    const errorElement = document.createElement('div');
    errorElement.className = 'field-error text-red-600 text-sm mt-1 flex items-center';
    errorElement.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i>' + message;
    
    field.parentNode.appendChild(errorElement);
  }

  hideFieldError(field) {
    const existingError = field.parentNode.querySelector('.field-error');
    if (existingError) {
      existingError.remove();
    }
  }

  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  setupLoadingStates() {
    // Add loading states to buttons
    const buttons = document.querySelectorAll('button[type="submit"], .btn-loading');
    buttons.forEach(button => {
      button.addEventListener('click', () => {
        if (button.form && button.form.checkValidity()) {
          this.setButtonLoading(button, true);
        }
      });
    });

    // Add loading states to links with data-loading attribute
    const loadingLinks = document.querySelectorAll('a[data-loading]');
    loadingLinks.forEach(link => {
      link.addEventListener('click', () => {
        this.showLoadingOverlay();
      });
    });
  }

  setButtonLoading(button, loading) {
    if (loading) {
      button.disabled = true;
      const originalText = button.innerHTML;
      button.dataset.originalText = originalText;
      button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
    } else {
      button.disabled = false;
      button.innerHTML = button.dataset.originalText || 'Submit';
    }
  }

  showLoadingOverlay() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) {
      overlay.classList.remove('hidden');
    }
  }

  hideLoadingOverlay() {
    const overlay = document.getElementById('loadingOverlay');
    if (overlay) {
      overlay.classList.add('hidden');
    }
  }

  setupKeyboardNavigation() {
    // Enhanced keyboard navigation for dropdowns
    document.addEventListener('keydown', (e) => {
      const activeDropdown = document.querySelector('.dropdown:not(.hidden)');
      if (activeDropdown) {
        const menuItems = activeDropdown.querySelectorAll('a, button');
        const currentIndex = Array.from(menuItems).findIndex(item => item === document.activeElement);

        switch (e.key) {
          case 'ArrowDown':
            e.preventDefault();
            const nextIndex = currentIndex < menuItems.length - 1 ? currentIndex + 1 : 0;
            menuItems[nextIndex].focus();
            break;
          case 'ArrowUp':
            e.preventDefault();
            const prevIndex = currentIndex > 0 ? currentIndex - 1 : menuItems.length - 1;
            menuItems[prevIndex].focus();
            break;
        }
      }
    });
  }

  setupAccessibility() {
    // Add focus indicators for keyboard navigation
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Tab') {
        document.body.classList.add('keyboard-navigation');
      }
    });

    document.addEventListener('mousedown', () => {
      document.body.classList.remove('keyboard-navigation');
    });

    // Announce dynamic content changes to screen readers
    this.setupAriaLiveRegions();
  }

  setupAriaLiveRegions() {
    // Create aria-live region for announcements
    const liveRegion = document.createElement('div');
    liveRegion.setAttribute('aria-live', 'polite');
    liveRegion.setAttribute('aria-atomic', 'true');
    liveRegion.className = 'sr-only';
    liveRegion.id = 'aria-live-region';
    document.body.appendChild(liveRegion);
  }

  announceToScreenReader(message) {
    const liveRegion = document.getElementById('aria-live-region');
    if (liveRegion) {
      liveRegion.textContent = message;
      setTimeout(() => {
        liveRegion.textContent = '';
      }, 1000);
    }
  }

  handleResponsiveDesign() {
    // Handle responsive table scrolling
    const tables = document.querySelectorAll('.table-container');
    tables.forEach(container => {
      if (container.scrollWidth > container.clientWidth) {
        container.setAttribute('tabindex', '0');
        container.setAttribute('role', 'region');
        container.setAttribute('aria-label', 'Scrollable table');
      }
    });

    // Handle responsive navigation
    window.addEventListener('resize', () => {
      const sidebar = document.getElementById('sidebar');
      const sidebarOverlay = document.getElementById('sidebarOverlay');
      
      if (window.innerWidth >= 1024) {
        if (sidebar) {
          sidebar.classList.remove('open');
          sidebar.style.transform = 'translateX(0)';
        }
        if (sidebarOverlay) {
          sidebarOverlay.classList.add('hidden');
        }
        document.body.classList.remove('overflow-hidden');
      }
    });

    // Initialize on load
    if (window.innerWidth >= 1024) {
      const sidebar = document.getElementById('sidebar');
      if (sidebar) {
        sidebar.style.transform = 'translateX(0)';
      }
    }
  }

  initializeComponents() {
    // Initialize any components that need to be set up on load
    this.initializeTooltips();
    this.initializeCharts();
    this.initializeAnimations();
  }

  initializeTooltips() {
    // Tooltip functionality
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(tooltip => {
      tooltip.addEventListener('mouseenter', () => {
        this.showTooltip(tooltip);
      });
      
      tooltip.addEventListener('mouseleave', () => {
        this.hideTooltip(tooltip);
      });
    });
  }

  showTooltip(element) {
    // Create tooltip element
    const tooltipText = element.getAttribute('data-tooltip');
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.textContent = tooltipText;
    tooltip.style.cssText = `
      position: absolute;
      background: rgba(0, 0, 0, 0.8);
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 12px;
      z-index: 1000;
      pointer-events: none;
      white-space: nowrap;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      animation: fadeIn 0.2s ease-in-out;
    `;
    
    document.body.appendChild(tooltip);
    
    // Position tooltip
    const rect = element.getBoundingClientRect();
    tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
    
    element.tooltipElement = tooltip;
  }

  hideTooltip(element) {
    if (element.tooltipElement) {
      element.tooltipElement.remove();
      delete element.tooltipElement;
    }
  }

  initializeCharts() {
    // Chart initialization logic would go here
    // This is a placeholder for any chart libraries like Chart.js
  }

  setupCardHoverEffects() {
    const cards = document.querySelectorAll('.card, .dashboard-card, .metric-card');
    cards.forEach(card => {
      card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-5px)';
        card.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
      });
      
      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
        card.style.boxShadow = '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)';
      });
    });
  }

  setupButtonRippleEffects() {
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
      button.addEventListener('click', function(e) {
        // Create ripple element
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        this.appendChild(ripple);
        
        // Get click position
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size/2;
        const y = e.clientY - rect.top - size/2;
        
        // Style ripple
        ripple.style.cssText = `
          position: absolute;
          width: ${size}px;
          height: ${size}px;
          left: ${x}px;
          top: ${y}px;
          background: rgba(255, 255, 255, 0.5);
          border-radius: 50%;
          transform: scale(0);
          animation: ripple 0.6s linear;
          pointer-events: none;
        `;
        
        // Remove ripple after animation
        setTimeout(() => {
          ripple.remove();
        }, 600);
      });
    });
  }

  setupTheme() {
    // Check for saved theme preference or default to system preference
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
      document.body.classList.add('dark-theme');
    }
  }
}

// Add ripple animation to styles
const style = document.createElement('style');
style.textContent = `
  @keyframes ripple {
    to {
      transform: scale(2);
      opacity: 0;
    }
  }
`;
document.head.appendChild(style);

// Initialize the app when the DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  window.enhancedSIEMApp = new EnhancedSIEMApp();
});

// Export for testing purposes
if (typeof module !== 'undefined' && module.exports) {
  module.exports = EnhancedSIEMApp;
}