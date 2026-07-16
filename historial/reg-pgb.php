<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

$modo = $_GET['modo'] ?? 'wc';

if ($modo === 'gateway') {
    $resultado = mysqli_query($conexion, "SELECT * FROM gateway_ordenes ORDER BY created_at DESC");
} elseif ($modo === 'mixto') {
    // Mixtos: registros de ordenes con pago parcial (monto_pagado) o productos múltiples
    $resultado = mysqli_query($conexion, "SELECT * FROM ordenes WHERE monto_pagado IS NOT NULL OR producto LIKE '%+%' ORDER BY created_at DESC");
} else {
    $resultado = mysqli_query($conexion, "SELECT * FROM ordenes WHERE monto_pagado IS NULL AND producto NOT LIKE '%+%' ORDER BY created_at DESC");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Pagos Básicos</title>
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
        --text-main: #000000;
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
        color: var(--color-primary);
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
        color: var(--color-primary);
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
        background: rgba(255, 108, 12, 0.06);
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

    .modo-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.2rem;
        flex-wrap: wrap;
    }

    .modo-tab {
        padding: 0.5rem 1.2rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.25s;
        border: 1.5px solid var(--color-secondary-2);
        color: var(--color-secondary-5);
        background: rgba(255, 255, 255, 0.03);
    }

    .modo-tab:hover {
        text-decoration: none;
        color: var(--text-main);
        border-color: var(--color-secondary-5);
    }

    .modo-tab.active-wc {
        border-color: var(--color-primary);
        background: rgba(255, 108, 12, 0.10);
        color: var(--color-primary);
    }

    .modo-tab.active-gw {
        border-color: var(--color-secondary-3);
        background: rgba(0, 98, 168, 0.10);
        color: var(--color-secondary-3);
    }

    .modo-tab.active-mixto {
        border-color: var(--color-secondary-3);
        background: rgba(0, 98, 168, 0.10);
        color: var(--color-secondary-3);
    }

    .btn-continuar {
        background: rgba(0, 98, 168, 0.12);
        border: 1px solid rgba(0, 98, 168, 0.35);
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

    .btn-continuar:hover {
        background: rgba(0, 98, 168, 0.25);
        color: var(--color-secondary-3);
        text-decoration: none;
        border-color: var(--color-secondary-3);
    }

    .btn-verificar {
        background: rgba(255, 108, 12, 0.12);
        border: 1px solid rgba(255, 108, 12, 0.25);
        color: var(--color-primary);
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
        background: rgba(255, 108, 12, 0.25);
        color: var(--color-primary);
        text-decoration: none;
        border-color: var(--color-primary);
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

    .codigo-jugador {
        color: var(--color-secondary-3);
    }

    .codigo-correo {
        color: var(--color-secondary-1);
    }

    .precio-link {
        color: var(--color-primary);
        font-weight: 700;
    }

    .fecha-creacion {
        color: var(--color-secondary-5);
        font-size: 0.8rem;
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
            padding: 0.35rem 0.8rem;
            font-size: 0.75rem;
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
            <i class="fa-solid fa-money-bill-1-wave fs-3l" style="color: var(--color-primary);"></i>
            Historial de Pagos Básicos
        </div>

        <!-- TABS -->
        <div class="modo-tabs">
            <a href="reg-pgb.php?modo=wc" class="modo-tab <?= $modo === 'wc' ? 'active-wc' : '' ?>">
                <i class="bi bi-display"></i> Web Checkout
            </a>
            <a href="reg-pgb.php?modo=gateway" class="modo-tab <?= $modo === 'gateway' ? 'active-gw' : '' ?>">
                <i class="bi bi-code-slash"></i> API Gateway
            </a>
            <a href="reg-pgb.php?modo=mixto" class="modo-tab <?= $modo === 'mixto' ? 'active-mixto' : '' ?>">
                <i class="bi bi-shuffle"></i> Pago Mixto
            </a>
        </div>

        <?php
        if (!empty($_SESSION['verify_msg'])) {
            echo '<div class="alert-verify">' . htmlspecialchars($_SESSION['verify_msg']) . '</div>';
            unset($_SESSION['verify_msg']);
        }
        ?>

        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <?php if ($modo === 'gateway'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Producto</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'mixto'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Productos</th>
                                <th>ID Jugador</th>
                                <th>Total pedido</th>
                                <th>Monto pagado</th>
                                <th>Saldo restante</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <th>#ID</th>
                                <th>Producto</th>
                                <th>ID Jugador</th>
                                <th>Precio</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <?php if ($modo === 'gateway'): ?>
                                    <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>
                                    <td><?= htmlspecialchars($row['producto']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['correo']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td>
                                        <span class="estado-pill badge-<?= strtolower($row['estado']) ?>">
                                            <?= strtoupper($row['estado']) ?>
                                        </span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=gateway_ordenes&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-pgb.php?modo=gateway"
                                                class="btn-verificar">
                                                <i class="bi bi-arrow-repeat"></i> Verificar
                                            </a>
                                        <?php else: ?>
                                            <span style="color:var(--color-secondary-2); font-size:0.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                <?php elseif ($modo === 'mixto'): ?>
                                    <?php
                                        $total_ord    = (float) $row['precio'];
                                        $monto_pagado = isset($row['monto_pagado']) && $row['monto_pagado'] !== null ? (float) $row['monto_pagado'] : $total_ord;
                                        $saldo_rest   = $total_ord - $monto_pagado;
                                        $es_parcial   = $row['monto_pagado'] !== null && $monto_pagado < $total_ord;
                                    ?>
                                    <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>
                                    <td style="font-size:0.82rem;max-width:200px;"><?= htmlspecialchars($row['producto']) ?></td>
                                    <td><code class="codigo-jugador"><?= htmlspecialchars($row['jugador_id']) ?></code></td>
                                    <td style="color:var(--text-main);font-weight:700;">$<?= number_format($total_ord, 0, ',', '.') ?> COP</td>
                                    <td style="color:var(--color-secondary-1);font-weight:700;">$<?= number_format($monto_pagado, 0, ',', '.') ?> COP</td>
                                    <td>
                                        <?php if ($es_parcial): ?>
                                            <span style="color:var(--color-primary);font-weight:700;">$<?= number_format($saldo_rest, 0, ',', '.') ?> COP</span>
                                        <?php else: ?>
                                            <span style="color:var(--color-secondary-2); font-size:0.75rem;">— Completo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="estado-pill badge-<?= strtolower($row['estado']) ?>">
                                            <?= strtoupper($row['estado']) ?>
                                        </span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=ordenes&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-pgb.php?modo=mixto"
                                                class="btn-verificar">
                                                <i class="bi bi-arrow-repeat"></i> Verificar
                                            </a>
                                        <?php elseif (strtolower($row['estado']) === 'aprobada' && $es_parcial && $saldo_rest > 0): ?>
                                            <a href="../php/continuar_pago.php?id=<?= $row['id'] ?>" class="btn-continuar">
                                                <i class="bi bi-play-circle-fill"></i> Continuar pago
                                            </a>
                                        <?php else: ?>
                                            <span style="color:var(--color-secondary-2); font-size:0.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                <?php else: ?>
                                    <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>
                                    <td><?= htmlspecialchars($row['producto']) ?></td>
                                    <td><code class="codigo-jugador"><?= htmlspecialchars($row['jugador_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td>
                                        <span class="estado-pill badge-<?= strtolower($row['estado']) ?>">
                                            <?= strtoupper($row['estado']) ?>
                                        </span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=ordenes&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-pgb.php"
                                                class="btn-verificar">
                                                <i class="bi bi-arrow-repeat"></i> Verificar
                                            </a>
                                        <?php else: ?>
                                            <span style="color:var(--color-secondary-2); font-size:0.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No hay órdenes registradas aún.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>