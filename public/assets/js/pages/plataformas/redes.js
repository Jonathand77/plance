(function () {
            const products = {
                1: { name: '📺 YouTube Premium — Individual', servicio: 'YouTube Premium', plan: 'Individual', price: '19.900 COP', precio: 19900 },
                2: { name: '📺 YouTube Premium — Familiar', servicio: 'YouTube Premium', plan: 'Familiar', price: '29.900 COP', precio: 29900 },
                3: { name: '🐦 Twitter Verificado — Basic', servicio: 'Twitter Verificado', plan: 'Basic', price: '14.900 COP', precio: 14900 },
                4: { name: '🐦 Twitter Verificado — Premium', servicio: 'Twitter Verificado', plan: 'Premium', price: '32.900 COP', precio: 32900 },
                5: { name: '🐦 Twitter Verificado — Premium+', servicio: 'Twitter Verificado', plan: 'Premium+', price: '49.900 COP', precio: 49900 },
                6: { name: '✔️ Meta Verified — Instagram', servicio: 'Meta Verified', plan: 'Instagram', price: '24.900 COP', precio: 24900 },
                7: { name: '✔️ Meta Verified — Facebook', servicio: 'Meta Verified', plan: 'Facebook', price: '24.900 COP', precio: 24900 },
                8: { name: '✔️ Meta Verified — IG + FB', servicio: 'Meta Verified', plan: 'Instagram + Facebook', price: '39.900 COP', precio: 39900 },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;
                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;
                document.getElementById('instructionText').innerHTML =
                    p.servicio + '\u00ae | ' + p.plan + '<br>' +
                    '<span>\uD83C\uDF10</span> Acceso inmediato tras el primer pago<br>' +
                    '<span>\uD83D\uDD04</span> Renovación automática cada mes';
            }

            function initCards() {
                const cards = document.querySelectorAll('.product-card');
                if (cards.length === 0) { setTimeout(initCards, 100); return; }

                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(function (c) { c.classList.remove('selected'); });
                        card.classList.add('selected');
                        updateCheckout(parseInt(card.getAttribute('data-id')));
                    });
                });

                // Selección por defecto
                var def = document.querySelector('.product-card[data-id="1"]');
                if (def) { def.classList.add('selected'); updateCheckout(1); }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else {
                initCards();
            }

            // Buy button
            document.addEventListener('click', function (e) {
                var btn = e.target.closest('#btnBuy');
                if (!btn) return;

                var usuarioId = document.getElementById('usuarioIdInput').value.trim();
                if (!usuarioId) {
                    alert('⚠️ No se detectó tu correo de sesión. Por favor inicia sesión nuevamente.');
                    return;
                }

                var selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un plan primero.'); return; }

                var servicio = selectedCard.getAttribute('data-servicio');
                var plan = selectedCard.getAttribute('data-plan');
                var precio = selectedCard.getAttribute('data-precio');

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_recurrencia.php';

                [['servicio', servicio], ['plan', plan], ['precio', precio], ['usuario_id', usuarioId]].forEach(function (pair) {
                    var input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });

        })();
