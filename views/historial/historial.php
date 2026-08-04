<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

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
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/historial.css">

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