<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil — <?= htmlspecialchars($row['usuario']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://googleapis.com" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/profile/index.css">

<body>

    <nav class="navbar navbar-dark navbar-expand-lg px-3 py-2">
        <a class="navbar-brand fw-bold" href="../index.php" style="color: var(--accent);">
            <img src="../assets/icons/iconoy.png" alt="Logo" style="width: 30px;">
        </a>
        <a href="../index.php" class="btn-back-nav"><i class="fa-solid fa-circle-arrow-left"></i> Atrás</a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <span
                style="background-color: rgba(30,33,44,0.84); padding: 5px 12px; border-radius: 8px; font-weight: 600; color: var(--text-main);">
                <?= isset($_SESSION['usuario']) ? "Hola, " . htmlspecialchars($_SESSION['usuario']) : "Invitado" ?>
                <i class="bi bi-circle-fill" style="color: var(--color-secondary-1);"></i>
            </span>

            <!-- El desplegable a la derecha -->
            <div class="dropdown">
                <button class="dropbtn">Opciones ▼</button>
                <div class="dropdown-content">
                    <a href="<?= $nav_base ?>contactos.php"><i class="bi bi-envelope-fill"></i> Contactos</a>
                    <hr>
                    <a href="<?= $nav_base ?>php/cerrar_sesion.php" class="cerrar-sesion"><i
                            class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                </div>
            </div>
        </div>
    </nav>

    <script src="../assets/js/pages/profile/index.js"></script>

    <div class="profile-layout">

        <?php if ($msg): ?>
            <div class="alert-custom alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <!-- PERFIL -->
        <div class="pcard">
            <div class="pcard-title">Mi Perfil</div>
            <div class="profile-header">

                <?php if (!empty($row['profile_image']) && file_exists('../uploads/' . $row['profile_image'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($row['profile_image']) ?>" class="avatar-img" alt="Foto">
                <?php else: ?>
                    <div class="avatar-initials"><?= strtoupper(substr($row['usuario'], 0, 1)) ?></div>
                <?php endif; ?>

                <div class="profile-info">
                    <div class="profile-top-row">
                        <div class="profile-name"><?= htmlspecialchars($row['usuario']) ?></div>
                        <a href="edit_profile.php" class="btn-edit">
                            <i class="bi bi-pencil-fill"></i> Editar perfil
                        </a>
                    </div>

                    <div class="profile-correo"><?= htmlspecialchars($row['correo']) ?></div>

                    <?php if (!empty($row['bio'])): ?>
                        <div class="profile-bio">"<?= htmlspecialchars($row['bio']) ?>"</div>
                    <?php endif; ?>

                    <div class="profile-meta">
                        <span class="meta-item"><i class="bi bi-person-badge"></i> ID:
                            <?= htmlspecialchars($row['id']) ?></span>
                        <?php if (!empty($row['location'])): ?>
                            <span class="meta-item"><i class="bi bi-geo-alt-fill"></i>
                                <?= htmlspecialchars($row['location']) ?></span>
                        <?php endif; ?>
                        <span class="meta-item"><i class="bi bi-calendar3"></i> Unido:
                            <?= htmlspecialchars(substr($row['created_at'] ?? 'N/A', 0, 10)) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTIVIDAD -->
        <div class="pcard">
            <div class="pcard-title">Mi Actividad</div>
            <div class="activity-grid">
                <div class="activity-box">
                    <div class="activity-num"><?= $total_ordenes_pago ?></div>
                    <div class="activity-label"><i class="bi bi-wallet-fill" style="color: var(--accent);"></i> Total de
                        órdenes</div>
                </div>
                <div class="activity-box">
                    <div class="activity-num"><?= $total_aprobadas ?></div>
                    <div class="activity-label"><i class="bi bi-cart-check-fill"
                            style="color: var(--color-secondary-1);"></i> Total Pagos Aprobados</div>
                </div>
                <div class="activity-box">
                    <div class="activity-num"><?= $total_ordenes_rechazadas ?></div>
                    <div class="activity-label"><i class="fa-solid fa-xmark" style="color: var(--color-danger);"></i>
                        Total Pagos Rechazados</div>
                </div>
            </div>
        </div>

        <!-- RESUMEN -->
        <div class="resumencard">
            <div class="pcard-title">Resumen</div>
            <div class="summary-grid">
                <div class="summary-box">
                    <div class="summary-num"><?= $total_ordenes ?></div>
                    <div class="summary-label">Total Recargas</div>
                </div>
                <div class="summary-box">
                    <div class="summary-num"><?= $total_subs ?></div>
                    <div class="summary-label">Suscripciones</div>
                </div>
                <div class="summary-box">
                    <div class="summary-num"><?= $total_recurrencias ?></div>
                    <div class="summary-label">Recurrencias</div>
                </div>
                <div class="summary-box">
                    <div class="summary-num"><?= $total_gw_ordenes ?></div>
                    <div class="summary-label"><i class="bi bi-lightning-fill" style="color: var(--accent);"></i>
                        Gateway Pagos</div>
                </div>
                <div class="summary-box">
                    <div class="summary-num"><?= $total_gw_subs ?></div>
                    <div class="summary-label"><i class="bi bi-lightning-fill" style="color: var(--accent);"></i>
                        Gateway Suscripciones</div>
                </div>
                <div class="summary-box">
                    <div class="summary-num"><?= $total_gw_suscription ?></div>
                    <div class="summary-label"><i class="bi bi-lightning-fill" style="color: var(--accent);"></i>
                        Gateway Suscripción pura</div>
                </div>
            </div>
        </div>

        <!-- CALENDARIO DE ACTIVIDAD -->
        <div class="pcard">
            <div class="calendar-header">
                <div class="pcard-title" style="margin-bottom:0;">Historial de actividad</div>
                <div class="calendar-total" id="calTotal"></div>
            </div>
            <div class="calendar-scroll">
                <div class="cal-months" id="calMonths"></div>
                <div class="calendar-grid" id="calGrid"></div>
            </div>
            <div class="cal-legend">
                <span>Menos</span>
                <div class="cal-legend-cell"
                    style="background:var(--bg-card); border:1px solid rgba(255,255,255,0.04);"></div>
                <div class="cal-legend-cell level-1"></div>
                <div class="cal-legend-cell level-2"></div>
                <div class="cal-legend-cell level-3"></div>
                <div class="cal-legend-cell level-4"></div>
                <span>Más</span>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.__activityData = <?= $actividad_json ?>;
    </script>
    <script src="../assets/js/pages/profile/index-activity.js"></script>
</body>

</html>