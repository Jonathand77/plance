<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Ordenes\PagoMixtoController;

$__view = (new PagoMixtoController())->handleReturn($_SESSION);

$orden_id = $__view['ordenId'];
$productos = $__view['productos'];
$total = $__view['total'];
$monto_parcial = $__view['montoParcial'];
$allow_partial = $__view['allowPartial'];
$reference = $__view['reference'];
$nuevo_estado = $__view['nuevoEstado'];
$estado_final = $__view['estadoFinal'];
$monto_pagado = $__view['montoPagado'];

// Colores usando la nueva paleta estandarizada
if ($estado_final === 'APPROVED') {
    $icono = '✅';
    $titulo = '¡Pago aprobado!';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
    $mensaje = $allow_partial
        ? '¡Pago parcial procesado exitosamente! El saldo restante quedará pendiente.'
        : '¡Tu pago fue procesado exitosamente!';
} elseif ($estado_final === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
    $bg_estado = 'rgba(255,108,12,0.12)';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos cuando se complete.';
} else {
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
    $bg_estado = 'rgba(220,53,69,0.12)';
    $mensaje = 'No se pudo procesar el pago. Por favor intenta de nuevo.';
}
require __DIR__ . '/../views/retorno_mixto.php';
