<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscripcionController;

$__view = (new SuscripcionController())->handleReturn($_GET);

$sub_id = $__view['subId'];
$token = $__view['token'];
$subs = $__view['subs'];

// ══════════════════════════════════════════
// Determinar estado del pago - usando nueva paleta
// ══════════════════════════════════════════
$status_p2p = $__view['statusP2p'];

if ($status_p2p === 'APPROVED') {
    $nuevo_estado = 'aprobada';
    $icono = '✅';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0, 207, 180, 0.15)';
} elseif ($status_p2p === 'REJECTED') {
    $nuevo_estado = 'rechazada';
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = 'Tu pago no pudo ser procesado. Intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220, 53, 69, 0.15)';
} elseif ($status_p2p === 'PENDING') {
    $nuevo_estado = 'pendiente';
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos pronto.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255, 108, 12, 0.15)';
} else {
    $nuevo_estado = 'cancelada';
    $icono = '🚫';
    $titulo = 'Suscripción cancelada';
    $mensaje = 'Cancelaste el proceso de pago.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125, 134, 140, 0.15)';
}

// (Estado y token ya actualizados en BD por SuscripcionController::handleReturn())

// ── Definir título y mensaje según si hay token ──
if ($status_p2p === 'APPROVED') {
    if (!empty($token)) {
        $titulo = '¡Suscripción activada!';
        $mensaje = 'Tu suscripción fue procesada y tu tarjeta quedó guardada para futuros cobros. ¡Disfrútala!';
    } else {
        $titulo = '¡Pago aprobado!';
        $mensaje = 'Tu pago fue exitoso. Guarda tu tarjeta para activar la suscripción completa y agilizar futuros pagos.';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de suscripción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_subs.css">
</head>

<body>
    <div class="result-card">

        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($nuevo_estado === 'aprobada' && empty($token)): ?>
            <a href="php/tokenizar.php?sub=<?= $sub_id ?>" class="btn-tokenizar">
                🔐 Guardar tarjeta para futuros cobros
            </a>
        <?php endif; ?>

        <?php if ($nuevo_estado === 'aprobada' && !empty($token)): ?>
            <div class="token-guardado">
                🔐 <strong>Tarjeta guardada</strong> — Tus próximos pagos serán automáticos.
            </div>
        <?php endif; ?>

        <?php if ($subs): ?>
            <div class="order-details">
                <div class="order-row">
                    <span>Suscripción #</span>
                    <span><?= htmlspecialchars($subs['id']) ?></span>
                </div>
                <div class="order-row">
                    <span>Plataforma</span>
                    <span><?= htmlspecialchars($subs['plataforma']) ?></span>
                </div>
                <div class="order-row">
                    <span>Plan</span>
                    <span><?= htmlspecialchars($subs['plan']) ?></span>
                </div>
                <div class="order-row">
                    <span>Correo</span>
                    <span><?= htmlspecialchars($subs['usuario_id']) ?></span>
                </div>
                <div class="order-row">
                    <span>Total</span>
                    <span>$<?= number_format($subs['precio'], 0, ',', '.') ?> COP</span>
                </div>
                <div class="order-row">
                    <span>Estado</span>
                    <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
                </div>
            </div>
        <?php endif; ?>

        <a href="sesiones.php" class="btn-home">← Inicio</a>
        <a href="plataformas/streaming.php" class="btn-volver">Ver planes</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>