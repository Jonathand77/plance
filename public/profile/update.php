<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\ProfileUpdateController;
use Plance\Support\Auth;

if (!Auth::puedeAcceder()) {
    header('Location: ../login.php');
    exit();
}

(new ProfileUpdateController())->handle($_POST, $_FILES);
