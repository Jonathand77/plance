<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="en"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cod Mobile Productos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/cod.css">

<body>
    <?php
    $nav_back_url = "juegos.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <!-- BANNER -->
    <div class="game-banner">
        <div class="game-banner__tag">
            <img src="https://media.tycsports.com/files/2021/07/15/307410/cod-mobile-todas-las-novedades-de-la-beta-de-julio-_862x485.jpg"
                class="card-img-top" alt="Juego 1" class="game-icon">
            Call of Duty Points
        </div>
        <div class="banner-player-id">
            <label for="jugadorIdInput">🆔 ID de jugador</label>
            <input type="text" id="jugadorIdInput" placeholder="Ej: 0011122224444555" autocomplete="off" />
        </div>
    </div>

    <!-- ── MAIN LAYOUT ── -->
    <main class="shop-layout">

        <!-- IZQ: Productos Panel -->
        <section class="products-panel">

            <!-- Products Grid -->
            <div class="section-block">
                <p class="section-label">Elige el producto</p>
                <div class="products-grid" id="productsGrid">

                    <div class="product-card" data-id="1" data-pts="88" data-price="16614" data-original=""
                        data-discount="">
                        <img src="https://cdn1.codashop.com/S/content/common/images/denom-image/CODM/30_CODM_CP_new.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">88</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price">7.000 COP</div>
                    </div>

                    <div class="product-card popular-card" data-id="2" data-pts="500" data-price="12927"
                        data-original="18972" data-discount="32">
                        <div class="badge-popular">★ Popular</div>
                        <img src="https://kaleoz-media.seagmcdn.com/kaleoz-store/202111/oss-116f913788ed63121abd36d198aee702.png?x-oss-process=image/format,webp"
                            style="height: 25px; width: 40px" alt="">
                        <div class="product-card__pts">460</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">18.972 COP</div>
                        <div class="product-card__price">12.927 COP <span class="discount-tag">-32%</span></div>
                    </div>

                    <div class="product-card" data-id="3" data-pts="1100" data-price="26233" data-original="37981"
                        data-discount="31">
                        <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">1100</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">9.000 COP</div>
                        <div class="product-card__price">26.233 COP <span class="discount-tag">-31%</span></div>
                    </div>

                    <div class="product-card" data-id="4" data-pts="2400" data-price="29921" data-original="74000"
                        data-discount="61">
                        <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">2400</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">74.000 COP</div>
                        <div class="product-card__price">29.921 COP <span class="discount-tag">-61%</span></div>
                    </div>

                    <div class="product-card" data-id="5" data-pts="5000" data-price="56611" data-original="152039"
                        data-discount="62">
                        <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">5000</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">152.039 COP</div>
                        <div class="product-card__price">56.611 COP <span class="discount-tag">-62%</span></div>
                    </div>

                    <div class="product-card" data-id="6" data-pts="9500" data-price="94858" data-original="285406"
                        data-discount="67">
                        <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">9500</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">285.406 COP</div>
                        <div class="product-card__price">94.858 COP <span class="discount-tag">-67%</span></div>
                    </div>

                    <div class="product-card" data-id="7" data-pts="13000" data-price="142762" data-original="380154"
                        data-discount="63">
                        <img src="https://static.wikia.nocookie.net/callofduty/images/4/4e/COD_Points_stack_5000_BO3.png/revision/latest?cb=20151218135441"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">13000</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">380.154 COP</div>
                        <div class="product-card__price">142.762 COP <span class="discount-tag">-63%</span></div>
                    </div>

                    <div class="product-card" data-id="8" data-pts="21000" data-price="216215" data-original="579249"
                        data-discount="63">
                        <img src="https://pbs.twimg.com/media/EaREXFjXgAE-Of7.png" style="height: 40px; width: 40px"
                            alt="">
                        <div class="product-card__pts">21000</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">579.249 COP</div>
                        <div class="product-card__price">216.215 COP <span class="discount-tag">-63%</span></div>
                    </div>

                    <div class="product-card" data-id="9" data-pts="26000" data-price="262066" data-original="760307"
                        data-discount="66">
                        <img src="https://pbs.twimg.com/media/EaREXFjXgAE-Of7.png" style="height: 40px; width: 40px"
                            alt="">
                        <div class="product-card__pts">26000</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">760.307 COP</div>
                        <div class="product-card__price">262.066 COP <span class="discount-tag">-66%</span></div>
                    </div>

                    <div class="product-card" data-id="10" data-pts="39000" data-price="387339" data-original="1140461"
                        data-discount="67">
                        <img src="https://pbs.twimg.com/media/EaREXFjXgAE-Of7.png" style="height: 40px; width: 40px"
                            alt="">
                        <div class="product-card__pts">39000</div>
                        <div class="product-card__label">Puntos</div>
                        <div class="product-card__price-old">1.140.461 COP</div>
                        <div class="product-card__price">387.339 COP <span class="discount-tag">-67%</span></div>
                    </div>

                    <div class="product-card battlepass-card" data-id="11" data-pts="Battle Pass" data-price="106187"
                        data-original="114019" data-discount="7">
                        <img src="https://images.kinguin.net/g/carousel-main-mobile/media/images/products/_battlepassg.png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts" style="font-size:0.85rem;">Battle Pass</div>
                        <div class="product-card__label">Battle Pass</div>
                        <div class="product-card__price-old">38.000 COP</div>
                        <div class="product-card__price">24.000 COP <span class="discount-tag">-37%</span></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Derecha: Checkout Panel -->
        <aside class="checkout-panel" id="checkoutPanel">

            <div class="checkout-summary">
                <div class="checkout-product-name">
                    <img id="checkoutImg" src="" alt="" />
                    <span id="checkoutName"></span>
                </div>
                <div class="checkout-row">
                    <span class="checkout-label">Plazo de entrega</span>
                    <span class="checkout-delivery">Instante</span>
                </div>

                <div class="checkout-divider"></div>

                <div class="checkout-row checkout-total-row">
                    <span class="checkout-label">Total</span>
                    <div class="checkout-pricing">
                        <span class="checkout-original" id="checkoutOriginal">18.972 COP</span>
                        <div class="checkout-final-row">
                            <span class="checkout-badge" id="checkoutBadge">-32%</span>
                            <span class="checkout-final-price" id="checkoutPrice">12.927 COP</span>
                        </div>
                    </div>
                </div>

                <button class="btn-buy" id="btnBuy">
                    <span>Comprar ahora</span>
                    <span class="btn-arrow">→</span>
                </button>

                <div class="trust-badges">
                    <div class="trust-item"><i class="bi bi-shield-check fs-6"></i><span>Garantía de reembolso ·
                            P2P</span></div>
                    <div class="trust-item"><i class="bi bi-lightning-fill fs-6"></i><span>Pago rápido · Apple Pay / G
                            Pay</span></div>
                    <div class="trust-item"><i class="bi bi-headset fs-6"></i><span>Asistencia en directo 24/7 — ¡A tu
                            lado!</span></div>
                </div>
            </div>

            <div class="delivery-instructions">
                <p class="section-label">Instrucciones de entrega</p>
                <div class="instruction-text" id="instructionText">
                    Activision® | 500 Points (Xbox Digital Key) 🎮<br>
                    <span class="flag">🌐</span> Region: Global<br>
                    <span class="flag warn">⚠</span> IMPORTANT NOTE BEFORE PURCHASE
                </div>
                <button class="btn-instructions">Ver todas las instrucciones ▾</button>
            </div>

            <div class="vendor-box">
                <p class="section-label">Designer</p>
                <div class="vendor-info">
                    <div class="vendor-avatar">JM</div>
                    <div>
                        <div class="vendor-name">Jair ✔</div>
                        <div class="vendor-rating">👍 2026 · <a href="#">Evertec Placetopay SAS</a></div>
                    </div>
                </div>
            </div>

        </aside>
    </main>

    <!-- JS -->
    <script src="../assets/js/pages/games/cod.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>