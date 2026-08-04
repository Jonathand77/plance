<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IA's — Planes de Inteligencia Artificial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/plataformas/ia.css">

<body>
    <?php
    $nav_back_url = "suscripciones.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            <i class="bi bi-robot" style="color: var(--accent);"></i> IA's — Planes de Inteligencia Artificial
            <span class="rec-badge"><i class="fa-solid fa-globe" style="color: var(--accent);"></i> Suscripción
                Recurrente</span>
        </div>
        <div class="period-selector">
            <button class="period-btn active" id="btnMensual" onclick="setPeriod('mensual')">Mensual</button>
            <button class="period-btn" id="btnAnual" onclick="setPeriod('anual')">Anual</button>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <!-- CLAUDE -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=claude.ai&sz=32" alt="Claude"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>Claude</span>
                </div>
                <div class="products-grid">
                    <div class="product-card popular-card" data-id="1" data-servicio="Claude" data-plan="Pro"
                        data-precio-mensual="22900" data-precio-anual="229000">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">Claude</div>
                        <div class="product-card__pts">Pro</div>
                        <div class="product-card__label">Uso extendido · Proyectos · Prioridad</div>
                        <div class="product-card__price price-mensual">22.900 COP <span class="rec-tag">/ mes</span>
                        </div>
                        <div class="product-card__price price-anual">229.000 COP <span class="rec-tag">/ año</span>
                        </div>
                    </div>
                    <div class="product-card" data-id="2" data-servicio="Claude" data-plan="Max"
                        data-precio-mensual="109000" data-precio-anual="1090000">
                        <div class="product-card__platform">Claude</div>
                        <div class="product-card__pts">Max</div>
                        <div class="product-card__label">5x más uso · Acceso anticipado</div>
                        <div class="product-card__price price-mensual">109.000 COP <span class="rec-tag">/ mes</span>
                        </div>
                        <div class="product-card__price price-anual">1.090.000 COP <span class="rec-tag">/ año</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHATGPT -->
            <div class="section-block">
                <div class="platform-header">
                    <img src="https://www.google.com/s2/favicons?domain=chatgpt.com&sz=32" alt="ChatGPT"
                        style="width:24px;height:24px;border-radius:4px;">
                    <span>ChatGPT</span>
                </div>
                <div class="products-grid">
                    <div class="product-card" data-id="3" data-servicio="ChatGPT" data-plan="Go"
                        data-precio-mensual="8900" data-precio-anual="89000">
                        <div class="product-card__platform">ChatGPT</div>
                        <div class="product-card__pts">Go</div>
                        <div class="product-card__label">Acceso básico · GPT-4o mini</div>
                        <div class="product-card__price price-mensual">8.900 COP <span class="rec-tag">/ mes</span>
                        </div>
                        <div class="product-card__price price-anual">89.000 COP <span class="rec-tag">/ año</span></div>
                    </div>
                    <div class="product-card popular-card" data-id="4" data-servicio="ChatGPT" data-plan="Plus"
                        data-precio-mensual="22900" data-precio-anual="229000">
                        <div class="badge-popular">★ Popular</div>
                        <div class="product-card__platform">ChatGPT</div>
                        <div class="product-card__pts">Plus</div>
                        <div class="product-card__label">GPT-4o · DALL·E · Plugins</div>
                        <div class="product-card__price price-mensual">22.900 COP <span class="rec-tag">/ mes</span>
                        </div>
                        <div class="product-card__price price-anual">229.000 COP <span class="rec-tag">/ año</span>
                        </div>
                    </div>
                    <div class="product-card" data-id="5" data-servicio="ChatGPT" data-plan="Pro"
                        data-precio-mensual="219000" data-precio-anual="2190000">
                        <div class="product-card__platform">ChatGPT</div>
                        <div class="product-card__pts">Pro</div>
                        <div class="product-card__label">Uso ilimitado · o1 Pro · Acceso total</div>
                        <div class="product-card__price price-mensual">219.000 COP <span class="rec-tag">/ mes</span>
                        </div>
                        <div class="product-card__price price-anual">2.190.000 COP <span class="rec-tag">/ año</span>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel" id="checkoutPanel">
            <div class="checkout-summary">
                <div class="checkout-product-name" id="checkoutName">🤖 Claude — Pro</div>
                <div class="checkout-row">
                    <span class="checkout-label">Periodicidad</span>
                    <span class="checkout-delivery" id="checkoutPeriod">Mensual</span>
                </div>
                <div class="checkout-row">
                    <span class="checkout-label">Duración</span>
                    <span class="checkout-delivery" id="checkoutDuration">12 meses</span>
                </div>
                <div class="checkout-divider"></div>
                <div class="checkout-row checkout-total-row">
                    <span class="checkout-label">Total</span>
                    <div class="checkout-pricing">
                        <span class="checkout-final-price" id="checkoutPrice">22.900 COP</span>
                    </div>
                </div>
                <div class="recurring-info">
                    <i class="bi bi-arrow-repeat"></i>
                    <span id="recurringMsg">Cobro automático mensual durante 12 meses.</span>
                </div>
                <button class="btn-buy" id="btnBuy">
                    <span>Suscribirse ahora</span>
                    <span class="btn-arrow">→</span>
                </button>
                <div class="trust-badges">
                    <div class="trust-item">💰 <span>Garantía de reembolso · P2P</span></div>
                    <div class="trust-item">🔄 <span>Cobro recurrente automático</span></div>
                    <div class="trust-item">📞 <span>Asistencia en directo 24/7</span></div>
                </div>
            </div>

            <div class="delivery-instructions">
                <p class="section-label">Instrucciones</p>
                <div class="instruction-text" id="instructionText">
                    Claude® | Plan Pro 🤖<br>
                    <span>🌐</span> Acceso inmediato tras el primer pago<br>
                    <span>⚠️</span> Renovación automática
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

    <input type="hidden" id="usuarioIdInput" value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>">
    <input type="hidden" id="currentPeriod" value="mensual">

    <script>
        window.__iaProducts = <?= json_encode([
            1 => ['servicio' => 'Claude', 'plan' => 'Pro', 'precioM' => 22900, 'precioA' => 229000],
            2 => ['servicio' => 'Claude', 'plan' => 'Max', 'precioM' => 109000, 'precioA' => 1090000],
            3 => ['servicio' => 'ChatGPT', 'plan' => 'Go', 'precioM' => 8900, 'precioA' => 89000],
            4 => ['servicio' => 'ChatGPT', 'plan' => 'Plus', 'precioM' => 22900, 'precioA' => 229000],
            5 => ['servicio' => 'ChatGPT', 'plan' => 'Pro', 'precioM' => 219000, 'precioA' => 2190000],
        ]) ?>;
    </script>
    <script src="../assets/js/pages/plataformas/ia.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>