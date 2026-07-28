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
require __DIR__ . '/../views/retorno_preautorizacion.php';
