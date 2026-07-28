<?php
session_start();


// Obtener resultado de sesión
$gw = $_SESSION['gw_result'] ?? null;
unset($_SESSION['gw_result']);

if (!$gw) {
    header("Location: index.php");
    exit();
}

$status = $gw['status'] ?? 'FAILED';
$nuevo_estado = $gw['estado'] ?? 'rechazada';
$producto = $gw['producto'] ?? '';
$precio = $gw['precio'] ?? 0;
$correo = $gw['correo'] ?? '';
$nombre = $gw['nombre'] ?? '';
$orden_id = $gw['orden_id'] ?? '';
$message = $gw['message'] ?? '';
$reference = $gw['reference'] ?? '';

// Definir visual según estado - usando nueva paleta
if ($status === 'APPROVED') {
    $icono = '✔';
    $titulo = '¡Pago aprobado!';
    $mensaje = 'Tu compra fue procesada exitosamente. ¡Disfruta tus UC Points!';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
} elseif ($status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos pronto.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
} else {
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = !empty($message) ? $message : 'Tu pago no pudo ser procesado. Verifica los datos e intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
}
require __DIR__ . '/../views/retorno_gateway.php';
