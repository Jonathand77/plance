<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de suscripción | Plance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/estados-subs-gateway.css">
</head>

<body>
    <div class="main-card">

        <div class="demo-banner">
            <strong>⚠️ Simulación API Gateway — Suscripción</strong>
            Elige el estado que deseas simular para esta transacción
        </div>

        <div class="card-title-main">¡Transacción de prueba!</div>
        <div class="card-subtitle">
            Selecciona el resultado que quieres ver.<br>
            En producción real, PlacetoPay determina este estado automáticamente.
        </div>

        <div class="product-info">
            <span class="product-info-name">
                <?= $es_pago_sub ? '📺' : '🎵' ?>
                <?= htmlspecialchars($servicio) ?> — <?= htmlspecialchars($plan) ?>
            </span>
            <span class="product-info-price">$<?= number_format((float) $precio, 0, ',', '.') ?> COP</span>
        </div>

        <span class="estado-label">Estado de la transacción</span>
        <div class="estados-grid">
            <div class="estado-btn aprobada-token selected" onclick="selectEstado('aprobada-token', this)">
                <span class="check">✔</span>
                <div class="estado-icon">💳</div>
                <div class="estado-name">Aprobada + Token</div>
                <div class="estado-desc">Pago exitoso y tarjeta guardada</div>
            </div>
            <div class="estado-btn aprobada-sin" onclick="selectEstado('aprobada-sin', this)">
                <span class="check">✔</span>
                <div class="estado-icon">✔</div>
                <div class="estado-name">Aprobada</div>
                <div class="estado-desc">Pago exitoso sin tokenizar</div>
            </div>
            <div class="estado-btn pendiente" onclick="selectEstado('pendiente', this)">
                <span class="check">✔</span>
                <div class="estado-icon">⏳</div>
                <div class="estado-name">Pendiente</div>
                <div class="estado-desc">En proceso de verificación</div>
            </div>
            <div class="estado-btn rechazada" onclick="selectEstado('rechazada', this)">
                <span class="check">✔</span>
                <div class="estado-icon">❌</div>
                <div class="estado-name">Rechazada</div>
                <div class="estado-desc">No se pudo procesar</div>
            </div>
        </div>

        <div class="razon-wrap">
            <span class="estado-label">Razón</span>
            <select class="razon-select" id="razonSelect">
                <option value="APPROVED_TRANSACTION">APPROVED_TRANSACTION (00) — Con token</option>
            </select>
        </div>

        <form method="POST"
            action="php/<?= $es_pago_sub ? 'crear_suscripciones_gateway' : 'crear_suscription_gateway' ?>.php"
            id="estadoForm">
            <input type="hidden" name="estado_elegido" id="estadoElegido" value="aprobada-token">
            <input type="hidden" name="razon_elegida" id="razonElegida" value="APPROVED_TRANSACTION">
            <?php foreach ($data as $key => $value): ?>
                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
            <?php endforeach; ?>
        </form>

        <button class="btn-procesar" id="btnProcesar" onclick="procesar()">
            <i class="bi bi-play-circle-fill"></i> Procesar transacción
        </button>
        <a href="javascript:history.back()" class="cancel-link">← Cancelar y volver</a>
    </div>

    <script src="assets/js/pages/estados-subs-gateway.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>