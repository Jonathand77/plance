<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Strike — Gold</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/bloodstrike.css">

<body>
    <?php
    $nav_back_url = "juegos.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            🩸 Blood Strike — Gold
            <span class="gw-badge">⚡ API Gateway</span>
            <span class="tds-badge"><i class="bi bi-shield-lock-fill"></i> 3DS Obligatorio</span>
        </div>
        <div class="banner-player-id">
            <label for="jugadorIdInput">🆔 ID de jugador</label>
            <input type="text" id="jugadorIdInput" placeholder="Ej: 512345678" autocomplete="off">
        </div>
    </div>

    <div class="security-warning">
        <i class="bi bi-shield-exclamation"></i>
        <div>
            <strong>⚠️ Aviso para comercios:</strong> La integración con API Gateway implica el manejo directo de datos
            sensibles del usuario. Para operar en producción es <strong>obligatorio</strong> contar con certificación
            <strong>PCI-DSS</strong> y se recomienda implementar <strong>3D Secure (3DS)</strong> para reducir el riesgo
            de fraude. Esta demo es solo con fines ilustrativos.
            <br>
            La base de datos de esta web <strong>NO! Guarda datos sensibles</strong> como el <strong>Número de tarjeta,
                Fecha y CVV</strong> o <strong>Números de cuenta</strong> esta es solo una demostración del servicio.
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">
            <p class="section-label">Elige el importe de Gold</p>
            <div class="products-grid">
                <div class="product-card" data-id="1" data-price="4900" data-pts="80">
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">80 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">4.900 COP</div>
                </div>

                <div class="product-card" data-id="2" data-price="9900" data-pts="170">
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">170 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">9.900 COP</div>
                </div>

                <div class="product-card popular-card" data-id="3" data-price="19900" data-pts="360">
                    <div class="badge-popular">★ Popular</div>
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">360 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">19.900 COP <span class="discount-tag">+20 extra</span></div>
                </div>

                <div class="product-card" data-id="4" data-price="34900" data-pts="660">
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">660 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">34.900 COP <span class="discount-tag">+40 extra</span></div>
                </div>

                <div class="product-card" data-id="5" data-price="54900" data-pts="1120">
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">1120 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">54.900 COP <span class="discount-tag">+80 extra</span></div>
                </div>

                <div class="product-card popular-card" data-id="6" data-price="99900" data-pts="2240">
                    <div class="badge-popular">🔥 Mejor valor</div>
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">2240 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">99.900 COP <span class="discount-tag">+200 extra</span></div>
                </div>

                <div class="product-card" data-id="7" data-price="179900" data-pts="4480">
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">4480 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">179.900 COP <span class="discount-tag">+480 extra</span></div>
                </div>

                <div class="product-card" data-id="8" data-price="299900" data-pts="8960">
                    <div class="product-card__img">
                        <img src="https://cdn.gameboost.com/games/blood-strike/gold/gold.webp"
                            style="height: 40px; width: 40px" alt="">
                    </div>
                    <div class="product-card__pts">8960 Gold</div>
                    <div class="product-card__label">Blood Strike</div>
                    <div class="product-card__price">299.900 COP <span class="discount-tag">+960 extra</span></div>
                </div>
            </div>

            <!-- Modo de simulación -->
            <div class="sim-mode-wrap">
                <span class="sim-mode-label">Modo de simulación</span>
                <div class="sim-mode-toggle">
                    <button type="button" class="sim-mode-opt active" id="modoElegir" onclick="setModo('elegir')">
                        <i class="bi bi-sliders"></i> Elegir estado
                    </button>
                    <button type="button" class="sim-mode-opt" id="modoAuto" onclick="setModo('auto')">
                        <i class="bi bi-lightning-charge-fill"></i> Pago normal
                    </button>
                </div>
                <div class="sim-mode-hint" id="modoHint">Elige manualmente cómo termina la transacción.</div>
            </div>
        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-product-name"><img id="checkoutImg" src="" alt="" /><span id="checkoutName">🎖️ 360
                        Gold</span></div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total</span>
                    <span class="checkout-price" id="checkoutPrice">19.900 COP</span>
                </div>

                <div class="checkout-divider"></div>

                <!-- Tabs método de pago -->
                <div class="payment-tabs">
                    <button class="payment-tab active" id="tabTarjeta" onclick="setPayment('tarjeta')">
                        <i class="bi bi-credit-card-fill"></i> Tarjeta
                    </button>
                    <button class="payment-tab" id="tabCuenta" onclick="setPayment('cuenta')">
                        <i class="bi bi-bank2"></i> Cuenta
                    </button>
                </div>

                <!-- FORMULARIO TARJETA -->
                <div class="form-section active" id="formTarjeta">
                    <span class="section-label-sm">Datos de la tarjeta</span>
                    <div class="field-group">
                        <label class="field-label">Número de tarjeta</label>
                        <input type="text" class="field-input" id="cardNumber" placeholder="0000 0000 0000 0000"
                            maxlength="19">
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Vencimiento</label>
                            <input type="text" class="field-input" id="cardExpiry" placeholder="MM/AA" maxlength="5">
                        </div>
                        <div class="field-group">
                            <label class="field-label">CVV</label>
                            <input type="text" class="field-input" id="cardCvv" placeholder="123" maxlength="4">
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Nombre en la tarjeta</label>
                        <input type="text" class="field-input" id="cardName" placeholder="Como aparece en la tarjeta">
                    </div>
                    <div class="checkout-divider"></div>
                    <span class="section-label-sm">Datos del titular</span>
                    <div class="field-group">
                        <label class="field-label">Correo electrónico</label>
                        <input type="email" class="field-input" id="bsCorreo"
                            value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Teléfono</label>
                        <input type="text" class="field-input" id="bsTelefono" placeholder="3001234567">
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Tipo de documento</label>
                            <select class="field-input" id="bsTipoDoc">
                                <option value="CC">Cédula</option>
                                <option value="CE">Cédula Extranjería</option>
                                <option value="NIT">NIT</option>
                                <option value="PP">Pasaporte</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Número de documento</label>
                            <input type="text" class="field-input" id="bsNumDoc" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Nombre completo</label>
                        <input type="text" class="field-input" id="bsNombre" placeholder="Nombre y apellido">
                    </div>
                </div>

                <!-- FORMULARIO CUENTA -->
                <div class="form-section" id="formCuenta">
                    <span class="section-label-sm">Datos bancarios</span>
                    <div class="field-group">
                        <label class="field-label">Banco</label>
                        <select class="field-input" id="cuentaBanco">
                            <option value="BANCOLOMBIA">Bancolombia</option>
                            <option value="NEQUI">Nequi</option>
                            <option value="DAVIVIENDA">Davivienda</option>
                            <option value="BBVA">BBVA</option>
                            <option value="BOGOTA">Banco de Bogotá</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Tipo de cuenta</label>
                        <select class="field-input" id="cuentaTipo">
                            <option value="AHORROS">Ahorros</option>
                            <option value="CORRIENTE">Corriente</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Número de cuenta</label>
                        <input type="text" class="field-input" id="cuentaNumero" placeholder="0000000000">
                    </div>
                    <div class="checkout-divider"></div>
                    <span class="section-label-sm">Datos del titular</span>
                    <div class="field-group">
                        <label class="field-label">Nombre completo</label>
                        <input type="text" class="field-input" id="cuentaNombre" placeholder="Nombre y apellido">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Correo electrónico</label>
                        <input type="email" class="field-input" id="cuentaCorreo"
                            value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Teléfono</label>
                        <input type="text" class="field-input" id="cuentaTelefono" placeholder="3001234567">
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Tipo de documento</label>
                            <select class="field-input" id="cuentaTipoDoc">
                                <option value="CC">Cédula</option>
                                <option value="CE">Cédula Extranjería</option>
                                <option value="NIT">NIT</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Número de documento</label>
                            <input type="text" class="field-input" id="cuentaNumDoc" placeholder="1234567890">
                        </div>
                    </div>
                </div>

                <button class="btn-pagar" id="btnPagar">
                    <i class="bi bi-lock-fill"></i> Pagar ahora
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Protegido con 3D Secure · API Gateway · Evertec
                </div>
            </div>
        </aside>
    </main>

    <!-- MODAL 3DS OBLIGATORIO -->
    <div class="tds-overlay" id="tdsOverlay">
        <div class="tds-modal">
            <div class="tds-modal-icon">🔒</div>
            <div class="tds-modal-title">Verificación 3D Secure</div>
            <div class="tds-modal-sub">
                Para completar tu pago necesitamos verificar tu identidad.<br>
                Ingresa el código de 6 dígitos enviado por tu banco.
            </div>
            <div class="tds-inputs">
                <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
                <input type="text" class="tds-digit" maxlength="1" inputmode="numeric">
            </div>
            <div class="tds-hint">💡 Código de demo: <span>1 2 3 4 5 6</span></div>
            <div class="tds-status" id="tdsStatus"></div>
            <button class="btn-tds-cancel" id="btnTdsCancel">Cancelar</button>
        </div>
    </div>

    <input type="hidden" id="usuarioIdInput" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
    <input type="hidden" id="currentPayment" value="tarjeta">

    <script>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>