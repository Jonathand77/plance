<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Ordenes\PagoMixtoController;

$ordenId = (int) ($_GET['id'] ?? 0);

if (!$ordenId) {
    header('Location: ../historial/reg-pgb.php?modo=mixto');
    exit();
}

(new PagoMixtoController())->handleContinuar($ordenId);
