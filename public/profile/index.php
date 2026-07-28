<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\ProfileIndexController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new ProfileIndexController())->handle();

$row = $__view['row'];
$total_ordenes_pago = $__view['totalOrdenesPago'];
$total_aprobadas = $__view['totalAprobadas'];
$total_ordenes_rechazadas = $__view['totalOrdenesRechazadas'];
$total_ordenes = $__view['totalOrdenes'];
$total_subs = $__view['totalSubs'];
$total_recurrencias = $__view['totalRecurrencias'];
$total_gw_ordenes = $__view['totalGwOrdenes'];
$total_gw_subs = $__view['totalGwSubs'];
$total_gw_suscription = $__view['totalGwSuscription'];
$actividad_json = $__view['actividadJson'];
$msg = $__view['msg'];
$msg_type = $__view['msgType'];

$nav_base = $nav_base ?? '../';
?>
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
<style>
    :root {

        /* Variables específicas del componente */
        --bg-base: #0d0e10;
        --bg-surface: #16181c;
        --bg-card: #1E2128;
        --border: #4C5F71;
        --accent: #FF6C0C;
        --accent-dark: #c99010;
        --text-primary: #f0f1f3;
        --text-secondary: #7D868C;
        --text-muted: #4C5F71;
        --green: #00CFB4;
        --font-display: 'Barlow', sans-serif;
        --font-body: 'Barlow', sans-serif;
        --radius-md: 10px;
        --radius-lg: 14px;
        --color-success: #00CFB4;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: var(--bg-base);
        color: var(--text-primary);
        font-family: var(--font-body);
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--border);
    }

    /* ── DROPDOWN ── */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background: rgba(30, 33, 44, 0.84);
        color: var(--accent);
        border: 1.5px solid rgba(255, 108, 12, 0.3);
        border-radius: 8px;
        padding: 6px 14px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .dropbtn:hover {
        border-color: var(--accent);
        background: rgba(255, 108, 12, 0.1);
    }

    .dropdown-content {
        display: none;
        position: absolute;
        left: 0;
        top: calc(100% + 6px);
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 10px;
        min-width: 170px;
        z-index: 999;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        animation: dropFade 0.15s ease;
    }

    @keyframes dropFade {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-content a {
        display: block;
        padding: 0.6rem 1rem;
        color: var(--text-primary);
        font-size: 0.87rem;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }

    .dropdown-content a:hover {
        background: rgba(255, 108, 12, 0.1);
        color: var(--accent);
        text-decoration: none;
    }

    .dropdown-content hr {
        border-color: var(--border);
        margin: 0.2rem 0;
    }

    .dropdown-content .cerrar-sesion {
        color: var(--color-danger) !important;
    }

    .dropdown-content .cerrar-sesion:hover {
        background: rgba(220, 53, 69, 0.1) !important;
        color: var(--color-danger) !important;
    }

    .dropdown.open .dropdown-content {
        display: block;
    }

    .profile-layout {
        max-width: 860px;
        margin: 2rem auto;
        padding: 0 1.2rem 3rem;
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .pcard {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.4rem 1.6rem;
    }

    .resumencard {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.4rem 1.6rem;
    }

    .pcard-title {
        font-family: var(--font-display);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-bottom: 1.1rem;
    }

    /* PERFIL HEADER */
    .profile-header {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
    }

    .avatar-img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        border: 2.5px solid var(--accent);
        flex-shrink: 0;
    }

    .avatar-initials {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--accent-dark));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        color: #0d0e10;
        border: 2.5px solid var(--accent);
        flex-shrink: 0;
    }

    .profile-info {
        flex: 1;
    }

    .profile-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 0.3rem;
    }

    .profile-name {
        font-family: var(--font-display);
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: var(--bg-card);
        border: 1.5px solid var(--border);
        color: var(--text-primary);
        border-radius: 8px;
        padding: 0.4rem 1rem;
        font-family: var(--font-display);
        font-size: 0.88rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .btn-edit:hover {
        border-color: var(--accent);
        color: var(--accent);
        text-decoration: none;
    }

    .profile-correo {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
    }

    .profile-bio {
        font-size: 0.88rem;
        color: var(--text-secondary);
        margin-bottom: 0.6rem;
    }

    .profile-meta {
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }

    .meta-item {
        font-size: 0.78rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* ACTIVIDAD */
    .activity-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
    }

    .activity-box {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1rem;
        text-align: center;
        transition: border-color 0.2s;
    }

    .activity-box:hover {
        border-color: var(--accent);
    }

    .activity-num {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent);
        line-height: 1;
    }

    .activity-label {
        font-size: 0.78rem;
        color: var(--text-secondary);
        margin-top: 0.3rem;
    }

    /* RESUMEN */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
    }

    .summary-box {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        padding: 1rem;
        text-align: center;
        transition: border-color 0.2s;
    }

    .summary-box:hover {
        border-color: var(--accent);
    }

    .summary-num {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent);
        line-height: 1;
    }

    .summary-label {
        font-size: 0.78rem;
        color: var(--text-secondary);
        margin-top: 0.3rem;
    }

    /* Alerts */
    .alert-custom {
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.88rem;
    }

    .alert-success {
        background: rgba(0, 207, 180, 0.12);
        color: var(--color-success);
        border: 1px solid rgba(0, 207, 180, 0.3);
    }

    .alert-error {
        background: rgba(220, 53, 69, 0.12);
        color: var(--color-danger);
        border: 1px solid rgba(220, 53, 69, 0.3);
    }

    /* CALENDARIO */
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.8rem;
    }

    .calendar-total {
        font-size: 0.82rem;
        color: var(--text-secondary);
    }

    .calendar-scroll {
        overflow-x: auto;
        padding-bottom: 0.4rem;
    }

    .calendar-grid {
        display: flex;
        gap: 3px;
        min-width: max-content;
    }

    .cal-col {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .cal-cell {
        width: 13px;
        height: 13px;
        border-radius: 2px;
        background: var(--bg-card);
        border: 1px solid rgba(255, 255, 255, 0.04);
        cursor: default;
        transition: transform 0.1s;
        position: relative;
    }

    .cal-cell:hover {
        transform: scale(1.3);
        z-index: 10;
    }

    .cal-cell.level-1 {
        background: rgba(255, 108, 12, 0.25);
    }

    .cal-cell.level-2 {
        background: rgba(255, 108, 12, 0.5);
    }

    .cal-cell.level-3 {
        background: rgba(255, 108, 12, 0.75);
    }

    .cal-cell.level-4 {
        background: var(--accent);
    }

    .cal-cell.empty {
        background: transparent;
        border-color: transparent;
        cursor: default;
    }

    .cal-months {
        display: flex;
        gap: 3px;
        margin-bottom: 4px;
        min-width: max-content;
        padding-left: 0;
    }

    .cal-month-label {
        font-size: 0.68rem;
        color: var(--text-muted);
        white-space: nowrap;
    }

    .cal-legend {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-top: 0.6rem;
        justify-content: flex-end;
    }

    .cal-legend span {
        font-size: 0.72rem;
        color: var(--text-muted);
    }

    .cal-legend-cell {
        width: 12px;
        height: 12px;
        border-radius: 2px;
    }

    /* Botón volver */
    .btn-back-nav {
        color: var(--accent);
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        text-decoration: none;
    }

    .btn-back-nav:hover {
        background: rgba(255, 108, 12, 0.10);
        color: var(--accent);
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .profile-header {
            flex-direction: column;
        }

        .activity-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .profile-top-row {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

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

    <script>
        (function () {
            document.querySelectorAll('.navbar .dropdown').forEach(function (dd) {
                var btn = dd.querySelector('.dropbtn');
                if (!btn) return;
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var wasOpen = dd.classList.contains('open');
                    document.querySelectorAll('.dropdown.open').forEach(function (o) { o.classList.remove('open'); });
                    if (!wasOpen) dd.classList.add('open');
                });
            });
            document.addEventListener('click', function () {
                document.querySelectorAll('.dropdown.open').forEach(function (o) { o.classList.remove('open'); });
            });
        })();
    </script>

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
        (function () {
            const data = <?= $actividad_json ?>;
            const grid = document.getElementById('calGrid');
            const months = document.getElementById('calMonths');
            const calTotal = document.getElementById('calTotal');

            const total = Object.values(data).reduce((a, b) => a + b, 0);
            calTotal.textContent = total + ' actividad' + (total !== 1 ? 'es' : '') + ' en el último año';

            const today = new Date();
            const end = new Date(today);
            const start = new Date(today);
            start.setDate(start.getDate() - 364);
            start.setDate(start.getDate() - start.getDay());

            const MONTHS = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

            function toKey(d) {
                return d.getFullYear() + '-' +
                    String(d.getMonth() + 1).padStart(2, '0') + '-' +
                    String(d.getDate()).padStart(2, '0');
            }

            function getLevel(cnt) {
                if (!cnt) return 0;
                if (cnt === 1) return 1;
                if (cnt === 2) return 2;
                if (cnt <= 4) return 3;
                return 4;
            }

            let monthLabels = [];
            let lastMonth = -1;
            let colIndex = 0;

            const cur = new Date(start);
            while (cur <= end) {
                const col = document.createElement('div');
                col.className = 'cal-col';

                const m = cur.getMonth();
                if (m !== lastMonth) {
                    monthLabels.push({ col: colIndex, label: MONTHS[m] });
                    lastMonth = m;
                }

                for (let d = 0; d < 7; d++) {
                    const cell = document.createElement('div');

                    if (cur > end) {
                        cell.className = 'cal-cell empty';
                    } else {
                        const key = toKey(cur);
                        const cnt = data[key] || 0;
                        const level = getLevel(cnt);
                        cell.className = 'cal-cell' + (level ? ' level-' + level : '');

                        const label = cnt
                            ? cnt + ' actividad' + (cnt > 1 ? 'es' : '') + ' — ' + key
                            : 'Sin actividad — ' + key;
                        cell.title = label;
                    }

                    col.appendChild(cell);
                    cur.setDate(cur.getDate() + 1);
                }

                grid.appendChild(col);
                colIndex++;
            }

            const colW = 16;
            let lastLabelRight = -999;
            monthLabels.forEach(({ col, label }) => {
                const left = col * colW;
                if (left - lastLabelRight < 28) return;
                const span = document.createElement('div');
                span.className = 'cal-month-label';
                span.style.width = '28px';
                span.textContent = label;
                months.appendChild(span);
                lastLabelRight = left + 28;
            });
        })();
    </script>
</body>

</html>