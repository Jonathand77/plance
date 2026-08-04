<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premier League — Kits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/textil/pl.css">

<body>
    <?php
    $nav_back_url = "deportivo.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="game-banner">
        <div class="game-banner__tag">
            ⚽ Premier League — Kits Deportivos
            <span class="link-badge">🔗 Link de Pago</span>
        </div>
    </div>

    <main class="shop-layout">
        <section class="products-panel">
            <p class="section-label">Elige tu equipación</p>
            <div class="products-grid">

                <div class="product-card" data-id="1" data-producto="Kit Liverpool FC" data-precio="50000">
                    <img class="product-card__img product-card__img--photo" src="../assets/kits/premier-league/liv.png" alt="Kit Liverpool FC">
                    <div class="product-card__name">Liverpool FC</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="2" data-producto="Kit Manchester City" data-precio="50000">
                    <img class="product-card__img product-card__img--photo" src="../assets/kits/premier-league/mcity.png" alt="Kit Manchester City">
                    <div class="product-card__name">Manchester City</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="3" data-producto="Kit Manchester United" data-precio="50000">
                    <img class="product-card__img product-card__img--photo" src="../assets/kits/premier-league/mufc.png" alt="Kit Manchester United">
                    <div class="product-card__name">Manchester United</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="4" data-producto="Kit Chelsea FC" data-precio="50000">
                    <img class="product-card__img product-card__img--photo" src="../assets/kits/premier-league/chelsea.png" alt="Kit Chelsea FC">
                    <div class="product-card__name">Chelsea FC</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="5" data-producto="Kit Arsenal FC" data-precio="50000">
                    <img class="product-card__img product-card__img--photo" src="../assets/kits/premier-league/arsenal.png" alt="Kit Arsenal FC">
                    <div class="product-card__name">Arsenal FC</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="6" data-producto="Kit West Ham United" data-precio="50000">
                    <div class="product-card__img">🟣</div>
                    <div class="product-card__name">West Ham United</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="7" data-producto="Kit Tottenham Hotspur" data-precio="50000">
                    <img class="product-card__img product-card__img--photo" src="../assets/kits/premier-league/tot.png" alt="Kit Tottenham Hotspur">
                    <div class="product-card__name">Tottenham Hotspur</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

                <div class="product-card" data-id="8" data-producto="Kit Aston Villa" data-precio="50000">
                    <div class="product-card__img">🟣</div>
                    <div class="product-card__name">Aston Villa</div>
                    <div class="product-card__label">Kit completo · Temporada 24/25</div>
                    <div class="product-card__price">50.000 COP</div>
                </div>

            </div>
        </section>

        <!-- CHECKOUT -->
        <aside class="checkout-panel">
            <div class="checkout-box">
                <div class="checkout-product-name" id="checkoutName">⚽ Liverpool FC — Kit completo</div>
                <div class="checkout-price-row">
                    <span style="font-size:0.85rem;color:var(--text-secondary);">Total</span>
                    <span class="checkout-price">50.000 COP</span>
                </div>

                <div class="link-info">
                    <i class="bi bi-link-45deg" style="font-size:1rem;flex-shrink:0;"></i>
                    <span>Se generará un <strong>link de pago</strong> que podrás compartir por correo, WhatsApp o redes
                        sociales. El link expira en 24 horas.</span>
                </div>

                <div class="checkout-divider"></div>
                <span class="section-label-sm">Datos del comprador</span>

                <div class="field-group">
                    <label class="field-label">Correo electrónico</label>
                    <input type="email" class="field-input" id="correoInput"
                        value="<?php echo htmlspecialchars($_SESSION['correo'] ?? ''); ?>"
                        placeholder="correo@ejemplo.com">
                </div>
                <div class="field-group">
                    <label class="field-label">Nombre completo</label>
                    <input type="text" class="field-input" id="nombreInput" placeholder="Nombre y apellido">
                </div>

                <button class="btn-generar" id="btnGenerar">
                    <i class="bi bi-link-45deg"></i> Generar link de pago
                </button>
                <div class="security-note">
                    <i class="bi bi-shield-check"></i>
                    Link de Pago · PlacetoPay · Evertec
                </div>
            </div>
        </aside>
    </main>

    <script src="../assets/js/pages/textil/pl.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>