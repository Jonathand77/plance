<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\SettingsController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new SettingsController())->handle($_POST, $_SERVER['REQUEST_METHOD']);

$row = $__view['row'];
$alerta = $__view['alerta'];
$alerta_tipo = $__view['alertaTipo'];
$total_ordenes = $__view['totalOrdenes'];
$total_aprobadas = $__view['totalAprobadas'];
$total_rechazadas = $__view['totalRechazadas'];
$total_pendientes = $__view['totalPendientes'];
$avatar = $__view['avatar'];
$initial = $__view['initial'];
require __DIR__ . '/../../views/settings/ajustes.php';
