<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Suscripciones\RecurrenciaController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../plataformas/redes.php');
    exit();
}

(new RecurrenciaController())->handleCreate($_POST);
