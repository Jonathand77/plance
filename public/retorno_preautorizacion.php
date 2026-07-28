<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Reservaciones\PreauthorizationController;

$__view = (new PreauthorizationController())->handleReturn($_GET, $_SESSION);

$reserva_id = $__view['reservaId'];
$habitacion = $__view['habitacion'];
$total = $__view['total'];
$correo = $__view['correo'];
$requestId = $__view['requestId'];
$checkin = $__view['checkin'];
$checkout = $__view['checkout'];
$noches = $__view['noches'];
$nombre = $__view['nombre'];
$gw_status = $__view['gwStatus'];
$gw_reason = $__view['gwReason'];
$nuevo_estado = $__view['nuevoEstado'];

// Colores usando la nueva paleta estandarizada
if ($gw_status === 'APPROVED') {
    $icono = '🏨';
    $titulo = '¡Reserva confirmada!';
    $mensaje = 'Tu habitación ha sido reservada exitosamente. La preautorización fue aprobada — tu tarjeta no ha sido cobrada aún.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
} elseif ($gw_status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Reserva pendiente';
    $mensaje = 'Tu reserva está siendo procesada. Te notificaremos cuando se confirme la preautorización.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
    $bg_estado = 'rgba(255,108,12,0.12)';
} elseif ($gw_reason === 'EX') {
    $icono = '⏱️';
    $titulo = 'Sesión expirada';
    $mensaje = 'El tiempo para completar la preautorización se agotó y la sesión de pago venció. Tu tarjeta no fue afectada. Vuelve a intentar la reserva.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
    $bg_estado = 'rgba(125,134,140,0.12)';
} elseif ($gw_reason === '¬C') {
    $icono = '✋';
    $titulo = 'Pago cancelado';
    $mensaje = 'Cancelaste el proceso de preautorización antes de completarlo. Tu tarjeta no fue afectada. Puedes volver a intentar la reserva cuando quieras.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
    $bg_estado = 'rgba(125,134,140,0.12)';
} else {
    $icono = '❌';
    $titulo = 'Reserva rechazada';
    $mensaje = 'No se pudo procesar la preautorización. Por favor intenta con otra tarjeta o contacta a tu banco.';
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
    <title>Resultado — Preautorización</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_preautorizacion.css">
</head>

<body>
    <div class="result-card"
        style="--title-color: <?= $color ?>; --bg-icon: <?= $bg_icon ?>; --bg-estado: <?= $bg_estado ?>;">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-msg"><?= $mensaje ?></p>

        <div class="pre-badge">
            <i class="bi bi-shield-lock-fill"></i>
            Preautorización (Check-in) · Web Checkout · PlacetoPay
        </div>

        <?php if ($gw_status === 'APPROVED'): ?>
            <!-- Fechas de estadía -->
            <div class="stay-box">
                <div class="stay-item">
                    <div class="stay-label">Check-in</div>
                    <div class="stay-date"><?= htmlspecialchars($checkin) ?></div>
                </div>
                <div class="stay-sep">→</div>
                <div class="stay-item">
                    <div class="stay-label">Check-out</div>
                    <div class="stay-date"><?= htmlspecialchars($checkout) ?></div>
                </div>
                <div class="stay-sep">·</div>
                <div class="stay-item">
                    <div class="stay-label">Noches</div>
                    <div class="stay-date"><?= $noches ?></div>
                </div>
            </div>

            <div class="preauth-aviso">
                ⚠️ <strong>Recuerda:</strong> Esta es una <strong>preautorización</strong> — tu tarjeta no ha sido cobrada.
                El cargo se realizará al momento del check-out en el hotel.
            </div>
        <?php endif; ?>

        <div class="order-details">
            <div class="order-row"><span>Reserva #</span><span>#<?= $reserva_id ?></span></div>
            <div class="order-row"><span>Habitación</span><span><?= htmlspecialchars($habitacion) ?></span></div>
            <?php if ($nombre): ?>
                <div class="order-row"><span>Huésped</span><span><?= htmlspecialchars($nombre) ?></span></div>
            <?php endif; ?>
            <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($correo) ?></span></div>
            <div class="order-row">
                <span>Monto preautorizado</span>
                <span style="color:var(--title-color);font-size:1.05rem;">$<?= number_format($total, 0, ',', '.') ?>
                    COP</span>
            </div>
            <div class="order-row"><span>Referencia</span><span
                    style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($requestId) ?></span>
            </div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="reservasiones/hotel.php" class="btn-volver">Ver habitaciones</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>