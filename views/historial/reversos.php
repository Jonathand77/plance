<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reversos — Transacciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/reversos.css">

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="bi bi-arrow-counterclockwise"></i> Transacciones para Reverso
        </div>

        <?php if ($msg): ?>
            <div class="alert-<?= $msg_type === 'success' ? 'success' : 'error' ?>-custom">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <?php if (count($transacciones) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Tipo</th>
                            <th>Producto / Servicio</th>
                            <th>Usuario</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transacciones as $trx): ?>
                            <tr>
                                <td><span style="color:var(--color-secondary-5);">#<?= htmlspecialchars($trx['id']) ?></span>
                                </td>
                                <td>
                                    <span class="tipo-badge tipo-<?= $trx['tipo'] ?>">
                                        <?= $trx['tipo'] === 'orden' ? '<i class="bi bi-controller"></i> Juego' : ($trx['tipo'] === 'suscripcion' ? '<i class="bi bi-tv"></i> Suscripción' : '🔄 Recurrencia') ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($trx['nombre']) ?></td>
                                <td><code class="codigo-usuario"><?= htmlspecialchars($trx['usuario']) ?></code></td>
                                <td class="precio-aprobado">$<?= number_format($trx['precio'], 0, ',', '.') ?> COP</td>
                                <td>
                                    <span class="estado-pill badge-<?= strtolower($trx['estado']) ?>">
                                        <?= strtoupper($trx['estado']) ?>
                                    </span>
                                </td>
                                <td class="fecha-creacion"><?= htmlspecialchars($trx['created_at']) ?></td>
                                <td>
                                    <a href="detalle_reverso.php?id=<?= $trx['id'] ?>&tipo=<?= $trx['tipo'] ?>"
                                        class="btn-detalle">
                                        <i class="bi bi-eye-fill"></i> Ver detalle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-arrow-counterclockwise" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes transacciones aprobadas disponibles para reverso.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>