<?php

session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Suscripciones\SuscripcionController;

(new SuscripcionController())->handleTokenizar($_GET);
