<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streaming — Suscripciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/plataformas/streaming.css">

<body>

    <!-- NAVBAR -->
    <?php
    $nav_back_url = "suscripciones.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <!-- GAME BANNER -->
    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="bi bi-tv-fill" style="color: var(--accent);"></i> Suscripciones Streaming
        </div>
        <span
            style="background-color: rgba(30, 33, 44, 0.84); padding: 5px 12px; border-radius: 8px; font-weight: 600; color: var(--text-main);">
            <?php
            if (isset($_SESSION['correo'])) {
                echo $_SESSION['correo'];
            } else {
                echo "Invitado";
            }
            ?>
            <i class="bi bi-circle-fill" style="color: var(--color-secondary-1);"></i>
        </span>
    </div>

    <!-- Campo oculto con correo de sesión -->
    <input type="hidden" id="usuarioIdInput" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">

    <!-- MAIN LAYOUT -->
    <main class="shop-layout">

        <!-- LEFT: Products Panel -->
        <section class="products-panel">

            <!-- NETFLIX -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=netflix.com&sz=32" alt="Netflix">
                    <span>Netflix</span>
                </div>
                <div class="products-grid">

                    <div class="product-card" data-id="1" data-plataforma="Netflix" data-plan="Estándar con Anuncios"
                        data-precio="17900">
                        <div class="product-card__platform">Netflix</div>
                        <div class="product-card__pts">Estándar con Anuncios</div>
                        <div class="product-card__label">1 mes · HD · 2 pantallas</div>
                        <div class="product-card__price">17.900 COP</div>
                    </div>

                    <div class="product-card popular-card" data-id="2" data-plataforma="Netflix" data-plan="Estándar"
                        data-precio="26900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Netflix</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">1 mes · Full HD · 2 pantallas</div>
                        <div class="product-card__price">26.900 COP</div>
                    </div>

                    <div class="product-card" data-id="3" data-plataforma="Netflix" data-plan="Premium"
                        data-precio="36900">
                        <div class="product-card__platform">Netflix</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">1 mes · 4K · 4 pantallas</div>
                        <div class="product-card__price">36.900 COP</div>
                    </div>

                </div>
            </div>

            <!-- HBO MAX -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=max.com&sz=32" alt="HBO Max">
                    <span>HBO Max</span>
                </div>
                <div class="products-grid">

                    <div class="product-card" data-id="4" data-plataforma="HBO Max" data-plan="Básico"
                        data-precio="19900">
                        <div class="product-card__platform">HBO Max</div>
                        <div class="product-card__pts">Básico</div>
                        <div class="product-card__label">1 mes · HD · 2 pantallas</div>
                        <div class="product-card__price">19.900 COP</div>
                    </div>

                    <div class="product-card" data-id="5" data-plataforma="HBO Max" data-plan="Estándar"
                        data-precio="29900">
                        <div class="product-card__platform">HBO Max</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">1 mes · Full HD · 3 pantallas</div>
                        <div class="product-card__price">29.900 COP</div>
                    </div>

                    <div class="product-card" data-id="6" data-plataforma="HBO Max" data-plan="Ultimate"
                        data-precio="39900">
                        <div class="product-card__platform">HBO Max</div>
                        <div class="product-card__pts">Ultimate</div>
                        <div class="product-card__label">1 mes · 4K · 4 pantallas</div>
                        <div class="product-card__price">39.900 COP</div>
                    </div>

                </div>
            </div>

            <!-- DISNEY+ -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=disneyplus.com&sz=32" alt="Disney+">
                    <span>Disney+</span>
                </div>
                <div class="products-grid">

                    <div class="product-card" data-id="7" data-plataforma="Disney+" data-plan="Estándar"
                        data-precio="16900">
                        <div class="product-card__platform">Disney+</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">1 mes · Full HD · 2 pantallas</div>
                        <div class="product-card__price">16.900 COP</div>
                    </div>

                    <div class="product-card popular-card" data-id="8" data-plataforma="Disney+" data-plan="Premium"
                        data-precio="28900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Disney+</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">1 mes · 4K · 4 pantallas</div>
                        <div class="product-card__price">28.900 COP</div>
                    </div>

                    <div class="product-card" data-id="9" data-plataforma="Disney+" data-plan="Duo Premium"
                        data-precio="38900">
                        <div class="product-card__platform">Disney+</div>
                        <div class="product-card__pts">Duo Premium</div>
                        <div class="product-card__label">1 mes · 4K · 4 pantallas</div>
                        <div class="product-card__price">38.900 COP</div>
                    </div>

                </div>
            </div>

        </section>

        <!-- RIGHT: Checkout Panel -->
        <aside class="checkout-panel" id="checkoutPanel">

            <div class="checkout-summary">
                <div class="checkout-product-name" id="checkoutName">📺 Netflix — Estándar</div>

                <div class="checkout-row">
                    <span class="checkout-label">Duración</span>
                    <span class="checkout-delivery">1 mes</span>
                </div>
                <div class="checkout-row">
                    <span class="checkout-label">Renovación</span>
                    <span class="checkout-delivery">Manual</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="checkout-row checkout-total-row">
                    <span class="checkout-label">Total</span>
                    <div class="checkout-pricing">
                        <span class="checkout-final-price" id="checkoutPrice">26.900 COP</span>
                    </div>
                </div>

                <button class="btn-buy" id="btnBuy">
                    <span>Suscribirse ahora</span>
                    <span class="btn-arrow">→</span>
                </button>

                <div class="trust-badges">
                    <div class="trust-item">💰 <span>Garantía de reembolso · P2P</span></div>
                    <div class="trust-item">⚡ <span>Pago rápido · Apple Pay / G Pay</span></div>
                    <div class="trust-item">💬 <span>Asistencia en directo 24/7</span></div>
                </div>
            </div>

            <div class="delivery-instructions">
                <p class="section-label">Instrucciones</p>
                <div class="instruction-text" id="instructionText">
                    Netflix® | Plan Estándar 📺<br>
                    <span>🌐</span> Acceso inmediato tras el pago<br>
                    <span>⚠️</span> IMPORTANT NOTE BEFORE PURCHASE
                </div>
                <button class="btn-instructions">Ver todas las instrucciones ▾</button>
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

    <!-- JS -->
    <script>
        (function () {

            const products = {
                1: { name: '📺 Netflix — Est. con Anuncios', plataforma: 'Netflix', plan: 'Estándar con Anuncios', price: '17.900 COP', precio: 17900 },
                2: { name: '📺 Netflix — Estándar', plataforma: 'Netflix', plan: 'Estándar', price: '26.900 COP', precio: 26900 },
                3: { name: '📺 Netflix — Premium', plataforma: 'Netflix', plan: 'Premium', price: '36.900 COP', precio: 36900 },
                4: { name: '🎬 HBO Max — Básico', plataforma: 'HBO Max', plan: 'Básico', price: '19.900 COP', precio: 19900 },
                5: { name: '🎬 HBO Max — Estándar', plataforma: 'HBO Max', plan: 'Estándar', price: '29.900 COP', precio: 29900 },
                6: { name: '🎬 HBO Max — Ultimate', plataforma: 'HBO Max', plan: 'Ultimate', price: '39.900 COP', precio: 39900 },
                7: { name: '✨ Disney+ — Estándar', plataforma: 'Disney+', plan: 'Estándar', price: '16.900 COP', precio: 16900 },
                8: { name: '✨ Disney+ — Premium', plataforma: 'Disney+', plan: 'Premium', price: '28.900 COP', precio: 28900 },
                9: { name: '✨ Disney+ — Duo Premium', plataforma: 'Disney+', plan: 'Duo Premium', price: '38.900 COP', precio: 38900 },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;

                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;

                document.getElementById('instructionText').innerHTML =
                    p.plataforma + ' | Plan ' + p.plan + ' 📺<br>' +
                    '<span>🌐</span> Acceso inmediato tras el pago<br>' +
                    '<span>⚠️</span> IMPORTANT NOTE BEFORE PURCHASE';
            }

            function initCards() {
                const cards = document.querySelectorAll('.product-card');
                if (cards.length === 0) { setTimeout(initCards, 100); return; }

                cards.forEach(function (card) {
                    card.addEventListener('click', function () {
                        cards.forEach(function (c) { c.classList.remove('selected'); });
                        card.classList.add('selected');
                        updateCheckout(parseInt(card.getAttribute('data-id')));
                    });
                });

                // Selección por defecto: Netflix Estándar
                var def = document.querySelector('.product-card[data-id="2"]');
                if (def) { def.classList.add('selected'); updateCheckout(2); }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCards);
            } else {
                initCards();
            }

            // Buy button
            document.addEventListener('click', function (e) {
                var btn = e.target.closest('#btnBuy');
                if (!btn) return;

                var usuarioId = document.getElementById('usuarioIdInput').value.trim();
                if (!usuarioId) {
                    alert('⚠️ Por favor ingresa tu correo antes de continuar.');
                    document.getElementById('usuarioIdInput').focus();
                    return;
                }

                // Obtener datos de la tarjeta seleccionada
                var selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un plan primero.'); return; }

                var plataforma = selectedCard.getAttribute('data-plataforma');
                var plan = selectedCard.getAttribute('data-plan');
                var precio = selectedCard.getAttribute('data-precio');

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_subs.php';

                [['plataforma', plataforma], ['plan', plan], ['precio', precio], ['usuario_id', usuarioId]].forEach(function (pair) {
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = pair[0];
                    input.value = pair[1];
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });

        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>