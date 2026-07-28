// Desplegables del sidebar (Guía / Seguridad)
    document.querySelectorAll('.nav-title').forEach(function (btn) {
      btn.addEventListener('click', function () {
        const target = document.getElementById(this.dataset.target);
        const collapsed = this.classList.toggle('collapsed');
        this.setAttribute('aria-expanded', String(!collapsed));
        if (target) target.classList.toggle('collapsed', collapsed);
      });
    });

    // Scroll suave para los links del sidebar
    document.querySelectorAll('.nav a[href^="#"]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        document.querySelectorAll('.nav a').forEach(a => a.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Búsqueda simple
    document.querySelector('.search').addEventListener('input', function () {
      const q = this.value.toLowerCase();
      document.querySelectorAll('.section').forEach(function (sec) {
        const text = sec.textContent.toLowerCase();
        sec.style.opacity = (!q || text.includes(q)) ? '1' : '0.25';
      });
    });

    (function () {
      const lightbox = document.getElementById('imgLightbox');
      const lightboxImg = document.getElementById('lightboxImg');
      const closeBtn = document.getElementById('lightboxClose');

      function openLightbox(src, alt) {
        lightboxImg.src = src;
        lightboxImg.alt = alt || '';
        lightbox.classList.add('active');
        document.body.classList.add('lightbox-open');
      }

      function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.classList.remove('lightbox-open');
      }

      document.querySelectorAll('.image-placeholder img').forEach(function (img) {
        img.addEventListener('click', function () {
          openLightbox(img.currentSrc || img.src, img.alt);
        });
      });

      closeBtn.addEventListener('click', closeLightbox);
      lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) closeLightbox();
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
      });
    })();
