<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Ordenes\PagoMixtoController;

$fallbackOrdenId = isset($_GET['orden_id']) ? (int) $_GET['orden_id'] : null;

$__view = (new PagoMixtoController())->handleContinuarReturn($_SESSION, $fallbackOrdenId);

$orden_id = $__view['ordenId'];
$row = $__view['row'];
$total = $__view['total'];
$monto_previo = $__view['montoPrevio'];
$saldo_final = $__view['saldoFinal'];
$monto_ahora = $__view['montoAhora'];
$nuevo_estado = $__view['nuevoEstado'];

// Colores usando la paleta estandarizada
if ($nuevo_estado === 'aprobada') {
    $icono = $saldo_final <= 0 ? '🎉' : '✅';
    $titulo = $saldo_final <= 0 ? '¡Pago completado!' : '¡Abono registrado!';
    $mensaje = $saldo_final <= 0
        ? '¡Excelente! Completaste el pago total de tu pedido.'
        : 'Tu abono fue registrado. Aún tienes un saldo pendiente.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
} elseif ($nuevo_estado === 'pendiente') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
    $bg_estado = 'rgba(255,108,12,0.12)';
} else {
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = 'No se pudo procesar el pago. Por favor intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
    $bg_estado = 'rgba(220,53,69,0.12)';
}

require __DIR__ . '/../views/retorno_continuar.php';
