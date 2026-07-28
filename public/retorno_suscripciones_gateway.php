<?php
session_start();


$gw = $_SESSION['gw_sub_result'] ?? null;
unset($_SESSION['gw_sub_result']);

if (!$gw) {
    header("Location: index.php");
    exit();
}

$status = $gw['status'] ?? 'FAILED';
$nuevo_estado = $gw['estado'] ?? 'rechazada';
$servicio = $gw['servicio'] ?? '';
$plan = $gw['plan'] ?? '';
$precio = $gw['precio'] ?? 0;
$nombre = $gw['nombre'] ?? '';
$correo = $gw['correo'] ?? '';
$orden_id = $gw['orden_id'] ?? '';
$reference = $gw['reference'] ?? '';
$token = $gw['token'] ?? '';
$message = $gw['message'] ?? '';

// Definir visual según estado - usando nueva paleta
if ($status === 'APPROVED') {
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    if (!empty($token)) {
        $icono = '🔐';
        $titulo = '¡Suscripción completa!';
        $mensaje = '¡Tu pago fue procesado y tu tarjeta quedó guardada para futuros cobros automáticos!';
    } else {
        $icono = '✔';
        $titulo = '¡Pago exitoso!';
        $mensaje = 'Tu pago fue procesado y la suscripción fue activada correctamente.';
    }
} elseif ($status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
} else {
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = !empty($message) ? $message : 'No se pudo procesar. Verifica los datos e intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
}
require __DIR__ . '/../views/retorno_suscripciones_gateway.php';
