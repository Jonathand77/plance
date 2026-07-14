<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../plataformas/streaming_gateway.php");
    exit();
}

require_once 'conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

// Recibir datos
$servicio = trim($_POST['servicio'] ?? '');
$plan = trim($_POST['plan'] ?? '');
$precio = trim($_POST['precio'] ?? '');
$nombre = trim($_POST['nombre'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$tipo_doc = trim($_POST['tipo_doc'] ?? '');
$num_doc = trim($_POST['num_doc'] ?? '');

if (empty($servicio) || empty($plan) || empty($precio) || empty($nombre) || empty($correo) || empty($num_doc)) {
    die("❌ Faltan datos. Por favor completa todos los campos.");
}

// Sanitizar
$servicio = mysqli_real_escape_string($conexion, $servicio);
$plan = mysqli_real_escape_string($conexion, $plan);
$precio = mysqli_real_escape_string($conexion, $precio);
$nombre = mysqli_real_escape_string($conexion, $nombre);
$correo = mysqli_real_escape_string($conexion, $correo);
$telefono = mysqli_real_escape_string($conexion, $telefono);
$tipo_doc = mysqli_real_escape_string($conexion, $tipo_doc);
$num_doc = mysqli_real_escape_string($conexion, $num_doc);

// ══════════════════════════════════════════
// SIMULACIÓN API Gateway — Pago + Suscripción
// En producción real aquí iría la llamada
// al API Gateway con credenciales PCI-DSS
// ══════════════════════════════════════════
$campos_ok = !empty($nombre) && !empty($correo) && !empty($num_doc) && !empty($telefono);
$guardar_tarjeta = ($_POST['guardar_tarjeta'] ?? '0') === '1';
$estado_elegido = trim($_POST['estado_elegido'] ?? '');
$razon_elegida = trim($_POST['razon_elegida'] ?? '');

// Determinar estado según selector
if ($campos_ok && in_array($estado_elegido, ['aprobada-token', 'aprobada-sin', 'pendiente', 'rechazada'])) {
    $nuevo_estado = match ($estado_elegido) {
        'aprobada-token', 'aprobada-sin' => 'aprobada',
        'pendiente' => 'pendiente',
        default => 'rechazada'
    };
    $status = match ($nuevo_estado) {
        'aprobada' => 'APPROVED',
        'pendiente' => 'PENDING',
        default => 'REJECTED'
    };
    // Token solo si eligió aprobada-token
    $guardar_tarjeta = ($estado_elegido === 'aprobada-token');
} else {
    $nuevo_estado = $campos_ok ? 'aprobada' : 'rechazada';
    $status = $campos_ok ? 'APPROVED' : 'REJECTED';
}

$reference = 'GWSUB-' . strtoupper(bin2hex(random_bytes(4)));
$token = ($nuevo_estado === 'aprobada' && $guardar_tarjeta) ? 'TOK-' . strtoupper(bin2hex(random_bytes(8))) : '';

// Guardar en BD
$estado_safe = mysqli_real_escape_string($conexion, $nuevo_estado);
$ref_safe = mysqli_real_escape_string($conexion, $reference);
$token_safe = mysqli_real_escape_string($conexion, $token);

$query = "INSERT INTO gateway_suscripciones (servicio, plan, precio, nombre, correo, telefono, tipo_doc, num_doc, estado, request_id, token)
          VALUES ('$servicio', '$plan', '$precio', '$nombre', '$correo', '$telefono', '$tipo_doc', '$num_doc', '$estado_safe', '$ref_safe', '$token_safe')";

$resultado = mysqli_query($conexion, $query);
if (!$resultado)
    die("❌ Error al guardar: " . mysqli_error($conexion));

$orden_id = mysqli_insert_id($conexion);

// Guardar en sesión para retorno
$_SESSION['gw_sub_result'] = [
    'orden_id' => $orden_id,
    'tipo' => 'suscripciones',
    'status' => $status,
    'estado' => $nuevo_estado,
    'servicio' => $servicio,
    'plan' => $plan,
    'precio' => $precio,
    'nombre' => $nombre,
    'correo' => $correo,
    'reference' => $reference,
    'token' => $token,
    'message' => match ($nuevo_estado) {
        'aprobada' => $guardar_tarjeta ? '¡Suscripción completa! Tarjeta guardada. (' . $razon_elegida . ')' : 'Pago exitoso. Suscripción activada. (' . $razon_elegida . ')',
        'pendiente' => 'Transacción en proceso. (' . $razon_elegida . ')',
        default => 'Transacción rechazada. (' . $razon_elegida . ')'
    },
];

unset($_SESSION['gw_subs_pending']);
header("Location: ../retorno_suscripciones_gateway.php?orden=" . $orden_id);
exit();
?>