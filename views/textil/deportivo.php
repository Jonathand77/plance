<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kits Deportivos</title>
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

<link rel="stylesheet" href="../assets/css/pages/textil/deportivo.css">

<body class="d-flex flex-column min-vh-100">

    <?php
    $nav_back_url = "textiles.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <section>
        <div class="container mt-5">
            <h1 class="text-center mb-3" style="color: var(--text-main);">Kits Deportivos</h1>

            <!-- Botones para filtrar por servicio PlaceToPay -->
            <div class="d-flex justify-content-center mb-4">
                <div class="servicio-toggle" role="group" aria-label="Filtrar ropa por servicio">
                    <button type="button" class="servicio-btn active" data-filter="web">API Link de pagos</button>
                    <button type="button" class="servicio-btn" data-filter="api">N/A</button>
                </div>
            </div>

            <div class="row" style="text-align: center;" id="games-row">

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://kickbol.com/wp-content/uploads/2023/08/English-Premier-League-1.png"
                                class="card-img-top" alt="Premier League">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">Premier League</h5>
                            <p class="card-text">Compra Equipaciones de tus equipos ingleses favoritos</p>
                            <a href="../textil/pl.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://logowik.com/content/uploads/images/laliga-santander5892.logowik.com.webp"
                                class="card-img-top" alt="La Liga">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">La Liga</h5>
                            <p class="card-text">Compra Equipaciones de tus equipos españoles favoritos</p>
                            <a href="../textil/laliga.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://logowik.com/content/uploads/blog/bundesliga-football-clubs-and-logos3600.logowik.com.webp"
                                class="card-img-top" alt="Bundesliga">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">Bundesliga</h5>
                            <p class="card-text">Compra equipaciones de tus equipos alemanes favoritos</p>
                            <a href="../textil/bundesliga.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://1000logos.net/wp-content/uploads/2019/01/Italian-Serie-A-Logo.png"
                                class="card-img-top" alt="Serie A">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">Serie A</h5>
                            <p class="card-text">Compra equipaciones de tus equipos italianos favoritos</p>
                            <a href="../textil/seriea.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="../assets/js/pages/textil/deportivo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>