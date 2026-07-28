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
require __DIR__ . '/../views/retorno_suscription_rec.php';
