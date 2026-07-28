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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Continuación de pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_continuar.css">
</head>

<body>
    <div class="result-card"
        style="--title-color: <?= $color ?>; --bg-icon: <?= $bg_icon ?>; --bg-estado: <?= $bg_estado ?>;">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-msg"><?= $mensaje ?></p>

        <div class="mix-badge">
            <i class="bi bi-shuffle"></i>
            Continuación de pago mixto · Web Checkout · PlacetoPay
        </div>

        <!-- Desglose actualizado -->
        <div class="breakdown">
            <div class="breakdown-title">Desglose del pago</div>
            <div class="breakdown-row">
                <span>Total del pedido</span>
                <span style="font-weight:700;">$<?= number_format($total, 0, ',', '.') ?> COP</span>
            </div>
            <div class="breakdown-row">
                <span>Abono anterior</span>
                <span style="color:var(--text-secondary);">$<?= number_format($monto_previo, 0, ',', '.') ?> COP</span>
            </div>
            <div class="breakdown-row">
                <span>Abono ahora</span>
                <span
                    style="color:var(--color-secondary-1);font-weight:700;">$<?= number_format($monto_ahora, 0, ',', '.') ?>
                    COP</span>
            </div>
            <div class="breakdown-row">
                <span style="font-weight:700;">Saldo restante</span>
                <span
                    style="color:<?= $saldo_final <= 0 ? 'var(--color-secondary-1)' : 'var(--color-primary)' ?>;font-weight:800;font-size:1rem;">
                    <?= $saldo_final <= 0 ? '✅ $0 — Pagado completo' : '$' . number_format($saldo_final, 0, ',', '.') . ' COP' ?>
                </span>
            </div>
        </div>

        <div class="order-details">
            <div class="order-row"><span>Orden #</span><span>#<?= $orden_id ?></span></div>
            <div class="order-row"><span>Producto</span><span
                    style="font-size:0.82rem;"><?= htmlspecialchars($row['producto']) ?></span></div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="historial/reg-pgb.php?modo=mixto" class="btn-volver">Ver historial</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>