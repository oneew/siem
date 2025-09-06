document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const body = document.body;

    const toggleSidebar = () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('hidden');
        
        // Prevent body scroll when sidebar is open on mobile
        if (sidebar.classList.contains('open')) {
            body.style.overflow = 'hidden';
        } else {
            body.style.overflow = '';
        }
    };

    const closeSidebar = () => {
        sidebar.classList.remove('open');
        overlay.classList.add('hidden');
        body.style.overflow = '';
    };

    if (menuToggle && sidebar && overlay) {
        menuToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });
    
        overlay.addEventListener('click', toggleSidebar);
    }

    // Close sidebar when clicking outside on larger screens
    document.addEventListener('click', (e) => {
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isClickOnMenuToggle = menuToggle && menuToggle.contains(e.target);
        
        if (!isClickInsideSidebar && !isClickOnMenuToggle && sidebar.classList.contains('open')) {
            closeSidebar();
        }
    });

    // Close sidebar on escape key press
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeSidebar();
        }
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            // On large screens, ensure sidebar is visible and reset body overflow
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
            body.style.overflow = '';
        }
    });
});