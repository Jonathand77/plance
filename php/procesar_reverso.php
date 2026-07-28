<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Historial\ReversosController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

(new ReversosController())->handleReversar($_GET);
