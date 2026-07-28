<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Preautorizaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/reg-prea.css">

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="bi bi-shield-lock-fill" style="color: var(--color-secondary-3);"></i>
            Historial de Preautorizaciones
        </div>

        <div class="info-banner">
            <i class="bi bi-info-circle-fill"></i>
            Las <strong>preautorizaciones</strong> reservan el monto en tu tarjeta sin cobrarlo. El cargo real se
            realiza al hacer check-out en el hotel. Si ves estado <strong>Pendiente</strong>, puedes verificar el
            estado actual con el botón correspondiente.
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
                            <th>Habitación</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $row): ?>
                            <tr>
                                <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>
                                <td style="font-weight:600;">🏨 <?= htmlspecialchars($row['habitacion']) ?></td>
                                <td style="font-size:0.82rem;color:var(--text-secondary);max-width:200px;">
                                    <?= htmlspecialchars($row['descripcion']) ?>
                                </td>
                                <td class="precio-link">
                                    $<?= number_format($row['precio'], 0, ',', '.') ?>
                                    <span
                                        style="font-size:0.72rem;color:var(--text-secondary);"><?= htmlspecialchars($row['moneda']) ?></span>
                                </td>
                                <td><span class="preauth-pill"><i class="bi bi-shield-lock-fill"></i> Check-in</span>
                                </td>
                                <td>
                                    <span class="estado-pill badge-<?= strtolower($row['estado']) ?>">
                                        <?= strtoupper($row['estado']) ?>
                                    </span>
                                </td>
                                <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                        <a href="../php/verificar_pago.php?tabla=reservaciones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-prea.php"
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
                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes reservaciones registradas aún.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="paginacion.css">
    <style>
        :root {
            --pag-accent: #0062A8;
        }
    </style>
    <script src="paginacion.js"></script>
</body>

</html>