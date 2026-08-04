<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Membresía Recurrente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_rec.css">
</head>

<body>
    <div class="result-card">

        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($rec): ?>
            <div class="order-details">
                <div class="order-row">
                    <span>Recurrencia #</span>
                    <span><?= htmlspecialchars($rec['id']) ?></span>
                </div>
                <div class="order-row">
                    <span>Servicio</span>
                    <span><?= htmlspecialchars($rec['servicio']) ?></span>
                </div>
                <div class="order-row">
                    <span>Plan</span>
                    <span><?= htmlspecialchars($rec['plan']) ?></span>
                </div>
                <div class="order-row">
                    <span>Correo</span>
                    <span><?= htmlspecialchars($rec['usuario_id']) ?></span>
                </div>
                <div class="order-row">
                    <span>Total / mes</span>
                    <span>$<?= number_format($rec['precio'], 0, ',', '.') ?> COP</span>
                </div>
                <div class="order-row">
                    <span>Próximo cobro</span>
                    <span><?= htmlspecialchars($rec['next_payment'] ?? 'N/A') ?></span>
                </div>
                <div class="order-row">
                    <span>Fin de recurrencia</span>
                    <span
                        class="fecha-fin"><?= $nuevo_estado === 'aprobada' ? date('Y-m-d', strtotime('+12 months')) : 'N/A' ?></span>
                </div>
                <div class="order-row">
                    <span>Estado</span>
                    <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
                </div>
            </div>

            <?php if ($nuevo_estado === 'aprobada'): ?>
                <div class="recurring-detail">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>
                        Tu membresía se renovará automáticamente cada mes durante <strong>12 meses</strong>.<br>
                        Próximo cobro: <strong><?= htmlspecialchars($rec['next_payment'] ?? 'N/A') ?></strong><br>
                        Fin de recurrencia: <strong><?= date('Y-m-d', strtotime('+12 months')) ?></strong>
                    </span>
                </div>
            <?php endif; ?>

        <?php endif; ?>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="plataformas/redes.php" class="btn-volver">Ver planes</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>