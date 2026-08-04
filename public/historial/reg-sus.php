<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialSuscripcionesController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

$modo = $_GET['modo'] ?? 'wc-sub';

$__view = (new HistorialSuscripcionesController())->handleList($modo);
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
$cancel_msg = $__view['cancelMsg'];
require __DIR__ . '/../../views/historial/reg-sus.php';
