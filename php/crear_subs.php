<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscripcionController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../plataformas/streaming.php');
    exit();
}

(new SuscripcionController())->handleCreate($_POST);
