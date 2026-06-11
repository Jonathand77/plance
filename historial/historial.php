<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', '', 'place_bsd');
    if (!$conexion) die("Error de conexión: " . mysqli_connect_error());
}

// Contar registros del usuario actual
$correo_sesion = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

$total_ordenes = mysqli_fetch_assoc (mysqli_query($conexion, "SELECT COUNT(*) as total FROM ordenes"))['total'];
$total_subs    = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM suscripciones WHERE usuario_id = '$correo_sesion'"))['total'];
$total_recs    = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM recurrencias WHERE usuario_id = '$correo_sesion'"))['total'];

$total_links   = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM payment_link"))['total'];

$total_pagos = $total_ordenes + $total_subs + $total_recs; 
$total_pagos= number_format($total_pagos, 0, ',', '.');



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historiales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<style>
    body {
        /* background-image: url(../assets/images/bg26.jpg); */
        background-color: #000000;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        min-height: 100vh;
        font-family: 'Barlow', sans-serif;
    }
    .navbar {
        background-color: #0f0f0fa9 !important;
        backdrop-filter: blur(8px);
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
        color: #f0f1f3;
    }
    .panel-subtitulo {
        font-size: 0.9rem;
        color: #8a8d96;
        margin-bottom: 2rem;
    }
    .historial-card {
        background: rgba(15,15,15,0.85);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 14px;
        padding: 1.5rem 1.8rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-decoration: none;
        transition: all 0.2s ease;
        backdrop-filter: blur(8px);
    }
    .historial-card:hover {
        border-color: var(--card-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 24px rgba(0,0,0,0.4);
        text-decoration: none;
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
        background: var(--card-bg);
    }
    .card-icon2 {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        background-color: #f0b429;
    }
    .card-name {
        font-size: 1rem;
        font-weight: 700;
        color: #f0f1f3;
        margin-bottom: 0.1rem;
    }
    .card-desc {
        font-size: 0.8rem;
        color: #8a8d96;
    }
    .card-badge {
        background: var(--card-bg);
        color: var(--card-color);
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 700;
    }
    .card-arrow {
        color: #8a8d96;
        font-size: 1.1rem;
        margin-left: 0.5rem;
    }

     .historial-divider { height: 1px; background: var(--border); margin: 0.8rem 0; }
</style>
<body>
    <?php
        $nav_back_url  = "../home.php";
        $nav_back_text = "Atrás";
        $nav_base      = "../";
        require_once '../php/navbar.php';
    ?>

    <div class="panel-container">
        <div class="panel-titulo"><i class="bi bi-file-text-fill"></i> Mis Historiales</div>
        <div class="panel-subtitulo">Consulta el registro de tus pagos y suscripciones</div>
        <!-- Pagos Básicos -->
        <a href="reg-pgb.php" class="historial-card" style="--card-color: #f0b429; --card-bg: rgba(240,180,41,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-money-bill-1-wave fs-3l" style="color: #f0b429;"></i>
                </div>
                <div>
                    <div class="card-name">Pagos Básicos</div>
                    <div class="card-desc">Recargas de juegos — COD, Free Fire, EA FC, eFootball</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_ordenes ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

        <!-- Suscripciones -->
        <a href="reg-sus.php" class="historial-card" style="--card-color: #a855f7; --card-bg: rgba(168,85,247,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-credit-card" style="color: rgb(111, 0, 255);"></i>
                </div>
                <div>
                    <div class="card-name">Suscripciones</div>
                    <div class="card-desc">Streaming — Netflix, HBO Max, Disney+</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_subs ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

        <!-- Membresías Recurrentes -->
        <a href="reg-rec.php" class="historial-card" style="--card-color: #4d9fff; --card-bg: rgba(77,159,255,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="bi bi-calendar-check-fill" style="color: #4d9fff;"></i>
                </div>
                <div>
                    <div class="card-name">Recurrentes</div>
                    <div class="card-desc">Renovaciones automáticas de servicios</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_recs ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

        <!-- Links de Pago -->
        <a href="reg-link.php" class="historial-card" style="--card-color: #f71cff; --card-bg: rgba(215, 59, 246, 0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-link" style="color: rgb(165, 0, 124);"></i>
                </div>
                <div>
                    <div class="card-name">Links de Pago</div>
                    <div class="card-desc">API Link de pagos — links compartibles PlacetoPay</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_links ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

        <div class="historial-divider"></div>

        <div class="panel-titulo"><i class="fa-solid fa-money-bill-transfer"></i> Reversos</div>
        <div class="panel-subtitulo">Consulta tus pagos aprobados y solicita su reverso</div>

        <!--- Reversos -->
        <a href="reversos.php" class="historial-card" style="--card-color: rgb(255, 238, 0); --card-bg: rgba(77,159,255,0.12);">
            <div class="card-left">
                <div class="card-icon2">
                    <i class="fa-solid fa-recycle" style="color: rgb(0, 0, 0);"></i> 
                </div>
                <div>
                    <div class="card-name">Reversos</div>
                    <div class="card-desc">Reversar transacciones aprobadas</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_pagos ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

    </div>

        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>