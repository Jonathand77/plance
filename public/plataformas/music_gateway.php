<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Música — API Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/plataformas/music_gateway.css">

<body>
    <?php
    $nav_back_url = "suscripciones.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="bi bi-music-note-list"></i> Música — Suscripción Pura
            <span class="gw-badge"><i class="bi bi-lightning-charge-fill"></i> API Gateway</span>
            <span class="sub-badge"><i class="bi bi-shield-lock-fill"></i> Tokenización</span>
            <span class="tds-badge"><i class="bi bi-shield-lock-fill"></i> 3DS</span>
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
            La base de datos de esta web <strong>NO! Guarda datos sensibles </strong> como el <strong> Numero de
                tarjeta, Fecha y CVV</strong> o <strong>Numeros de cuenta</strong> esta es solo una demostracion del
            servicio <strong></strong>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <!-- SPOTIFY -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=spotify.com&sz=32" alt="Spotify"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Spotify</span>
                </div>
                <div class="products-grid">
                    <div class="product-card popular-card" data-id="1" data-servicio="Spotify" data-plan="Individual"
                        data-precio="14900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Spotify</div>
                        <div class="product-card__pts">Individual</div>
                        <div class="product-card__label">Sin anuncios · Descargas · 1 cuenta</div>
                        <div class="product-card__price">14.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="2" data-servicio="Spotify" data-plan="Duo" data-precio="19900">
                        <div class="product-card__platform">Spotify</div>
                        <div class="product-card__pts">Duo</div>
                        <div class="product-card__label">Sin anuncios · Descargas · 2 cuentas</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="3" data-servicio="Spotify" data-plan="Familiar"
                        data-precio="24900">
                        <div class="product-card__platform">Spotify</div>
                        <div class="product-card__pts">Familiar</div>
                        <div class="product-card__label">Sin anuncios · Descargas · 6 cuentas</div>
                        <div class="product-card__price">24.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- DEEZER -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=deezer.com&sz=32" alt="Deezer"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Deezer</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="4" data-servicio="Deezer" data-plan="Premium"
                        data-precio="12900">
                        <div class="product-card__platform">Deezer</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">Sin anuncios · HD · 1 cuenta</div>
                        <div class="product-card__price">12.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="5" data-servicio="Deezer" data-plan="Familia"
                        data-precio="19900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Deezer</div>
                        <div class="product-card__pts">Familia</div>
                        <div class="product-card__label">Sin anuncios · HD · 6 cuentas</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
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

        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-product-name" id="checkoutName">🎵 Spotify — Individual</div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total / mes</span>
                    <span class="checkout-price" id="checkoutPrice">14.900 COP</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="token-info">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Suscripción pura — tu tarjeta será tokenizada de forma segura para futuros cobros.</span>
                </div>

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
                    <input type="text" class="field-input" id="cardNameOnCard" placeholder="Como aparece en la tarjeta">
                </div>

                <div class="checkout-divider"></div>
                <span class="section-label-sm">Datos del titular</span>
                <div class="field-group">
                    <label class="field-label">Correo electrónico</label>
                    <input type="email" class="field-input" id="gwCorreo"
                        value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                </div>
                <div class="field-group">
                    <label class="field-label">Teléfono</label>
                    <input type="text" class="field-input" id="gwTelefono" placeholder="3001234567">
                </div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Tipo de documento</label>
                        <select class="field-input" id="gwTipoDoc">
                            <option value="CC">Cédula</option>
                            <option value="CE">Cédula Extranjería</option>
                            <option value="NIT">NIT</option>
                            <option value="PP">Pasaporte</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Número de documento</label>
                        <input type="text" class="field-input" id="gwNumDoc" placeholder="1234567890">
                    </div>
                </div>

                <!-- 3DS checkbox -->
                <label class="tds-check-wrap">
                    <input type="checkbox" id="tdsCheck">
                    <span class="tds-check-label">
                        🔐 <strong>Autenticar con 3D Secure (3DS)</strong><br>
                        Activa una capa extra de seguridad para proteger tu tarjeta.
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
                    <i class="bi bi-lock-fill"></i> Registrar suscripción
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Pago seguro · API Gateway · Evertec PlacetoPay
                </div>
            </div>
        </aside>
    </main>

    <script>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>