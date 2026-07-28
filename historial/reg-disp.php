<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialDispersionesController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialDispersionesController())->handleList();
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Dispersiones</title>
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

        /* Variables específicas del componente */
        --bg-base: #0d0e10;
        --bg-surface: #1E212C;
        --bg-card: #1E2128;
        --bg-card-hover: #252830;
        --border: #4C5F71;
        --border-active: #FF6C0C;
        --accent: #00CFB4;
        --accent-glow: rgba(0, 207, 180, 0.25);
        --accent-soft: rgba(0, 207, 180, 0.1);
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

    .tabla-container {
        background: var(--bg-surface);
        border-radius: var(--radius-lg);
        padding: 1.8rem;
        margin: 2rem auto;
        max-width: 1150px;
        border: 1px solid var(--border);
    }

    .tabla-titulo {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        color: var(--accent);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        color: var(--text-primary);
        border-color: rgba(255, 255, 255, 0.08);
    }

    .table thead th {
        background: rgba(0, 0, 0, 0.6);
        color: var(--accent);
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
        transition: background var(--transition);
    }

    .table tbody tr:hover {
        background: var(--accent-soft);
    }

    .table tbody td {
        border-color: rgba(255, 255, 255, 0.05);
        font-size: 0.88rem;
        vertical-align: middle;
        color: var(--text-primary);
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

    .badge-exitosa {
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
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

    .disp-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
        border: 1px solid rgba(0, 207, 180, 0.3);
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.04em;
    }

    /* Desglose inline */
    .desglose-cell {
        font-size: 0.78rem;
        line-height: 1.7;
    }

    .desglose-vuelo {
        color: var(--color-secondary-1);
        font-weight: 600;
    }

    .desglose-imp {
        color: var(--color-primary);
        font-weight: 600;
    }

    .sin-registros {
        text-align: center;
        padding: 3rem;
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    .sin-registros i {
        color: var(--text-muted);
    }

    .btn-verificar {
        background: rgba(0, 207, 180, 0.12);
        border: 1px solid rgba(0, 207, 180, 0.25);
        color: var(--color-secondary-1);
        border-radius: var(--radius-sm);
        padding: 0.25rem 0.7rem;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all var(--transition);
        white-space: nowrap;
        font-family: 'Barlow', sans-serif;
    }

    .btn-verificar:hover {
        background: rgba(0, 207, 180, 0.25);
        color: var(--color-secondary-1);
        text-decoration: none;
        border-color: var(--color-secondary-1);
        transform: translateY(-1px);
    }

    .alert-verify {
        background: rgba(0, 207, 180, 0.12);
        color: var(--color-secondary-1);
        border: 1px solid rgba(0, 207, 180, 0.3);
        border-radius: var(--radius-md);
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.88rem;
    }

    .info-banner {
        background: rgba(0, 207, 180, 0.07);
        border: 1px solid rgba(0, 207, 180, 0.2);
        border-left: 3px solid var(--color-secondary-1);
        border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
        padding: 0.75rem 1rem;
        margin-bottom: 1.2rem;
        font-size: 0.82rem;
        color: var(--color-secondary-1);
        line-height: 1.6;
    }

    .fecha-creacion {
        color: var(--text-secondary);
        font-size: 0.8rem;
    }

    .codigo-id {
        color: var(--text-secondary);
        font-weight: 600;
    }

    .precio-link {
        font-weight: 600;
        color: var(--text-primary);
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

        .tabla-titulo {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 600px) {
        .table thead th {
            font-size: 0.55rem;
            padding: 0.3rem 0.2rem;
        }

        .table tbody td {
            font-size: 0.65rem;
            padding: 0.3rem 0.2rem;
        }

        .disp-pill {
            font-size: 0.6rem;
            padding: 0.1rem 0.3rem;
        }

        .estado-pill {
            font-size: 0.6rem;
            padding: 0.1rem 0.4rem;
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
            <i class="bi bi-diagram-3-fill" style="color: var(--color-secondary-1);"></i>
            Historial de Tiquetes — Dispersión de Pago
        </div>

        <div class="info-banner">
            <i class="bi bi-info-circle-fill"></i>
            En los pagos con <strong>dispersión</strong>, el monto total se divide automáticamente entre la aerolínea
            y los impuestos aeroportuarios. Aquí puedes ver el desglose de cada tiquete.
        </div>

        <?php if (!empty($verify_msg)): ?>
            <div class="alert-verify"><?= htmlspecialchars($verify_msg) ?></div>
        <?php endif; ?>

        <?php if (count($registros) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Destino</th>
                            <th>Tipo</th>
                            <th>Vuelo (aerolínea)</th>
                            <th>Impuestos</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $row): ?>
                            <tr>
                                <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>
                                <td style="font-weight:600;">✈️ <?= htmlspecialchars($row['destino']) ?></td>
                                <td><span class="disp-pill"><i class="bi bi-diagram-3-fill"></i> Dispersión</span>
                                </td>
                                <td class="desglose-cell">
                                    <span class="desglose-vuelo">$<?= number_format($row['precio_base'], 0, ',', '.') ?>
                                        COP</span>
                                </td>
                                <td class="desglose-cell">
                                    <span class="desglose-imp">$<?= number_format($row['impuesto'], 0, ',', '.') ?>
                                        COP</span>
                                </td>
                                <td class="precio-link">$<?= number_format($row['precio_total'], 0, ',', '.') ?> COP
                                </td>
                                <td>
                                    <span class="estado-pill badge-<?= strtolower($row['estado']) ?>">
                                        <?= strtoupper($row['estado']) ?>
                                    </span>
                                </td>
                                <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                        <a href="../php/verificar_pago.php?tabla=dispersiones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-disp.php"
                                            class="btn-verificar">
                                            <i class="bi bi-arrow-repeat"></i> Verificar
                                        </a>
                                    <?php else: ?>
                                        <span style="color:var(--text-muted); font-size:0.75rem;">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-airplane" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes tiquetes registrados aún.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="paginacion.css">
    <style>
        :root {
            --pag-accent: #00CFB4;
        }
    </style>
    <script src="paginacion.js"></script>
</body>

</html>