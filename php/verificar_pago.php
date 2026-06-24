<?php
session_start();
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}
require_once __DIR__ . '/http_client.php';
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once 'conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion) die("Error de conexión: " . mysqli_connect_error());
}

// Recibir parámetros
$tabla      = $_GET['tabla']      ?? '';
$id         = intval($_GET['id']  ?? 0);
$request_id = $_GET['request_id'] ?? '';
$redirect   = $_GET['redirect']   ?? '../historial/historial.php';

// Validar tabla permitida (seguridad)
$tablas_permitidas = ['ordenes', 'suscripciones', 'recurrencias', 'suscription_rec', 'suscription', 'gateway_suscripciones', 'gateway_suscription', 'gateway_ordenes'];
if (!in_array($tabla, $tablas_permitidas) || !$id || !$request_id) {
    header("Location: $redirect");
    exit();
}

// ══════════════════════════════════════════
// Consultar estado a PlaceToPay
// ══════════════════════════════════════════
$login     = "2d9eaf1e662518756a3d78806543af5b";
$secretKey = "3YC5brb5eAR4xBGQ";
$url       = "https://checkout-test.placetopay.com/api/session/" . $request_id;

$seed     = date('c');
$nonce    = bin2hex(random_bytes(16));
$tranKey  = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
$nonceB64 = base64_encode($nonce);

$auth = [
    "auth" => [
        "login"   => $login,
        "tranKey" => $tranKey,
        "nonce"   => $nonceB64,
        "seed"    => $seed
    ]
];

[$response] = p2p_json_post($url, $auth);

$result = json_decode($response ?: '{}', true);

// ══════════════════════════════════════════
// Determinar nuevo estado
// ══════════════════════════════════════════
$status_p2p = $result['status']['status'] ?? 'UNKNOWN';

$nuevo_estado = match($status_p2p) {
    'APPROVED' => 'aprobada',
    'REJECTED' => 'rechazada',
    'PENDING'  => 'pendiente',
    default    => 'cancelada'
};

// ══════════════════════════════════════════
// Actualizar en BD
// ══════════════════════════════════════════
$id_safe     = mysqli_real_escape_string($conexion, $id);
$estado_safe = mysqli_real_escape_string($conexion, $nuevo_estado);
$tabla_safe  = $tabla; // ya validada arriba

mysqli_query($conexion, "UPDATE $tabla_safe SET estado = '$estado_safe' WHERE id = '$id_safe'");

// Redirigir de vuelta con mensaje
$_SESSION['verify_msg']  = "✅ Orden #$id actualizada a: " . strtoupper($nuevo_estado);
header("Location: $redirect");
exit();
?>