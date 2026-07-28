<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Historial\VerificarPagoController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

(new VerificarPagoController())->handle($_GET);
