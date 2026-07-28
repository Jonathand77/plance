(function () {
            const products = {
                1: { name: '🔴 Liverpool FC — Kit completo', producto: 'Kit Liverpool FC' },
                2: { name: '🔵 Manchester City — Kit completo', producto: 'Kit Manchester City' },
                3: { name: '🔴 Manchester United — Kit completo', producto: 'Kit Manchester United' },
                4: { name: '🔵 Chelsea FC — Kit completo', producto: 'Kit Chelsea FC' },
                5: { name: '🔴 Arsenal FC — Kit completo', producto: 'Kit Arsenal FC' },
                6: { name: '🟣 West Ham United — Kit completo', producto: 'Kit West Ham United' },
                7: { name: '⚪ Tottenham Hotspur — Kit completo', producto: 'Kit Tottenham Hotspur' },
                8: { name: '🟣 Aston Villa — Kit completo', producto: 'Kit Aston Villa' },
            };

            function initCards() {
                const cards = document.querySelectorAll('.product-card');
                if (cards.length === 0) { setTimeout(initCards, 100); return; }
                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        const id = parseInt(card.getAttribute('data-id'));
                        document.getElementById('checkoutName').textContent = products[id].name;
                    });
                });
                var def = document.querySelector('.product-card[data-id="1"]');
                if (def) def.classList.add('selected');
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            document.getElementById('btnGenerar').addEventListener('click', function () {
                const selected = document.querySelector('.product-card.selected');
                if (!selected) { alert('⚠️ Selecciona una equipación primero.'); return; }

                const correo = document.getElementById('correoInput').value.trim();
                const nombre = document.getElementById('nombreInput').value.trim();

                if (!correo) { alert('⚠️ Por favor ingresa tu correo electrónico.'); return; }
                if (!nombre) { alert('⚠️ Por favor ingresa tu nombre.'); return; }

                const producto = selected.getAttribute('data-producto');
                const precio = selected.getAttribute('data-precio');

                const btn = document.getElementById('btnGenerar');
                btn.disabled = true;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Generando link...';

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_link_pago.php';

                [['producto', producto], ['precio', precio],
                ['correo', correo], ['nombre', nombre]].forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });
        })();
