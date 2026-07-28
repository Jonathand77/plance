<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialLinksController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialLinksController())->handleList();
$registros = $__view['registros'];
require __DIR__ . '/../../views/historial/reg-link.php';
