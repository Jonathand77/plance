<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialPagosBasicosController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$modo = $_GET['modo'] ?? 'wc';

$__view = (new HistorialPagosBasicosController())->handleList($modo);
$registros = $__view['registros'];
$verify_msg = $__view['verifyMsg'];
require __DIR__ . '/../../views/historial/reg-pgb.php';
