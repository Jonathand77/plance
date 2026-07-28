<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataformas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Tu CSS -->
    <link rel="stylesheet"
        href="../assets/css/estilos.css?v=<?php echo filemtime($__publicDir . '/../assets/css/estilos.css'); ?>">
</head>

<link rel="stylesheet" href="../assets/css/pages/plataformas/suscripciones.css">

<body class="d-flex flex-column min-vh-100">

    <?php
    $nav_back_url = "../sesiones.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="container text-center">
        <div class="second-title">
            <i class="bi bi-google-play fs-3"></i>
            <div>
                <strong>Bienvenido a la sesión de plataformas</strong>
                <br>
                Elige la tienda en la que vas a hacer tus pagos
            </div>
        </div>
    </div>

    <section>
        <div class="container mt-5">
            <h1 class="text-center mb-3" style="color: var(--text-main);">Plataformas</h1>

            <!-- Botones para filtrar por servicio PlaceToPay -->
            <div class="d-flex justify-content-center mb-4">
                <div class="servicio-toggle" role="group" aria-label="Filtrar juegos por servicio">
                    <button type="button" class="servicio-btn active" data-filter="web">Web Checkout</button>
                    <button type="button" class="servicio-btn" data-filter="api">API Gateway</button>
                </div>
            </div>

            <div class="row" style="text-align: center" id="suscripciones-row">

                <!-- WEB CHECKOUT -->
                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://www.dongee.com/tutoriales/content/images/2024/04/image-6.png"
                                class="card-img-top" alt="streaming">
                        </div>
                        <div class="suscrip">Pago + Suscripción</div>
                        <div class="card-body">
                            <div class="servicio1">Web Checkout</div>
                            <h5 class="card-title">Streamings</h5>
                            <p class="card-text">Adquiere planes</p>
                            <a href="streaming.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://imagenes.20minutos.es/files/image_1280_720/files/fp/uploads/imagenes/2024/06/26/redes-sociales.r_d.566-624-11532.jpeg"
                                class="card-img-top" alt="redes">
                        </div>
                        <div class="suscrip">Recurrencia</div>
                        <div class="card-body">
                            <div class="servicio1">Web Checkout</div>
                            <h5 class="card-title">Redes Sociales</h5>
                            <p class="card-text">Adquiere Membresías y verificados</p>
                            <a href="redes.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://www.clarin.com/2025/06/02/r8YhhzdFc_0x750__1.jpg" class="card-img-top"
                                alt="ia">
                        </div>
                        <div class="suscrip">Suscripción + Recurrencia</div>
                        <div class="card-body">
                            <div class="servicio1">Web Checkout</div>
                            <h5 class="card-title">IA's</h5>
                            <p class="card-text">Mejora tus planes</p>
                            <a href="ia.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://imagenes.20minutos.es/files/image_1920_1080/uploads/imagenes/2022/11/23/comparacion-de-precios-de-netflix-hbo-max-prime-video-y-otras-plataformas-para-ver-series-y-peliculas.jpeg"
                                class="card-img-top" alt="otras streaming">
                        </div>
                        <div class="suscrip">Suscripción</div>
                        <div class="card-body">
                            <div class="servicio1">Web Checkout</div>
                            <h5 class="card-title">Otros Streamings</h5>
                            <p class="card-text">Adquiere planes</p>
                            <a href="otras_streaming.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <!-- API GATEWAY -->
                <div class="col-md-4 mb-4" data-servicio="api">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://elfrente.com.co/content/images/2024/01/stream-1.jpg" class="card-img-top"
                                alt="streamings gateway">
                        </div>
                        <div class="suscrip">Pago + Suscripción</div>
                        <div class="card-body">
                            <div class="servicio2">API Gateway</div>
                            <h5 class="card-title">Streamings</h5>
                            <p class="card-text">Adquiere planes</p>
                            <a href="../plataformas/streaming_gateway.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="api">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://i.blogs.es/e018be/portada/1366_2000.webp" class="card-img-top"
                                alt="musica">
                        </div>
                        <div class="suscrip">Suscripción</div>
                        <div class="card-body">
                            <div class="servicio2">API Gateway</div>
                            <h5 class="card-title">Música</h5>
                            <p class="card-text">Mejora tus planes de música</p>
                            <a href="../plataformas/music_gateway.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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