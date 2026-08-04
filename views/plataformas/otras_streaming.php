<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Otras Plataformas — Suscripción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/plataformas/otras_streaming.css">

<body>
    <?php
    $nav_back_url = "suscripciones.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="bi bi-tv-fill" style="color: var(--accent);"></i> Otras Plataformas — Suscripción Pura
            <span class="sub-badge"><i class="bi bi-shield-lock-fill"></i> Tokenización</span>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <!-- AMAZON PRIME -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=primevideo.com&sz=32" alt="Amazon Prime"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Amazon Prime</span>
                </div>
                <div class="products-grid">
                    <div class="product-card popular-card" data-id="1" data-servicio="Amazon Prime" data-plan="Mensual"
                        data-precio="9900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Amazon Prime</div>
                        <div class="product-card__pts">Mensual</div>
                        <div class="product-card__label">Video · Music · Envíos · 1 mes</div>
                        <div class="product-card__price">9.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="2" data-servicio="Amazon Prime" data-plan="Anual"
                        data-precio="89900">
                        <div class="product-card__platform">Amazon Prime</div>
                        <div class="product-card__pts">Anual</div>
                        <div class="product-card__label">Video · Music · Envíos · 12 meses</div>
                        <div class="product-card__price">89.900 COP <span class="sub-tag">/ año</span></div>
                    </div>
                </div>
            </div>

            <!-- CRUNCHYROLL -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=crunchyroll.com&sz=32" alt="Crunchyroll"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Crunchyroll</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="3" data-servicio="Crunchyroll" data-plan="Fan"
                        data-precio="12900">
                        <div class="product-card__platform">Crunchyroll</div>
                        <div class="product-card__pts">Fan</div>
                        <div class="product-card__label">Anime HD · Sin anuncios · 1 pantalla</div>
                        <div class="product-card__price">12.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="4" data-servicio="Crunchyroll" data-plan="Mega Fan"
                        data-precio="19900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Crunchyroll</div>
                        <div class="product-card__pts">Mega Fan</div>
                        <div class="product-card__label">Anime 4K · Sin anuncios · 4 pantallas</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- STAR+ -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=starplus.com&sz=32" alt="Star+"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Star+</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="5" data-servicio="Star+" data-plan="Estándar"
                        data-precio="19900">
                        <div class="product-card__platform">Star+</div>
                        <div class="product-card__pts">Estándar</div>
                        <div class="product-card__label">Series · Deportes · Full HD</div>
                        <div class="product-card__price">19.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="6" data-servicio="Star+" data-plan="Combo+"
                        data-precio="29900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Star+</div>
                        <div class="product-card__pts">Combo+</div>
                        <div class="product-card__label">Star+ y Disney+ · 4K · 4 pantallas</div>
                        <div class="product-card__price">29.900 COP <span class="sub-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel" id="checkoutPanel">
            <div class="checkout-summary">
                <div class="checkout-product-name" id="checkoutName">🛒 Amazon Prime — Mensual</div>
                <div class="checkout-row">
                    <span class="checkout-label">Tipo</span>
                    <span class="checkout-delivery">Suscripción pura</span>
                </div>
                <div class="checkout-row">
                    <span class="checkout-label">Cobro</span>
                    <span class="checkout-delivery">Primer mes + tokenización</span>
                </div>
                <div class="checkout-divider"></div>
                <div class="checkout-row checkout-total-row">
                    <span class="checkout-label">Total</span>
                    <div class="checkout-pricing">
                        <span class="checkout-final-price" id="checkoutPrice">9.900 COP</span>
                    </div>
                </div>
                <div class="sub-info">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Tu tarjeta será tokenizada de forma segura para futuros cobros. El primer mes se cobra al
                        suscribirse.</span>
                </div>
                <button class="btn-buy" id="btnBuy">
                    <span>Suscribirse ahora</span>
                    <span class="btn-arrow">→</span>
                </button>
                <div class="trust-badges">
                    <div class="trust-item">🛡️ <span>Garantía de reembolso · P2P</span></div>
                    <div class="trust-item">🔐 <span>Tarjeta tokenizada de forma segura</span></div>
                    <div class="trust-item">💬 <span>Asistencia en directo 24/7</span></div>
                </div>
            </div>

            <div class="delivery-instructions">
                <p
                    style="font-family:'Barlow Condensed',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-secondary);margin-bottom:0.75rem;">
                    Instrucciones</p>
                <div class="instruction-text" id="instructionText">
                    Amazon Prime® | Plan Mensual 🛒<br>
                    <span>🌐</span> Acceso inmediato tras el pago<br>
                    <span>🔐</span> Tarjeta guardada para futuros cobros
                </div>
                <button class="btn-instructions">Ver todas las instrucciones ▾</button>
            </div>

            <div class="vendor-box">
                <p
                    style="font-family:'Barlow Condensed',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--text-secondary);margin-bottom:0.5rem;">
                    Designer</p>
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

    <input type="hidden" id="usuarioIdInput" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">

    <script>
        (function () {
            const products = {
                1: { name: '🛒 Amazon Prime — Mensual', servicio: 'Amazon Prime', plan: 'Mensual', precio: 9900 },
                2: { name: '🛒 Amazon Prime — Anual', servicio: 'Amazon Prime', plan: 'Anual', precio: 89900 },
                3: { name: '🍥 Crunchyroll — Fan', servicio: 'Crunchyroll', plan: 'Fan', precio: 12900 },
                4: { name: '🍥 Crunchyroll — Mega Fan', servicio: 'Crunchyroll', plan: 'Mega Fan', precio: 19900 },
                5: { name: '⭐ Star+ — Estándar', servicio: 'Star+', plan: 'Estándar', precio: 19900 },
                6: { name: '⭐ Star+ — Combo+', servicio: 'Star+', plan: 'Combo+', precio: 29900 },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;
                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.precio.toLocaleString('es-CO') + ' COP';
                document.getElementById('instructionText').innerHTML =
                    p.servicio + '\u00ae | Plan ' + p.plan + '<br>' +
                    '<span>\uD83C\uDF10</span> Acceso inmediato tras el pago<br>' +
                    '<span>\uD83D\uDD10</span> Tarjeta guardada para futuros cobros';
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

            document.addEventListener('click', function (e) {
                var btn = e.target.closest('#btnBuy');
                if (!btn) return;

                var usuarioId = document.getElementById('usuarioIdInput').value.trim();
                if (!usuarioId) { alert('⚠️ No se detectó tu correo de sesión.'); return; }

                var selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un plan primero.'); return; }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_suscription.php';

                [['servicio', selectedCard.getAttribute('data-servicio')],
                ['plan', selectedCard.getAttribute('data-plan')],
                ['precio', selectedCard.getAttribute('data-precio')],
                ['usuario_id', usuarioId]].forEach(function (pair) {
                    var input = document.createElement('input');
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