<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streaming — API Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/plataformas/streaming_gateway.css">

<body>
    <?php
    $nav_back_url = "suscripciones.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="bi bi-tv-fill"></i> Streaming — Pago + Suscripción
            <span class="gw-badge"><i class="bi bi-lightning-charge-fill"></i> API Gateway</span>
            <span class="tds-badge"><i class="bi bi-shield-lock-fill"></i> 3DS</span>
        </div>
    </div>

    <!-- AVISO DE SEGURIDAD PARA COMERCIOS -->
    <div class="security-warning">
        <i class="bi bi-shield-exclamation"></i>
        <div>
            <strong>⚠️ Aviso para comercios:</strong> La integración con API Gateway implica el manejo directo de datos
            sensibles del usuario (número de tarjeta, CVV, datos bancarios). Para operar en producción es
            <strong>obligatorio</strong> contar con certificación <strong>PCI-DSS</strong> y se recomienda implementar
            autenticación <strong>3D Secure (3DS)</strong> para reducir el riesgo de fraude. Esta demo es solo con fines
            ilustrativos.
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <!-- NETFLIX -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=netflix.com&sz=32" alt="Netflix"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Netflix</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="1" data-servicio="Netflix" data-plan="Estándar con anuncios"
                        data-precio="14900">
                        <div class="product-card__platform">Netflix</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">Con anuncios · Full HD · 2 pantallas</div>
                        <div class="product-card__price">14.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="2" data-servicio="Netflix" data-plan="Estándar"
                        data-precio="26900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Netflix</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">Sin anuncios · Full HD · 2 pantallas</div>
                        <div class="product-card__price">26.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="3" data-servicio="Netflix" data-plan="Premium"
                        data-precio="36900">
                        <div class="product-card__platform">Netflix</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">4K Ultra HD · 4 pantallas · Dolby</div>
                        <div class="product-card__price">36.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- PARAMOUNT+ -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=paramountplus.com&sz=32" alt="Paramount+"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Paramount+</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="4" data-servicio="Paramount+" data-plan="Essential"
                        data-precio="12900">
                        <div class="product-card__platform">Paramount+</div>
                        <div class="product-card__pts">Essential</div>
                        <div class="product-card__label">Con anuncios · HD · 3 pantallas</div>
                        <div class="product-card__price">12.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="5" data-servicio="Paramount+" data-plan="Showtime"
                        data-precio="22900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Paramount+</div>
                        <div class="product-card__pts">Showtime</div>
                        <div class="product-card__label">Sin anuncios · 4K · Showtime incluido</div>
                        <div class="product-card__price">22.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- DAZN -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=dazn.com&sz=32" alt="DAZN"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>DAZN</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="6" data-servicio="DAZN" data-plan="Estándar" data-precio="19900">
                        <div class="product-card__platform">DAZN</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">Deportes en vivo · HD · 1 pantalla</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="7" data-servicio="DAZN" data-plan="Premium"
                        data-precio="34900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">DAZN</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">Deportes en vivo · 4K · 4 pantallas</div>
                        <div class="product-card__price">34.900 COP <span class="sub-tag">/ mes</span></div>
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
                    <div class="sim-mode-hint" id="modoHint">Elige manualmente cómo termina la suscripción.</div>
                </div>

            </div>

        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-product-name" id="checkoutName">📺 Netflix — Estándar</div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total / mes</span>
                    <span class="checkout-price" id="checkoutPrice">26.900 COP</span>
                </div>

                <div class="checkout-divider"></div>

                <!-- Tabs método pago -->
                <div class="payment-tabs">
                    <button class="payment-tab active" id="tabTarjeta" onclick="setPayment('tarjeta')">
                        <i class="bi bi-credit-card-fill"></i> Tarjeta
                    </button>
                    <button class="payment-tab" id="tabPSE" onclick="setPayment('pse')">
                        <i class="bi bi-bank2"></i> PSE
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
                        <input type="email" class="field-input" id="cardCorreo"
                            value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Teléfono</label>
                        <input type="text" class="field-input" id="cardTelefono" placeholder="3001234567">
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Tipo de documento</label>
                            <select class="field-input" id="cardTipoDoc">
                                <option value="CC">Cédula</option>
                                <option value="CE">Cédula Extranjería</option>
                                <option value="NIT">NIT</option>
                                <option value="PP">Pasaporte</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Número de documento</label>
                            <input type="text" class="field-input" id="cardNumDoc" placeholder="1234567890">
                        </div>
                    </div>
                    <!-- Checkbox guardar tarjeta -->
                    <div class="guardar-tarjeta-wrap">
                        <input type="checkbox" id="guardarTarjeta">
                        <label for="guardarTarjeta">
                            🔐 Guardar tarjeta para futuros cobros automáticos
                        </label>
                    </div>
                </div>

                <!-- FORMULARIO PSE -->
                <div class="form-section" id="formPSE">
                    <span class="section-label-sm">Datos bancarios (PSE)</span>
                    <div class="field-group">
                        <label class="field-label">Banco</label>
                        <select class="field-input" id="pseBanco">
                            <option value="BANCOLOMBIA">Bancolombia</option>
                            <option value="NEQUI">Nequi</option>
                            <option value="DAVIVIENDA">Davivienda</option>
                            <option value="BBVA">BBVA</option>
                            <option value="BOGOTA">Banco de Bogotá</option>
                            <option value="OCCIDENTE">Banco de Occidente</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Tipo de persona</label>
                        <select class="field-input" id="pseTipoPersona">
                            <option value="N">Natural</option>
                            <option value="J">Jurídica</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Nombre completo</label>
                        <input type="text" class="field-input" id="pseNombre" placeholder="Nombre y apellido">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Correo electrónico</label>
                        <input type="email" class="field-input" id="pseCorreo"
                            value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Teléfono</label>
                        <input type="text" class="field-input" id="pseTelefono" placeholder="3001234567">
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Tipo de documento</label>
                            <select class="field-input" id="pseTipoDoc">
                                <option value="CC">Cédula</option>
                                <option value="CE">Cédula Extranjería</option>
                                <option value="NIT">NIT</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Número de documento</label>
                            <input type="text" class="field-input" id="pseNumDoc" placeholder="1234567890">
                        </div>
                    </div>
                </div>


                <!-- 3DS checkbox -->
                <label class="tds-check-wrap">
                    <input type="checkbox" id="tdsCheck">
                    <span class="tds-check-label">
                        <i class="fa-solid fa-lock" style="color: var(--accent);"></i> <strong> Prueba de Autenticación
                            con 3D Secure (3DS)</strong><br>
                        Activa una capa extra de seguridad para proteger tu pago.
                    </span>
                </label>

                <!-- Panel 3DS -->
                <div class="tds-panel" id="tdsPanel">
                    <div class="tds-panel-title">🔐 Verificación 3D Secure</div>
                    <div class="tds-panel-sub">Ingresa el código de 6 dígitos enviado a tu banco para autenticar la
                        transacción.</div>
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
                </div>


                <button class="btn-pagar" id="btnPagar">
                    <i class="bi bi-lock-fill"></i> Suscribirse ahora
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Pago seguro · API Gateway · Evertec PlacetoPay
                </div>
            </div>
        </aside>
    </main>

    <input type="hidden" id="currentPayment" value="tarjeta">

    <script>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>