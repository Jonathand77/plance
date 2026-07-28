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

    <link rel="stylesheet" href="../assets/css/estilos.css">
    <link rel="stylesheet" href="../assets/css/pages/settings/ajustes.css">
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