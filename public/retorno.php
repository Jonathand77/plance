<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Ordenes\OrdenController;

$__view = (new OrdenController())->handleReturn($_GET, $_SESSION);

$order_id = $__view['orderId'];
$orden = $__view['orden'];

// ══════════════════════════════════════════
// Determinar estado del pago - usando nueva paleta
// ══════════════════════════════════════════
$status_p2p = $__view['statusP2p'];

// Mapear estado de PlaceToPay a nuestro estado en BD
if ($status_p2p === 'APPROVED') {
    $nuevo_estado = 'aprobada';
    $icono = '✅';
    $titulo = '¡Pago aprobado!';
    $mensaje = 'Tu recarga fue procesada exitosamente.';
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
    // CANCELED u otro
    $nuevo_estado = 'cancelada';
    $icono = '🚫';
    $titulo = 'Pago cancelado';
    $mensaje = 'Cancelaste el proceso de pago.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125, 134, 140, 0.15)';
}

// ══════════════════════════════════════════
// (Estado ya actualizado en BD por OrdenController::handleReturn())
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno.css">
</head>

<body>
    <div class="result-card">

        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($orden): ?>
            <div class="order-details">
                <div class="order-row">
                    <span>Orden #</span>
                    <span><?= htmlspecialchars($orden['id']) ?></span>
                </div>
                <div class="order-row">
                    <span>Producto</span>
                    <span><?= htmlspecialchars($orden['producto']) ?></span>
                </div>
                <div class="order-row">
                    <span>ID Jugador</span>
                    <span><?= htmlspecialchars($orden['jugador_id']) ?></span>
                </div>
                <div class="order-row">
                    <span>Total</span>
                    <span>$<?= number_format($orden['precio'], 0, ',', '.') ?> COP</span>
                </div>
                <div class="order-row">
                    <span>Estado</span>
                    <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
                </div>
            </div>
        <?php endif; ?>

        <a href="sesiones.php" class="btn-home">← Volver al comercio</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>