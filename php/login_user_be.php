<?php

session_start();
require_once __DIR__ . '/../src/bootstrap.php';

use Plance\Controllers\Auth\LoginController;

(new LoginController())->handle($_POST);
