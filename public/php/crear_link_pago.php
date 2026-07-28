<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\PaymentLinks\PaymentLinkController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../textil/pl.php');
    exit();
}

(new PaymentLinkController())->handleCreate($_POST);
