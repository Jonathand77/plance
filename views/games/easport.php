<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA FC Productos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Tu CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/easport.css">

<body>
    <?php
    $nav_back_url = "juegos.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <!-- ════════════════════════════════════════
         GAME BANNER
         ════════════════════════════════════════ -->
    <div class="game-banner">
        <div class="game-banner__tag">
            <img src="https://media.es.wired.com/photos/64dad651532fc59e0e8d53a4/16:9/w_1280,c_limit/EA%20Sports.jpg"
                class="card-img-top" alt="" class="game-icon">
            EA Sports FC Points
        </div>
        <div class="banner-player-id">
            <label for="jugadorIdInput">🆔 ID de jugador</label>
            <input type="text" id="jugadorIdInput" placeholder="Ej: 0011122224444555" autocomplete="off" />
        </div>
    </div>

    <!-- ════════════════════════════════════════
         MAIN LAYOUT
         ════════════════════════════════════════ -->
    <main class="shop-layout">

        <!-- LEFT: Products Panel -->
        <section class="products-panel">

            <!-- Products Grid -->
            <div class="section-block">
                <p class="section-label">Elige el importe</p>
                <div class="products-grid" id="productsGrid">

                    <div class="product-card" data-id="1" data-pts="200" data-price="6500" data-original=""
                        data-discount="">
                        <img src="https://pbs.twimg.com/media/F07sn5UWYBQZ4jB.png" class="moneda1"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">100</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price">6.500 COP</div>
                    </div>

                    <div class="product-card popular-card" data-id="2" data-pts="500" data-price="14000"
                        data-original="18000" data-discount="32">
                        <div class="badge-popular">⭐ Popular</div>
                        <img src="https://cdn1.codashop.com/images/826_219b1202-df20-4fe8-bfcb-d2689d381d31_EA%20SPORTS%20FC%20Mobile_category/1705583704508_40-FC-Points%20(1).png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">500</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price-old">18.000 COP</div>
                        <div class="product-card__price">14.000 COP <span class="discount-tag">-32%</span></div>
                    </div>

                    <div class="product-card" data-id="3" data-pts="1100" data-price="25500" data-original="31000"
                        data-discount="31">
                        <img src="https://cdn1.codashop.com/images/826_219b1202-df20-4fe8-bfcb-d2689d381d31_EA%20SPORTS%20FC%20Mobile_category/1705583704508_40-FC-Points%20(1).png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">1100</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price-old">31.000 COP</div>
                        <div class="product-card__price">25.500 COP <span class="discount-tag">-31%</span></div>
                    </div>

                    <div class="product-card" data-id="4" data-pts="2200" data-price="36000" data-original="44000"
                        data-discount="61">
                        <img src="https://cdn1.codashop.com/images/826_219b1202-df20-4fe8-bfcb-d2689d381d31_EA%20SPORTS%20FC%20Mobile_category/1705583704508_40-FC-Points%20(1).png"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">2200</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price-old">44.000 COP</div>
                        <div class="product-card__price">36.000 COP <span class="discount-tag">-61%</span></div>
                    </div>

                    <div class="product-card" data-id="5" data-pts="5000" data-price="42500" data-original="56900"
                        data-discount="62">
                        <img src="https://cdn1.codashop.com/images/1811_219b1202-df20-4fe8-bfcb-d2689d381d31_224713e22083a9e37572a9991d934d42_image/579606ef8775b5142968d05c21578c4c.webp"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">5000</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price-old">56.900 COP</div>
                        <div class="product-card__price">42.500 COP <span class="discount-tag">-62%</span></div>
                    </div>

                    <div class="product-card" data-id="6" data-pts="9500" data-price="72000" data-original="85400"
                        data-discount="67">
                        <img src="https://cdn1.codashop.com/images/1811_219b1202-df20-4fe8-bfcb-d2689d381d31_224713e22083a9e37572a9991d934d42_image/579606ef8775b5142968d05c21578c4c.webp"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">9500</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price-old">85.400 COP</div>
                        <div class="product-card__price">72.000 COP <span class="discount-tag">-67%</span></div>
                    </div>

                    <div class="product-card" data-id="7" data-pts="12500" data-price="90000" data-original="120500"
                        data-discount="63">
                        <img src="https://cdn1.codashop.com/images/1811_219b1202-df20-4fe8-bfcb-d2689d381d31_224713e22083a9e37572a9991d934d42_image/579606ef8775b5142968d05c21578c4c.webp"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts">12500</div>
                        <div class="product-card__label">Puntos FC</div>
                        <div class="product-card__price-old">120.500 COP</div>
                        <div class="product-card__price">90.000 COP <span class="discount-tag">-63%</span></div>
                    </div>

                    <div class="product-card battlepass-card" data-id="8" data-pts="Star Pass" data-price="18.500"
                        data-original="29.000" data-discount="7">
                        <img src="https://cdn1.codashop.com/images/1811_219b1202-df20-4fe8-bfcb-d2689d381d31_224713e22083a9e37572a9991d934d42_category/1765872198506_c3dfa8dd-cd10-4179-aaae-6aed47aa2962.webp"
                            style="height: 40px; width: 40px" alt="">
                        <div class="product-card__pts" style="font-size:0.85rem;">Star Pass</div>
                        <div class="product-card__label">Pass</div>
                        <div class="product-card__price-old">29.000 COP</div>
                        <div class="product-card__price">18.500 COP <span class="discount-tag">-37%</span></div>
                    </div>

                </div>
            </div>
        </section>

        <!-- RIGHT: Checkout Panel -->
        <aside class="checkout-panel" id="checkoutPanel">

            <div class="checkout-summary">
                <div class="checkout-product-name">
                    <img id="checkoutImg"
                        src="https://cdn1.codashop.com/images/826_219b1202-df20-4fe8-bfcb-d2689d381d31_EA%20SPORTS%20FC%20Mobile_category/1705583704508_40-FC-Points%20(1).png"
                        class="checkout-coin-img" alt="" />
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
                        <span class="checkout-original" id="checkoutOriginal">18.000 COP</span>
                        <div class="checkout-final-row">
                            <span class="checkout-badge" id="checkoutBadge">-32%</span>
                            <span class="checkout-final-price" id="checkoutPrice">14.000 COP</span>
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
                    EA SPORTS® | 500 Points (Xbox Digital Key) 🎮<br>
                    <span class="flag">🌐</span> Region: Global<br>
                    <span class="flag warn">⚠️</span> IMPORTANT NOTE BEFORE PURCHASE
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
    <script src="../assets/js/pages/games/easport.js"></script>
</body>
</html>