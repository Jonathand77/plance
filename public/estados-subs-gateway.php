<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['gw_subs_pending'] = $_POST;
}

if (empty($_SESSION['gw_subs_pending'])) {
    header("Location: index.php");
    exit();
}

$data = $_SESSION['gw_subs_pending'];
$servicio = $data['servicio'] ?? 'Servicio';
$plan = $data['plan'] ?? '';
$precio = $data['precio'] ?? 0;
$tipo = isset($data['guardar_tarjeta']) ? 'suscripciones' : 'suscription';
$es_pago_sub = ($tipo === 'suscripciones'); // streaming = pago+sub, music = pura
require __DIR__ . '/../views/estados-subs-gateway.php';
