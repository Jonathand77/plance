<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Suscripción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_suscription.css">
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($nuevo_estado === 'aprobada' && !empty($token)): ?>
            <div class="token-box">
                <i class="bi bi-shield-lock-fill"></i>
                <span>🔐 <strong>Tarjeta tokenizada</strong> — Tu medio de pago quedó registrado de forma segura para
                    futuros cobros.</span>
            </div>
        <?php endif; ?>

        <?php if ($subs): ?>
            <div class="order-details">
                <div class="order-row"><span>Suscripción #</span><span>#<?= htmlspecialchars($subs['id']) ?></span></div>
                <div class="order-row"><span>Servicio</span><span><?= htmlspecialchars($subs['servicio']) ?></span></div>
                <div class="order-row"><span>Plan</span><span><?= htmlspecialchars($subs['plan']) ?></span></div>
                <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($subs['usuario_id']) ?></span></div>
                <div class="order-row"><span>Precio</span><span>$<?= number_format($subs['precio'], 0, ',', '.') ?>
                        COP</span></div>
                <div class="order-row">
                    <span>Token</span>
                    <span class="token-estado <?= !empty($token) ? 'token-guardado' : 'token-no' ?>">
                        <?= !empty($token) ? '✅ Guardado' : '— No tokenizado' ?>
                    </span>
                </div>
                <div class="order-row"><span>Estado</span><span><span
                            class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span></div>
            </div>
        <?php endif; ?>

        <a href="sesiones.php" class="btn-home">← Inicio</a>
        <a href="plataformas/otras_streaming.php" class="btn-volver">Ver planes</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>