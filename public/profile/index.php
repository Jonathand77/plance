<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\ProfileIndexController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

$__view = (new ProfileIndexController())->handle();

$row = $__view['row'];
$total_ordenes_pago = $__view['totalOrdenesPago'];
$total_aprobadas = $__view['totalAprobadas'];
$total_ordenes_rechazadas = $__view['totalOrdenesRechazadas'];
$total_ordenes = $__view['totalOrdenes'];
$total_subs = $__view['totalSubs'];
$total_recurrencias = $__view['totalRecurrencias'];
$total_gw_ordenes = $__view['totalGwOrdenes'];
$total_gw_subs = $__view['totalGwSubs'];
$total_gw_suscription = $__view['totalGwSuscription'];
$actividad_json = $__view['actividadJson'];
$msg = $__view['msg'];
$msg_type = $__view['msgType'];

$nav_base = $nav_base ?? '../';
require __DIR__ . '/../../views/profile/index.php';
