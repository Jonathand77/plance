<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialSuscripcionesController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$modo = $_GET['modo'] ?? 'wc-sub';

$__view = (new HistorialSuscripcionesController())->handleList($modo);
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Suscripciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
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
        font-family: 'Barlow', sans-serif;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .tabla-container {
        background: rgba(30, 33, 44, 0.85);
        border-radius: 14px;
        padding: 1.8rem;
        margin: 2rem auto;
        max-width: 1100px;
        backdrop-filter: blur(8px);
        border: 1px solid var(--color-secondary-2);
    }

    .tabla-titulo {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        color: var(--color-secondary-3);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        color: white;
        border-color: rgba(255, 255, 255, 0.08);
    }

    .table thead th {
        background: rgba(0, 0, 0, 0.6);
        color: var(--color-secondary-3);
        border-color: rgba(255, 255, 255, 0.08);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        padding: 0.8rem 0.6rem;
    }

    .table tbody tr {
        border-color: rgba(255, 255, 255, 0.05);
        background-color: rgba(0, 0, 0, 0.3);
        transition: background 0.2s;
    }

    .table tbody tr:hover {
        background: rgba(0, 98, 168, 0.06);
    }

    .table tbody td {
        border-color: rgba(255, 255, 255, 0.05);
        font-size: 0.88rem;
        vertical-align: middle;
        color: var(--text-main);
        padding: 0.7rem 0.6rem;
    }

    /* Badges de estado usando la nueva paleta */
    .badge-aprobada {
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
    }

    .badge-pendiente {
        background: rgba(255, 108, 12, 0.15);
        color: var(--color-primary);
    }

    .badge-rechazada {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .badge-cancelada {
        background: rgba(125, 134, 140, 0.15);
        color: var(--color-secondary-5);
    }

    .badge-error {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .estado-pill {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sin-registros {
        text-align: center;
        padding: 3rem;
        color: var(--color-secondary-5);
        font-size: 0.95rem;
    }

    .sin-registros i {
        color: var(--color-secondary-2);
    }

    .modo-tabs-group {
        margin-bottom: 1.2rem;
    }

    .modo-tabs-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--color-secondary-2);
        margin-bottom: 0.4rem;
    }

    .modo-tabs {
        display: flex;
        gap: 0.4rem;
        flex-wrap: wrap;
        margin-bottom: 0.6rem;
    }

    .modo-tab {
        padding: 0.4rem 0.85rem;
        border-radius: 8px;
        font-size: 0.79rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s;
        border: 1.5px solid var(--color-secondary-2);
        color: var(--color-secondary-5);
        background: rgba(255, 255, 255, 0.02);
    }

    .modo-tab:hover {
        text-decoration: none;
        color: var(--text-main);
        border-color: var(--color-secondary-5);
    }

    .modo-tab.active-purple {
        border-color: var(--color-secondary-3);
        background: rgba(0, 98, 168, 0.10);
        color: var(--color-secondary-3);
    }

    .modo-tab.active-blue {
        border-color: var(--color-secondary-3);
        background: rgba(0, 98, 168, 0.10);
        color: var(--color-secondary-3);
    }

    .modo-tab.active-green {
        border-color: var(--color-secondary-1);
        background: rgba(0, 207, 180, 0.10);
        color: var(--color-secondary-1);
    }

    .modo-tab.active-orange {
        border-color: var(--color-primary);
        background: rgba(255, 108, 12, 0.10);
        color: var(--color-primary);
    }

    .tabs-divider {
        height: 1px;
        background: var(--color-secondary-2);
        margin: 0.6rem 0;
    }

    .btn-verificar {
        background: rgba(0, 98, 168, 0.12);
        border: 1px solid rgba(0, 98, 168, 0.25);
        color: var(--color-secondary-3);
        border-radius: 6px;
        padding: 0.25rem 0.7rem;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s;
        white-space: nowrap;
        font-family: 'Barlow', sans-serif;
    }

    .btn-verificar:hover {
        background: rgba(0, 98, 168, 0.25);
        color: var(--color-secondary-3);
        text-decoration: none;
        border-color: var(--color-secondary-3);
    }

    .alert-verify {
        background: rgba(0, 207, 180, 0.12);
        color: var(--color-secondary-1);
        border: 1px solid rgba(0, 207, 180, 0.3);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.88rem;
    }

    .codigo-id {
        color: var(--color-secondary-5);
    }

    .codigo-correo {
        color: var(--color-secondary-3);
    }

    .codigo-correo-gw {
        color: var(--color-primary);
    }

    .precio-link {
        color: var(--color-secondary-3);
        font-weight: 700;
    }

    .precio-gw {
        color: var(--color-primary);
        font-weight: 700;
    }

    .fecha-creacion {
        color: var(--color-secondary-5);
        font-size: 0.8rem;
    }

    .token-guardado {
        color: var(--color-secondary-1);
        font-size: 0.78rem;
    }

    .token-vacio {
        color: var(--color-secondary-2);
        font-size: 0.78rem;
    }

    .periodicidad-badge {
        background: rgba(0, 98, 168, 0.12);
        color: var(--color-secondary-3);
        font-size: 0.72rem;
        padding: 0.1rem 0.4rem;
        border-radius: 3px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tabla-container {
            padding: 1rem;
            margin: 1rem 0.5rem;
        }

        .table thead th {
            font-size: 0.65rem;
            padding: 0.5rem 0.3rem;
        }

        .table tbody td {
            font-size: 0.75rem;
            padding: 0.5rem 0.3rem;
        }

        .btn-verificar {
            font-size: 0.65rem;
            padding: 0.15rem 0.4rem;
        }

        .modo-tab {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="fa-solid fa-credit-card" style="color: var(--color-secondary-3);"></i>
            Historial de Suscripciones
        </div>

        <!-- TABS Web Checkout -->
        <div class="modo-tabs-group">
            <div class="modo-tabs-label"><i class="bi bi-display"></i> Web Checkout</div>
            <div class="modo-tabs">
                <a href="reg-sus.php?modo=wc-sub" class="modo-tab <?= $modo === 'wc-sub' ? 'active-purple' : '' ?>"><i
                        class="bi bi-tv"></i> Pago + Suscripción</a>
                <a href="reg-sus.php?modo=wc-rec" class="modo-tab <?= $modo === 'wc-rec' ? 'active-blue' : '' ?>"><i
                        class="fa-solid fa-credit-card"></i> Recurrentes</a>
                <a href="reg-sus.php?modo=wc-pura" class="modo-tab <?= $modo === 'wc-pura' ? 'active-green' : '' ?>"><i
                        class="bi bi-key"></i> Suscripción pura</a>
            </div>
            <div class="tabs-divider"></div>
            <div class="modo-tabs-label"><i class="bi bi-code-slash"></i> API Gateway</div>
            <div class="modo-tabs">
                <a href="reg-sus.php?modo=gw-sub" class="modo-tab <?= $modo === 'gw-sub' ? 'active-orange' : '' ?>"><i
                        class="bi bi-tv"></i> Pago + Suscripción</a>
                <a href="reg-sus.php?modo=gw-pura" class="modo-tab <?= $modo === 'gw-pura' ? 'active-orange' : '' ?>"><i
                        class="bi bi-key"></i> Suscripción pura</a>
            </div>
        </div>

        <?php if (!empty($verify_msg)): ?>
            <div class="alert-verify"><?= htmlspecialchars($verify_msg) ?></div>
        <?php endif; ?>

        <?php if (count($registros) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <?php if (in_array($modo, ['wc-sub'])): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Plataforma</th>
                                <th>Plan</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'wc-rec'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Correo</th>
                                <th>Precio/mes</th>
                                <th>Periodicidad</th>
                                <th>Próx. cobro</th>
                                <th>Fin</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'wc-pura'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'gw-sub'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'gw-pura'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $row): ?>
                            <tr>
                                <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>

                                <?php if ($modo === 'wc-sub'): ?>
                                    <td><?= htmlspecialchars($row['plataforma']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=suscripciones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-sub"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'wc-rec'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td><span
                                            class="periodicidad-badge"><?= $row['periodicidad'] === 'Y' ? 'Anual' : 'Mensual' ?></span>
                                    </td>
                                    <td style="color:var(--text-main);">
                                        <?= !empty($row['next_payment']) ? htmlspecialchars($row['next_payment']) : '—' ?></td>
                                    <td style="color:var(--color-primary);">
                                        <?= !empty($row['fecha_fin']) ? htmlspecialchars($row['fecha_fin']) : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=suscription_rec&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-rec"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'wc-pura'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=suscription&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-pura"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'gw-sub'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><code class="codigo-correo-gw"><?= htmlspecialchars($row['correo']) ?></code></td>
                                    <td class="precio-gw">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=gateway_suscripciones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=gw-sub"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'gw-pura'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><code class="codigo-correo-gw"><?= htmlspecialchars($row['correo']) ?></code></td>
                                    <td class="precio-gw">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=gateway_suscription&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=gw-pura"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes registros en esta categoría aún.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>