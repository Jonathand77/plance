<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="en"<?= $data_theme_attr ?? '' ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Fire — Diamantes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/freefire.css">
<body>
    <?php
        $nav_back_url  = "juegos.php";
        $nav_back_text = "Atras";
        $nav_base      = "../";
        require_once '../php/navbar.php';
    ?>

    <!-- ═══ GAME BANNER ═══ -->
    <div class="game-banner">
        <div class="game-banner__tag">
            <img src="https://www.masgamers.com/wp-content/uploads/2022/06/free-fire-nuevo-logo.png" class="card-img-top" alt="" class="game-icon" />
            Free Fire — Diamantes
        </div>
        <div class="banner-player-id">
            <label for="jugadorIdInput">🆔 ID de jugador</label>
            <input type="text" id="jugadorIdInput" placeholder="Ej: 123456789" autocomplete="off" />
        </div>
    </div>

    <!-- ═══ MAIN LAYOUT ═══ -->
    <main class="shop-layout">

        <!-- LEFT: Products Panel -->
        <section class="products-panel">
            <div class="section-block">
                <p class="section-label">Elige el importe</p>
                <div class="products-grid" id="productsGrid">

                    <div class="product-card" data-id="1" data-pts="100" data-price="4500" data-original="" data-discount="">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">100</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price">4.500 COP</div>
                    </div>

                    <div class="product-card popular-card" data-id="2" data-pts="310" data-price="11900" data-original="15000" data-discount="21">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">310</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">15.000 COP</div>
                        <div class="product-card__price">11.900 COP <span class="discount-tag">-21%</span></div>
                    </div>

                    <div class="product-card" data-id="3" data-pts="520" data-price="19800" data-original="26000" data-discount="24">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="💎">
                        <div class="product-card__pts">520</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">26.000 COP</div>
                        <div class="product-card__price">19.800 COP <span class="discount-tag">-24%</span></div>
                    </div>

                    <div class="product-card" data-id="4" data-pts="1060" data-price="38500" data-original="52000" data-discount="26">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="💎">
                        <div class="product-card__pts">1060</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">52.000 COP</div>
                        <div class="product-card__price">38.500 COP <span class="discount-tag">-26%</span></div>
                    </div>

                    <div class="product-card" data-id="5" data-pts="2180" data-price="74000" data-original="98000" data-discount="24">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">2180</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">98.000 COP</div>
                        <div class="product-card__price">74.000 COP <span class="discount-tag">-24%</span></div>
                    </div>

                    <div class="product-card" data-id="6" data-pts="3640" data-price="118000" data-original="155000" data-discount="24">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="💎">
                        <div class="product-card__pts">3640</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">155.000 COP</div>
                        <div class="product-card__price">118.000 COP <span class="discount-tag">-24%</span></div>
                    </div>

                    <div class="product-card" data-id="7" data-pts="5600" data-price="175000" data-original="230000" data-discount="24">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="💎">
                        <div class="product-card__pts">5600</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">230.000 COP</div>
                        <div class="product-card__price">175.000 COP <span class="discount-tag">-24%</span></div>
                    </div>

                    <div class="product-card" data-id="8" data-pts="11000" data-price="320000" data-original="420000" data-discount="24">
                        <img src="https://www.ciberonline.com/recargas/img/diamantes1.webp" style="height: 40px; width: 40px" alt="💎">
                        <div class="product-card__pts">11000</div>
                        <div class="product-card__label">Diamantes</div>
                        <div class="product-card__price-old">420.000 COP</div>
                        <div class="product-card__price">320.000 COP <span class="discount-tag">-24%</span></div>
                    </div>

                    <div class="product-card battlepass-card" data-id="9" data-pts="Pase Elite" data-price="22000" data-original="35000" data-discount="37">
                        <img src="https://sc.filehippo.net/images/t_app-icon-l/p/49509f05-847a-4e51-80dc-701dd861418a/2900070462/pase-elite-free-fire-icon.png" style="height: 40px; width: 40px" alt="🛡️">
                        <div class="product-card__pts" style="font-size:0.85rem;">Pase Elite</div>
                        <div class="product-card__label">Pase de Batalla</div>
                        <div class="product-card__price-old">35.000 COP</div>
                        <div class="product-card__price">22.000 COP <span class="discount-tag">-37%</span></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- RIGHT: Checkout Panel -->
        <aside class="checkout-panel" id="checkoutPanel">

            <div class="checkout-summary">
                <div class="checkout-product-name"><img id="checkoutImg" src="" alt="" /><span id="checkoutName">💎 310 Diamantes</span></div>

                <div class="checkout-row">
                    <span class="checkout-label">Plazo de entrega</span>
                    <span class="checkout-delivery">Instante</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="checkout-row checkout-total-row">
                    <span class="checkout-label">Total</span>
                    <div class="checkout-pricing">
                        <span class="checkout-original" id="checkoutOriginal">15.000 COP</span>
                        <div class="checkout-final-row">
                            <span class="checkout-badge" id="checkoutBadge">-21%</span>
                            <span class="checkout-final-price" id="checkoutPrice">11.900 COP</span>
                        </div>
                    </div>
                </div>

                <button class="btn-buy" id="btnBuy">
                    <span>Comprar ahora</span>
                    <span class="btn-arrow">→</span>
                </button>

                <div class="trust-badges">
                    <div class="trust-item"><i class="bi bi-shield-check fs-6"></i><span>Garantía de reembolso · P2P</span></div>
                    <div class="trust-item"><i class="bi bi-lightning-fill fs-6"></i><span>Pago rápido · Apple Pay / G Pay</span></div>
                    <div class="trust-item"><i class="bi bi-headset fs-6"></i><span>Asistencia en directo 24/7 — ¡A tu lado!</span></div>
                </div>
            </div>

            <div class="delivery-instructions">
                <p class="section-label">Instrucciones de entrega</p>
                <div class="instruction-text" id="instructionText">
                    Garena® | 310 Diamantes 🎮<br>
                    <span class="flag">🌐</span> Region: Global<br>
                    <span class="flag warn">⛔</span> IMPORTANT NOTE BEFORE PURCHASE
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
    <script src="../assets/js/pages/games/freefire.js"></script>

</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
    <script src="assets/js/script.js"></script>
</html>