<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscriptionRecController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../plataformas/ia.php');
    exit();
}

(new SuscriptionRecController())->handleCreate($_POST);
