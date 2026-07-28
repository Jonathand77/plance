<?php
session_start();
require_once __DIR__ . '/src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscriptionRecController;

$__view = (new SuscriptionRecController())->handleReturn($_GET);

$rec_id = $__view['recId'];
$rec = $__view['rec'];
$status_p2p = $__view['statusP2p'];

// Definir visual según estado - usando nueva paleta
if ($status_p2p === 'APPROVED') {
    $nuevo_estado = 'aprobada';
    $icono = '✅';
    $titulo = '¡Recurrencia IA activada!';
    $mensaje = 'Tu plan de IA fue activado. Los cobros se realizarán automáticamente.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
} elseif ($status_p2p === 'REJECTED') {
    $nuevo_estado = 'rechazada';
    $icono = '❌';
    $titulo = 'Pago rechazado';
    $mensaje = 'Tu pago no pudo ser procesado. Intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
} elseif ($status_p2p === 'PENDING') {
    $nuevo_estado = 'pendiente';
    $icono = '⏳';
    $titulo = 'Pago pendiente';
    $mensaje = 'Tu pago está siendo procesado. Te notificaremos pronto.';
    $color = '#FF6C0C';
    $bg_icon = 'rgba(255,108,12,0.15)';
} else {
    $nuevo_estado = 'cancelada';
    $icono = '🚫';
    $titulo = 'Recurrencia cancelada';
    $mensaje = 'Cancelaste el proceso de pago.';
    $color = '#7D868C';
    $bg_icon = 'rgba(125,134,140,0.15)';
}

// (Estado y fecha_fin ya actualizados en BD por SuscriptionRecController::handleReturn())
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Plan IA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
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
            --bg-surface: #16181c;
            --bg-card: #1E2128;
            --border: #4C5F71;
            --text-primary: #f0f1f3;
            --text-secondary: #7D868C;
            --font-display: 'Barlow', sans-serif;
            --font-body: 'Barlow', sans-serif;
            --color-success: #00CFB4;
            --color-danger: #dc3545;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-primary);
            font-family: var(--font-body);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .result-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            max-width: 480px;
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
            background: <?= $bg_icon ?>;
        }

        .result-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 800;
            color: <?= $color ?>;
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }

        .result-message {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        .order-details {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-bottom: 1rem;
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
            color: var(--text-primary);
        }

        .estado-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-size: 0.78rem;
            font-weight: 700;
            font-family: var(--font-display);
            letter-spacing: 0.05em;
            background: <?= $bg_icon ?>;
            color: <?= $color ?>;
        }

        .recurring-detail {
            background: rgba(255, 108, 12, 0.08);
            border: 1px solid rgba(255, 108, 12, 0.2);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.2rem;
            text-align: left;
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
            font-size: 0.82rem;
            color: var(--color-primary);
        }

        .recurring-detail i {
            flex-shrink: 0;
            margin-top: 0.1rem;
        }

        .btn-home {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: <?= $color ?>;
            color: #0d0e10;
            border: none;
            border-radius: 8px;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            margin-right: 0.5rem;
        }

        .btn-home:hover {
            opacity: 0.85;
            color: #0d0e10;
            text-decoration: none;
            background: <?= $color ?>;
        }

        .btn-volver {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-volver:hover {
            border-color: <?= $color ?>;
            color: <?= $color ?>;
            text-decoration: none;
        }

        .fecha-fin {
            color: var(--color-primary);
        }
    </style>
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($rec): ?>
            <div class="order-details">
                <div class="order-row"><span>Recurrencia #</span><span>#<?= htmlspecialchars($rec['id']) ?></span></div>
                <div class="order-row"><span>Servicio</span><span><?= htmlspecialchars($rec['servicio']) ?></span></div>
                <div class="order-row"><span>Plan</span><span><?= htmlspecialchars($rec['plan']) ?></span></div>
                <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($rec['usuario_id']) ?></span></div>
                <div class="order-row"><span>Total</span><span>$<?= number_format($rec['precio'], 0, ',', '.') ?> COP</span>
                </div>
                <div class="order-row">
                    <span>Periodicidad</span><span><?= $rec['periodicidad'] === 'Y' ? 'Anual' : 'Mensual' ?></span></div>
                <div class="order-row"><span>Próximo
                        cobro</span><span><?= htmlspecialchars($rec['next_payment'] ?? 'N/A') ?></span></div>
                <div class="order-row"><span>Fin</span><span
                        class="fecha-fin"><?= $nuevo_estado === 'aprobada' ? date('Y-m-d', $rec['periodicidad'] === 'Y' ? strtotime('+1 year') : strtotime('+12 months')) : 'N/A' ?></span>
                </div>
                <div class="order-row"><span>Estado</span><span><span
                            class="estado-badge"><?= strtoupper($nuevo_estado) ?></span></span></div>
            </div>

            <?php if ($nuevo_estado === 'aprobada'): ?>
                <div class="recurring-detail">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Tu plan se renovará automáticamente de forma
                        <strong><?= $rec['periodicidad'] === 'Y' ? 'anual' : 'mensual' ?></strong>. Próximo cobro:
                        <strong><?= htmlspecialchars($rec['next_payment'] ?? 'N/A') ?></strong></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <a href="sesiones.php" class="btn-home">← Inicio</a>
        <a href="plataformas/ia.php" class="btn-volver">Ver planes</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>