<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\SettingsController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new SettingsController())->handle($_POST, $_SERVER['REQUEST_METHOD']);

$row = $__view['row'];
$alerta = $__view['alerta'];
$alerta_tipo = $__view['alertaTipo'];
$total_ordenes = $__view['totalOrdenes'];
$total_aprobadas = $__view['totalAprobadas'];
$total_rechazadas = $__view['totalRechazadas'];
$total_pendientes = $__view['totalPendientes'];
$avatar = $__view['avatar'];
$initial = $__view['initial'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes | <?= htmlspecialchars($row['usuario']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
            --bg-main: #0d0e10;
            --bg-sidebar: #1E212C;
            --bg-card: #1E2128;
            --bg-card-soft: #1E2128;
            --border: rgba(255, 255, 255, 0.08);
            --text-soft: #7D868C;
            --text-muted: #4C5F71;
            --yellow: #FF6C0C;
            --blue-strong: #0062A8;
            --orange: #FF6C0C;
            --success: #00CFB4;
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.22);
            --radius-lg: 16px;
            --radius-md: 12px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--bg-main);
            color: var(--text-main);
            font-family: 'Barlow', sans-serif;
        }

        a {
            text-decoration: none;
        }

        .settings-page {
            max-width: 1280px;
            margin: 0 auto;
            padding: 28px 20px 40px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 22px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            color: #dbe3ea;
            font-weight: 700;
            font-size: .95rem;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.02);
            transition: .2s ease;
        }

        .back-link:hover {
            color: #fff;
            border-color: rgba(255, 255, 255, 0.16);
            background: rgba(255, 255, 255, 0.04);
        }

        .topbar-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin: 0;
            color: var(--text-main);
        }

        .topbar-subtitle {
            margin: 2px 0 0;
            color: var(--text-soft);
            font-size: .95rem;
        }

        .settings-layout {
            display: grid;
            grid-template-columns: 270px 1fr;
            gap: 20px;
            align-items: start;
        }

        .settings-sidebar {
            background: rgba(30, 33, 44, 0.85);
            border-radius: 16px;
            padding: 16px;
            position: sticky;
            top: 20px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
            border-radius: 12px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 10px;
            color: var(--text-main);
            font-weight: 600;
            transition: .2s ease;
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
            color: var(--text-soft);
        }

        .sidebar-link.active,
        .sidebar-link:hover {
            background: var(--color-primary);
            color: #0d0e10;
        }

        .sidebar-link.active i,
        .sidebar-link:hover i {
            color: #0d0e10;
        }

        .sidebar-divider {
            height: 1px;
            background: var(--border);
            margin: 12px 4px;
        }

        .settings-main {
            display: grid;
            gap: 20px;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: 1.05fr 1fr;
            gap: 20px;
        }

        .card-panel {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .card-arrow {
            color: var(--text-soft);
            font-size: 1rem;
        }

        .profile-card-body {
            padding: 20px;
        }

        .profile-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 18px;
        }

        .profile-user {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .avatar-img {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
            flex-shrink: 0;
        }

        .avatar-fallback {
            width: 62px;
            height: 62px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--color-primary), #c99010);
            color: #0d0e10;
            font-size: 1.45rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .profile-name {
            margin: 0 0 4px;
            font-size: 1.2rem;
            font-weight: 800;
        }

        .profile-id {
            color: var(--text-soft);
            font-size: .88rem;
        }

        .btn-profile {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid var(--border);
            color: #fff;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.02);
            transition: .2s ease;
            white-space: nowrap;
        }

        .btn-profile:hover {
            border-color: rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .profile-info-grid {
            display: grid;
            gap: 12px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 170px 1fr;
            gap: 12px;
            align-items: center;
        }

        .info-label {
            color: var(--text-soft);
            font-size: .92rem;
        }

        .info-value {
            color: var(--text-main);
            font-size: .96rem;
            font-weight: 600;
            word-break: break-word;
        }

        .verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .verified-badge i {
            color: var(--color-secondary-1);
        }

        .config-link {
            color: var(--orange);
            font-weight: 700;
        }

        .activity-card-body {
            padding: 20px;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        .activity-item {
            text-align: center;
            padding: 14px 10px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.015);
            border: 1px solid var(--border);
        }

        .activity-number {
            font-size: 2rem;
            line-height: 1;
            font-weight: 800;
            margin-bottom: 8px;
            color: #fff;
        }

        .activity-number.pending {
            color: var(--color-primary);
        }

        .activity-number.total {
            color: var(--text-main);
        }

        .activity-number.approved {
            color: var(--color-secondary-1);
        }

        .activity-number.rejected {
            color: #dc3545;
        }

        .activity-label {
            font-size: .88rem;
            color: var(--text-soft);
        }

        .settings-card {
            padding: 20px;
        }

        .settings-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 18px;
        }

        .settings-card-title {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 800;
        }

        .settings-card-desc {
            margin: 6px 0 0;
            color: var(--text-soft);
            font-size: .94rem;
        }

        .alert-box {
            margin-bottom: 16px;
            border-radius: 12px;
            padding: 12px 14px;
            font-weight: 600;
            font-size: .95rem;
        }

        .alert-box.success {
            background: rgba(0, 207, 180, 0.12);
            border: 1px solid rgba(0, 207, 180, 0.28);
            color: var(--color-secondary-1);
        }

        .alert-box.error {
            background: rgba(220, 53, 69, 0.10);
            border: 1px solid rgba(220, 53, 69, 0.25);
            color: #dc3545;
        }

        .settings-form {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: .92rem;
            font-weight: 700;
            color: var(--text-soft);
        }

        .form-control-custom {
            width: 100%;
            border: 1px solid var(--border);
            background: rgba(30, 33, 44, 0.6);
            color: #fff;
            border-radius: 12px;
            padding: 12px 14px;
            outline: none;
            transition: .2s ease;
        }

        .form-control-custom:focus {
            border-color: var(--color-secondary-3);
            box-shadow: 0 0 0 3px rgba(0, 98, 168, 0.18);
        }

        textarea.form-control-custom {
            min-height: 120px;
            resize: vertical;
        }

        .readonly-note {
            color: var(--text-muted);
            font-size: .82rem;
            margin-top: 6px;
        }

        .form-actions {
            grid-column: 1 / -1;
            display: flex;
            justify-content: flex-end;
        }

        .btn-save {
            border: none;
            background: var(--color-primary);
            color: #0d0e10;
            font-weight: 800;
            border-radius: 12px;
            padding: 12px 18px;
            transition: .2s ease;
        }

        .btn-save:hover {
            background: var(--color-secondary-3);
            color: #fff;
        }

        @media (max-width: 1100px) {
            .overview-grid {
                grid-template-columns: 1fr;
            }

            .activity-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            .settings-layout {
                grid-template-columns: 1fr;
            }

            .settings-sidebar {
                position: static;
            }

            .settings-form {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .profile-top {
                flex-direction: column;
                align-items: stretch;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 4px;
            }

            .activity-grid {
                grid-template-columns: 1fr 1fr;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <div class="settings-page">
        <div class="topbar">
            <div>
                <h1 class="topbar-title">Ajustes</h1>
                <p class="topbar-subtitle">Administra tu cuenta y la configuración principal del perfil.</p>
            </div>

            <a href="../index.php" class="back-link">
                <i class="bi bi-arrow-left"></i>
                volver
            </a>
        </div>

        <div class="settings-layout">
            <aside class="settings-sidebar">
                <nav class="sidebar-menu">
                    <a href="#mi-cuenta" class="sidebar-link active">
                        <i class="bi bi-gear-fill"></i>
                        Mi cuenta
                    </a>

                    <a href="#configuracion" class="sidebar-link">
                        <i class="bi bi-sliders"></i>
                        Configuración
                    </a>
                </nav>

                <div class="sidebar-divider"></div>

                <div style="padding: 8px 10px 2px; color: var(--text-soft); font-size: .9rem;">
                    Panel inspirado en la referencia visual tipo SEAGM.
                </div>
            </aside>

            <main class="settings-main">
                <section id="mi-cuenta" class="overview-grid">
                    <article class="card-panel">
                        <div class="card-header">
                            <h2 class="card-title">Mi Perfil</h2>
                            <span class="card-arrow"><i class="bi bi-chevron-right"></i></span>
                        </div>

                        <div class="profile-card-body">
                            <div class="profile-top">
                                <div class="profile-user">
                                    <?php if ($avatar): ?>
                                        <img src="<?= $avatar ?>" alt="Avatar" class="avatar-img">
                                    <?php else: ?>
                                        <div class="avatar-fallback"><?= $initial ?></div>
                                    <?php endif; ?>
                                    <div>
                                        <h3 class="profile-name"><?= htmlspecialchars($row['usuario']) ?></h3>
                                        <div class="profile-id">ID de usuario: <?= htmlspecialchars($row['id']) ?></div>
                                    </div>
                                </div>

                                <a href="../profile/index.php" class="btn-profile">
                                    <i class="bi bi-person-gear"></i>
                                    Perfil de usuario
                                </a>
                            </div>

                            <div class="profile-info-grid">
                                <div class="info-row">
                                    <div class="info-label">Correo electrónico</div>
                                    <div class="info-value verified-badge">
                                        <span><?= htmlspecialchars($row['correo']) ?></span>
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-label">Teléfono</div>
                                    <div class="info-value">
                                        <span style="color: var(--text-soft);">No configurado</span>
                                        <a href="#configuracion" class="config-link" style="margin-left: 10px;">Agregar
                                            ahora</a>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="info-label">Ubicación</div>
                                    <div class="info-value">
                                        <?= !empty($row['location']) ? htmlspecialchars($row['location']) : '<span style="color: var(--text-soft);">No definida</span>' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <article class="card-panel">
                        <div class="card-header">
                            <h2 class="card-title">Mi Actividad</h2>
                            <span class="card-arrow"><i class="bi bi-chevron-right"></i></span>
                        </div>

                        <div class="activity-card-body">
                            <div class="activity-grid">
                                <div class="activity-item">
                                    <div class="activity-number pending"><?= $total_pendientes ?></div>
                                    <div class="activity-label">Pendiente</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-number total"><?= $total_ordenes ?></div>
                                    <div class="activity-label">Total órdenes</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-number approved"><?= $total_aprobadas ?></div>
                                    <div class="activity-label">Aprobado</div>
                                </div>

                                <div class="activity-item">
                                    <div class="activity-number rejected"><?= $total_rechazadas ?></div>
                                    <div class="activity-label">Rechazado</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </main>
        </div>
    </div>

    <script>
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                sidebarLinks.forEach(item => item.classList.remove('active'));
                this.classList.add('active');
            });
        });

        window.addEventListener('scroll', () => {
            const cuenta = document.getElementById('mi-cuenta');
            const configuracion = document.getElementById('configuracion');

            const cuentaTop = cuenta.getBoundingClientRect().top;
            const configTop = configuracion.getBoundingClientRect().top;

            sidebarLinks.forEach(item => item.classList.remove('active'));

            if (configTop <= 140) {
                sidebarLinks[1].classList.add('active');
            } else {
                sidebarLinks[0].classList.add('active');
            }
        });
    </script>
</body>

</html>