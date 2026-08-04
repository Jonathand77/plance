<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\CancelarRecurrenciaController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

(new CancelarRecurrenciaController())->handle($_GET);
