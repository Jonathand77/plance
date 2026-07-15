<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../textil/pl.php");
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
$producto = trim($_POST['producto'] ?? '');
$precio = trim($_POST['precio'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');

if (empty($producto) || empty($precio) || empty($correo)) {
    die("❌ Faltan datos.");
}

// Sanitizar
$producto = mysqli_real_escape_string($conexion, $producto);
$precio = mysqli_real_escape_string($conexion, $precio);
$correo = mysqli_real_escape_string($conexion, $correo);
$nombre = mysqli_real_escape_string($conexion, $nombre);

// Generar referencia única
$referencia = 'PL-' . strtoupper(bin2hex(random_bytes(4)));
$descripcion = 'Kit deportivo: ' . $producto;
$expiracion = date('Y-m-d H:i:s', strtotime('+24 hours'));

// ══════════════════════════════════════════
// 🔗 LINK DE PAGO — PlacetoPay
// ══════════════════════════════════════════
$login = "2d9eaf1e662518756a3d78806543af5b";
$secretKey = "3YC5brb5eAR4xBGQ";
$url = "https://sites-test.placetopay.com/api/payment-link";

$seed = date('c');
$nonce = bin2hex(random_bytes(16));
$tranKey = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
$nonceB64 = base64_encode($nonce);

$data = [
    "auth" => [
        "login" => $login,
        "tranKey" => $tranKey,
        "nonce" => $nonceB64,
        "seed" => $seed
    ],
    "locale" => "es_CO",
    "name" => $producto,
    "description" => $descripcion,
    "reference" => $referencia,
    "paymentsAllowed" => 12,
    "expirationDate" => $expiracion,
    "paymentExpiration" => 15,
    "payment" => [
        "amount" => [
            "currency" => "COP",
            "total" => (float) $precio
        ]
    ],
    "paymentMethod" => ["pse", "visa", "mastercard"],
    "notifyUrl" => "https://doorman-situated-delivery.ngrok-free.dev/plance/php/notify.php",
    "receiverEmails" => [$correo]
];

[$response, $curlError] = p2p_json_post($url, $data);

$result = json_decode($response, true);
$link_url = $result['url'] ?? $result['link'] ?? $result['data']['url'] ?? '';
$link_id = $result['id'] ?? $result['linkId'] ?? '';
$status = $result['status']['status'] ?? ($link_url ? 'OK' : 'ERROR');

// Guardar en BD
$link_url_safe = mysqli_real_escape_string($conexion, $link_url);
$link_id_safe = mysqli_real_escape_string($conexion, (string) $link_id);
$ref_safe = mysqli_real_escape_string($conexion, $referencia);
$exp_safe = mysqli_real_escape_string($conexion, $expiracion);
$estado_db = $link_url ? 'activo' : 'error';
$estado_safe = mysqli_real_escape_string($conexion, $estado_db);

$query = "INSERT INTO payment_link (producto, precio, link_id, link_url, referencia, descripcion, estado, expiracion, correo)
          VALUES ('$producto', '$precio', '$link_id_safe', '$link_url_safe', '$ref_safe', '$descripcion', '$estado_safe', '$exp_safe', '$correo')";

mysqli_query($conexion, $query);
$registro_id = mysqli_insert_id($conexion);

// Guardar en sesión para retorno
$_SESSION['link_result'] = [
    'registro_id' => $registro_id,
    'producto' => $producto,
    'precio' => $precio,
    'correo' => $correo,
    'nombre' => $nombre,
    'referencia' => $referencia,
    'link_url' => $link_url,
    'link_id' => $link_id,
    'expiracion' => $expiracion,
    'status' => $status,
    'http_code' => $httpCode,
    'raw' => $result
];

header("Location: ../retorno_link.php");
exit();
?>