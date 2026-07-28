<?php
session_start();


$data = $_SESSION['link_result'] ?? null;
unset($_SESSION['link_result']);

if (!$data) {
    header("Location: index.php");
    exit();
}

$link_url = $data['link_url'] ?? '';
$producto = $data['producto'] ?? '';
$precio = $data['precio'] ?? 0;
$correo = $data['correo'] ?? '';
$nombre = $data['nombre'] ?? '';
$referencia = $data['referencia'] ?? '';
$expiracion = $data['expiracion'] ?? '';
$link_id = $data['link_id'] ?? '';
$exito = !empty($link_url);

// Definir visual según resultado - usando nueva paleta
if ($exito) {
    $icono = '🔗';
    $titulo = '¡Link generado!';
    $mensaje = 'Tu link de pago fue creado exitosamente. Compártelo por correo, WhatsApp o redes sociales.';
    $color = '#0062A8';
    $bg_icon = 'rgba(0,98,168,0.15)';
} else {
    $icono = '❌';
    $titulo = 'Error al generar';
    $mensaje = 'No se pudo generar el link de pago. Intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
}
require __DIR__ . '/../views/retorno_link.php';
