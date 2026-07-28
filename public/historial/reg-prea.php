<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialPreautorizacionesController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialPreautorizacionesController())->handleList();
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
require __DIR__ . '/../../views/historial/reg-prea.php';
