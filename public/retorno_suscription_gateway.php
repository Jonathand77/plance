<?php
session_start();


$gw = $_SESSION['gw_mus_result'] ?? null;
unset($_SESSION['gw_mus_result']);

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
    $icono = '🔐';
    $titulo = '¡Suscripción registrada!';
    $mensaje = 'Tu tarjeta fue tokenizada y la suscripción quedó activa correctamente.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
} elseif ($status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Proceso pendiente';
    $mensaje = 'Tu solicitud está siendo procesada.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
} else {
    $icono = '❌';
    $titulo = 'Proceso rechazado';
    $mensaje = !empty($message) ? $message : 'No se pudo procesar. Verifica los datos e intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
}
require __DIR__ . '/../views/retorno_suscription_gateway.php';
