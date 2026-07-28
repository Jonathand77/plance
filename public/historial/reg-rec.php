<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialRecurrenciasController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialRecurrenciasController())->handleList();
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
$cancel_msg = $__view['cancelMsg'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Membresías Recurrentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
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

    .recurrente-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: rgba(0, 98, 168, 0.12);
        color: var(--color-secondary-3);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
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

    .btn-cancelar {
        background: rgba(220, 53, 69, 0.12);
        border: 1px solid rgba(220, 53, 69, 0.25);
        color: #dc3545;
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

    .btn-cancelar:hover {
        background: rgba(220, 53, 69, 0.25);
        color: #dc3545;
        text-decoration: none;
        border-color: #dc3545;
    }

    .alert-cancel {
        background: rgba(220, 53, 69, 0.12);
        color: #dc3545;
        border: 1px solid rgba(220, 53, 69, 0.3);
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

    .precio-link {
        color: var(--color-secondary-3);
        font-weight: 700;
    }

    .fecha-creacion {
        color: var(--color-secondary-5);
        font-size: 0.8rem;
    }

    .fecha-proximo {
        color: var(--text-main);
    }

    .fecha-fin {
        color: var(--color-primary);
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

        .btn-verificar,
        .btn-cancelar {
            font-size: 0.65rem;
            padding: 0.15rem 0.4rem;
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
            <i class="bi bi-calendar-check-fill" style="color: var(--color-secondary-3);"></i>
            Historial de Membresías Recurrentes
        </div>

        <?php if (!empty($verify_msg)): ?>
            <div class="alert-verify"><?= htmlspecialchars($verify_msg) ?></div>
        <?php endif; ?>
        <?php if (!empty($cancel_msg)): ?>
            <div class="alert-cancel"><?= htmlspecialchars($cancel_msg) ?></div>
        <?php endif; ?>

        <?php if (count($registros) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Servicio</th>
                            <th>Plan</th>
                            <th>Correo</th>
                            <th>Precio / mes</th>
                            <th>Próximo cobro</th>
                            <th>Fin recurrencia</th>
                            <th>Periodicidad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $row): ?>
                            <tr>
                                <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>
                                <td><?= htmlspecialchars($row['servicio']) ?></td>
                                <td><?= htmlspecialchars($row['plan']) ?></td>
                                <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                <td class="precio-link">
                                    $<?= number_format($row['precio'], 0, ',', '.') ?> COP
                                </td>
                                <td class="fecha-proximo">
                                    <?= !empty($row['next_payment']) ? htmlspecialchars($row['next_payment']) : '—' ?>
                                </td>
                                <td class="fecha-fin">
                                    <?= !empty($row['fecha_fin']) ? htmlspecialchars($row['fecha_fin']) : '—' ?>
                                </td>
                                <td>
                                    <span class="recurrente-badge">
                                        <i class="bi bi-arrow-repeat"></i>
                                        <?= $row['periodicidad'] === 'M' ? 'Mensual' : htmlspecialchars($row['periodicidad']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="estado-pill badge-<?= strtolower($row['estado']) ?>">
                                        <?= strtoupper($row['estado']) ?>
                                    </span>
                                </td>
                                <td class="fecha-creacion">
                                    <?= htmlspecialchars($row['created_at']) ?>
                                </td>
                                <td>
                                    <div style="display:flex; flex-direction:column; gap:0.3rem;">
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=recurrencias&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-rec.php"
                                                class="btn-verificar">
                                                <i class="bi bi-arrow-repeat"></i> Verificar
                                            </a>
                                        <?php elseif (strtolower($row['estado']) === 'aprobada'): ?>
                                            <a href="../php/cancelar_rec.php?id=<?= $row['id'] ?>" class="btn-cancelar"
                                                onclick="return confirm('⚠️ ¿Estás seguro de cancelar esta membresía? Esta acción no se puede deshacer.')">
                                                <i class="bi bi-x-circle-fill"></i> Cancelar
                                            </a>
                                        <?php else: ?>
                                            <span style="color:var(--color-secondary-2); font-size:0.75rem;">—</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-arrow-repeat" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes membresías recurrentes registradas aún.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>