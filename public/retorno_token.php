<?php
session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscripcionController;

$__view = (new SuscripcionController())->handleReturnTokenizacion($_GET, $_SESSION);

$sub_id = $__view['subId'];
$token = $__view['token'];

// Definir visual según resultado - usando nueva paleta
if (!empty($token)) {
    $exito = true;
    $titulo = '🔐 ¡Tarjeta guardada!';
    $mensaje = 'Tu tarjeta fue tokenizada exitosamente. Tu suscripción está completamente activada.';
    $color = '#00CFB4';
    $bg_icon = 'rgba(0,207,180,0.15)';
    $icono = '✅';
} else {
    $exito = false;
    $titulo = 'No se pudo guardar';
    $mensaje = 'No logramos tokenizar tu tarjeta. Puedes intentarlo nuevamente desde tu historial.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
    $icono = '❌';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado — Tokenización</title>
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
            max-width: 420px;
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
            background:
                <?= $bg_icon ?>
            ;
        }

        .result-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 800;
            color:
                <?= $color ?>
            ;
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }

        .result-message {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        .btn-home {
            display: inline-block;
            padding: 0.75rem 2rem;
            background:
                <?= $color ?>
            ;
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
            background:
                <?= $color ?>
            ;
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
            border-color:
                <?= $color ?>
            ;
            color:
                <?= $color ?>
            ;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="plataformas/streaming.php" class="btn-volver">Ver planes</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>