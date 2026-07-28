<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\GatewaySuscripcionesController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../plataformas/streaming_gateway.php');
    exit();
}

(new GatewaySuscripcionesController())->handleCreate($_POST);
