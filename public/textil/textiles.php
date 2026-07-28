<?php
session_start();


require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

// Contar registros del usuario actual
$correo_sesion = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

$total_ordenes = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM ordenes"))['total'];
$total_subs = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM suscripciones WHERE usuario_id = '$correo_sesion'"))['total'];
$total_recs = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT COUNT(*) as total FROM recurrencias WHERE usuario_id = '$correo_sesion'"))['total'];

$total_pagos = $total_ordenes + $total_subs + $total_recs;
$total_pagos = number_format($total_pagos, 0, ',', '.');
require __DIR__ . '/../../views/textil/textiles.php';
