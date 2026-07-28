<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscriptionController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../plataformas/otras_streamings.php');
    exit();
}

(new SuscriptionController())->handleCreate($_POST);
