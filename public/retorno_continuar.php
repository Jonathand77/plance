<?php
session_start();

require_once 'php/conexion_be.php';
require_once __DIR__ . '/php/http_client.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

$data = $_SESSION['continuar_result'] ?? null;
$orden_id = (int) ($_GET['orden_id'] ?? ($data['orden_id'] ?? 0));
unset($_SESSION['continuar_result']);

if (!$orden_id) {
    header("Location: index.php");
    exit();
}

// Traer orden actualizada
$row = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM ordenes WHERE id = $orden_id"));
if (!$row) {
    header("Location: index.php");
    exit();
}

$total = (float) $row['precio'];
$monto_previo = (float) $row['monto_pagado'];
$saldo_rest = $total - $monto_previo;
$requestId = $data['requestId'] ?? null;

// Consultar estado en PlacetoPay
$nuevo_estado = 'pendiente';
$monto_ahora = 0;

if ($requestId) {
    $rdata = (new \Plance\Services\Payments\PlaceToPayClient())->querySession($requestId, 'estandar');
    $gw_status = $rdata['status']['status'] ?? 'PENDING';

    if (!empty($rdata['payment'])) {
        $pago = $rdata['payment'][0] ?? [];
        $monto_ahora = (float) ($pago['amount']['from']['total'] ?? $saldo_rest);
        $gw_status = $pago['status']['status'] ?? $gw_status;
    } else {
        $monto_ahora = $saldo_rest;
    }

    $nuevo_estado = match ($gw_status) {
        'APPROVED' => 'aprobada',
        'PENDING' => 'pendiente',
        default => 'rechazada'
    };

    // Actualizar BD — sumar el nuevo monto al previo
    if ($nuevo_estado === 'aprobada') {
        $nuevo_monto = $monto_previo + $monto_ahora;
        $saldo_final = $total - $nuevo_monto;
        // Solo marcamos la orden como "aprobada" cuando ya no queda saldo;
        // si aún queda saldo, sigue "pendiente" de completar el pago.
        $estado_orden = $saldo_final <= 0 ? 'aprobada' : 'pendiente';
        $estado_safe = mysqli_real_escape_string($conexion, $estado_orden);
        mysqli_query($conexion, "UPDATE ordenes SET estado='$estado_safe', monto_pagado = " . (float) $nuevo_monto . " WHERE id = $orden_id");
    } else {
        $nuevo_monto = $monto_previo;
        $saldo_final = $saldo_rest;
    }
} else {
    $nuevo_monto = $monto_previo;
    $saldo_final = $saldo_rest;
    $monto_ahora = $saldo_rest;
}

// Colores usando la nueva paleta estandarizada
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
