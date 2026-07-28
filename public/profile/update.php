<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\ProfileUpdateController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

(new ProfileUpdateController())->handle($_POST, $_FILES);
