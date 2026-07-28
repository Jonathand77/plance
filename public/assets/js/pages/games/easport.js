(function () {

            const products = {
                1: { name: '100 FC', price: '6.500 COP', original: '', badge: '', delivery: 'Instante' },
                2: { name: '500 FC', price: '14.000 COP', original: '18.000 COP', badge: '-32%', delivery: 'Instante' },
                3: { name: '1100 FC', price: '25.500 COP', original: '31.000 COP', badge: '-31%', delivery: 'Instante' },
                4: { name: '2200 FC', price: '36.000 COP', original: '44.000 COP', badge: '-61%', delivery: 'Instante' },
                5: { name: '5000 FC', price: '42.500 COP', original: '56.900 COP', badge: '-62%', delivery: 'Instante' },
                6: { name: '9500 FC', price: '72.000 COP', original: '85.400 COP', badge: '-67%', delivery: 'Instante' },
                7: { name: '12500 FC', price: '90.000 COP', original: '120.500 COP', badge: '-63%', delivery: 'Instante' },
                8: { name: 'Star Pass', price: '18.500 COP', original: '29.000 COP', badge: '-37%', delivery: 'Instante' },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;

                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;

                const imgEl = document.getElementById('checkoutImg');
                const cardImg = document.querySelector('.product-card[data-id="' + id + '"] img');
                if (imgEl && cardImg) {
                    imgEl.src = cardImg.getAttribute('src');
                    imgEl.style.display = '';
                } else if (imgEl) {
                    imgEl.style.display = 'none';
                }

                const origEl = document.getElementById('checkoutOriginal');
                const badgeEl = document.getElementById('checkoutBadge');

                if (p.original) {
                    origEl.textContent = p.original;
                    badgeEl.textContent = p.badge;
                    origEl.style.display = '';
                    badgeEl.style.display = '';
                } else {
                    origEl.style.display = 'none';
                    badgeEl.style.display = 'none';
                }

                document.getElementById('instructionText').innerHTML =
                    'EA SPORTS\u00ae | ' + p.name.replace(/[\u{1F4B0}\u{1F947}\u{1F3C6}\u{1F48E}\u{1F6E1}\uFE0F]/gu, '').trim() +
                    ' \uD83C\uDFAE<br>' +
                    '<span class="flag">\uD83C\uDF10</span> Region: Global<br>' +
                    '<span class="flag warn">\u26D4</span> IMPORTANT NOTE BEFORE PURCHASE';
            }

            function initCards() {
                const cards = document.querySelectorAll('.product-card');

                if (cards.length === 0) {
                    setTimeout(initCards, 100);
                    return;
                }

                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(function (c) { c.classList.remove('selected'); });
                        card.classList.add('selected');
                        updateCheckout(parseInt(card.getAttribute('data-id')));
                    });
                });

                // Selección por defecto: tarjeta 500 FC
                var def = document.querySelector('.product-card[data-id="2"]');
                if (def) {
                    def.classList.add('selected');
                    updateCheckout(2);
                }
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

                var jugadorId = document.getElementById('jugadorIdInput').value.trim();
                if (!jugadorId) {
                    alert('⚠️ Por favor ingresa tu ID de jugador antes de continuar.');
                    document.getElementById('jugadorIdInput').focus();
                    return;
                }

                var producto = document.getElementById('checkoutName').textContent.trim();
                var precio = document.getElementById('checkoutPrice').textContent.replace(/[^0-9]/g, '');

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_orden.php';

                [['producto', producto], ['precio', precio], ['jugador_id', jugadorId]].forEach(function (pair) {
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
