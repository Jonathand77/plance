<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Reservaciones\PreauthorizationController;

$__view = (new PreauthorizationController())->handleReturn($_GET, $_SESSION);

$reserva_id = $__view['reservaId'];
$habitacion = $__view['habitacion'];
$total = $__view['total'];
$correo = $__view['correo'];
$requestId = $__view['requestId'];
$checkin = $__view['checkin'];
$checkout = $__view['checkout'];
$noches = $__view['noches'];
$nombre = $__view['nombre'];
$gw_status = $__view['gwStatus'];
$gw_reason = $__view['gwReason'];
$nuevo_estado = $__view['nuevoEstado'];

// Colores usando la nueva paleta estandarizada
if ($gw_status === 'APPROVED') {
    $icono = '🏨';
    $titulo = '¡Reserva confirmada!';
    $mensaje = 'Tu habitación ha sido reservada exitosamente. La preautorización fue aprobada — tu tarjeta no ha sido cobrada aún.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $bg_estado = 'rgba(0,207,180,0.12)';
} elseif ($gw_status === 'PENDING') {
    $icono = '⏳';
    $titulo = 'Reserva pendiente';
    $mensaje = 'Tu reserva está siendo procesada. Te notificaremos cuando se confirme la preautorización.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
    $bg_estado = 'rgba(255,108,12,0.12)';
} elseif ($gw_reason === 'EX') {
    $icono = '⏱️';
    $titulo = 'Sesión expirada';
    $mensaje = 'El tiempo para completar la preautorización se agotó y la sesión de pago venció. Tu tarjeta no fue afectada. Vuelve a intentar la reserva.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
    $bg_estado = 'rgba(125,134,140,0.12)';
} elseif ($gw_reason === '¬C') {
    $icono = '✋';
    $titulo = 'Pago cancelado';
    $mensaje = 'Cancelaste el proceso de preautorización antes de completarlo. Tu tarjeta no fue afectada. Puedes volver a intentar la reserva cuando quieras.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
    $bg_estado = 'rgba(125,134,140,0.12)';
} else {
    $icono = '❌';
    $titulo = 'Reserva rechazada';
    $mensaje = 'No se pudo procesar la preautorización. Por favor intenta con otra tarjeta o contacta a tu banco.';
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
    <title>Resultado — Preautorización</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        :root {

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

        .pre-badge {
            background: rgba(0, 98, 168, 0.08);
            border: 1px solid rgba(0, 98, 168, 0.2);
            border-radius: var(--radius-sm);
            padding: 0.6rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.8rem;
            color: #6bb6e8;
            display: flex;
            gap: 0.5rem;
            align-items: center;
            justify-content: center;
        }

        /* Fechas de estadía */
        .stay-box {
            background: rgba(0, 98, 168, 0.07);
            border: 1px solid rgba(0, 98, 168, 0.2);
            border-radius: var(--radius-md);
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.2rem;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .stay-item {
            text-align: center;
        }

        .stay-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-secondary);
            margin-bottom: 0.2rem;
        }

        .stay-date {
            font-family: var(--font-d);
            font-size: 1.1rem;
            font-weight: 800;
            color: #6bb6e8;
        }

        .stay-sep {
            color: var(--text-secondary);
            font-size: 1.2rem;
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

        /* Aviso preauth */
        .preauth-aviso {
            background: rgba(255, 108, 12, 0.07);
            border: 1px solid rgba(255, 108, 12, 0.2);
            border-radius: var(--radius-sm);
            padding: 0.7rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.8rem;
            color: var(--color-primary);
            text-align: left;
            line-height: 1.5;
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

        <div class="pre-badge">
            <i class="bi bi-shield-lock-fill"></i>
            Preautorización (Check-in) · Web Checkout · PlacetoPay
        </div>

        <?php if ($gw_status === 'APPROVED'): ?>
            <!-- Fechas de estadía -->
            <div class="stay-box">
                <div class="stay-item">
                    <div class="stay-label">Check-in</div>
                    <div class="stay-date"><?= htmlspecialchars($checkin) ?></div>
                </div>
                <div class="stay-sep">→</div>
                <div class="stay-item">
                    <div class="stay-label">Check-out</div>
                    <div class="stay-date"><?= htmlspecialchars($checkout) ?></div>
                </div>
                <div class="stay-sep">·</div>
                <div class="stay-item">
                    <div class="stay-label">Noches</div>
                    <div class="stay-date"><?= $noches ?></div>
                </div>
            </div>

            <div class="preauth-aviso">
                ⚠️ <strong>Recuerda:</strong> Esta es una <strong>preautorización</strong> — tu tarjeta no ha sido cobrada.
                El cargo se realizará al momento del check-out en el hotel.
            </div>
        <?php endif; ?>

        <div class="order-details">
            <div class="order-row"><span>Reserva #</span><span>#<?= $reserva_id ?></span></div>
            <div class="order-row"><span>Habitación</span><span><?= htmlspecialchars($habitacion) ?></span></div>
            <?php if ($nombre): ?>
                <div class="order-row"><span>Huésped</span><span><?= htmlspecialchars($nombre) ?></span></div>
            <?php endif; ?>
            <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($correo) ?></span></div>
            <div class="order-row">
                <span>Monto preautorizado</span>
                <span style="color:var(--title-color);font-size:1.05rem;">$<?= number_format($total, 0, ',', '.') ?>
                    COP</span>
            </div>
            <div class="order-row"><span>Referencia</span><span
                    style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($requestId) ?></span>
            </div>
            <div class="order-row">
                <span>Estado</span>
                <span><span class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="reservasiones/hotel.php" class="btn-volver">Ver habitaciones</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>