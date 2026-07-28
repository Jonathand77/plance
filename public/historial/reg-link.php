<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialLinksController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialLinksController())->handleList();
$registros = $__view['registros'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Links de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/reg-link.css">

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="fa-solid fa-link" style="color: var(--color-primary);"></i>
            Historial de Links de Pago
        </div>

        <?php if (count($registros) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Referencia</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Pagos</th>
                            <th>Expira</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $row):
                            $estado = strtolower($row['estado']);
                            $expirado = !empty($row['expiracion']) && strtotime($row['expiracion']) < time();
                            if ($estado === 'activo' && $expirado)
                                $estado_show = 'expirado';
                            else
                                $estado_show = $estado;
                            ?>
                            <tr>
                                <td><span style="color:var(--color-secondary-5);">#<?= htmlspecialchars($row['id']) ?></span>
                                </td>
                                <td><?= htmlspecialchars($row['producto']) ?></td>
                                <td class="precio-link">$<?= number_format((float) $row['precio'], 0, ',', '.') ?> COP</td>
                                <td><code class="codigo-ref"><?= htmlspecialchars($row['referencia']) ?></code></td>
                                <td><code class="codigo-correo"><?= htmlspecialchars($row['correo']) ?></code></td>
                                <td>
                                    <span class="estado-pill badge-<?= $estado_show ?>">
                                        <?= strtoupper($estado_show) ?>
                                    </span>
                                </td>
                                <td style="text-align:center; color:var(--text-main);"><?= (int) ($row['pagos_usados'] ?? 0) ?>
                                </td>
                                <td class="fecha-expira">
                                    <?= !empty($row['expiracion']) ? htmlspecialchars($row['expiracion']) : '—' ?></td>
                                <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <?php if (!empty($row['link_url']) && $estado === 'activo' && !$expirado): ?>
                                        <div style="display:flex; gap:0.3rem; flex-wrap:wrap;">
                                            <a href="<?= htmlspecialchars($row['link_url']) ?>" target="_blank"
                                                class="btn-link-action">
                                                <i class="bi bi-box-arrow-up-right"></i> Abrir
                                            </a>
                                            <button type="button" class="btn-link-action btn-copy"
                                                data-link="<?= htmlspecialchars($row['link_url'], ENT_QUOTES) ?>"
                                                onclick="copyLink(this)">
                                                <i class="bi bi-clipboard"></i> Copiar
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <span style="color:var(--color-secondary-2); font-size:0.75rem;">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No hay links de pago generados aún.
            </div>
        <?php endif; ?>
    </div>

    <script>
        function copyLink(btn) {
            const link = btn.getAttribute('data-link');
            navigator.clipboard.writeText(link).then(function () {
                const original = btn.innerHTML;
                btn.classList.add('copied');
                btn.innerHTML = '<i class="bi bi-check2"></i> Copiado';
                setTimeout(function () {
                    btn.classList.remove('copied');
                    btn.innerHTML = original;
                }, 2000);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>