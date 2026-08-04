<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialLinksController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialLinksController())->handleList();
$registros = $__view['registros'];
require __DIR__ . '/../../views/historial/reg-link.php';
