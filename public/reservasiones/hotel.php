<?php
session_start();
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
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/reservasiones/hotel.css">

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