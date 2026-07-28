(function () {

            const products = {
                1: { name: '📺 Netflix — Est. con Anuncios', plataforma: 'Netflix', plan: 'Estándar con Anuncios', price: '17.900 COP', precio: 17900 },
                2: { name: '📺 Netflix — Estándar', plataforma: 'Netflix', plan: 'Estándar', price: '26.900 COP', precio: 26900 },
                3: { name: '📺 Netflix — Premium', plataforma: 'Netflix', plan: 'Premium', price: '36.900 COP', precio: 36900 },
                4: { name: '🎬 HBO Max — Básico', plataforma: 'HBO Max', plan: 'Básico', price: '19.900 COP', precio: 19900 },
                5: { name: '🎬 HBO Max — Estándar', plataforma: 'HBO Max', plan: 'Estándar', price: '29.900 COP', precio: 29900 },
                6: { name: '🎬 HBO Max — Ultimate', plataforma: 'HBO Max', plan: 'Ultimate', price: '39.900 COP', precio: 39900 },
                7: { name: '✨ Disney+ — Estándar', plataforma: 'Disney+', plan: 'Estándar', price: '16.900 COP', precio: 16900 },
                8: { name: '✨ Disney+ — Premium', plataforma: 'Disney+', plan: 'Premium', price: '28.900 COP', precio: 28900 },
                9: { name: '✨ Disney+ — Duo Premium', plataforma: 'Disney+', plan: 'Duo Premium', price: '38.900 COP', precio: 38900 },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;

                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;

                document.getElementById('instructionText').innerHTML =
                    p.plataforma + ' | Plan ' + p.plan + ' 📺<br>' +
                    '<span>🌐</span> Acceso inmediato tras el pago<br>' +
                    '<span>⚠️</span> IMPORTANT NOTE BEFORE PURCHASE';
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

                // Selección por defecto: Netflix Estándar
                var def = document.querySelector('.product-card[data-id="2"]');
                if (def) { def.classList.add('selected'); updateCheckout(2); }
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
                    alert('⚠️ Por favor ingresa tu correo antes de continuar.');
                    document.getElementById('usuarioIdInput').focus();
                    return;
                }

                // Obtener datos de la tarjeta seleccionada
                var selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un plan primero.'); return; }

                var plataforma = selectedCard.getAttribute('data-plataforma');
                var plan = selectedCard.getAttribute('data-plan');
                var precio = selectedCard.getAttribute('data-precio');

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_subs.php';

                [['plataforma', plataforma], ['plan', plan], ['precio', precio], ['usuario_id', usuarioId]].forEach(function (pair) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = pair[0];
                    input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });

        })();
