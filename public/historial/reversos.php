<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\ReversosController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new ReversosController())->handleList();

$transacciones = $__view['transacciones'];
$msg = $__view['msg'];
$msg_type = $__view['msgType'];
require __DIR__ . '/../../views/historial/reversos.php';
