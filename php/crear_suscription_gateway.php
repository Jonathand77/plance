<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\GatewaySuscriptionController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../plataformas/music_gateway.php');
    exit();
}

(new GatewaySuscriptionController())->handleCreate($_POST);
