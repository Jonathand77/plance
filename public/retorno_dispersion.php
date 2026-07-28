<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Dispersiones\DispersionController;

$__view = (new DispersionController())->handleReturn($_GET);

$disp_id = $__view['dispersionId'];
$destino = $__view['destino'];
$total = $__view['total'];
$base = $__view['base'];
$impuesto = $__view['impuesto'];
$requestId = $__view['requestId'];
$gw_status = $__view['gwStatus'];
$nuevo_estado = $__view['nuevoEstado'];

// Colores usando la nueva paleta estandarizada
if ($gw_status === 'APPROVED') {
    $icono = '✅';
    $titulo = '¡Tiquete confirmado!';
    $mensaje = 'Tu pago fue procesado y dispersado exitosamente entre la aerolínea y los impuestos aeroportuarios.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
} elseif ($gw_status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos cuando se confirme.';
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
require __DIR__ . '/../views/retorno_dispersion.php';
