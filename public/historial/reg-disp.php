<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

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
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/reg-disp.css">

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