<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juegos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Tu CSS -->
    <link rel="stylesheet"
        href="../assets/css/estilos.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/estilos.css'); ?>">
</head>

<style>
    :root {
    }

    body {
        color: white;
        background-color: #0d0e10;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Barlow', sans-serif;
    }

    .card {
        background: linear-gradient(rgba(30, 33, 44, 0.85) 0%, rgba(13, 14, 16, 0.9));
        background-size: cover;
        color: #e4e4e4;
        border: 1px solid var(--color-secondary-2);
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        align-items: center;
        position: relative;
        overflow: visible;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(255, 108, 12, 0.3);
        border-color: var(--color-primary);
    }

    .card-img-top {
        border-radius: 15px 15px 0 0;
        height: 200px;
        width: 100%;
        object-fit: cover;
    }

    main {
        flex: 1;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        color: #ffffff;
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .back:hover {
        background: var(--color-primary);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(255, 108, 12, 0.4);
    }

    /* Etiqueta "Pago Básico" */
    .pagob {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--color-primary);
        color: #0d0e10;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        padding: 0.2rem 1rem;
        border-radius: 20px;
        box-shadow: 0 2px 10px rgba(255, 108, 12, 0.3);
        white-space: nowrap;
        pointer-events: none;
    }

    .servicio1 {
        background: var(--color-secondary-3);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        display: inline-block;
    }

    .servicio2 {
        background: var(--color-primary);
        color: #0d0e10;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        display: inline-block;
    }

    /* Filtro servicio (botones) */
    .servicio-toggle {
        display: inline-flex;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid var(--color-secondary-2);
        background: rgba(0, 0, 0, 0.3);
    }

    .servicio-btn {
        border: 0;
        padding: 0.6rem 1.2rem;
        background: transparent;
        color: var(--text-main);
        font-weight: 700;
        letter-spacing: 0.02em;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
        line-height: 1;
    }

    .servicio-btn+.servicio-btn {
        border-left: 1px solid var(--color-secondary-2);
    }

    .servicio-btn.active {
        background: rgba(255, 108, 12, 0.15);
        color: var(--color-primary);
    }

    .servicio-btn:hover {
        background: rgba(255, 108, 12, 0.08);
        color: var(--color-primary);
    }

    .second-title {
        background: rgba(30, 33, 44, 0.5);
        border-radius: 0 12px 12px 0;
        padding: 0.9rem 1.2rem;
        margin: 10px;
        gap: 0.8rem;
        align-items: center;
        font-size: 1.00rem;
        color: var(--text-main);
        line-height: 1.4;
        border-left: 4px solid var(--color-primary);
    }

    .second-title i {
        color: var(--color-primary);
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .second-title strong {
        color: var(--color-primary);
    }

    .btn-productos {
        background-color: rgba(30, 33, 44, 0.6) !important;
        color: #ffffff !important;
        border: 1px solid var(--color-secondary-2) !important;
        transition: all 0.3s ease !important;
        border-radius: 8px !important;
        padding: 0.4rem 1.2rem !important;
    }

    .btn-productos:hover {
        background-color: var(--color-primary) !important;
        color: #0d0e10 !important;
        border-color: var(--color-primary) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 108, 12, 0.3);
    }

    .card-body {
        padding: 1.2rem;
        width: 100%;
    }

    .card-title {
        color: var(--text-main);
        margin-top: 0.5rem;
    }

    .card-text {
        color: var(--color-secondary-5);
        font-size: 0.9rem;
    }
</style>

<body class="d-flex flex-column min-vh-100">

    <?php
    $nav_back_url = "../sesiones.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="container text-center">
        <div class="second-title">
            <i class="bi bi-controller fs-3"></i>
            <div>
                <strong>Bienvenido a la sesión de juegos móviles</strong>
                <br>
                Elige la tienda en la que vas a hacer tus pagos
            </div>
        </div>

        <section>
            <div class="container mt-5">
                <h1 class="text-center mb-3" style="color: var(--text-main);">Juegos</h1>

                <!-- Botones para filtrar por servicio PlaceToPay -->
                <div class="d-flex justify-content-center mb-4">
                    <div class="servicio-toggle" role="group" aria-label="Filtrar juegos por servicio">
                        <button type="button" class="servicio-btn active" data-filter="web">Web Checkout</button>
                        <button type="button" class="servicio-btn" data-filter="api">API Gateway</button>
                    </div>
                </div>

                <div class="row" style="text-align: center;" id="games-row">

                    <!-- Web Checkout - COD Mobile -->
                    <div class="col-md-4 mb-4" data-servicio="web">
                        <div class="card h-100">
                            <img src="https://media.tycsports.com/files/2021/07/15/307410/cod-mobile-todas-las-novedades-de-la-beta-de-julio-_862x485.jpg"
                                class="card-img-top" alt="Call of Duty Mobile">
                            <div class="pagob">Pago Básico</div>
                            <div class="card-body">
                                <div class="servicio1">Web Checkout</div>
                                <h5 class="card-title">Call of Duty Mobile</h5>
                                <p class="card-text">Compra Cod Points móviles</p>
                                <a href="../games/cod.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Web Checkout - Free Fire -->
                    <div class="col-md-4 mb-4" data-servicio="web">
                        <div class="card h-100">
                            <img src="https://imagenes.hobbyconsolas.com/files/image_1280_720/uploads/imagenes/2023/04/25/690d3b41af1b7.jpeg"
                                class="card-img-top" alt="Free Fire">
                            <div class="pagob">Pago Básico</div>
                            <div class="card-body">
                                <div class="servicio1">Web Checkout</div>
                                <h5 class="card-title">Free Fire</h5>
                                <p class="card-text">Compra diamantes y más</p>
                                <a href="../games/freefire.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Web Checkout - eFootball -->
                    <div class="col-md-4 mb-4" data-servicio="web">
                        <div class="card h-100">
                            <img src="https://www.konami.com/efootball/s/img/main_page_1.png?v=930" class="card-img-top"
                                alt="Efootball">
                            <div class="pagob">Pago Básico</div>
                            <div class="card-body">
                                <div class="servicio1">Web Checkout</div>
                                <h5 class="card-title">eFootball Mobile</h5>
                                <p class="card-text">Compra monedas y más</p>
                                <a href="../games/efootball.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Web Checkout - EA Sports -->
                    <div class="col-md-4 mb-4" data-servicio="web">
                        <div class="card h-100">
                            <img src="https://media.es.wired.com/photos/64dad651532fc59e0e8d53a4/16:9/w_1280,c_limit/EA%20Sports.jpg"
                                class="card-img-top" alt="EA Sports">
                            <div class="pagob">Pago Básico</div>
                            <div class="card-body">
                                <div class="servicio1">Web Checkout</div>
                                <h5 class="card-title">EA FC Sports Mobile</h5>
                                <p class="card-text">Compra puntos y más</p>
                                <a href="../games/easport.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                    <!-- API Gateway - PUBG -->
                    <div class="col-md-4 mb-4" data-servicio="api">
                        <div class="card h-100">
                            <img src="https://img.redbull.com/images/c_limit,w_1500,h_1000/f_auto,q_auto/redbullcom/2018/02/13/c3c16515-d639-45cd-8d7d-5fe26623130b/pubg"
                                class="card-img-top" alt="PUBG">
                            <div class="pagob">Pago Básico</div>
                            <div class="card-body">
                                <div class="servicio2">API Gateway</div>
                                <h5 class="card-title">PUBG Battlegrounds</h5>
                                <p class="card-text">Compra UC y más</p>
                                <a href="../games/pubg.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                    <!-- API Gateway - Blood Strike -->
                    <div class="col-md-4 mb-4" data-servicio="api">
                        <div class="card h-100">
                            <img src="https://cdn.aptoide.com/imgs/6/8/c/68c301631138548dca9af0d780cccff9_fgraphic.png"
                                class="card-img-top" alt="Blood Strike">
                            <div class="pagob">Pago Básico</div>
                            <div class="card-body">
                                <div class="servicio2">API Gateway</div>
                                <h5 class="card-title">Blood Strike</h5>
                                <p class="card-text">Compra Gold y más</p>
                                <a href="../games/bloodstrike.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                    <!-- Web Checkout - Rainbow Six Siege Mobile (Pago Mixto) -->
                    <div class="col-md-4 mb-4" data-servicio="web">
                        <div class="card h-100">
                            <img src="https://cdn.donatov.net/cover/pack-14533-1771960014.webp" class="card-img-top"
                                alt="Rainbow Six Siege Mobile">
                            <div class="pagob">Pago Mixto</div>
                            <div class="card-body">
                                <div class="servicio1">Web Checkout</div>
                                <h5 class="card-title">Rainbow Six Siege Mobile</h5>
                                <p class="card-text">Compra Platinum y pases de batalla</p>
                                <a href="../games/rainbowsix.php" class="btn btn-productos">Productos</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <script>
        (function () {
            const buttons = Array.from(document.querySelectorAll('.servicio-btn'));
            const cards = Array.from(document.querySelectorAll('[data-servicio]'));

            function applyFilter(filter) {
                cards.forEach(card => {
                    const svc = card.getAttribute('data-servicio');
                    card.style.display = (svc === filter) ? '' : 'none';
                });
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    applyFilter(btn.getAttribute('data-filter'));
                });
            });

            // Default: Web Checkout
            applyFilter('web');
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>