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
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/reg-rec.css">

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