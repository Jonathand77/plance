<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de transacción | Plance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/estados-gateway.css">
</head>

<body>
    <div class="main-card">

        <div class="demo-banner">
            <strong>⚠️ Simulación API Gateway</strong>
            Elige el estado que deseas simular para esta transacción
        </div>

        <div class="card-title-main">¡Transacción de prueba!</div>
        <div class="card-subtitle">
            Selecciona el resultado que quieres ver.<br>
            En producción real, PlacetoPay determina este estado automáticamente.
        </div>

        <!-- Info producto -->
        <div class="product-info">
            <span class="product-info-name">🎮 <?= htmlspecialchars($producto) ?></span>
            <span class="product-info-price">$<?= number_format((float) $precio, 0, ',', '.') ?> COP</span>
        </div>

        <!-- Selector de estado -->
        <span class="estado-label">Estado de la transacción</span>
        <div class="estados-grid">
            <div class="estado-btn aprobada selected" onclick="selectEstado('aprobada', this)">
                <span class="check">✔</span>
                <div class="estado-icon">✔</div>
                <div class="estado-name">Aprobada</div>
            </div>
            <div class="estado-btn pendiente" onclick="selectEstado('pendiente', this)">
                <span class="check">✔</span>
                <div class="estado-icon">⏳</div>
                <div class="estado-name">Pendiente</div>
            </div>
            <div class="estado-btn rechazada" onclick="selectEstado('rechazada', this)">
                <span class="check">✔</span>
                <div class="estado-icon">❌</div>
                <div class="estado-name">Rechazada</div>
            </div>
        </div>

        <!-- Selector de razón -->
        <div class="razon-wrap">
            <span class="estado-label">Razón</span>
            <select class="razon-select" id="razonSelect">
                <!-- Opciones aprobada -->
                <option value="APPROVED_TRANSACTION" data-estado="aprobada">APPROVED_TRANSACTION (00)</option>
                <!-- Opciones pendiente -->
                <option value="PENDING_TRANSACTION" data-estado="pendiente">PENDING_TRANSACTION (?-)</option>
                <option value="PENDING_VALIDATION" data-estado="pendiente">PENDING_VALIDATION (?V)</option>
                <!-- Opciones rechazada -->
                <option value="CANCELLED_TRANSACTION" data-estado="rechazada">CANCELLED_TRANSACTION (?C)</option>
                <option value="FAILED_TRANSACTION" data-estado="rechazada">FAILED_TRANSACTION (?F)</option>
                <option value="REJECTED_TRANSACTION" data-estado="rechazada">REJECTED_TRANSACTION (?R)</option>
            </select>
        </div>

        <!-- Formulario oculto -->
        <form method="POST" action="php/crear_pb_gateway.php" id="estadoForm">
            <input type="hidden" name="estado_elegido" id="estadoElegido" value="aprobada">
            <input type="hidden" name="razon_elegida" id="razonElegida" value="APPROVED_TRANSACTION">
            <?php foreach ($_SESSION['gw_pending'] as $key => $value): ?>
                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
            <?php endforeach; ?>
        </form>

        <button class="btn-procesar" id="btnProcesar" onclick="procesar()">
            <i class="bi bi-play-circle-fill"></i> Procesar transacción
        </button>
        <a href="javascript:history.back()" class="cancel-link">← Cancelar y volver</a>

    </div>

    <script src="assets/js/pages/estados-gateway.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>