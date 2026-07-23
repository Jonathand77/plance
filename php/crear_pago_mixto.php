<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../games/rainbowsix.php");
    exit();
}

require_once 'conexion_be.php';
require_once __DIR__ . '/http_client.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

// Recibir datos
$jugador_id = trim($_POST['jugador_id'] ?? '');
$productos = trim($_POST['productos'] ?? '');
$total = (float) ($_POST['total'] ?? 0);
$monto_parcial = (float) ($_POST['monto_parcial'] ?? $total);
$allow_partial = ($_POST['allow_partial'] ?? '0') === '1';

if (empty($jugador_id) || empty($productos) || $total <= 0) {
    die("❌ Faltan datos principales.");
}

$jugador_id = mysqli_real_escape_string($conexion, $jugador_id);
$productos = mysqli_real_escape_string($conexion, $productos);

// ── Credenciales y Auth ──
$login = "2d9eaf1e662518756a3d78806543af5b";
$secretKey = "3YC5brb5eAR4xBGQ";
$endpoint = "https://checkout-test.placetopay.com/api/session";

$seed = date('c');
$nonce = bin2hex(random_bytes(16));
$tranKey = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
$nonceB64 = base64_encode($nonce);

$reference = 'MIX-' . strtoupper(bin2hex(random_bytes(4)));

// ── Body del request ──
// Si allow_partial = true, enviamos el monto parcial como total
// y allowPartial: true para que PlacetoPay permita pago incompleto
$monto_a_cobrar = $allow_partial ? $monto_parcial : $total;

$body = [
    "auth" => [
        "login" => $login,
        "tranKey" => $tranKey,
        "nonce" => $nonceB64,
        "seed" => $seed
    ],
    "payment" => [
        "reference" => $reference,
        "description" => $productos,
        "amount" => [
            "currency" => "COP",
            "total" => $monto_a_cobrar
        ],
        "allowPartial" => $allow_partial
    ],
    "expiration" => date('c', strtotime('+30 minutes')),
    "returnUrl" => "http://localhost/plance/retorno_mixto.php",
    "ipAddress" => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
    "userAgent" => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
    "locale" => "es_CO"
];

// ── Llamada a PlacetoPay ──
[$response, $curlError] = p2p_json_post($endpoint, $body);

if ($curlError) {
    die("❌ Error de conexión: " . $curlError);
}

$result = json_decode($response ?: '{}', true);
$status = $result['status']['status'] ?? 'FAILED';
$message = $result['status']['message'] ?? 'Sin respuesta';
$requestId = $result['requestId'] ?? null;
$processUrl = $result['processUrl'] ?? null;

// ── Guardar en BD ──
$estado_db = ($status === 'OK') ? 'pendiente' : 'rechazada';
$est_safe = mysqli_real_escape_string($conexion, $estado_db);
$prod_safe = mysqli_real_escape_string($conexion, $productos);
$rid_safe = mysqli_real_escape_string($conexion, (string) ($requestId ?? 0));

$query = "INSERT INTO ordenes (request_id, producto, precio, jugador_id, estado, monto_pagado)
          VALUES ('$rid_safe', '$prod_safe', '$total', '$jugador_id', '$est_safe', NULL)";

mysqli_query($conexion, $query);
$orden_id = mysqli_insert_id($conexion);

// ── Sesión para retorno ──
$_SESSION['mix_result'] = [
    'orden_id' => $orden_id,
    'productos' => $productos,
    'total' => $total,
    'monto_parcial' => $monto_parcial,
    'allow_partial' => $allow_partial,
    'reference' => $reference,
    'requestId' => $requestId,
    'processUrl' => $processUrl,
    'status' => $status,
    'message' => $message,
];

// Si todo bien → redirigir a PlacetoPay
if ($status === 'OK' && $processUrl) {
    header("Location: " . $processUrl);
    exit();
}

// Si falló → retorno con error
header("Location: ../retorno_mixto.php?error=1");
exit();
?>