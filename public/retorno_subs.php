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
require __DIR__ . '/../views/retorno_subs.php';
