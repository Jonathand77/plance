<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membresías y Verificados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/plataformas/redes.css">

<body>
    <?php
    $nav_back_url = "suscripciones.php";
    $nav_back_text = "Atrás";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <!-- GAME BANNER -->
    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="fa-solid fa-globe" style="color: var(--accent);"></i> Membresías y Verificados
            <span class="recurring-badge"><i class="bi bi-calendar-check-fill" style="color: var(--accent);"></i> Pago
                Recurrente</span>
        </div>
    </div>

    <!-- MAIN LAYOUT -->
    <main class="shop-layout">

        <!-- LEFT: Products -->
        <section class="products-panel">

            <!-- YOUTUBE PREMIUM -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=youtube.com&sz=32" alt="YouTube"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>YouTube Premium</span>
                </div>
                <div class="products-grid">
                    <div class="product-card popular-card" data-id="1" data-servicio="YouTube Premium"
                        data-plan="Individual" data-precio="19900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">YouTube</div>
                        <div class="product-card__pts">Individual</div>
                        <div class="product-card__label">Sin anuncios · YT Music · 1 cuenta</div>
                        <div class="product-card__price">19.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="2" data-servicio="YouTube Premium" data-plan="Familiar"
                        data-precio="29900">
                        <div class="product-card__platform">YouTube</div>
                        <div class="product-card__pts">Familiar</div>
                        <div class="product-card__label">Sin anuncios · YT Music · 5 cuentas</div>
                        <div class="product-card__price">29.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- TWITTER/X VERIFICADO -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=x.com&sz=32" alt="Twitter X"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>X (Twitter) Verificado</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="3" data-servicio="Twitter Verificado" data-plan="Basic"
                        data-precio="14900">
                        <div class="product-card__platform">X · Twitter</div>
                        <div class="product-card__pts">Basic</div>
                        <div class="product-card__label">Verificado · Editar tweets</div>
                        <div class="product-card__price">14.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="4" data-servicio="Twitter Verificado"
                        data-plan="Premium" data-precio="32900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">X · Twitter</div>
                        <div class="product-card__pts">Premium</div>
                        <div class="product-card__label">Verificado · Menos anuncios · Grok AI</div>
                        <div class="product-card__price">32.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="5" data-servicio="Twitter Verificado" data-plan="Premium+"
                        data-precio="49900">
                        <div class="product-card__platform">X · Twitter</div>
                        <div class="product-card__pts">Premium+</div>
                        <div class="product-card__label">Sin anuncios · Grok AI avanzado</div>
                        <div class="product-card__price">49.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

            <!-- META VERIFIED -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=meta.com&sz=32" alt="Meta"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Meta Verified</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="6" data-servicio="Meta Verified" data-plan="Instagram"
                        data-precio="24900">
                        <div class="product-card__platform">Meta · Instagram</div>
                        <div class="product-card__pts">Instagram</div>
                        <div class="product-card__label">✔️ Verificado · Soporte prioritario</div>
                        <div class="product-card__price">24.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                    <div class="product-card" data-id="7" data-servicio="Meta Verified" data-plan="Facebook"
                        data-precio="24900">
                        <div class="product-card__platform">Meta · Facebook</div>
                        <div class="product-card__pts">Facebook</div>
                        <div class="product-card__label">✔️ Verificado · Soporte prioritario</div>
                        <div class="product-card__price">24.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="8" data-servicio="Meta Verified"
                        data-plan="Instagram + Facebook" data-precio="39900">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Meta · Combo</div>
                        <div class="product-card__pts">IG + FB</div>
                        <div class="product-card__label">✔️ Ambas plataformas</div>
                        <div class="product-card__price">39.900 COP <span class="recurrente-tag">/ mes</span></div>
                    </div>
                </div>
            </div>

        </section>

        <!-- RIGHT: Checkout -->
        <aside class="checkout-panel" id="checkoutPanel">
            <div class="checkout-summary">
                <div class="checkout-product-name" id="checkoutName">📺 YouTube Premium — Individual</div>

                <div class="checkout-row">
                    <span class="checkout-label">Periodicidad</span>
                    <span class="checkout-delivery">Mensual</span>
                </div>
                <div class="checkout-row">
                    <span class="checkout-label">Duración</span>
                    <span class="checkout-delivery">12 meses</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="checkout-row checkout-total-row">
                    <span class="checkout-label">Total / mes</span>
                    <div class="checkout-pricing">
                        <span class="checkout-final-price" id="checkoutPrice">19.900 COP</span>
                    </div>
                </div>

                <div class="recurring-info">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Este servicio se cobra automáticamente cada mes durante 12 meses. Puedes cancelar en cualquier
                        momento.</span>
                </div>

                <button class="btn-buy" id="btnBuy">
                    <span>Suscribirse ahora</span>
                    <span class="btn-arrow">→</span>
                </button>

                <div class="trust-badges">
                    <div class="trust-item">💰 <span>Garantía de reembolso · P2P</span></div>
                    <div class="trust-item">🔄 <span>Cobro recurrente automático mensual</span></div>
                    <div class="trust-item">📞 <span>Asistencia en directo 24/7</span></div>
                </div>
            </div>

            <div class="delivery-instructions">
                <p class="section-label">Instrucciones</p>
                <div class="instruction-text" id="instructionText">
                    YouTube Premium® | Plan Individual 📺<br>
                    <span>🌐</span> Acceso inmediato tras el primer pago<br>
                    <span>⚠️</span> Renovación automática cada mes
                </div>
                <button class="btn-instructions">Ver todas las instrucciones ▾</button>
            </div>

            <div class="vendor-box">
                <p class="section-label">Designer</p>
                <div class="vendor-info">
                    <div class="vendor-avatar">JM</div>
                    <div>
                        <div class="vendor-name">Jair ✔️</div>
                        <div class="vendor-rating">👍 2026 · <a href="#">Evertec Placetopay SAS</a></div>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <!-- Campo oculto con correo de sesión -->
    <input type="hidden" id="usuarioIdInput" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">

    <script>
        (function () {
            const products = {
                1: { name: '📺 YouTube Premium — Individual', servicio: 'YouTube Premium', plan: 'Individual', price: '19.900 COP', precio: 19900 },
                2: { name: '📺 YouTube Premium — Familiar', servicio: 'YouTube Premium', plan: 'Familiar', price: '29.900 COP', precio: 29900 },
                3: { name: '🐦 Twitter Verificado — Basic', servicio: 'Twitter Verificado', plan: 'Basic', price: '14.900 COP', precio: 14900 },
                4: { name: '🐦 Twitter Verificado — Premium', servicio: 'Twitter Verificado', plan: 'Premium', price: '32.900 COP', precio: 32900 },
                5: { name: '🐦 Twitter Verificado — Premium+', servicio: 'Twitter Verificado', plan: 'Premium+', price: '49.900 COP', precio: 49900 },
                6: { name: '✔️ Meta Verified — Instagram', servicio: 'Meta Verified', plan: 'Instagram', price: '24.900 COP', precio: 24900 },
                7: { name: '✔️ Meta Verified — Facebook', servicio: 'Meta Verified', plan: 'Facebook', price: '24.900 COP', precio: 24900 },
                8: { name: '✔️ Meta Verified — IG + FB', servicio: 'Meta Verified', plan: 'Instagram + Facebook', price: '39.900 COP', precio: 39900 },
            };

            function updateCheckout(id) {
                const p = products[id];
                if (!p) return;
                document.getElementById('checkoutName').textContent = p.name;
                document.getElementById('checkoutPrice').textContent = p.price;
                document.getElementById('instructionText').innerHTML =
                    p.servicio + '\u00ae | ' + p.plan + '<br>' +
                    '<span>\uD83C\uDF10</span> Acceso inmediato tras el primer pago<br>' +
                    '<span>\uD83D\uDD04</span> Renovación automática cada mes';
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

                // Selección por defecto
                var def = document.querySelector('.product-card[data-id="1"]');
                if (def) { def.classList.add('selected'); updateCheckout(1); }
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
                    alert('⚠️ No se detectó tu correo de sesión. Por favor inicia sesión nuevamente.');
                    return;
                }

                var selectedCard = document.querySelector('.product-card.selected');
                if (!selectedCard) { alert('⚠️ Selecciona un plan primero.'); return; }

                var servicio = selectedCard.getAttribute('data-servicio');
                var plan = selectedCard.getAttribute('data-plan');
                var precio = selectedCard.getAttribute('data-precio');

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '../php/crear_recurrencia.php';

                [['servicio', servicio], ['plan', plan], ['precio', precio], ['usuario_id', usuarioId]].forEach(function (pair) {
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