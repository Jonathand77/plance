<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialDispersionesController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialDispersionesController())->handleList();
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
require __DIR__ . '/../../views/historial/reg-disp.php';
