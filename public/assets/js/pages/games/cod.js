(function () {

            const products = {
                1: { name: '88 CP', price: '7.000 COP', original: '', badge: '', delivery: 'Instante' },
                2: { name: '460 CP', price: '12.927 COP', original: '18.972 COP', badge: '-32%', delivery: 'Instante' },
                3: { name: '1100 CP', price: '26.233 COP', original: '37.981 COP', badge: '-31%', delivery: 'Instante' },
                4: { name: '2400 CP', price: '29.921 COP', original: '74.000 COP', badge: '-61%', delivery: 'Instante' },
                5: { name: '5000 CP', price: '56.611 COP', original: '152.039 COP', badge: '-62%', delivery: 'Instante' },
                6: { name: '9500 CP', price: '94.858 COP', original: '285.406 COP', badge: '-67%', delivery: 'Instante' },
                7: { name: '13000 CP', price: '142.762 COP', original: '380.154 COP', badge: '-63%', delivery: 'Instante' },
                8: { name: '21000 CP', price: '216.215 COP', original: '579.249 COP', badge: '-63%', delivery: 'Instante' },
                9: { name: '26000 CP', price: '262.066 COP', original: '760.307 COP', badge: '-66%', delivery: 'Instante' },
                10: { name: '39000 CP', price: '387.339 COP', original: '1.140.461 COP', badge: '-67%', delivery: 'Instante' },
                11: { name: 'Battle Pass', price: '24.000 COP', original: '38.000 COP', badge: '-37%', delivery: 'Instante' },
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
                    'Activision\u00ae | ' + p.name.replace(/[\u{1F4B0}\u{1F947}\u{1F3C6}\u{1F48E}\u{1F6E1}\uFE0F]/gu, '').trim() +
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

                // Selección por defecto: tarjeta 500 CP
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
