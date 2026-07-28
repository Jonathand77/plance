<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    die();
}
$__publicDir = __DIR__;
require __DIR__ . '/../views/login.php';
