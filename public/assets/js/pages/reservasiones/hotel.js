(function () {
            const products = {
                1: { name: '🛏️ Habitación Estándar', precio: 150000, price: '150.000 COP' },
                2: { name: '🛏️🛏️ Habitación Doble', precio: 220000, price: '220.000 COP' },
                3: { name: '🌊 Vista al Mar', precio: 320000, price: '320.000 COP' },
                4: { name: '✨ Suite Junior', precio: 480000, price: '480.000 COP' },
                5: { name: '👑 Suite Presidencial', precio: 850000, price: '850.000 COP' },
                6: { name: '👨‍👩‍👧‍👦 Habitación Familiar', precio: 280000, price: '280.000 COP' },
                7: { name: '💼 Habitación Ejecutiva', precio: 390000, price: '390.000 COP' },
                8: { name: '🌆 Penthouse', precio: 1200000, price: '1.200.000 COP' },
            };

            let selectedId = null;

            function fmt(n) { return '$' + n.toLocaleString('es-CO') + ' COP'; }

            window.calcTotal = function () {
                if (!selectedId) return;
                const ci = document.getElementById('checkIn').value;
                const co = document.getElementById('checkOut').value;
                if (!ci || !co) return;
                const diff = (new Date(co) - new Date(ci)) / 86400000;
                if (diff <= 0) {
                    document.getElementById('totalNochesRow').style.display = 'none';
                    return;
                }
                const total = diff * products[selectedId].precio;
                document.getElementById('totalNochesText').textContent = diff + ' noche(s) × ' + products[selectedId].price;
                document.getElementById('totalFinalText').textContent = 'Total: ' + fmt(total);
                document.getElementById('totalNochesRow').style.display = 'block';
            };

            function initCards() {
                const cards = document.querySelectorAll('.room-card');
                if (!cards.length) { setTimeout(initCards, 100); return; }
                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        selectedId = parseInt(card.getAttribute('data-id'));
                        document.getElementById('checkoutName').textContent = products[selectedId].name;
                        document.getElementById('checkoutPrice').textContent = products[selectedId].price;
                        calcTotal();
                    });
                });
            }

            // Fechas mínimas
            const hoy = new Date().toISOString().split('T')[0];
            document.getElementById('checkIn').min = hoy;
            document.getElementById('checkOut').min = hoy;

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            window.reservar = function () {
                if (!selectedId) { alert('⚠️ Selecciona una habitación.'); return; }

                const ci = document.getElementById('checkIn').value;
                const co = document.getElementById('checkOut').value;
                const nombre = document.getElementById('hNombre').value.trim();
                const correo = document.getElementById('hCorreo').value.trim();
                const tel = document.getElementById('hTelefono').value.trim();
                const tipoDoc = document.getElementById('hTipoDoc').value;
                const numDoc = document.getElementById('hNumDoc').value.trim();

                if (!ci || !co) { alert('⚠️ Selecciona las fechas de check-in y check-out.'); return; }
                if (new Date(co) <= new Date(ci)) { alert('⚠️ El check-out debe ser posterior al check-in.'); return; }
                if (!nombre || !correo || !tel || !numDoc) { alert('⚠️ Completa todos los datos del huésped.'); return; }

                const noches = (new Date(co) - new Date(ci)) / 86400000;
                const total = noches * products[selectedId].precio;
                const card = document.querySelector('.room-card.selected');

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_preautorizacion.php';

                [
                    ['habitacion', card.getAttribute('data-nombre')],
                    ['precio', products[selectedId].precio],
                    ['total', total],
                    ['noches', noches],
                    ['checkin', ci],
                    ['checkout', co],
                    ['nombre', nombre],
                    ['correo', correo],
                    ['telefono', tel],
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
