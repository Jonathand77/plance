(function () {
            const buttons = Array.from(document.querySelectorAll('.servicio-btn'));
            const cards = Array.from(document.querySelectorAll('[data-servicio]'));

            function applyFilter(filter) {
                cards.forEach(card => {
                    const svc = card.getAttribute('data-servicio');
                    card.style.display = (svc === filter) ? '' : 'none';
                });
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    applyFilter(btn.getAttribute('data-filter'));
                });
            });

            // Default: API Link de pagos
            applyFilter('web');
        })();
