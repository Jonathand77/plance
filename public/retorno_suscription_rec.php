<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscriptionRecController;

$__view = (new SuscriptionRecController())->handleReturn($_GET);

$rec_id = $__view['recId'];
$rec = $__view['rec'];
$status_p2p = $__view['statusP2p'];

// Definir visual según estado - usando nueva paleta
if ($status_p2p === 'APPROVED') {
    $nuevo_estado = 'aprobada';
    $icono = '✅';
    $titulo = '¡Recurrencia IA activada!';
    $mensaje = 'Tu plan de IA fue activado. Los cobros se realizarán automáticamente.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
} elseif ($status_p2p === 'REJECTED') {
    $nuevo_estado = 'rechazada';
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = 'Tu pago no pudo ser procesado. Intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
} elseif ($status_p2p === 'PENDING') {
    $nuevo_estado = 'pendiente';
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos pronto.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
} else {
    $nuevo_estado = 'cancelada';
    $icono = '🚫';
    $titulo = 'Recurrencia cancelada';
    $mensaje = 'Cancelaste el proceso de pago.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
}

// (Estado y fecha_fin ya actualizados en BD por SuscriptionRecController::handleReturn())
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Plan IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_suscription_rec.css">
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($rec): ?>
            <div class="order-details">
                <div class="order-row"><span>Recurrencia #</span><span>#<?= htmlspecialchars($rec['id']) ?></span></div>
                <div class="order-row"><span>Servicio</span><span><?= htmlspecialchars($rec['servicio']) ?></span></div>
                <div class="order-row"><span>Plan</span><span><?= htmlspecialchars($rec['plan']) ?></span></div>
                <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($rec['usuario_id']) ?></span></div>
                <div class="order-row"><span>Total</span><span>$<?= number_format($rec['precio'], 0, ',', '.') ?> COP</span>
                </div>
                <div class="order-row">
                    <span>Periodicidad</span><span><?= $rec['periodicidad'] === 'Y' ? 'Anual' : 'Mensual' ?></span></div>
                <div class="order-row"><span>Próximo
                        cobro</span><span><?= htmlspecialchars($rec['next_payment'] ?? 'N/A') ?></span></div>
                <div class="order-row"><span>Fin</span><span
                        class="fecha-fin"><?= $nuevo_estado === 'aprobada' ? date('Y-m-d', $rec['periodicidad'] === 'Y' ? strtotime('+1 year') : strtotime('+12 months')) : 'N/A' ?></span>
                </div>
                <div class="order-row"><span>Estado</span><span><span
                            class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span></div>
            </div>

            <?php if ($nuevo_estado === 'aprobada'): ?>
                <div class="recurring-detail">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Tu plan se renovará automáticamente de forma
                        <strong><?= $rec['periodicidad'] === 'Y' ? 'anual' : 'mensual' ?></strong>. Próximo cobro:
                        <strong><?= htmlspecialchars($rec['next_payment'] ?? 'N/A') ?></strong></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <a href="sesiones.php" class="btn-home">← Inicio</a>
        <a href="plataformas/ia.php" class="btn-volver">Ver planes</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>