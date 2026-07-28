<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Profile\ProfileEditController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new ProfileEditController())->handle();
$row = $__view['row'];
$msg = $__view['msg'];
$msg_type = $__view['msgType'];
require __DIR__ . '/../../views/profile/edit_profile.php';
