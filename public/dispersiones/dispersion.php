<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispersiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/dispersiones/dispersion.css">

<body>
    <?php
    $nav_back_url = "../sesiones.php";
    $nav_back_text = "Atrás";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="container text-center">
        <div class="second-title">
            <i class="fa-solid fa-plane-departure fs-3"></i>
            <div>
                <strong>Bienvenido a la sesión de dispersiones</strong>
                <br>
                Elige tu destino y reserva tu vuelo
            </div>
        </div>

        <div class="panel-container text-start">
            <!-- Enlaces -->
            <a href="tickets.php" class="historial-card"
                style="--card-color: var(--color-secondary-1); --card-bg: rgba(0,207,180,0.12);">
                <div class="card-left">
                    <div class="card-icon">
                        <i class="fa-solid fa-plane" style="color: var(--color-secondary-1);"></i>
                    </div>
                    <div>
                        <div class="card-name">Tiquetes de avión</div>
                        <div class="card-desc">Compra tu boleto de avión al mejor precio</div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <span class="card-badge">Dispersión</span>
                    <i class="bi bi-chevron-right card-arrow"></i>
                </div>
            </a>

            <div class="historial-divider"></div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>