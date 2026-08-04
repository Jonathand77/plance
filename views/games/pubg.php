<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUBG — UC Points</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/pubg.css">

<body>
    <?php
    $nav_back_url = "juegos.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <!-- ═══ GAME BANNER ═══ -->
    <div class="game-banner">
        <div class="game-banner__tag">
            <img src="https://img.redbull.com/images/c_limit,w_1500,h_1000/f_auto,q_auto/redbullcom/2018/02/13/c3c16515-d639-45cd-8d7d-5fe26623130b/pubg"
                class="card-img-top" alt="" class="game-icon" />
            PUBG — UC Points
            <span class="gw-badge">⚡ API Gateway</span>
            <span class="tds-badge"><i class="bi bi-shield-lock-fill"></i> 3DS</span>
        </div>

        <div class="banner-player-id">
            <label for="jugadorIdInput">🆔 ID de jugador</label>
            <input type="text" id="jugadorIdInput" placeholder="Ej: 123456789" autocomplete="off" />
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
            <div class="section-block">
                <p class="section-label">Elige el importe</p>
                <div class="products-grid">

                    <div class="product-card" data-id="1" data-pts="60" data-price="4900" data-original=""
                        data-discount="">
                        <img src="https://martsbd.com/wp-content/uploads/2023/04/PUBG-Mobile-UC-Station.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">60 UC</div>
                        <div class="product-card__label">UC Points</div>
                        <div class="product-card__price">4.900 COP</div>
                    </div>

                    <div class="product-card popular-card" data-id="2" data-pts="325" data-price="21900"
                        data-original="28000" data-discount="21">
                        <div class="badge-popular">★ Popular</div>
                        <img src="https://martsbd.com/wp-content/uploads/2023/04/PUBG-Mobile-UC-Station.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">325 UC</div>
                        <div class="product-card__label">UC Points</div>
                        <div class="product-card__price-old">28.000 COP</div>
                        <div class="product-card__price">21.900 COP <span class="discount-tag">-21%</span></div>
                    </div>

                    <div class="product-card" data-id="3" data-pts="660" data-price="39900" data-original="52000"
                        data-discount="23">
                        <img src="https://martsbd.com/wp-content/uploads/2023/04/PUBG-Mobile-UC-Station.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">660 UC</div>
                        <div class="product-card__label">UC Points</div>
                        <div class="product-card__price-old">52.000 COP</div>
                        <div class="product-card__price">39.900 COP <span class="discount-tag">-23%</span></div>
                    </div>

                    <div class="product-card" data-id="4" data-pts="1800" data-price="99900" data-original="135000"
                        data-discount="26">
                        <img src="https://martsbd.com/wp-content/uploads/2023/04/PUBG-Mobile-UC-Station.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">1800 UC</div>
                        <div class="product-card__label">UC Points</div>
                        <div class="product-card__price-old">135.000 COP</div>
                        <div class="product-card__price">99.900 COP <span class="discount-tag">-26%</span></div>
                    </div>

                    <div class="product-card" data-id="5" data-pts="3850" data-price="189900" data-original="260000"
                        data-discount="26">
                        <img src="https://martsbd.com/wp-content/uploads/2023/04/PUBG-Mobile-UC-Station.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">3850 UC</div>
                        <div class="product-card__label">UC Points</div>
                        <div class="product-card__price-old">260.000 COP</div>
                        <div class="product-card__price">189.900 COP <span class="discount-tag">-26%</span></div>
                    </div>

                    <div class="product-card" data-id="6" data-pts="8100" data-price="369900" data-original="500000"
                        data-discount="26">
                        <img src="https://martsbd.com/wp-content/uploads/2023/04/PUBG-Mobile-UC-Station.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">8100 UC</div>
                        <div class="product-card__label">UC Points</div>
                        <div class="product-card__price-old">500.000 COP</div>
                        <div class="product-card__price">369.900 COP <span class="discount-tag">-26%</span></div>
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
            </div>
        </section>

        <!-- CHECKOUT CON FORMULARIO DE PAGO -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-product-name"><img id="checkoutImg" src="" alt="" /><span id="checkoutName">💎 325
                        UC Points</span></div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total</span>
                    <span class="checkout-price" id="checkoutPrice">21.900 COP</span>
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
                        <input type="text" class="field-input" id="cardName" placeholder="Como aparece en la tarjeta"
                            value="<?php echo htmlspecialchars($_SESSION['usuario'] ?? ''); ?>">
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Tipo de documento</label>
                            <select class="field-input" id="cardTipoDoc">
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CC">Cédula</option>
                                <option value="PP">Pasaporte</option>
                                <option value="CE">Cédula Extranjería</option>
                                <option value="NIT">NIT</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Número de documento</label>
                            <input type="text" class="field-input" id="cardNumDoc" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Correo electrónico</label>
                        <input type="email" class="field-input" id="cardCorreo" placeholder="correo@ejemplo.com"
                            value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Teléfono</label>
                        <input type="text" class="field-input" id="cardTelefono" placeholder="3001234567">
                    </div>
                </div>

                <!-- FORMULARIO CUENTA -->
                <div class="form-section" id="formCuenta">
                    <div class="field-group">
                        <label class="field-label">Banco</label>
                        <select class="field-input" id="cuentaBanco">
                            <option value="BANCOLOMBIA">Bancolombia</option>
                            <option value="NEQUI">Nequi</option>
                            <option value="DAVIVIENDA">Davivienda</option>
                            <option value="BBVA">BBVA</option>
                            <option value="BOGOTA">Banco de Bogotá</option>
                            <option value="OCCIDENTE">Banco de Occidente</option>
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
                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Tipo de documento</label>
                            <select class="field-input" id="cuentaTipoDoc">
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CC">Cédula</option>
                                <option value="PP">Pasaporte</option>
                                <option value="CE">Cédula Extranjería</option>
                                <option value="NIT">NIT</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Número de documento</label>
                            <input type="text" class="field-input" id="cuentaNumDoc" placeholder="1234567890">
                        </div>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Nombre completo</label>
                        <input type="text" class="field-input" id="cuentaNombre" placeholder="Nombre y apellido">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Correo electrónico</label>
                        <input type="email" class="field-input" id="cuentaCorreo" placeholder="correo@ejemplo.com"
                            value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                    </div>
                    <div class="field-group">
                        <label class="field-label">Teléfono</label>
                        <input type="text" class="field-input" id="cuentaTelefono" placeholder="3001234567">
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
                    <div class="tds-panel-sub">
                        Ingresa el código de 6 dígitos enviado a tu banco para autenticar la transacción.
                    </div>
                    <div class="tds-inputs">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric" pattern="[0-9]">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric" pattern="[0-9]">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric" pattern="[0-9]">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric" pattern="[0-9]">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric" pattern="[0-9]">
                        <input type="text" class="tds-digit" maxlength="1" inputmode="numeric" pattern="[0-9]">
                    </div>
                    <div class="tds-hint">💡 Código de demo: <span>1 2 3 4 5 6</span></div>
                    <div class="tds-status" id="tdsStatus"></div>
                </div>

                <button class="btn-pagar" id="btnPagar">
                    <i class="bi bi-lock-fill"></i> Pagar ahora
                </button>

                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Pago seguro · API Gateway · Evertec PlacetoPay
                </div>

            </div>
            <div class="vendor-box">
                <p class="section-label">Designer</p>
                <div class="vendor-info">
                    <div class="vendor-avatar">JM</div>
                    <div>
                        <div class="vendor-name">Jair ✅</div>
                        <div class="vendor-rating">👍 2026 · <a href="#">Evertec Placetopay SAS</a></div>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <input type="hidden" id="currentPayment" value="tarjeta">

    <script src="../assets/js/pages/games/pubg.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>