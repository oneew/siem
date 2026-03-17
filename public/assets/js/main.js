document.addEventListener('DOMContentLoaded', () => {
  const pageContent = document.getElementById('pageContent');
  const pageTitle = document.getElementById('pageTitle');
  const navLinks = document.querySelectorAll('.nav-link');

  function loadPage(page, title) {
    fetch(`pages/${page}.html`)
      .then(res => res.text())
      .then(html => {
        pageContent.innerHTML = html;
        pageTitle.textContent = title;
      })
      .catch(() => {
        pageContent.innerHTML = `<p class="text-red-500">Gagal memuat halaman ${page}</p>`;
      });
  }

  navLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      navLinks.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
      const page = link.dataset.page;
      const title = link.textContent.trim();
      loadPage(page, title);
    });
  });

  // Default: buka dashboard
  loadPage('dashboard', 'Dashboard');
});
