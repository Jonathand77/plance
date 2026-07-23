<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

// Contar registros del usuario actual
$correo_sesion = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

function safeCount(mysqli $conexion, string $sql): int
{
    try {
        $result = mysqli_query($conexion, $sql);
        if (!$result) {
            return 0;
        }
        $row = mysqli_fetch_assoc($result);
        return (int) ($row['total'] ?? 0);
    } catch (mysqli_sql_exception $e) {
        return 0;
    }
}

$total_ordenes = safeCount($conexion, "SELECT COUNT(*) as total FROM ordenes");
$total_subs = safeCount($conexion, "SELECT COUNT(*) as total FROM suscripciones WHERE usuario_id = '$correo_sesion'");
$total_recs = safeCount($conexion, "SELECT COUNT(*) as total FROM recurrencias WHERE usuario_id = '$correo_sesion'");

$total_links = safeCount($conexion, "SELECT COUNT(*) as total FROM payment_link");
$total_disp = safeCount($conexion, "SELECT COUNT(*) as total FROM dispersiones WHERE usuario_id = '$correo_sesion'");
$total_prea = safeCount($conexion, "SELECT COUNT(*) as total FROM reservaciones WHERE usuario_id = '$correo_sesion'");

$total_pagos = $total_ordenes + $total_subs + $total_recs;
$total_pagos = number_format($total_pagos, 0, ',', '.');
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
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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

    .historial-divider {
        height: 1px;
        background: var(--color-secondary-2);
        margin: 1.5rem 0;
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

        .card-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.6rem;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "../index.php";
    $nav_back_text = "Atrás";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="panel-container">
        <div class="panel-titulo"><i class="bi bi-file-text-fill" style="color: var(--color-primary);"></i> Mis
            Historiales</div>
        <div class="panel-subtitulo">Consulta el registro de tus pagos y suscripciones</div>

        <!-- Pagos Básicos -->
        <a href="reg-pgb.php" class="historial-card"
            style="--card-color: var(--color-primary); --card-bg: rgba(255,108,12,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-money-bill-1-wave fs-3l" style="color: var(--color-primary);"></i>
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
        <a href="reg-sus.php" class="historial-card"
            style="--card-color: var(--color-secondary-3); --card-bg: rgba(0,98,168,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-credit-card" style="color: var(--color-secondary-3);"></i>
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
        <a href="reg-rec.php" class="historial-card"
            style="--card-color: var(--color-secondary-1); --card-bg: rgba(0,207,180,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="bi bi-calendar-check-fill" style="color: var(--color-secondary-1);"></i>
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

        <!-- Links de Pago - AHORA CON COLOR DE LA PALETA -->
        <a href="reg-link.php" class="historial-card"
            style="--card-color: var(--color-secondary-1); --card-bg: rgba(0,207,180,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-link" style="color: var(--color-secondary-1);"></i>
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

        <!-- Dispersiones -->
        <a href="reg-disp.php" class="historial-card"
            style="--card-color: var(--color-secondary-1); --card-bg: rgba(0,207,180,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="fa-solid fa-plane" style="color: var(--color-secondary-1);"></i>
                </div>
                <div>
                    <div class="card-name">Dispersiones</div>
                    <div class="card-desc">Tiquetes de avión — pago dividido entre aerolínea e impuestos</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_disp ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

        <!-- Preautorizaciones -->
        <a href="reg-prea.php" class="historial-card"
            style="--card-color: var(--color-secondary-3); --card-bg: rgba(0,98,168,0.12);">
            <div class="card-left">
                <div class="card-icon">
                    <i class="bi bi-building-fill" style="color: var(--color-secondary-3);"></i>
                </div>
                <div>
                    <div class="card-name">Preautorizaciones</div>
                    <div class="card-desc">Reservas de hotel — monto reservado sin cobrar hasta el check-out</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge"><?= $total_prea ?> Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

        <div class="historial-divider"></div>

        <div class="panel-titulo"><i class="fa-solid fa-money-bill-transfer" style="color: var(--color-primary);"></i>
            Reversos</div>
        <div class="panel-subtitulo">Consulta tus pagos aprobados y solicita su reverso</div>

        <!-- Reversos -->
        <a href="reversos.php" class="historial-card" style="--card-color: var(--color-primary); --card-bg: rgba(251,191,36,0.12);">
            <div class="card-left">
                <div class="card-icon2">
                    <i class="fa-solid fa-recycle" style="color: #0d0e10;"></i>
                </div>
                <div>
                    <div class="card-name">Reversos</div>
                    <div class="card-desc">Reversar transacciones aprobadas</div>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <span class="card-badge" style="color: var(--card-color); background: var(--card-bg);"><?= $total_pagos ?>
                    Registros</span>
                <i class="bi bi-chevron-right card-arrow"></i>
            </div>
        </a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>