<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Tiquete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_dispersion.css">
</head>

<body>
    <div class="result-card"
        style="--title-color: <?= $color ?>; --bg-icon: <?= $bg_icon ?>; --bg-estado: <?= $bg_estado ?>;">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-msg"><?= $mensaje ?></p>

        <div class="disp-badge">
            <i class="bi bi-diagram-3-fill"></i>
            Dispersión de pago · Web Checkout · PlacetoPay
        </div>

        <?php if ($gw_status === 'APPROVED'): ?>
            <!-- Desglose dispersión -->
            <div class="disp-box">
                <div class="disp-title">💸 Distribución del pago</div>
                <div class="disp-row">
                    <span>✈️ Aerolínea (vuelo)</span>
                    <span style="color:var(--color-secondary-1);font-weight:700;">$<?= number_format($base, 0, ',', '.') ?>
                        COP</span>
                </div>
                <div class="disp-row">
                    <span>🏛️ Impuestos aeroportuarios</span>
                    <span style="color:var(--color-primary);font-weight:700;">$<?= number_format($impuesto, 0, ',', '.') ?>
                        COP</span>
                </div>
                <div class="disp-row total">
                    <span>Total dispersado</span>
                    <span>$<?= number_format($total, 0, ',', '.') ?> COP</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="order-details">
            <div class="order-row"><span>Tiquete #</span><span>#<?= $disp_id ?></span></div>
            <div class="order-row"><span>Destino</span><span>✈️ <?= htmlspecialchars($destino) ?></span></div>
            <div class="order-row"><span>Total</span><span
                    style="color:var(--title-color);font-size:1.05rem;">$<?= number_format($total, 0, ',', '.') ?>
                    COP</span></div>
            <div class="order-row"><span>Referencia</span><span
                    style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($requestId) ?></span>
            </div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="dispersiones/tickets.php" class="btn-volver">Ver tiquetes</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>