<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Ordenes\GatewayOrdenController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../games/pubg.php');
    exit();
}

(new GatewayOrdenController())->handleCreate($_POST);
