<?php
session_start();
require_once __DIR__ . '/src/bootstrap.php';

use Plance\Controllers\Ordenes\PagoMixtoController;

$__view = (new PagoMixtoController())->handleReturn($_SESSION);

$orden_id = $__view['ordenId'];
$productos = $__view['productos'];
$total = $__view['total'];
$monto_parcial = $__view['montoParcial'];
$allow_partial = $__view['allowPartial'];
$reference = $__view['reference'];
$nuevo_estado = $__view['nuevoEstado'];
$estado_final = $__view['estadoFinal'];
$monto_pagado = $__view['montoPagado'];

// Colores usando la nueva paleta estandarizada
if ($estado_final === 'APPROVED') {
    $icono = '✅';
    $titulo = '¡Pago aprobado!';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
    $mensaje = $allow_partial
        ? '¡Pago parcial procesado exitosamente! El saldo restante quedará pendiente.'
        : '¡Tu pago fue procesado exitosamente!';
} elseif ($estado_final === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
    $bg_estado = 'rgba(255,108,12,0.12)';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos cuando se complete.';
} else {
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
    $bg_estado = 'rgba(220,53,69,0.12)';
    $mensaje = 'No se pudo procesar el pago. Por favor intenta de nuevo.';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Pago Mixto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            /* Nueva paleta estandarizada */
            --color-primary: #FF6C0C;
            --color-secondary-1: #00CFB4;
            --color-secondary-2: #4C5F71;
            --color-secondary-3: #0062A8;
            --color-secondary-4: #1E212C;
            --color-secondary-5: #7D868C;
            --text-main: #f1f5f9;

            /* Variables específicas del componente */
            --bg-base: #0d0e10;
            --bg-surface: #1E212C;
            --bg-card: #1E2128;
            --bg-card-hover: #252830;
            --border: #4C5F71;
            --border-active: #FF6C0C;
            --text-primary: #f0f1f3;
            --text-secondary: #7D868C;
            --text-muted: #4C5F71;
            --font-d: 'Barlow Condensed', sans-serif;
            --font-b: 'Barlow', sans-serif;
            --radius-sm: 6px;
            --radius-md: 10px;
            --radius-lg: 16px;
            --transition: 0.2s ease;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg-base);
            color: var(--text-primary);
            font-family: var(--font-b);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            -webkit-font-smoothing: antialiased;
        }

        .result-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 2.5rem 2rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
            animation: fadeUp 0.4s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-icon {
            font-size: 3rem;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            background: var(--bg-icon, rgba(255, 108, 12, 0.15));
        }

        .result-title {
            font-family: var(--font-d);
            font-size: 2rem;
            font-weight: 800;
            color: var(--title-color, var(--color-primary));
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }

        .result-msg {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        /* Badge mixto */
        .mix-badge {
            background: rgba(0, 98, 168, 0.08);
            border: 1px solid rgba(0, 98, 168, 0.2);
            border-radius: var(--radius-sm);
            padding: 0.6rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.8rem;
            color: #7ec8f0;
            display: flex;
            gap: 0.5rem;
            align-items: center;
            justify-content: center;
        }

        /* Desglose de pago */
        .pago-breakdown {
            background: rgba(0, 207, 180, 0.07);
            border: 1px solid rgba(0, 207, 180, 0.2);
            border-radius: var(--radius-md);
            padding: 1rem 1.2rem;
            margin-bottom: 1.2rem;
            text-align: left;
        }

        .breakdown-title {
            font-family: var(--font-d);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 0.6rem;
        }

        .breakdown-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.35rem 0;
            font-size: 0.85rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .breakdown-row:last-child {
            border-bottom: none;
        }

        .breakdown-row span:first-child {
            color: var(--text-secondary);
        }

        .breakdown-row span:last-child {
            font-weight: 700;
        }

        .order-details {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 1rem 1.2rem;
            margin-bottom: 1.2rem;
            text-align: left;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .order-row span:first-child {
            color: var(--text-secondary);
        }

        .order-row span:last-child {
            font-weight: 600;
        }

        .estado-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: var(--radius-sm);
            font-size: 0.78rem;
            font-weight: 700;
            font-family: var(--font-d);
            letter-spacing: 0.05em;
            background: var(--bg-estado, rgba(255, 108, 12, 0.12));
            color: var(--title-color, var(--color-primary));
        }

        .btn-home {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: var(--color-primary);
            color: #0d0e10;
            border: none;
            border-radius: var(--radius-sm);
            font-family: var(--font-d);
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all var(--transition);
            margin-right: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-home::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.12), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-home:hover {
            background: var(--color-secondary-3);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(255, 108, 12, 0.3);
            text-decoration: none;
        }

        .btn-home:hover::before {
            transform: translateX(100%);
        }

        .btn-volver {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: var(--font-d);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all var(--transition);
        }

        .btn-volver:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
            text-decoration: none;
            background: rgba(255, 108, 12, 0.05);
        }
    </style>
</head>

<body>
    <div class="result-card"
        style="--title-color: <?= $color ?>; --bg-icon: <?= $bg_icon ?>; --bg-estado: <?= $bg_estado ?>;">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-msg"><?= $mensaje ?></p>

        <div class="mix-badge">
            <i class="bi bi-shuffle"></i>
            <?= $allow_partial ? 'Pago <strong>mixto / parcial</strong> · Web Checkout · PlacetoPay' : 'Pago <strong>múltiple</strong> · Web Checkout · PlacetoPay' ?>
        </div>

        <?php if ($allow_partial): ?>
            <div class="pago-breakdown">
                <div class="breakdown-title">Desglose del pago</div>
                <div class="breakdown-row">
                    <span>Total del pedido</span>
                    <span>$<?= number_format($total, 0, ',', '.') ?> COP</span>
                </div>
                <div class="breakdown-row">
                    <span>Monto pagado ahora</span>
                    <span
                        style="color:var(--color-secondary-1);">$<?= number_format($monto_pagado ?? $monto_parcial, 0, ',', '.') ?>
                        COP</span>
                </div>
                <div class="breakdown-row">
                    <span>Saldo restante</span>
                    <span
                        style="color:var(--color-primary);">$<?= number_format($total - ($monto_pagado ?? $monto_parcial), 0, ',', '.') ?>
                        COP</span>
                </div>
            </div>
        <?php endif; ?>

        <div class="order-details">
            <div class="order-row"><span>Orden #</span><span>#<?= $orden_id ?></span></div>
            <div class="order-row"><span>Productos</span><span
                    style="font-size:0.8rem;text-align:right;max-width:60%;"><?= htmlspecialchars($productos) ?></span>
            </div>
            <div class="order-row"><span>Referencia</span><span
                    style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($reference) ?></span>
            </div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="games/rainbowsix.php" class="btn-volver">Ver tienda</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>