<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiquetes — Dispersión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/dispersiones/tickets.css">

<body>
    <?php
    $nav_back_url = "dispersion.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            ✈️ Tiquetes Aéreos — Dispersión de Pago
            <span class="wc-badge">🖥️ Web Checkout</span>
            <span class="disp-badge">💸 Dispersión</span>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <div class="disp-info">
                <i class="bi bi-info-circle-fill"></i>
                <span><strong>¿Qué es la Dispersión?</strong> Al pagar tu tiquete, el monto total se divide
                    automáticamente: una parte va al valor del vuelo y otra cubre los impuestos aeroportuarios. Todo en
                    una sola transacción.</span>
            </div>

            <!-- Filtro por región -->
            <div class="region-tabs">
                <button class="region-tab active" onclick="filterRegion('all', this)">🌎 Todos</button>
                <button class="region-tab" onclick="filterRegion('sur', this)">🌎 Suramérica</button>
                <button class="region-tab" onclick="filterRegion('europa', this)">🌍 Europa</button>
                <button class="region-tab" onclick="filterRegion('asia', this)">🌏 Asia & NA</button>
            </div>

            <p class="section-label">✈️ Destinos disponibles</p>
            <div class="tickets-grid">

                <!-- SURAMÉRICA -->
                <div class="ticket-card" data-region="sur" data-id="1" data-dest="Cartagena, Colombia"
                    data-base="350000" data-imp="50000" data-total="400000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇨🇴</span>
                        <div>
                            <div class="ticket-dest">Cartagena</div>
                            <div class="ticket-sub">Colombia · Vuelo directo</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$350.000</span></div>
                            <div>Impuestos: <span>$50.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">400.000 COP</div>
                        </div>
                    </div>
                </div>

                <div class="ticket-card" data-region="sur" data-id="2" data-dest="Buenos Aires, Argentina"
                    data-base="800000" data-imp="120000" data-total="920000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇦🇷</span>
                        <div>
                            <div class="ticket-dest">Buenos Aires</div>
                            <div class="ticket-sub">Argentina · 1 escala</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$800.000</span></div>
                            <div>Impuestos: <span>$120.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">920.000 COP</div>
                        </div>
                    </div>
                </div>

                <div class="ticket-card" data-region="sur" data-id="3" data-dest="Cusco, Perú" data-base="650000"
                    data-imp="95000" data-total="745000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇵🇪</span>
                        <div>
                            <div class="ticket-dest">Cusco</div>
                            <div class="ticket-sub">Perú · 1 escala</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$650.000</span></div>
                            <div>Impuestos: <span>$95.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">745.000 COP</div>
                        </div>
                    </div>
                </div>

                <div class="ticket-card" data-region="sur" data-id="4" data-dest="Río de Janeiro, Brasil"
                    data-base="900000" data-imp="130000" data-total="1030000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇧🇷</span>
                        <div>
                            <div class="ticket-dest">Río de Janeiro</div>
                            <div class="ticket-sub">Brasil · 1 escala</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$900.000</span></div>
                            <div>Impuestos: <span>$130.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">1.030.000 COP</div>
                        </div>
                    </div>
                </div>

                <!-- EUROPA -->
                <div class="ticket-card" data-region="europa" data-id="5" data-dest="París, Francia" data-base="2500000"
                    data-imp="350000" data-total="2850000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇫🇷</span>
                        <div>
                            <div class="ticket-dest">París</div>
                            <div class="ticket-sub">Francia · 2 escalas</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$2.500.000</span></div>
                            <div>Impuestos: <span>$350.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">2.850.000 COP</div>
                        </div>
                    </div>
                </div>

                <div class="ticket-card" data-region="europa" data-id="6" data-dest="Roma, Italia" data-base="2200000"
                    data-imp="320000" data-total="2520000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇮🇹</span>
                        <div>
                            <div class="ticket-dest">Roma</div>
                            <div class="ticket-sub">Italia · 2 escalas</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$2.200.000</span></div>
                            <div>Impuestos: <span>$320.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">2.520.000 COP</div>
                        </div>
                    </div>
                </div>

                <!-- ASIA & NA -->
                <div class="ticket-card" data-region="asia" data-id="7" data-dest="Tokio, Japón" data-base="3000000"
                    data-imp="420000" data-total="3420000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇯🇵</span>
                        <div>
                            <div class="ticket-dest">Tokio</div>
                            <div class="ticket-sub">Japón · 2 escalas</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$3.000.000</span></div>
                            <div>Impuestos: <span>$420.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">3.420.000 COP</div>
                        </div>
                    </div>
                </div>

                <div class="ticket-card" data-region="asia" data-id="8" data-dest="Nueva York, USA" data-base="1800000"
                    data-imp="250000" data-total="2050000">
                    <div class="ticket-header">
                        <span class="ticket-flag">🇺🇸</span>
                        <div>
                            <div class="ticket-dest">Nueva York</div>
                            <div class="ticket-sub">USA · 1 escala</div>
                        </div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-details">
                        <div class="ticket-desglose">
                            <div>Vuelo: <span>$1.800.000</span></div>
                            <div>Impuestos: <span>$250.000</span></div>
                        </div>
                        <div class="ticket-total">
                            <div class="ticket-total-label">Total</div>
                            <div class="ticket-price">2.050.000 COP</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-dest" id="checkoutDest">✈️ Selecciona un destino</div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total del tiquete</span>
                    <span class="checkout-price" id="checkoutPrice">—</span>
                </div>

                <!-- Desglose dispersión -->
                <div class="dispersion-box" id="dispBox" style="display:none;">
                    <div
                        style="font-family:var(--font-display);font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--text-secondary);margin-bottom:0.5rem;">
                        Dispersión del pago</div>
                    <div class="disp-row">
                        <span>✈️ Aerolínea (vuelo)</span>
                        <span id="dispBase">$0</span>
                    </div>
                    <div class="disp-row">
                        <span>🏛️ Impuestos aerop.</span>
                        <span id="dispImp">$0</span>
                    </div>
                    <div class="disp-row total">
                        <span>Total</span>
                        <span id="dispTotal">$0</span>
                    </div>
                </div>

                <div class="checkout-divider"></div>
                <span class="section-label-sm">Datos del pasajero</span>

                <div class="field-group">
                    <label class="field-label">Nombre completo</label>
                    <input type="text" class="field-input" id="pNombre" placeholder="Nombre y apellido">
                </div>
                <div class="field-group">
                    <label class="field-label">Correo electrónico</label>
                    <input type="email" class="field-input" id="pCorreo"
                        value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
                </div>
                <div class="field-group">
                    <label class="field-label">Teléfono</label>
                    <input type="text" class="field-input" id="pTelefono" placeholder="3001234567">
                </div>
                <div class="field-row">
                    <div class="field-group">
                        <label class="field-label">Tipo de documento</label>
                        <select class="field-input" id="pTipoDoc">
                            <option value="CC">Cédula</option>
                            <option value="CE">Cédula Extranjería</option>
                            <option value="PP">Pasaporte</option>
                            <option value="NIT">NIT</option>
                        </select>
                    </div>
                    <div class="field-group">
                        <label class="field-label">Número de documento</label>
                        <input type="text" class="field-input" id="pNumDoc" placeholder="1234567890">
                    </div>
                </div>

                <button class="btn-comprar" id="btnComprar" onclick="comprar()">
                    <i class="bi bi-airplane-fill"></i> Comprar tiquete
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Dispersión · Web Checkout · PlacetoPay · Evertec
                </div>
            </div>
        </aside>
    </main>

    <script>
        (function () {
            const tickets = {
                1: { dest: '✈️ Cartagena, Colombia', base: 350000, imp: 50000, total: 400000 },
                2: { dest: '✈️ Buenos Aires, Argentina', base: 800000, imp: 120000, total: 920000 },
                3: { dest: '✈️ Cusco, Perú', base: 650000, imp: 95000, total: 745000 },
                4: { dest: '✈️ Río de Janeiro, Brasil', base: 900000, imp: 130000, total: 1030000 },
                5: { dest: '✈️ París, Francia', base: 2500000, imp: 350000, total: 2850000 },
                6: { dest: '✈️ Roma, Italia', base: 2200000, imp: 320000, total: 2520000 },
                7: { dest: '✈️ Tokio, Japón', base: 3000000, imp: 420000, total: 3420000 },
                8: { dest: '✈️ Nueva York, USA', base: 1800000, imp: 250000, total: 2050000 },
            };

            let selectedId = null;
            function fmt(n) { return '$' + n.toLocaleString('es-CO') + ' COP'; }

            function updateCheckout(id) {
                const t = tickets[id];
                document.getElementById('checkoutDest').textContent = t.dest;
                document.getElementById('checkoutPrice').textContent = fmt(t.total);
                document.getElementById('dispBase').textContent = fmt(t.base);
                document.getElementById('dispImp').textContent = fmt(t.imp);
                document.getElementById('dispTotal').textContent = fmt(t.total);
                document.getElementById('dispBox').style.display = 'block';
            }

            window.filterRegion = function (region, el) {
                document.querySelectorAll('.region-tab').forEach(t => t.classList.remove('active'));
                el.classList.add('active');
                document.querySelectorAll('.ticket-card').forEach(function (card) {
                    const r = card.getAttribute('data-region');
                    card.style.display = (region === 'all' || r === region) ? '' : 'none';
                });
            };

            function initCards() {
                const cards = document.querySelectorAll('.ticket-card');
                if (!cards.length) { setTimeout(initCards, 100); return; }
                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(c => c.classList.remove('selected'));
                        card.classList.add('selected');
                        selectedId = parseInt(card.getAttribute('data-id'));
                        updateCheckout(selectedId);
                    });
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else { initCards(); }

            window.comprar = function () {
                if (!selectedId) { alert('⚠️ Selecciona un destino primero.'); return; }
                const nombre = document.getElementById('pNombre').value.trim();
                const correo = document.getElementById('pCorreo').value.trim();
                const telefono = document.getElementById('pTelefono').value.trim();
                const tipoDoc = document.getElementById('pTipoDoc').value;
                const numDoc = document.getElementById('pNumDoc').value.trim();

                if (!nombre || !correo || !telefono || !numDoc) {
                    alert('⚠️ Completa todos los datos del pasajero.'); return;
                }

                const t = tickets[selectedId];
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_dispersion.php';

                [
                    ['destino', t.dest.replace('✈️ ', '')],
                    ['base', t.base],
                    ['impuesto', t.imp],
                    ['total', t.total],
                    ['nombre', nombre],
                    ['correo', correo],
                    ['telefono', telefono],
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