<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Pago Mixto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_mixto.css">
</head>

<body>
    <div class="result-card"
        style="--title-color: <?= $color ?>; --bg-icon: <?= $bg_icon ?>; --bg-estado: <?= $bg_estado ?>;">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-msg"><?= $mensaje ?></p>

        <div class="mix-badge">
            <i class="bi bi-shuffle"></i>
            <?= $allow_partial ? 'Pago <strong>mixto / parcial</strong> · Web Checkout · PlacetoPay' : 'Pago <strong>múltiple</strong> · Web Checkout · PlacetoPay' ?>
        </div>

        <?php if ($allow_partial): ?>
            <div class="pago-breakdown">
                <div class="breakdown-title">Desglose del pago</div>
                <div class="breakdown-row">
                    <span>Total del pedido</span>
                    <span>$<?= number_format($total, 0, ',', '.') ?> COP</span>
                </div>
                <div class="breakdown-row">
                    <span>Monto pagado ahora</span>
                    <span
                        style="color:var(--color-secondary-1);">$<?= number_format($monto_pagado ?? $monto_parcial, 0, ',', '.') ?>
                        COP</span>
                </div>
                <div class="breakdown-row">
                    <span>Saldo restante</span>
                    <span
                        style="color:var(--color-primary);">$<?= number_format($total - ($monto_pagado ?? $monto_parcial), 0, ',', '.') ?>
                        COP</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="order-details">
            <div class="order-row"><span>Orden #</span><span>#<?= $orden_id ?></span></div>
            <div class="order-row"><span>Productos</span><span
                    style="font-size:0.8rem;text-align:right;max-width:60%;"><?= htmlspecialchars($productos) ?></span>
            </div>
            <div class="order-row"><span>Referencia</span><span
                    style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($reference) ?></span>
            </div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="games/rainbowsix.php" class="btn-volver">Ver tienda</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>