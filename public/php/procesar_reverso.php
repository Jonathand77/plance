<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\ReversosController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

(new ReversosController())->handleReversar($_GET);
