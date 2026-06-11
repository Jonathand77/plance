<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../plataformas/music_gateway.php");
    exit();
}

require_once 'conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', '', 'place_bsd');
    if (!$conexion) die("Error de conexión: " . mysqli_connect_error());
}

$servicio = trim($_POST['servicio'] ?? '');
$plan     = trim($_POST['plan']     ?? '');
$precio   = trim($_POST['precio']   ?? '');
$nombre   = trim($_POST['nombre']   ?? '');
$correo   = trim($_POST['correo']   ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$tipo_doc = trim($_POST['tipo_doc'] ?? '');
$num_doc  = trim($_POST['num_doc']  ?? '');

if (empty($servicio) || empty($plan) || empty($precio) || empty($nombre) || empty($correo) || empty($num_doc)) {
    die("❌ Faltan datos. Por favor completa todos los campos.");
}

$servicio = mysqli_real_escape_string($conexion, $servicio);
$plan     = mysqli_real_escape_string($conexion, $plan);
$precio   = mysqli_real_escape_string($conexion, $precio);
$nombre   = mysqli_real_escape_string($conexion, $nombre);
$correo   = mysqli_real_escape_string($conexion, $correo);
$telefono = mysqli_real_escape_string($conexion, $telefono);
$tipo_doc = mysqli_real_escape_string($conexion, $tipo_doc);
$num_doc  = mysqli_real_escape_string($conexion, $num_doc);

// ══════════════════════════════════════════
// SIMULACIÓN API Gateway — Suscripción pura
// En producción real aquí iría la llamada
// al API Gateway con credenciales PCI-DSS
// ══════════════════════════════════════════
$campos_ok    = !empty($nombre) && !empty($correo) && !empty($num_doc) && !empty($telefono);

// ── Estado elegido en estados-subs-gateway.php ──
$estado_elegido = trim($_POST['estado_elegido'] ?? '');
$razon_elegida  = trim($_POST['razon_elegida']  ?? '');

if ($campos_ok && in_array($estado_elegido, ['aprobada-token', 'aprobada-sin', 'pendiente', 'rechazada'])) {
    $estado_final = $estado_elegido;
} else {
    $estado_final = $campos_ok ? 'aprobada-token' : 'rechazada';
}

switch ($estado_final) {
    case 'aprobada-token':
        $status = 'APPROVED'; $nuevo_estado = 'aprobada'; $con_token = true;  break;
    case 'aprobada-sin':
        $status = 'APPROVED'; $nuevo_estado = 'aprobada'; $con_token = false; break;
    case 'pendiente':
        $status = 'PENDING';  $nuevo_estado = 'pendiente'; $con_token = false; break;
    default:
        $status = 'REJECTED'; $nuevo_estado = 'rechazada'; $con_token = false; break;
}

$reference = 'GWMUS-' . strtoupper(bin2hex(random_bytes(4)));
$token     = $con_token ? 'TOK-' . strtoupper(bin2hex(random_bytes(8))) : '';

$estado_safe = mysqli_real_escape_string($conexion, $nuevo_estado);
$ref_safe    = mysqli_real_escape_string($conexion, $reference);
$token_safe  = mysqli_real_escape_string($conexion, $token);

$query = "INSERT INTO gateway_suscription (servicio, plan, precio, nombre, correo, telefono, tipo_doc, num_doc, estado, request_id, token)
          VALUES ('$servicio', '$plan', '$precio', '$nombre', '$correo', '$telefono', '$tipo_doc', '$num_doc', '$estado_safe', '$ref_safe', '$token_safe')";

$resultado = mysqli_query($conexion, $query);
if (!$resultado) die("❌ Error al guardar: " . mysqli_error($conexion));

$orden_id = mysqli_insert_id($conexion);

$_SESSION['gw_mus_result'] = [
    'orden_id'  => $orden_id,
    'status'    => $status,
    'estado'    => $nuevo_estado,
    'servicio'  => $servicio,
    'plan'      => $plan,
    'precio'    => $precio,
    'nombre'    => $nombre,
    'correo'    => $correo,
    'reference' => $reference,
    'token'     => $token,
    'message'   => match($nuevo_estado) {
        'aprobada'  => !empty($token) ? 'Suscripción registrada y tarjeta tokenizada. (' . $razon_elegida . ')' : 'Suscripción registrada sin tokenizar la tarjeta. (' . $razon_elegida . ')',
        'pendiente' => 'Suscripción en proceso de verificación. (' . $razon_elegida . ')',
        default     => 'Suscripción rechazada. (' . $razon_elegida . ')'
    },
];

unset($_SESSION['gw_subs_pending']);
header("Location: ../retorno_suscription_gateway.php?orden=" . $orden_id);
exit();
?>