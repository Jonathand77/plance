<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Dispersiones\DispersionController;

$__view = (new DispersionController())->handleReturn($_GET);

$disp_id = $__view['dispersionId'];
$destino = $__view['destino'];
$total = $__view['total'];
$base = $__view['base'];
$impuesto = $__view['impuesto'];
$requestId = $__view['requestId'];
$gw_status = $__view['gwStatus'];
$nuevo_estado = $__view['nuevoEstado'];

// Colores usando la nueva paleta estandarizada
if ($gw_status === 'APPROVED') {
    $icono = '✅';
    $titulo = '¡Tiquete confirmado!';
    $mensaje = 'Tu pago fue procesado y dispersado exitosamente entre la aerolínea y los impuestos aeroportuarios.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
} elseif ($gw_status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos cuando se confirme.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
    $bg_estado = 'rgba(255,108,12,0.12)';
} else {
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = 'No se pudo procesar el pago. Por favor intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
    $bg_estado = 'rgba(220,53,69,0.12)';
}
?>
<!DOCTYPE html>
<html lang="es">

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