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
    <title>Hotel Plance — Reservaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
</head>
<style>
    :root {
        /* Nueva paleta estandarizada */
        --color-primary: #FF6C0C;
        --color-secondary-1: #00CFB4;
        --color-secondary-2: #4C5F71;
        --color-secondary-3: #0062A8;
        --color-secondary-4: #1E212C;
        --color-secondary-5: #7D868C;
        --text-main: #f1f5f9;

        /* Variables específicas del componente */
        --bg-base: #0d0e10;
        --bg-surface: #1E212C;
        --bg-card: #1E2128;
        --bg-card-hover: #252830;
        --bg-selected: #0a1520;
        --border: #4C5F71;
        --border-active: #FF6C0C;
        --accent: #0062A8;
        --accent-glow: rgba(0, 98, 168, 0.25);
        --accent-dark: #004d85;
        --accent-soft: rgba(0, 98, 168, 0.1);
        --text-primary: #f0f1f3;
        --text-secondary: #7D868C;
        --text-muted: #4C5F71;
        --font-display: 'Barlow', sans-serif;
        --font-body: 'Barlow', sans-serif;
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
        background-color: rgba(30, 33, 44, 0.85) !important;
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
        flex-wrap: wrap;
    }

    .game-banner__tag {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.04em;
    }

    .wc-badge {
        background: rgba(0, 98, 168, 0.12);
        color: var(--accent);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        letter-spacing: 0.05em;
        font-family: var(--font-display);
    }

    .pre-badge {
        background: rgba(0, 98, 168, 0.12);
        color: #6bb6e8;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        letter-spacing: 0.05em;
        font-family: var(--font-display);
    }

    .shop-layout {
        display: grid;
        grid-template-columns: 1fr 370px;
        gap: 1.5rem;
        max-width: 1200px;
        margin: 1.5rem auto;
        padding: 0 1.5rem 3rem;
        align-items: start;
    }

    .section-label {
        font-family: var(--font-display);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
    }

    /* INFO PREAUTORIZACION */
    .preauth-info {
        background: rgba(0, 98, 168, 0.07);
        border: 1px solid rgba(0, 98, 168, 0.2);
        border-left: 3px solid var(--accent);
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        padding: 0.8rem 1rem;
        margin-bottom: 1.2rem;
        font-size: 0.82rem;
        color: #6bb6e8;
        line-height: 1.6;
    }

    .preauth-info strong {
        color: var(--accent);
    }

    /* GRID HABITACIONES */
    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
    }

    .room-card {
        position: relative;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.2rem;
        cursor: pointer;
        transition: all var(--transition);
        overflow: hidden;
    }

    .room-card:hover {
        background: var(--bg-card-hover);
        border-color: rgba(0, 98, 168, 0.4);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.35);
    }

    .room-card.selected {
        background: var(--bg-selected);
        border-color: var(--accent);
        box-shadow: 0 0 0 1px var(--accent), 0 4px 24px var(--accent-glow);
    }

    .room-card.selected::after {
        content: '✔';
        position: absolute;
        top: 0.7rem;
        right: 0.7rem;
        width: 20px;
        height: 20px;
        background: var(--accent);
        border-radius: 50%;
        color: #fff;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        line-height: 20px;
        text-align: center;
    }

    .room-badge {
        display: inline-block;
        background: rgba(0, 98, 168, 0.12);
        color: var(--accent);
        font-size: 0.68rem;
        font-weight: 700;
        padding: 0.15rem 0.5rem;
        border-radius: var(--radius-sm);
        margin-bottom: 0.5rem;
        font-family: var(--font-display);
        letter-spacing: 0.05em;
    }

    .room-badge.premium {
        background: rgba(255, 108, 12, 0.12);
        color: var(--color-primary);
    }

    .room-badge.suite {
        background: rgba(0, 207, 180, 0.12);
        color: var(--color-secondary-1);
    }

    .room-icon {
        font-size: 1.6rem;
        margin-bottom: 0.4rem;
    }

    .room-name {
        font-family: var(--font-display);
        font-size: 1.15rem;
        font-weight: 800;
        margin-bottom: 0.3rem;
        letter-spacing: 0.02em;
    }

    .room-desc {
        font-size: 0.78rem;
        color: var(--text-secondary);
        line-height: 1.5;
        margin-bottom: 0.6rem;
    }

    .room-amenities {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 0.6rem;
    }

    .amenity {
        font-size: 0.68rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--border);
        padding: 0.15rem 0.4rem;
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
    }

    .room-price {
        font-family: var(--font-display);
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--accent);
    }

    .room-price-label {
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-left: 0.2rem;
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
        padding: 1.3rem;
    }

    .checkout-room-name {
        font-family: var(--font-display);
        font-size: 1.15rem;
        font-weight: 800;
        margin-bottom: 0.3rem;
    }

    .checkout-price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.6rem;
    }

    .checkout-price {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--text-primary);
    }

    .checkout-divider {
        height: 1px;
        background: var(--border);
        margin: 0.7rem 0;
    }

    .section-label-sm {
        font-family: var(--font-display);
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
        display: block;
    }

    .field-group {
        margin-bottom: 0.65rem;
    }

    .field-label {
        font-size: 0.73rem;
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 0.25rem;
        display: block;
    }

    .field-input {
        width: 100%;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        border-radius: var(--radius-sm);
        color: var(--text-primary);
        font-family: var(--font-body);
        font-size: 0.83rem;
        padding: 0.4rem 0.7rem;
        outline: none;
        transition: border-color var(--transition);
    }

    .field-input:focus {
        border-color: var(--color-secondary-3);
        box-shadow: 0 0 0 3px rgba(0, 98, 168, 0.15);
    }

    .field-input::placeholder {
        color: var(--text-muted);
    }

    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }

    /* Fechas */
    .dates-info {
        background: rgba(0, 98, 168, 0.07);
        border: 1px solid rgba(0, 98, 168, 0.25);
        border-radius: var(--radius-sm);
        padding: 0.65rem 0.9rem;
        margin-bottom: 0.6rem;
        font-size: 0.8rem;
        color: #6bb6e8;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-reservar {
        width: 100%;
        margin-top: 0.8rem;
        padding: 0.85rem;
        background: var(--color-primary);
        border: none;
        border-radius: var(--radius-md);
        color: #0d0e10;
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        cursor: pointer;
        transition: all var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .btn-reservar::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.12), transparent);
        transform: translateX(-100%);
        transition: transform 0.5s ease;
    }

    .btn-reservar:hover {
        background: var(--color-secondary-3);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(255, 108, 12, 0.3);
        color: #fff;
    }

    .btn-reservar:hover::before {
        transform: translateX(100%);
    }

    .security-note {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.73rem;
        color: var(--text-muted);
        margin-top: 0.5rem;
        justify-content: center;
    }

    /* Preauth notice en checkout */
    .preauth-notice {
        background: rgba(0, 98, 168, 0.08);
        border: 1px solid rgba(0, 98, 168, 0.2);
        border-radius: var(--radius-sm);
        padding: 0.65rem 0.9rem;
        margin-top: 0.6rem;
        font-size: 0.78rem;
        color: #6bb6e8;
        line-height: 1.5;
    }

    #totalNochesRow {
        background: rgba(0, 98, 168, 0.07);
        border-radius: var(--radius-sm);
        padding: 0.6rem 0.8rem;
        margin-bottom: 0.6rem;
        font-size: 0.85rem;
        text-align: center;
    }

    #totalNochesText {
        color: #6bb6e8;
    }

    #totalFinalText {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--accent);
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

    @media(max-width:900px) {
        .shop-layout {
            grid-template-columns: 1fr;
        }

        .checkout-panel {
            position: static;
        }

        .rooms-grid {
            grid-template-columns: 1fr;
        }

        .field-row {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width:600px) {
        .game-banner {
            flex-direction: column;
            align-items: flex-start;
        }

        .room-card {
            padding: 0.9rem;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "reservas.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            🏨 Hotel Plance — Reservaciones
            <span class="wc-badge">🖥️ Web Checkout</span>
            <span class="pre-badge">🔐 Preautorización</span>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <div class="preauth-info">
                <i class="bi bi-info-circle-fill"></i>
                <span><strong>¿Cómo funciona la preautorización?</strong> Al reservar, PlacetoPay reserva el monto en tu
                    tarjeta sin cobrarlo aún. El cargo real se realiza al momento del check-out del hotel. Si cancelas
                    antes, el monto se libera automáticamente.</span>
            </div>

            <p class="section-label">🛏️ Selecciona tu habitación</p>
            <div class="rooms-grid">

                <div class="room-card" data-id="1" data-nombre="Habitación Estándar" data-precio="150000"
                    data-moneda="COP">
                    <span class="room-badge">ESTÁNDAR</span>
                    <div class="room-icon">🛏️</div>
                    <div class="room-name">Habitación Estándar</div>
                    <div class="room-desc">Cómoda habitación con cama doble, ideal para viajeros individuales o parejas.
                    </div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi</span>
                        <span class="amenity">❄️ A/C</span>
                        <span class="amenity">📺 TV</span>
                    </div>
                    <div class="room-price">150.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="2" data-nombre="Habitación Doble" data-precio="220000"
                    data-moneda="COP">
                    <span class="room-badge">DOBLE</span>
                    <div class="room-icon">🛏️🛏️</div>
                    <div class="room-name">Habitación Doble</div>
                    <div class="room-desc">Espaciosa habitación con dos camas individuales, perfecta para grupos o
                        familias.</div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi</span>
                        <span class="amenity">❄️ A/C</span>
                        <span class="amenity">📺 TV</span>
                        <span class="amenity">🧴 Amenities</span>
                    </div>
                    <div class="room-price">220.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="3" data-nombre="Habitación con Vista al Mar" data-precio="320000"
                    data-moneda="COP">
                    <span class="room-badge premium">PREMIUM</span>
                    <div class="room-icon">🌊</div>
                    <div class="room-name">Vista al Mar</div>
                    <div class="room-desc">Habitación premium con balcón privado y vista panorámica al mar. Desayuno
                        incluido.</div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi</span>
                        <span class="amenity">❄️ A/C</span>
                        <span class="amenity">🍳 Desayuno</span>
                        <span class="amenity">🛁 Jacuzzi</span>
                    </div>
                    <div class="room-price">320.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="4" data-nombre="Suite Junior" data-precio="480000" data-moneda="COP">
                    <span class="room-badge suite">SUITE</span>
                    <div class="room-icon">✨</div>
                    <div class="room-name">Suite Junior</div>
                    <div class="room-desc">Suite moderna con sala de estar separada, cama king y amenidades de lujo.
                    </div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi</span>
                        <span class="amenity">❄️ A/C</span>
                        <span class="amenity">🍳 Desayuno</span>
                        <span class="amenity">🛁 Jacuzzi</span>
                        <span class="amenity">🍷 Minibar</span>
                    </div>
                    <div class="room-price">480.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="5" data-nombre="Suite Presidencial" data-precio="850000"
                    data-moneda="COP">
                    <span class="room-badge suite">PRESIDENCIAL</span>
                    <div class="room-icon">👑</div>
                    <div class="room-name">Suite Presidencial</div>
                    <div class="room-desc">La experiencia más exclusiva. Sala, comedor, habitación y terraza privada con
                        vista de 360°.</div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi Premium</span>
                        <span class="amenity">🍳 Todo incluido</span>
                        <span class="amenity">🚗 Transfer</span>
                        <span class="amenity">🛁 Spa privado</span>
                    </div>
                    <div class="room-price">850.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="6" data-nombre="Habitación Familiar" data-precio="280000"
                    data-moneda="COP">
                    <span class="room-badge">FAMILIAR</span>
                    <div class="room-icon">👨‍👩‍👧‍👦</div>
                    <div class="room-name">Habitación Familiar</div>
                    <div class="room-desc">Amplia habitación diseñada para familias, con cama matrimonial y literas para
                        los pequeños.</div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi</span>
                        <span class="amenity">❄️ A/C</span>
                        <span class="amenity">📺 TV</span>
                        <span class="amenity">🧸 Kids friendly</span>
                    </div>
                    <div class="room-price">280.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="7" data-nombre="Habitación Ejecutiva" data-precio="390000"
                    data-moneda="COP">
                    <span class="room-badge premium">EJECUTIVA</span>
                    <div class="room-icon">💼</div>
                    <div class="room-name">Habitación Ejecutiva</div>
                    <div class="room-desc">Perfecta para viajeros de negocios. Escritorio, acceso al lounge ejecutivo y
                        late check-out.</div>
                    <div class="room-amenities">
                        <span class="amenity">📶 WiFi Premium</span>
                        <span class="amenity">☕ Lounge</span>
                        <span class="amenity">🖨️ Impresora</span>
                        <span class="amenity">🍳 Desayuno</span>
                    </div>
                    <div class="room-price">390.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

                <div class="room-card" data-id="8" data-nombre="Penthouse" data-precio="1200000" data-moneda="COP">
                    <span class="room-badge suite">PENTHOUSE</span>
                    <div class="room-icon">🌆</div>
                    <div class="room-name">Penthouse</div>
                    <div class="room-desc">El piso más alto del hotel. Piscina privada, cocina equipada y mayordomo
                        personal las 24h.</div>
                    <div class="room-amenities">
                        <span class="amenity">🏊 Piscina privada</span>
                        <span class="amenity">👨‍🍳 Chef</span>
                        <span class="amenity">🚗 Limousine</span>
                        <span class="amenity">🛁 Spa</span>
                    </div>
                    <div class="room-price">1.200.000 COP <span class="room-price-label">/ noche</span></div>
                </div>

            </div>
        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-room-name" id="checkoutName">🛏️ Habitación Estándar</div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Precio / noche</span>
                    <span class="checkout-price" id="checkoutPrice">150.000 COP</span>
                </div>

                <div class="dates-info">
                    <i class="bi bi-calendar2-check"></i>
                    Selecciona las fechas de tu estancia
                </div>

                <div class="field-row" style="margin-bottom:0.65rem;">
                    <div class="field-group" style="margin-bottom:0;">
                        <label class="field-label">Check-in</label>
                        <input type="date" class="field-input" id="checkIn" onchange="calcTotal()">
                    </div>
                    <div class="field-group" style="margin-bottom:0;">
                        <label class="field-label">Check-out</label>
                        <input type="date" class="field-input" id="checkOut" onchange="calcTotal()">
                    </div>
                </div>

                <div id="totalNochesRow" style="display:none;">
                    <span id="totalNochesText" style="color:#6bb6e8;"></span>
                    <div id="totalFinalText"></div>
                </div>

                <div class="checkout-divider"></div>
                <span class="section-label-sm">Datos del huésped</span>

                <div class="field-group">
                    <label class="field-label">Nombre completo</label>
                    <input type="text" class="field-input" id="hNombre" placeholder="Nombre y apellido">
                </div>
                <div class="field-group">
                    <label class="field-label">Correo electrónico</label>
                    <input type="email" class="field-input" id="hCorreo"
                        value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                </div>
                <div class="field-group">
                    <label class="field-label">Teléfono</label>
                    <input type="text" class="field-input" id="hTelefono" placeholder="3001234567">
                </div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Tipo de documento</label>
                        <select class="field-input" id="hTipoDoc">
                            <option value="CC">Cédula</option>
                            <option value="CE">Cédula Extranjería</option>
                            <option value="PP">Pasaporte</option>
                            <option value="NIT">NIT</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Número de documento</label>
                        <input type="text" class="field-input" id="hNumDoc" placeholder="1234567890">
                    </div>
                </div>

                <button class="btn-reservar" id="btnReservar" onclick="reservar()">
                    <i class="bi bi-calendar2-check-fill"></i> Reservar ahora
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Preautorización segura · PlacetoPay · Evertec
                </div>

                <div class="preauth-notice">
                    🔐 <strong>Preautorización:</strong> Tu tarjeta no será cobrada hasta el check-out. Solo se reserva
                    el monto como garantía.
                </div>
            </div>
        </aside>
    </main>

    <script>
        (function () {
            const products = {
                1: { name: '🛏️ Habitación Estándar', precio: 150000, price: '150.000 COP' },
                2: { name: '🛏️🛏️ Habitación Doble', precio: 220000, price: '220.000 COP' },
                3: { name: '🌊 Vista al Mar', precio: 320000, price: '320.000 COP' },
                4: { name: '✨ Suite Junior', precio: 480000, price: '480.000 COP' },
                5: { name: '👑 Suite Presidencial', precio: 850000, price: '850.000 COP' },
                6: { name: '👨‍👩‍👧‍👦 Habitación Familiar', precio: 280000, price: '280.000 COP' },
                7: { name: '💼 Habitación Ejecutiva', precio: 390000, price: '390.000 COP' },
                8: { name: '🌆 Penthouse', precio: 1200000, price: '1.200.000 COP' },
            };

            let selectedId = null;

            function fmt(n) { return '$' + n.toLocaleString('es-CO') + ' COP'; }

            window.calcTotal = function () {
                if (!selectedId) return;
                const ci = document.getElementById('checkIn').value;
                const co = document.getElementById('checkOut').value;
                if (!ci || !co) return;
                const diff = (new Date(co) - new Date(ci)) / 86400000;
                if (diff <= 0) {
                    document.getElementById('totalNochesRow').style.display = 'none';
                    return;
                }
                const total = diff * products[selectedId].precio;
                document.getElementById('totalNochesText').textContent = diff + ' noche(s) × ' + products[selectedId].price;
                document.getElementById('totalFinalText').textContent = 'Total: ' + fmt(total);
                document.getElementById('totalNochesRow').style.display = 'block';
            };

            function initCards() {
                const cards = document.querySelectorAll('.room-card');
                if (!cards.length) { setTimeout(initCards, 100); return; }
                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        selectedId = parseInt(card.getAttribute('data-id'));
                        document.getElementById('checkoutName').textContent = products[selectedId].name;
                        document.getElementById('checkoutPrice').textContent = products[selectedId].price;
                        calcTotal();
                    });
                });
            }

            // Fechas mínimas
            const hoy = new Date().toISOString().split('T')[0];
            document.getElementById('checkIn').min = hoy;
            document.getElementById('checkOut').min = hoy;

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            window.reservar = function () {
                if (!selectedId) { alert('⚠️ Selecciona una habitación.'); return; }

                const ci = document.getElementById('checkIn').value;
                const co = document.getElementById('checkOut').value;
                const nombre = document.getElementById('hNombre').value.trim();
                const correo = document.getElementById('hCorreo').value.trim();
                const tel = document.getElementById('hTelefono').value.trim();
                const tipoDoc = document.getElementById('hTipoDoc').value;
                const numDoc = document.getElementById('hNumDoc').value.trim();

                if (!ci || !co) { alert('⚠️ Selecciona las fechas de check-in y check-out.'); return; }
                if (new Date(co) <= new Date(ci)) { alert('⚠️ El check-out debe ser posterior al check-in.'); return; }
                if (!nombre || !correo || !tel || !numDoc) { alert('⚠️ Completa todos los datos del huésped.'); return; }

                const noches = (new Date(co) - new Date(ci)) / 86400000;
                const total = noches * products[selectedId].precio;
                const card = document.querySelector('.room-card.selected');

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_preautorizacion.php';

                [
                    ['habitacion', card.getAttribute('data-nombre')],
                    ['precio', products[selectedId].precio],
                    ['total', total],
                    ['noches', noches],
                    ['checkin', ci],
                    ['checkout', co],
                    ['nombre', nombre],
                    ['correo', correo],
                    ['telefono', tel],
                    ['tipo_doc', tipoDoc],
                    ['num_doc', numDoc],
                ].forEach(function (pair) {
                    const input = document.createElement('input');
                    input.type = 'hidden'; input.name = pair[0]; input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            };
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>