<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Dispersiones\DispersionController;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../dispersiones/tickets.php');
    exit();
}

(new DispersionController())->handleCreate($_POST);
