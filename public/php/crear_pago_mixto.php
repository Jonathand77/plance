<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Ordenes\PagoMixtoController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../games/rainbowsix.php');
    exit();
}

(new PagoMixtoController())->handleCreate($_POST);
