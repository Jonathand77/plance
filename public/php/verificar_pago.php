<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\VerificarPagoController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

(new VerificarPagoController())->handle($_GET);
