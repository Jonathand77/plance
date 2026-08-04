<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\ReversosController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

$__view = (new ReversosController())->handleDetalle($_GET);

$id = $__view['id'];
$tipo = $__view['tipo'];
$trx = $__view['trx'];
$nombre = $__view['nombre'];
$usuario = $__view['usuario'];
$msg = $__view['msg'];
$msg_type = $__view['msgType'];
require __DIR__ . '/../../views/historial/detalle_reverso.php';
