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

        /* Variables específicas del componente */
        --bg-base: #0d0e10;
        --bg-surface: #16181c;
        --bg-card: #1E2128;
        --bg-card-hover: #252830;
        --border: #4C5F71;
        --border-active: #FF6C0C;
        --accent: #FF6C0C;
        --accent-glow: rgba(255, 108, 12, 0.25);
        --text-primary: #f0f1f3;
        --text-secondary: #7D868C;
        --text-muted: #4C5F71;
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
        --transition: 0.2s ease;
    }

    body {
        background-color: var(--bg-base);
        color: var(--text-primary);
        font-family: 'Barlow', sans-serif;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--border);
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
        color: var(--text-primary);
    }

    .panel-subtitulo {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }

    .historial-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem 1.8rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        text-decoration: none;
        transition: all var(--transition);
        backdrop-filter: blur(8px);
    }

    .historial-card:hover {
        border-color: var(--card-color, var(--color-primary));
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        text-decoration: none;
        background: var(--bg-card-hover);
    }

    .card-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        background: var(--card-bg, rgba(255, 108, 12, 0.12));
        flex-shrink: 0;
    }

    .card-name {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.1rem;
    }

    .card-desc {
        font-size: 0.8rem;
        color: var(--text-secondary);
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
        color: var(--text-secondary);
        font-size: 1.1rem;
        margin-left: 0.5rem;
        transition: transform var(--transition);
    }

    .historial-card:hover .card-arrow {
        transform: translateX(4px);
    }

    .second-title {
        background: var(--bg-surface);
        border-radius: 0 var(--radius-md) var(--radius-md) 0;
        padding: 0.9rem 1.2rem;
        margin: 10px;
        gap: 0.8rem;
        font-size: 1.00rem;
        color: var(--text-primary);
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
        background: var(--border);
        margin: 0.8rem 0;
    }

    /* ── ANIMACIONES ── */
    @keyframes fadeSlideIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .panel-container {
        animation: fadeSlideIn 0.4s ease both;
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

        .card-icon {
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