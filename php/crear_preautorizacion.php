<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Reservaciones\PreauthorizationController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../reservasiones/hotel.php');
    exit();
}

(new PreauthorizationController())->handleCreate($_POST);
