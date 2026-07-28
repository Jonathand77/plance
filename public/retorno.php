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
require __DIR__ . '/../views/retorno.php';
