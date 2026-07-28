(function () {
            const products = {
                1: { name: ' Netflix — Estándar con anuncios', servicio: 'Netflix', plan: 'Estándar con anuncios', precio: 14900, price: '14.900 COP' },
                2: { name: ' Netflix — Estándar', servicio: 'Netflix', plan: 'Estándar', precio: 26900, price: '26.900 COP' },
                3: { name: ' Netflix — Premium', servicio: 'Netflix', plan: 'Premium', precio: 36900, price: '36.900 COP' },
                4: { name: ' Paramount+ — Essential', servicio: 'Paramount+', plan: 'Essential', precio: 12900, price: '12.900 COP' },
                5: { name: ' Paramount+ — Showtime', servicio: 'Paramount+', plan: 'Showtime', precio: 22900, price: '22.900 COP' },
                6: { name: ' DAZN — Estándar', servicio: 'DAZN', plan: 'Estándar', precio: 19900, price: '19.900 COP' },
                7: { name: ' DAZN — Premium', servicio: 'DAZN', plan: 'Premium', precio: 34900, price: '34.900 COP' },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;
                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;
            }

            window.setPayment = function (method) {
                document.getElementById('currentPayment').value = method;
                document.getElementById('tabTarjeta').classList.toggle('active', method === 'tarjeta');
                document.getElementById('tabPSE').classList.toggle('active', method === 'pse');
                document.getElementById('formTarjeta').classList.toggle('active', method === 'tarjeta');
                document.getElementById('formPSE').classList.toggle('active', method === 'pse');
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
                    ? 'Elige manualmente cómo termina la suscripción.'
                    : 'El estado se asigna automáticamente, como un pago real.';
            };

            document.getElementById('btnPagar').addEventListener('click', function () {
                const selected = document.querySelector('.product-card.selected');
                if (!selected) { alert('⚠️ Selecciona un plan primero.'); return; }

                const method = document.getElementById('currentPayment').value;
                const id = parseInt(selected.getAttribute('data-id'));
                const p = products[id];

                let nombre, correo, telefono, tipoDoc, numDoc;

                if (method === 'tarjeta') {
                    nombre = document.getElementById('cardName').value.trim();
                    correo = document.getElementById('cardCorreo').value.trim();
                    telefono = document.getElementById('cardTelefono').value.trim();
                    tipoDoc = document.getElementById('cardTipoDoc').value;
                    numDoc = document.getElementById('cardNumDoc').value.trim();
                    const cardNum = document.getElementById('cardNumber').value.replace(/\s/g, '');
                    const cvv = document.getElementById('cardCvv').value;
                    if (!nombre || !correo || !numDoc || !telefono || !cardNum || !cvv) {
                        alert('⚠️ Por favor completa todos los campos de tarjeta.'); return;
                    }
                } else {
                    nombre = document.getElementById('pseNombre').value.trim();
                    correo = document.getElementById('pseCorreo').value.trim();
                    telefono = document.getElementById('pseTelefono').value.trim();
                    tipoDoc = document.getElementById('pseTipoDoc').value;
                    numDoc = document.getElementById('pseNumDoc').value.trim();
                    if (!nombre || !correo || !numDoc || !telefono) {
                        alert('⚠️ Por favor completa todos los campos de PSE.'); return;
                    }
                }

                // Validar 3DS si está activado
                if (tdsCheck.checked && !tdsVerified) {
                    alert("⚠️ Debes completar la verificación 3D Secure antes de continuar.");
                    tdsDigits[0].focus(); return;
                }

                const form = document.createElement("form");
                form.method = 'POST';
                form.action = (modoSimulacion === 'auto')
                    ? '../php/crear_suscripciones_gateway.php'
                    : '../estados-subs-gateway.php';

                const campos = [
                    ['servicio', p.servicio], ['plan', p.plan], ['precio', p.precio],
                    ['nombre', nombre], ['correo', correo], ['telefono', telefono],
                    ['tipo_doc', tipoDoc], ['num_doc', numDoc], ['metodo', method],
                    ['guardar_tarjeta', document.getElementById('guardarTarjeta').checked ? '1' : '0']
                ];

                if (method === 'tarjeta') {
                    campos.push(
                        ['card_number', document.getElementById('cardNumber').value.replace(/\s/g, '')],
                        ['card_expiry', document.getElementById('cardExpiry').value],
                        ['card_cvv', document.getElementById('cardCvv').value],
                        ['card_name', document.getElementById('cardName').value]
                    );
                } else {
                    campos.push(
                        ['cuenta_banco', document.getElementById('pseBanco').value],
                        ['tipo_persona', document.getElementById('pseTipoPersona').value]
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
