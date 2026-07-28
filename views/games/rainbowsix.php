<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rainbow Six Siege Mobile — Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/games/rainbowsix.css">

<body>
    <?php
    $nav_back_url = "juegos.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            🎯 Rainbow Six Siege Mobile — Tienda
            <span class="wc-badge">🖥️ Web Checkout</span>
            <span class="mixto-badge">🔀 Pago Mixto</span>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">

            <!-- PLATINUM -->
            <p class="section-label">💎 Platinum — Moneda del juego</p>
            <div class="products-grid">
                <div class="product-card" data-id="p1" data-nombre="60 Platinum" data-precio="4900">
                    <img class="product-card__icon" src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp"
                        alt="">
                    <div class="product-card__info">
                        <div class="product-card__pts">60 Platinum</div>
                        <div class="product-card__label">Rainbow Six Siege Mobile</div>
                        <div class="product-card__price">4.900 COP</div>
                    </div>
                </div>
                <div class="product-card" data-id="p2" data-nombre="120 Platinum" data-precio="9900">
                    <img class="product-card__icon" src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp"
                        alt="">
                    <div class="product-card__info">
                        <div class="product-card__pts">120 Platinum</div>
                        <div class="product-card__label">Rainbow Six Siege Mobile</div>
                        <div class="product-card__price">9.900 COP</div>
                    </div>
                </div>
                <div class="product-card popular-card" data-id="p3" data-nombre="300 Platinum" data-precio="24900">
                    <div class="badge-popular">★ Popular</div>
                    <img class="product-card__icon" src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp"
                        alt="">
                    <div class="product-card__info">
                        <div class="product-card__pts">300 Platinum</div>
                        <div class="product-card__label">Rainbow Six Siege Mobile</div>
                        <div class="product-card__price">24.900 COP</div>
                    </div>
                </div>
                <div class="product-card" data-id="p4" data-nombre="600 Platinum" data-precio="49900">
                    <img class="product-card__icon" src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp"
                        alt="">
                    <div class="product-card__info">
                        <div class="product-card__pts">600 Platinum</div>
                        <div class="product-card__label">Rainbow Six Siege Mobile</div>
                        <div class="product-card__price">49.900 COP</div>
                    </div>
                </div>

                <div class="product-card popular-card" data-id="p5" data-nombre="1200 Platinum" data-precio="99900">
                    <div class="badge-popular">Mejor valor</div>
                    <img class="product-card__icon" src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp"
                        alt="">
                    <div class="product-card__info">
                        <div class="product-card__pts">1200 Platinum</div>
                        <div class="product-card__label">Rainbow Six Siege Mobile</div>
                        <div class="product-card__price">99.900 COP</div>
                    </div>
                </div>
                <div class="product-card" data-id="p6" data-nombre="2400 Platinum" data-precio="189900">
                    <img class="product-card__icon" src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp"
                        alt="">
                    <div class="product-card__info">
                        <div class="product-card__pts">2400 Platinum</div>
                        <div class="product-card__label">Rainbow Six Siege Mobile</div>
                        <div class="product-card__price">189.900 COP</div>
                    </div>
                </div>
            </div>

            <!-- PASES -->
            <p class="section-label">🎖️ Pases de batalla</p>
            <div class="pases-grid">
                <div class="pase-card" data-id="b1" data-nombre="Pase Premium Fantasma Gris" data-precio="39900">
                    <span class="pase-tag">PASE DE BATALLA</span>
                    <div class="pase-head">
                        <img class="pase-icon"
                            src="https://cdn1.codashop.com/images/7930_ce805d3c-62c8-4fd5-9c2c-80f230892257_79233c04adf11386399b9827c345a658_image/0eb60010fc1c69b1b9ef65d53829b521.webp"
                            alt="">
                        <div class="pase-name">Pase Premium<br>Fantasma Gris</div>
                    </div>
                    <div class="pase-desc">Acceso al pase de temporada con recompensas exclusivas del operador Fantasma
                        Gris.</div>
                    <div class="pase-price">39.900 COP</div>
                </div>
                <div class="pase-card" data-id="b2" data-nombre="Pase Elite Fantasma Gris" data-precio="79900">
                    <span class="pase-tag">PASE ELITE</span>
                    <div class="pase-head">
                        <img class="pase-icon"
                            src="https://cdn1.codashop.com/images/7930_ce805d3c-62c8-4fd5-9c2c-80f230892257_79233c04adf11386399b9827c345a658_image/d7406d15935e21ab8ecb5ad05ee788d2.webp"
                            alt="">
                        <div class="pase-name">Pase Elite<br>Fantasma Gris</div>
                    </div>
                    <div class="pase-desc">Incluye todo el Pase Premium más contenido exclusivo elite y recompensas
                        adicionales.</div>
                    <div class="pase-price">79.900 COP</div>
                </div>
            </div>

        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">

                <!-- Multi-producto checkbox -->
                <label class="check-wrap multi" style="margin-bottom:0.8rem;">
                    <input type="checkbox" id="multiCheck" onchange="toggleMulti()">
                    <span class="check-label">
                        <strong>🛒 Selección múltiple</strong>
                        Agrega varios productos al carrito y págalos juntos.
                    </span>
                </label>

                <!-- Carrito / resumen -->
                <span class="section-label-sm">Resumen</span>
                <div class="cart-items" id="cartItems">
                    <div class="cart-empty" id="cartEmpty">Selecciona un producto para comenzar</div>
                </div>
                <div class="total-row">
                    <span class="total-label">Total</span>
                    <span class="total-price" id="totalPrice">$0 COP</span>
                </div>

                <!-- Pago parcial checkbox -->
                <label class="check-wrap parcial">
                    <input type="checkbox" id="parcialCheck" onchange="toggleParcial()">
                    <span class="check-label">
                        <strong>🔀 Pago parcial (Mixto)</strong>
                        Paga solo una parte ahora y el resto después.
                    </span>
                </label>

                <!-- Panel pago parcial -->
                <div class="parcial-panel" id="parcialPanel">
                    <div class="parcial-amounts">
                        <span>Mínimo: <strong id="minAmount">0</strong></span>
                        <span>Total: <strong id="maxAmount">0</strong></span>
                    </div>
                    <input type="range" class="parcial-slider" id="parcialSlider" min="0" max="100" value="50"
                        oninput="updateSlider()">
                    <div class="parcial-now" id="parcialNow">$0 COP</div>
                    <div class="parcial-rest" id="parcialRest">Restante: $0 COP</div>
                </div>

                <div style="height:0.8rem;"></div>
                <span class="section-label-sm">Datos del jugador</span>
                <div class="field-group">
                    <label class="field-label">ID de jugador</label>
                    <input type="text" class="field-input" id="jugadorId" placeholder="Ej: R6M-123456">
                </div>

                <button class="btn-pagar" id="btnPagar" onclick="pagar()">
                    <i class="bi bi-lock-fill"></i> Pagar ahora
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Web Checkout · PlacetoPay · Evertec
                </div>
            </div>
        </aside>
    </main>

    <script src="../assets/js/pages/games/rainbowsix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>