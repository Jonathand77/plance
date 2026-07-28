<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Suscripción Música</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_suscription_gateway.css">
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= htmlspecialchars($mensaje) ?></p>

        <div class="gw-badge">
            <i class="bi bi-cpu-fill"></i>
            Procesado via <strong>API Gateway</strong> · Evertec PlacetoPay
        </div>

        <?php if ($status === 'APPROVED' && !empty($token)): ?>
            <div class="token-box">
                <i class="bi bi-shield-lock-fill"></i>
                <span>🔐 <strong>Tarjeta tokenizada</strong> — Tu medio de pago quedó registrado de forma segura para
                    futuros cobros.</span>
            </div>
        <?php endif; ?>

        <div class="order-details">
            <div class="order-row"><span>Orden #</span><span>#<?= htmlspecialchars($orden_id) ?></span></div>
            <div class="order-row"><span>Servicio</span><span><?= htmlspecialchars($servicio) ?></span></div>
            <div class="order-row"><span>Plan</span><span><?= htmlspecialchars($plan) ?></span></div>
            <div class="order-row"><span>Nombre</span><span><?= htmlspecialchars($nombre) ?></span></div>
            <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($correo) ?></span></div>
            <div class="order-row"><span>Total</span><span
                    style="color:<?= $color ?>;font-size:1.1rem;">$<?= number_format((float) $precio, 0, ',', '.') ?>
                    COP</span></div>
            <div class="order-row">
                <span>Token</span>
                <span class="token-estado <?= !empty($token) ? 'token-guardado' : 'token-no' ?>">
                    <?= !empty($token) ? '✔ Guardado' : '— No tokenizado' ?>
                </span>
            </div>
            <?php if (!empty($reference)): ?>
                <div class="order-row"><span>Referencia</span><span
                        style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($reference) ?></span>
                </div>
            <?php endif; ?>
            <div class="order-row"><span>Estado</span><span><span
                        class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span></div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="plataformas/music_gateway.php" class="btn-volver">Ver planes</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>