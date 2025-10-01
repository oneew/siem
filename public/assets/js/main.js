document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const body = document.body;
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = themeToggle ? themeToggle.querySelector('i') : null;

    // Periksa preferensi tema yang disimpan atau ikuti preferensi OS
    const savedTheme = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
    
    // Terapkan tema
    applyTheme(initialTheme);
    
    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            if (themeIcon) {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
                themeToggle.title = 'Beralih ke mode terang';
            }
        } else {
            document.documentElement.removeAttribute('data-theme');
            if (themeIcon) {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
                themeToggle.title = 'Beralih ke mode gelap';
            }
        }
        localStorage.setItem('theme', theme);
    }
    
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        applyTheme(newTheme);
    }

    const toggleSidebar = () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('hidden');
        
        // Cegah scroll body saat sidebar terbuka di perangkat mobile
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

    // Handle both old and new menu toggle buttons
    if ((menuToggle || mobileMenuToggle) && sidebar && overlay) {
        const toggleButton = menuToggle || mobileMenuToggle;
        
        toggleButton.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleSidebar();
        });
    
        overlay.addEventListener('click', toggleSidebar);
    }
    
    // Tambahkan event listener untuk toggle tema
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }

    // Tutup sidebar saat mengklik di luar pada layar besar
    document.addEventListener('click', (e) => {
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isClickOnMenuToggle = (menuToggle && menuToggle.contains(e.target)) || 
                                   (mobileMenuToggle && mobileMenuToggle.contains(e.target));
        const isClickOnThemeToggle = themeToggle && themeToggle.contains(e.target);
        
        if (!isClickInsideSidebar && !isClickOnMenuToggle && !isClickOnThemeToggle && sidebar.classList.contains('open')) {
            closeSidebar();
        }
    });

    // Tutup sidebar saat menekan tombol escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeSidebar();
        }
    });

    // Tangani perubahan ukuran jendela
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            // Pada layar besar, pastikan sidebar terlihat dan reset overflow body
            sidebar.classList.remove('open');
            overlay.classList.add('hidden');
            body.style.overflow = '';
        }
    });
});

// Fungsi bantu SweetAlert2
function showSuccessAlert(title, text = '') {
    Swal.fire({
        icon: 'success',
        title: title,
        text: text,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
}

function showErrorAlert(title, text = '') {
    Swal.fire({
        icon: 'error',
        title: title,
        text: text,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
}

function showInfoAlert(title, text = '') {
    Swal.fire({
        icon: 'info',
        title: title,
        text: text,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
}

function showWarningAlert(title, text = '') {
    Swal.fire({
        icon: 'warning',
        title: title,
        text: text,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK'
    });
}

function showConfirmAlert(title, text = '', confirmCallback) {
    Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed && confirmCallback) {
            confirmCallback();
        }
    });
}