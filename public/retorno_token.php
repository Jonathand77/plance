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
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_token.css">
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