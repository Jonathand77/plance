(function () {
            const products = {
                1: { name: '🤖 Claude — Pro', servicio: 'Claude', plan: 'Pro', precioM: 22900, precioA: 229000 },
                2: { name: '🤖 Claude — Max', servicio: 'Claude', plan: 'Max', precioM: 109000, precioA: 1090000 },
                3: { name: '🧠 ChatGPT — Go', servicio: 'ChatGPT', plan: 'Go', precioM: 8900, precioA: 89000 },
                4: { name: '🧠 ChatGPT — Plus', servicio: 'ChatGPT', plan: 'Plus', precioM: 22900, precioA: 229000 },
                5: { name: '🧠 ChatGPT — Pro', servicio: 'ChatGPT', plan: 'Pro', precioM: 219000, precioA: 2190000 },
            };

            function fmt(n) {
                return n.toLocaleString('es-CO') + ' COP';
            }

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;
                const period = document.getElementById('currentPeriod').value;
                const precio = period === 'mensual' ? p.precioM : p.precioA;
                const tag = period === 'mensual' ? '/ mes' : '/ año';
                const dur = period === 'mensual' ? '12 meses' : '1 año';

                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = fmt(precio);
                document.getElementById('checkoutPeriod').textContent = period === 'mensual' ? 'Mensual' : 'Anual';
                document.getElementById('checkoutDuration').textContent = dur;
                document.getElementById('recurringMsg').textContent = 'Cobro automático ' + (period === 'mensual' ? 'mensual durante 12 meses.' : 'anual por 1 año.');
                document.getElementById('instructionText').innerHTML =
                    p.servicio + '\u00ae | Plan ' + p.plan + ' \uD83E\uDD16<br>' +
                    '<span>\uD83C\uDF10</span> Acceso inmediato tras el primer pago<br>' +
                    '<span>\uD83D\uDD04</span> Renovación automática ' + (period === 'mensual' ? 'mensual' : 'anual');
            }

            window.setPeriod = function (period) {
                document.getElementById('currentPeriod').value = period;
                document.getElementById('btnMensual').classList.toggle('active', period === 'mensual');
                document.getElementById('btnAnual').classList.toggle('active', period === 'anual');

                document.querySelectorAll('.price-mensual').forEach(el => el.style.display = period === 'mensual' ? '' : 'none');
                document.querySelectorAll('.price-anual').forEach(el => el.style.display = period === 'anual' ? '' : 'none');

                const sel = document.querySelector('.product-card.selected');
                if (sel) updateCheckout(parseInt(sel.getAttribute('data-id')));
            };

            function initCards() {
                const cards = document.querySelectorAll('.product-card');
                if (cards.length === 0) { setTimeout(initCards, 100); return; }

                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        updateCheckout(parseInt(card.getAttribute('data-id')));
                    });
                });

                var def = document.querySelector('.product-card[data-id="1"]');
                if (def) { def.classList.add('selected'); updateCheckout(1); }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            document.addEventListener('click', function (e) {
                var btn = e.target.closest('#btnBuy');
                if (!btn) return;

                var usuarioId = document.getElementById('usuarioIdInput').value.trim();
                if (!usuarioId) { alert('⚠️ No se detectó tu correo de sesión.'); return; }

                var selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un plan primero.'); return; }

                var period = document.getElementById('currentPeriod').value;
                var id = parseInt(selectedCard.getAttribute('data-id'));
                var p = window.__iaProducts[id];

                var precio = period === 'mensual' ? p.precioM : p.precioA;
                var periodicidad = period === 'mensual' ? 'M' : 'Y';

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_suscription_rec.php';

                [['servicio', p.servicio], ['plan', p.plan], ['precio', precio],
                ['usuario_id', usuarioId], ['periodicidad', periodicidad]].forEach(function (pair) {
                    var input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });
        })();
