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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Suscripción Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_suscripciones_gateway.css">
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= htmlspecialchars($mensaje) ?></p>

        <?php if ($status === 'APPROVED' && !empty($token)): ?>
            <div class="token-guardado">
                <i class="bi bi-shield-lock-fill"></i>
                <span>🔐 <strong>Tarjeta tokenizada</strong> — Tu medio de pago quedó registrado de forma segura para
                    futuros cobros automáticos.</span>
            </div>
        <?php endif; ?>

        <div class="gw-badge">
            <i class="bi bi-cpu-fill"></i>
            Procesado via <strong>API Gateway</strong> · Evertec PlacetoPay
        </div>

        <div class="order-details">
            <div class="order-row"><span>Orden #</span><span>#<?= htmlspecialchars($orden_id) ?></span></div>
            <div class="order-row"><span>Servicio</span><span><?= htmlspecialchars($servicio) ?></span></div>
            <div class="order-row"><span>Plan</span><span><?= htmlspecialchars($plan) ?></span></div>
            <div class="order-row"><span>Nombre</span><span><?= htmlspecialchars($nombre) ?></span></div>
            <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($correo) ?></span></div>
            <div class="order-row"><span>Total</span><span
                    style="color:<?= $color ?>;font-size:1.1rem;">$<?= number_format((float) $precio, 0, ',', '.') ?>
                    COP</span></div>
            <?php if (!empty($reference)): ?>
                <div class="order-row"><span>Referencia</span><span
                        style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($reference) ?></span>
                </div>
            <?php endif; ?>
            <div class="order-row">
                <span>Tarjeta</span>
                <span class="tarjeta-estado <?= !empty($token) ? 'tarjeta-guardada' : 'tarjeta-no-guardada' ?>">
                    <?= !empty($token) ? '✅ Guardada' : '— No guardada' ?>
                </span>
            </div>
            <div class="order-row"><span>Estado</span><span><span
                        class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span></div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="plataformas/streaming_gateway.php" class="btn-volver">Ver planes</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>