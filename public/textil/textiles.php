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
<link rel="stylesheet" href="../assets/css/pages/textil/textiles.css">

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