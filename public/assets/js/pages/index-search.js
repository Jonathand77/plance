(function () {
            const input = document.getElementById('quickSearch');
            const box = document.getElementById('quickSearchSuggestions');
            if (!input || !box) return;

            const items = [
                { key: 'sesiones', label: 'Sesiones', href: 'sesiones.php', icon: 'bi bi-cart-plus-fill' },
                { key: 'historial', label: 'Historial', href: 'historial/historial.php', icon: 'bi bi-file-text-fill' },
                { key: 'configuracion', label: 'Configuración', href: 'profile/index.php', icon: 'bi bi-gear-fill' },
                { key: 'perfil', label: 'Mi Perfil', href: 'profile/index.php', icon: 'bi bi-person-badge' },
                { key: 'juegos', label: 'Juegos', href: 'games/juegos.php', icon: 'bi bi-controller' },
                { key: 'plataformas', label: 'Plataformas', href: 'plataformas/suscripciones.php', icon: 'bi bi-tv' },
                { key: 'dispersiones', label: 'Dispersiones', href: 'dispersiones/dispersion.php', icon: 'bi bi-airplane-fill' },
                { key: 'reservaciones', label: 'Reservaciones', href: 'reservasiones/reservas.php', icon: 'bi bi-building-fill' },
            ];

            function norm(s) { return (s || '').toLowerCase().trim(); }

            function render(list) {
                box.innerHTML = '';
                if (!list.length) { box.style.display = 'none'; return; }
                list.forEach(it => {
                    const a = document.createElement('a');
                    a.href = it.href;
                    a.innerHTML = `<i class="${it.icon}" style="color:var(--color-primary);"></i> <span>${it.label}</span>`;
                    box.appendChild(a);
                });
                box.style.display = 'block';
            }

            input.addEventListener('input', () => {
                const q = norm(input.value);
                if (!q) { box.style.display = 'none'; return; }
                const matches = items.filter(it => it.key.includes(q) || norm(it.label).includes(q)).slice(0, 5);
                render(matches);
            });

            document.addEventListener('click', (e) => {
                if (!box.contains(e.target) && e.target !== input) box.style.display = 'none';
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    const q = norm(input.value);
                    const first = items.find(it => it.key.includes(q) || norm(it.label).includes(q));
                    if (first) window.location.href = first.href;
                }
            });
        })();
