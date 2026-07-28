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
require __DIR__ . '/../views/retorno_token.php';
