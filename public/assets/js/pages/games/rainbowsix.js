(function () {
            let cart = {};   // { id: { nombre, precio } }
            let multiMode = false;

            function fmt(n) { return '$' + n.toLocaleString('es-CO') + ' COP'; }

            function getTotal() { return Object.values(cart).reduce((s, p) => s + p.precio, 0); }

            function renderCart() {
                const items = Object.values(cart);
                const total = getTotal();
                const empty = document.getElementById('cartEmpty');
                const cont = document.getElementById('cartItems');
                const tprice = document.getElementById('totalPrice');

                // Limpiar items previos (excepto empty)
                cont.querySelectorAll('.cart-item').forEach(e => e.remove());

                if (items.length === 0) {
                    empty.style.display = 'block';
                } else {
                    empty.style.display = 'none';
                    items.forEach(function (p) {
                        const row = document.createElement('div');
                        row.className = 'cart-item';
                        row.innerHTML = `<span class="cart-item-name">${p.nombre}</span><span class="cart-item-price">${fmt(p.precio)}</span>`;
                        cont.appendChild(row);
                    });
                }

                tprice.textContent = fmt(total);

                // Actualizar slider si está activo
                if (document.getElementById('parcialCheck').checked) {
                    updateSliderRange(total);
                }
            }

            function updateSliderRange(total) {
                const min = Math.ceil(total * 0.1);
                const slider = document.getElementById('parcialSlider');
                slider.min = min;
                slider.max = total;
                slider.value = Math.floor(total * 0.5);
                document.getElementById('minAmount').textContent = fmt(min);
                document.getElementById('maxAmount').textContent = fmt(total);
                updateSlider();
            }

            window.updateSlider = function () {
                const val = parseInt(document.getElementById('parcialSlider').value);
                const total = getTotal();
                document.getElementById('parcialNow').textContent = fmt(val);
                document.getElementById('parcialRest').textContent = 'Restante: ' + fmt(total - val);
            };

            window.toggleMulti = function () {
                multiMode = document.getElementById('multiCheck').checked;
                if (!multiMode) {
                    // En modo single dejamos solo el primero del carrito
                    const keys = Object.keys(cart);
                    if (keys.length > 1) {
                        const first = keys[0];
                        const keep = cart[first];
                        cart = { [first]: keep };
                    }
                    document.querySelectorAll('.product-card.in-cart, .pase-card.in-cart').forEach(c => {
                        if (c.getAttribute('data-id') !== Object.keys(cart)[0]) c.classList.remove('in-cart');
                    });
                }
                renderCart();
            };

            window.toggleParcial = function () {
                const show = document.getElementById('parcialCheck').checked;
                document.getElementById('parcialPanel').classList.toggle('show', show);
                if (show) updateSliderRange(getTotal());
            };

            function toggleCard(card_el) {
                const id = card_el.getAttribute('data-id');
                const nombre = card_el.getAttribute('data-nombre');
                const precio = parseInt(card_el.getAttribute('data-precio'));

                if (multiMode) {
                    if (cart[id]) {
                        delete cart[id];
                        card_el.classList.remove('in-cart');
                    } else {
                        cart[id] = { nombre, precio };
                        card_el.classList.add('in-cart');
                    }
                } else {
                    // Single mode — deseleccionar todo y seleccionar este
                    document.querySelectorAll('.product-card, .pase-card').forEach(c => {
                        c.classList.remove('selected', 'in-cart');
                    });
                    cart = {};
                    cart[id] = { nombre, precio };
                    card_el.classList.add('selected');
                }
                renderCart();
            }

            // Bind cards
            document.querySelectorAll('.product-card, .pase-card').forEach(function (card_el) {
                card_el.addEventListener('click', function () { toggleCard(this); });
            });

            window.pagar = function () {
                const jugadorId = document.getElementById('jugadorId').value.trim();
                if (!jugadorId) { alert('⚠️ Por favor ingresa tu ID de jugador.'); return; }

                const items = Object.values(cart);
                if (items.length === 0) { alert('⚠️ Selecciona al menos un producto.'); return; }

                const total = getTotal();
                const parcial = document.getElementById('parcialCheck').checked;
                const montoParcial = parcial ? parseInt(document.getElementById('parcialSlider').value) : total;

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_pago_mixto.php';

                const productos = items.map(p => p.nombre).join(' + ');

                [
                    ['jugador_id', jugadorId],
                    ['productos', productos],
                    ['total', total],
                    ['monto_parcial', montoParcial],
                    ['allow_partial', parcial ? '1' : '0'],
                    ['items_json', JSON.stringify(items)]
                ].forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            };

            renderCart();
        })();
