<?php

require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Auth\RegisterController;

(new RegisterController())->handle($_POST);
