<?php


file_put_contents('notify_debug.log', date('Y-m-d H:i:s') . " - Received notify:\n" . file_get_contents('php://input') . "\n\n", FILE_APPEND);


// notify.php — Endpoint para recibir notificaciones de PlaceToPay
session_start();

// Solo acepta POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}
// notify.php — Notificaciones de PlaceToPay

require_once 'conexion_be.php';

if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', '', 'place_bsd');
    if (!$conexion) {
        http_response_code(500);
        exit('Error de conexión');
    }
}

// Credenciales PlaceToPay (ajusta según tu config)
define('P2P_LOGIN', '2d9eaf1e662518756a3d78806543af5b');
define('P2P_TRANKEY', '3YC5brb5eAR4xBGQ');

// Recibir body
$body = file_get_contents('php://input');
$data = json_decode($body, true);


// DEBUG temporal
file_put_contents(__DIR__ . '/webhook_log.txt', date('Y-m-d H:i:s') . "\n" . $body . "\n\n", FILE_APPEND);

$data = json_decode($body, true);
// ... resto del código sin cambios

if (empty($data)) {
    http_response_code(400);
    exit('Sin datos');
}

// **VALIDAR FIRMA** (X-Signature header)
$headers = getallheaders();
$signature = $headers['X-Signature'] ?? '';

if (empty($signature)) {
    http_response_code(401);
    exit('Sin firma');
}

$nonce = $data['status']['date'] ?? date('c');
$seed = date('c');
$tranKey = base64_encode(sha1($nonce . P2P_TRANKEY, true));
$expectedSignature = base64_encode(sha1(P2P_LOGIN . $nonce . $tranKey, true));

if ($signature !== $expectedSignature) {
    http_response_code(403);
    exit('Firma inválida');
}

// Extraer datos
$status     = $data['status']['status'] ?? '';
$request_id = $data['requestId'] ?? '';
$reference  = $data['payment'][0]['reference'] ?? '';

if (empty($status) || empty($request_id)) {
    http_response_code(400);
    exit('Datos incompletos');
}

// Mapear estado
$nuevo_estado = match($status) {
    'APPROVED' => 'aprobada',
    'REJECTED' => 'rechazada',
    'PENDING'  => 'pendiente',
    default    => 'cancelada'
};

$request_id_safe = mysqli_real_escape_string($conexion, $request_id);
$estado_safe     = mysqli_real_escape_string($conexion, $nuevo_estado);

// Función para extraer token
function extraer_token($data) {
    $token = '';
    
    // Intento 1: subscription.instrument
    if (isset($data['subscription']['instrument']) && is_array($data['subscription']['instrument'])) {
        foreach ($data['subscription']['instrument'] as $item) {
            if (($item['keyword'] ?? '') === 'token') {
                return $item['value'] ?? '';
            }
        }
    }
    
    // Intento 2: payment[0].subscription
    if (isset($data['payment'][0]['subscription']) && is_array($data['payment'][0]['subscription'])) {
        foreach ($data['payment'][0]['subscription'] as $item) {
            if (($item['keyword'] ?? '') === 'token') {
                return $item['value'] ?? '';
            }
        }
    }
    
    return '';
}

// Identificar tabla por prefijo de referencia
if (strpos($reference, 'REC-') === 0) {                                                                            
    // Recurrencias
    $id = intval(str_replace('REC-', '', $reference));
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $query = "UPDATE recurrencias SET estado = '$estado_safe' WHERE id = '$id_safe' AND request_id = '$request_id_safe'";
    
} elseif (strpos($reference, 'SUB-') === 0) {
    // Suscripciones (tabla suscripciones)
    $id = intval(str_replace('SUB-', '', $reference));
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $token = '';
    if ($nuevo_estado === 'aprobada') {
        $token = extraer_token($data);
    }
    $token_safe = mysqli_real_escape_string($conexion, $token);
    
    $query = "UPDATE suscripciones SET estado = '$estado_safe', token = '$token_safe' WHERE id = '$id_safe' AND request_id = '$request_id_safe'";
    
} elseif (strpos($reference, 'SUB-') === 0) {
    // Suscripciones puras (tabla suscription)
    $id = intval(str_replace('SUB-', '', $reference));
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $token = '';
    if ($nuevo_estado === 'aprobada') {
        $token = extraer_token($data);
    }
    $token_safe = mysqli_real_escape_string($conexion, $token);
    
    $query = "UPDATE suscription SET estado = '$estado_safe', token = '$token_safe' WHERE id = '$id_safe' AND request_id = '$request_id_safe'";
    
} elseif (strpos($reference, 'SREC-') === 0) {
    // Suscripciones recurrentes (tabla suscription_rec)
    $id = intval(str_replace('SREC-', '', $reference));
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $query = "UPDATE suscription_rec SET estado = '$estado_safe' WHERE id = '$id_safe' AND request_id = '$request_id_safe'";
    
} elseif (strpos($reference, 'GW-') === 0) {
    // Gateway ordenes (pago básico sin WC)
    $id = intval(str_replace('GW-', '', $reference));
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $query = "UPDATE gateway_ordenes SET estado = '$estado_safe' WHERE id = '$id_safe' AND request_id = '$request_id_safe'";
    
} else {
    // Ordenes básicas (solo número)
    $id = intval($reference);
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $query = "UPDATE ordenes SET estado = '$estado_safe' WHERE id = '$id_safe'";
}



// else {
    // Ordenes básicas (solo número)
    $id = intval($reference);
    $id_safe = mysqli_real_escape_string($conexion, $id);
    
    $query = "UPDATE ordenes SET estado = '$estado_safe' WHERE id = '$id_safe'";
// } 

// Ejecutar query y validar
$result = mysqli_query($conexion, $query);

if (!$result) {
    error_log("Error webhook notify.php: " . mysqli_error($conexion));
    http_response_code(500);
    exit('Error BD');
}

http_response_code(200);
echo json_encode(['status' => 'OK']);
?>