(function () {
            const products = {
                1: { name: ' Spotify — Individual', servicio: 'Spotify', plan: 'Individual', precio: 14900, price: '14.900 COP' },
                2: { name: ' Spotify — Duo', servicio: 'Spotify', plan: 'Duo', precio: 19900, price: '19.900 COP' },
                3: { name: ' Spotify — Familiar', servicio: 'Spotify', plan: 'Familiar', precio: 24900, price: '24.900 COP' },
                4: { name: ' Deezer — Premium', servicio: 'Deezer', plan: 'Premium', precio: 12900, price: '12.900 COP' },
                5: { name: ' Deezer — Familia', servicio: 'Deezer', plan: 'Familia', precio: 19900, price: '19.900 COP' },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;
                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;
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
                var def = document.querySelector('.product-card[data-id="1"]');
                if (def) { def.classList.add('selected'); updateCheckout(1); }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

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
                    tdsStatus.textContent = '✅ Autenticación 3DS exitosa — puedes proceder.';
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
                if (tdsCheck.checked && !tdsVerified) {
                    alert('⚠️ Debes completar la verificación 3D Secure antes de continuar.');
                    tdsDigits[0].focus(); return;
                }
                const selected = document.querySelector('.product-card.selected');
                if (!selected) { alert('⚠️ Selecciona un plan primero.'); return; }

                const cardNum = document.getElementById('cardNumber').value.replace(/\s/g, '');
                const expiry = document.getElementById('cardExpiry').value;
                const cvv = document.getElementById('cardCvv').value;
                const cardName = document.getElementById('cardNameOnCard').value.trim();
                const nombre = cardName; // nombre en tarjeta = nombre del titular
                const correo = document.getElementById('gwCorreo').value.trim();
                const telefono = document.getElementById('gwTelefono').value.trim();
                const tipoDoc = document.getElementById('gwTipoDoc').value;
                const numDoc = document.getElementById('gwNumDoc').value.trim();

                if (!cardNum || cardNum.length < 15) { alert('⚠️ Ingresa un número de tarjeta válido.'); return; }
                if (!expiry) { alert('⚠️ Ingresa la fecha de vencimiento.'); return; }
                if (!cvv) { alert('⚠️ Ingresa el CVV.'); return; }
                if (!cardName) { alert('⚠️ Ingresa el nombre en la tarjeta.'); return; }
                if (!nombre || !correo || !numDoc || !telefono) {
                    alert('⚠️ Por favor completa todos los campos del titular.');
                    return;
                }

                const id = parseInt(selected.getAttribute('data-id'));
                const p = products[id];

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = (modoSimulacion === 'auto')
                    ? '../php/crear_suscription_gateway.php'
                    : '../estados-subs-gateway.php';

                const campos = [
                    ['servicio', p.servicio], ['plan', p.plan], ['precio', p.precio],
                    ['nombre', nombre], ['correo', correo], ['telefono', telefono],
                    ['tipo_doc', tipoDoc], ['num_doc', numDoc],
                    ['card_number', document.getElementById('cardNumber').value.replace(/\s/g, '')],
                    ['card_expiry', document.getElementById('cardExpiry').value],
                    ['card_cvv', document.getElementById('cardCvv').value],
                    ['card_name', document.getElementById('cardNameOnCard').value]
                ];

                campos.forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });
        })();
