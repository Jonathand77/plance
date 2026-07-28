<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Continuación de pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_continuar.css">
</head>

<body>
    <div class="result-card"
        style="--title-color: <?= $color ?>; --bg-icon: <?= $bg_icon ?>; --bg-estado: <?= $bg_estado ?>;">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-msg"><?= $mensaje ?></p>

        <div class="mix-badge">
            <i class="bi bi-shuffle"></i>
            Continuación de pago mixto · Web Checkout · PlacetoPay
        </div>

        <!-- Desglose actualizado -->
        <div class="breakdown">
            <div class="breakdown-title">Desglose del pago</div>
            <div class="breakdown-row">
                <span>Total del pedido</span>
                <span style="font-weight:700;">$<?= number_format($total, 0, ',', '.') ?> COP</span>
            </div>
            <div class="breakdown-row">
                <span>Abono anterior</span>
                <span style="color:var(--text-secondary);">$<?= number_format($monto_previo, 0, ',', '.') ?> COP</span>
            </div>
            <div class="breakdown-row">
                <span>Abono ahora</span>
                <span
                    style="color:var(--color-secondary-1);font-weight:700;">$<?= number_format($monto_ahora, 0, ',', '.') ?>
                    COP</span>
            </div>
            <div class="breakdown-row">
                <span style="font-weight:700;">Saldo restante</span>
                <span
                    style="color:<?= $saldo_final <= 0 ? 'var(--color-secondary-1)' : 'var(--color-primary)' ?>;font-weight:800;font-size:1rem;">
                    <?= $saldo_final <= 0 ? '✅ $0 — Pagado completo' : '$' . number_format($saldo_final, 0, ',', '.') . ' COP' ?>
                </span>
            </div>
        </div>

        <div class="order-details">
            <div class="order-row"><span>Orden #</span><span>#<?= $orden_id ?></span></div>
            <div class="order-row"><span>Producto</span><span
                    style="font-size:0.82rem;"><?= htmlspecialchars($row['producto']) ?></span></div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="historial/reg-pgb.php?modo=mixto" class="btn-volver">Ver historial</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>