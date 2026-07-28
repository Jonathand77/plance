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

<style>
    :root {
        /* Nueva paleta estandarizada */
        --color-primary: #FF6C0C;
        --color-secondary-1: #00CFB4;
        --color-secondary-2: #4C5F71;
        --color-secondary-3: #0062A8;
        --color-secondary-4: #1E212C;
        --color-secondary-5: #7D868C;
        --text-main: #f1f5f9;
    }

    body {
        background-color: #0d0e10;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Barlow', sans-serif;
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

    /* ── SPEED DIAL (iconos tipo navegador) ── */
    .speed-dial-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 28px;
        padding: 10px 0 20px;
    }

    .speed-dial-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        cursor: pointer;
        animation: fadeIn 0.6s ease forwards;
        opacity: 0;
    }

    .speed-dial-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .speed-dial-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .speed-dial-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .speed-dial-icon {
        width: 170px;
        height: 100px;
        border-radius: 18px;
        background: rgba(30, 33, 44, 0.85);
        border: 1px solid var(--color-secondary-2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: all 0.22s ease;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(6px);
    }

    .speed-dial-item:hover .speed-dial-icon {
        transform: translateY(-6px) scale(1.08);
        border-color: rgba(255, 108, 12, 0.5);
        box-shadow: 0 8px 28px rgba(255, 108, 12, 0.25);
        background: rgba(255, 108, 12, 0.08);
    }

    .speed-dial-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.75);
        text-align: center;
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.2s;
    }

    .speed-dial-item:hover .speed-dial-label {
        color: var(--color-primary);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

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