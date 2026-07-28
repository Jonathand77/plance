<?php
session_start();


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
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
        href="assets/css/estilos.css?v=<?php echo filemtime(__DIR__ . '/assets/css/estilos.css'); ?>">
</head>

<link rel="stylesheet" href="assets/css/pages/sesiones.css">

<body class="d-flex flex-column min-vh-100">
    <?php
    $nav_back_url = "index.php";
    $nav_back_text = "Atras";
    $nav_base = "./";
    require_once 'php/navbar.php';
    ?>

    <div class="container text-center">
        <h3 class="display-4 fw-bold mb-3" style="color: var(--text-main);">Sesiones</h3>
        <p class="lead mb-4" style="color: var(--color-secondary-5);">Elige la sesión que vas a usar.</p>
    </div>

    <!-- Speed Dial tipo navegador -->
    <div class="speed-dial-grid">

        <a href="games/juegos.php" class="speed-dial-item" title="Juegos Móviles">
            <div class="speed-dial-icon">
                <i class="fa-solid fa-gamepad fs-3" style="color: var(--color-primary);"></i>
            </div>
            <span class="speed-dial-label">Juegos Móviles</span>
        </a>

        <a href="plataformas/suscripciones.php" class="speed-dial-item" title="Plataformas Digitales">
            <div class="speed-dial-icon">
                <i class="bi bi-google-play" style="color: var(--color-primary);"></i>
            </div>
            <span class="speed-dial-label">Plataformas Digitales</span>
        </a>

        <a href="textil/textiles.php" class="speed-dial-item" title="Ropa">
            <div class="speed-dial-icon">
                <i class="fa-solid fa-tshirt fs-3" style="color: var(--color-primary);"></i>
            </div>
            <span class="speed-dial-label">Ropa</span>
        </a>

        <a href="dispersiones/dispersion.php" class="speed-dial-item" title="Tiquetes de Avión">
            <div class="speed-dial-icon">
                <i class="fa-solid fa-plane fs-3" style="color: var(--color-primary);"></i>
            </div>
            <span class="speed-dial-label">Tiquetes de Avión</span>
        </a>

        <a href="reservasiones/reservas.php" class="speed-dial-item" title="Hospedaje">
            <div class="speed-dial-icon">
                <i class="fa-solid fa-hotel fs-3" style="color: var(--color-primary);"></i>
            </div>
            <span class="speed-dial-label">Hospedaje</span>
        </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>