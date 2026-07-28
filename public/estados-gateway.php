<?php
session_start();


// Recibir datos del formulario de pubg/bloodstrike y guardar en sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['gw_pending'] = $_POST;
}

// Si no hay datos pendientes redirigir
if (empty($_SESSION['gw_pending'])) {
    header("Location: index.php");
    exit();
}

$producto = $_SESSION['gw_pending']['producto'] ?? 'Producto';
$precio = $_SESSION['gw_pending']['precio'] ?? 0;
require __DIR__ . '/../views/estados-gateway.php';
