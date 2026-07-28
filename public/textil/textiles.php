<?php
session_start();


require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

// Contar registros del usuario actual
$correo_sesion = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

$total_ordenes = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM ordenes"))['total'];
$total_subs = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM suscripciones WHERE usuario_id = '$correo_sesion'"))['total'];
$total_recs = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM recurrencias WHERE usuario_id = '$correo_sesion'"))['total'];

$total_pagos = $total_ordenes + $total_subs + $total_recs;
$total_pagos = number_format($total_pagos, 0, ',', '.');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Textiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<style>
    :root {
    }

    body {
        background-color: #0d0e10;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        min-height: 100vh;
        font-family: 'Barlow', sans-serif;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .panel-container {
        max-width: 700px;
        margin: 3rem auto;
        padding: 0 1rem;
    }

    .panel-titulo {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0.4rem;
        color: var(--text-main);
    }

    .panel-subtitulo {
        font-size: 0.9rem;
        color: var(--color-secondary-5);
        margin-bottom: 2rem;
    }

    .historial-card {
        background: rgba(30, 33, 44, 0.85);
        border: 1px solid var(--color-secondary-2);
        border-radius: 14px;
        padding: 1.5rem 1.8rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(8px);
    }

    .historial-card:hover {
        border-color: var(--card-color, var(--color-primary));
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        text-decoration: none;
        background: rgba(30, 33, 44, 0.95);
    }

    .card-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        background: var(--card-bg, rgba(255, 108, 12, 0.12));
        flex-shrink: 0;
    }

    .card-icon2 {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        background-color: var(--color-primary);
        flex-shrink: 0;
    }

    .card-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 0.1rem;
    }

    .card-desc {
        font-size: 0.8rem;
        color: var(--color-secondary-5);
    }

    .card-badge {
        background: var(--card-bg, rgba(255, 108, 12, 0.12));
        color: var(--card-color, var(--color-primary));
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .card-arrow {
        color: var(--color-secondary-5);
        font-size: 1.1rem;
        margin-left: 0.5rem;
        transition: transform 0.3s ease;
    }

    .historial-card:hover .card-arrow {
        transform: translateX(4px);
    }

    .second-title {
        background: rgba(30, 33, 44, 0.5);
        border-radius: 0 12px 12px 0;
        padding: 0.9rem 1.2rem;
        margin: 10px;
        gap: 0.8rem;
        font-size: 1.00rem;
        color: var(--text-main);
        line-height: 1.4;
        border-left: 4px solid var(--color-secondary-3);
    }

    .second-title i {
        color: var(--color-secondary-3);
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .second-title strong {
        color: var(--color-secondary-3);
    }

    .historial-divider {
        height: 1px;
        background: var(--color-secondary-2);
        margin: 0.8rem 0;
    }

    @media (max-width: 600px) {
        .panel-container {
            margin: 1.5rem auto;
            padding: 0 0.8rem;
        }

        .historial-card {
            padding: 1rem 1.2rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .card-left {
            gap: 0.7rem;
        }

        .card-icon,
        .card-icon2 {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }

        .card-name {
            font-size: 0.9rem;
        }

        .card-desc {
            font-size: 0.7rem;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "../sesiones.php";
    $nav_back_text = "Atrás";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="container text-center">
        <div class="second-title">
            <i class="fa-solid fa-tshirt fs-3"></i>
            <div>
                <strong>Bienvenido a la sesión de textiles</strong>
                <br>
                Elige la tienda en la que vas a hacer tus pagos
            </div>
        </div>

        <div class="panel-container text-start">
            <!-- Enlaces -->
            <a href="deportivo.php" class="historial-card"
                style="--card-color: var(--color-primary); --card-bg: rgba(255,108,12,0.12);">
                <div class="card-left">
                    <div class="card-icon">
                        <i class="fa-regular fa-futbol fs-3" style="color: var(--color-primary);"></i>
                    </div>
                    <div>
                        <div class="card-name">Deportivos</div>
                        <div class="card-desc">Compra las equipaciones de tus equipos favoritos</div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <span class="card-badge">API Link</span>
                    <i class="bi bi-chevron-right card-arrow"></i>
                </div>
            </a>

            <div class="historial-divider"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>