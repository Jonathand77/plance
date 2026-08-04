<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialRecurrenciasController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialRecurrenciasController())->handleList();
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
$cancel_msg = $__view['cancelMsg'];
require __DIR__ . '/../../views/historial/reg-rec.php';
