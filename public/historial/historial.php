<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\HistorialDashboardController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

$__view = (new HistorialDashboardController())->handleList();
$total_ordenes = $__view['totalOrdenes'];
$total_subs = $__view['totalSubs'];
$total_recs = $__view['totalRecs'];
$total_links = $__view['totalLinks'];
$total_disp = $__view['totalDisp'];
$total_prea = $__view['totalPrea'];
$total_pagos = $__view['totalPagos'];
require __DIR__ . '/../../views/historial/historial.php';
