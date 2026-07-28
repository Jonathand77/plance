(function () {
            const tickets = {
                1: { dest: '✈️ Cartagena, Colombia', base: 350000, imp: 50000, total: 400000 },
                2: { dest: '✈️ Buenos Aires, Argentina', base: 800000, imp: 120000, total: 920000 },
                3: { dest: '✈️ Cusco, Perú', base: 650000, imp: 95000, total: 745000 },
                4: { dest: '✈️ Río de Janeiro, Brasil', base: 900000, imp: 130000, total: 1030000 },
                5: { dest: '✈️ París, Francia', base: 2500000, imp: 350000, total: 2850000 },
                6: { dest: '✈️ Roma, Italia', base: 2200000, imp: 320000, total: 2520000 },
                7: { dest: '✈️ Tokio, Japón', base: 3000000, imp: 420000, total: 3420000 },
                8: { dest: '✈️ Nueva York, USA', base: 1800000, imp: 250000, total: 2050000 },
            };

            let selectedId = null;
            function fmt(n) { return '$' + n.toLocaleString('es-CO') + ' COP'; }

            function updateCheckout(id) {
                const t = tickets[id];
                document.getElementById('checkoutDest').textContent = t.dest;
                document.getElementById('checkoutPrice').textContent = fmt(t.total);
                document.getElementById('dispBase').textContent = fmt(t.base);
                document.getElementById('dispImp').textContent = fmt(t.imp);
                document.getElementById('dispTotal').textContent = fmt(t.total);
                document.getElementById('dispBox').style.display = 'block';
            }

            window.filterRegion = function (region, el) {
                document.querySelectorAll('.region-tab').forEach(t => t.classList.remove('active'));
                el.classList.add('active');
                document.querySelectorAll('.ticket-card').forEach(function (card) {
                    const r = card.getAttribute('data-region');
                    card.style.display = (region === 'all' || r === region) ? '' : 'none';
                });
            };

            function initCards() {
                const cards = document.querySelectorAll('.ticket-card');
                if (!cards.length) { setTimeout(initCards, 100); return; }
                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        selectedId = parseInt(card.getAttribute('data-id'));
                        updateCheckout(selectedId);
                    });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            window.comprar = function () {
                if (!selectedId) { alert('⚠️ Selecciona un destino primero.'); return; }
                const nombre = document.getElementById('pNombre').value.trim();
                const correo = document.getElementById('pCorreo').value.trim();
                const telefono = document.getElementById('pTelefono').value.trim();
                const tipoDoc = document.getElementById('pTipoDoc').value;
                const numDoc = document.getElementById('pNumDoc').value.trim();

                if (!nombre || !correo || !telefono || !numDoc) {
                    alert('⚠️ Completa todos los datos del pasajero.'); return;
                }

                const t = tickets[selectedId];
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_dispersion.php';

                [
                    ['destino', t.dest.replace('✈️ ', '')],
                    ['base', t.base],
                    ['impuesto', t.imp],
                    ['total', t.total],
                    ['nombre', nombre],
                    ['correo', correo],
                    ['telefono', telefono],
                    ['tipo_doc', tipoDoc],
                    ['num_doc', numDoc],
                ].forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            };
        })();
