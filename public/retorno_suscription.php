<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscriptionController;

$__view = (new SuscriptionController())->handleReturn($_GET);

$sub_id = $__view['subId'];
$token = $__view['token'];
$subs = $__view['subs'];
$status_p2p = $__view['statusP2p'];

// Determinar estado y mensajes - usando nueva paleta
if ($status_p2p === 'APPROVED') {
    $nuevo_estado = 'aprobada';
    if (!empty($token)) {
        $icono = '🔐';
        $titulo = '¡Tarjeta registrada!';
        $mensaje = 'Tu tarjeta fue tokenizada exitosamente. Tu suscripción está activa.';
    } else {
        $icono = '✅';
        $titulo = '¡Suscripción activada!';
        $mensaje = 'Tu suscripción fue procesada correctamente.';
    }
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
} elseif ($status_p2p === 'REJECTED') {
    $nuevo_estado = 'rechazada';
    $icono = '❌';
    $titulo = 'Proceso rechazado';
    $mensaje = 'No se pudo procesar. Intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
} elseif ($status_p2p === 'PENDING') {
    $nuevo_estado = 'pendiente';
    $icono = '⏳';
    $titulo = 'Proceso pendiente';
    $mensaje = 'Tu solicitud está siendo procesada.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
} else {
    $nuevo_estado = 'cancelada';
    $icono = '🚫';
    $titulo = 'Proceso cancelado';
    $mensaje = 'Cancelaste el proceso.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
}

// (Estado y token ya actualizados en BD por SuscriptionController::handleReturn())
require __DIR__ . '/../views/retorno_suscription.php';
