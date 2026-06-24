<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../games/pubg.php");
    exit();
}

require_once 'conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion) die("Error de conexión: " . mysqli_connect_error());
}

// Recibir datos
$producto   = trim($_POST['producto']   ?? '');
$precio     = trim($_POST['precio']     ?? '');
$jugador_id = trim($_POST['jugador_id'] ?? '');
$metodo     = trim($_POST['metodo']     ?? 'tarjeta');
$tipo_doc   = trim($_POST['tipo_doc']   ?? '');
$num_doc    = trim($_POST['num_doc']    ?? '');
$correo     = trim($_POST['correo']     ?? '');
$telefono   = trim($_POST['telefono']   ?? '');
$nombre     = trim($_POST['card_name']  ?? $_POST['nombre'] ?? '');

if (empty($producto) || empty($precio) || empty($jugador_id)) {
    die("❌ Faltan datos principales.");
}

// Sanitizar
$producto   = mysqli_real_escape_string($conexion, $producto);
$precio     = mysqli_real_escape_string($conexion, $precio);
$jugador_id = mysqli_real_escape_string($conexion, $jugador_id);
$correo     = mysqli_real_escape_string($conexion, $correo);
$telefono   = mysqli_real_escape_string($conexion, $telefono);
$tipo_doc   = mysqli_real_escape_string($conexion, $tipo_doc);
$num_doc    = mysqli_real_escape_string($conexion, $num_doc);
$nombre     = mysqli_real_escape_string($conexion, $nombre);

// ══════════════════════════════════════════
// SIMULACIÓN API Gateway (Demo)
// En producción real aquí iría la llamada
// al API Gateway con credenciales PCI-DSS
// ══════════════════════════════════════════
$campos_ok = !empty($nombre) && !empty($correo) && !empty($num_doc) && !empty($telefono);

if ($metodo === 'tarjeta') {
    $card_number = preg_replace('/\s/', '', $_POST['card_number'] ?? '');
    $campos_ok   = $campos_ok && strlen($card_number) >= 15 && !empty($_POST['card_cvv']);
} else {
    $campos_ok = $campos_ok && !empty($_POST['num_cuenta']);
}

// ── Usar estado elegido en estados-gateway.php ──
$estado_elegido = trim($_POST['estado_elegido'] ?? '');
$razon_elegida  = trim($_POST['razon_elegida']  ?? '');

if ($campos_ok && in_array($estado_elegido, ['aprobada', 'pendiente', 'rechazada'])) {
    $nuevo_estado = $estado_elegido;
} else {
    $nuevo_estado = $campos_ok ? 'aprobada' : 'rechazada';
}

$status = match($nuevo_estado) {
    'aprobada'  => 'APPROVED',
    'pendiente' => 'PENDING',
    default     => 'REJECTED'
};

$reference = 'GW-DEMO-' . strtoupper(bin2hex(random_bytes(4)));

// Guardar en BD
$estado_safe = mysqli_real_escape_string($conexion, $nuevo_estado);
$ref_safe    = mysqli_real_escape_string($conexion, $reference);

$query = "INSERT INTO gateway_ordenes (producto, precio, nombre, correo, telefono, tipo_doc, num_doc, estado, request_id)
          VALUES ('$producto', '$precio', '$nombre', '$correo', '$telefono', '$tipo_doc', '$num_doc', '$estado_safe', '$ref_safe')";

$resultado = mysqli_query($conexion, $query);
if (!$resultado) die("❌ Error al guardar: " . mysqli_error($conexion));

$orden_id = mysqli_insert_id($conexion);

// Guardar en sesión para retorno
$_SESSION['gw_result'] = [
    'orden_id'  => $orden_id,
    'status'    => $status,
    'estado'    => $nuevo_estado,
    'producto'  => $producto,
    'precio'    => $precio,
    'correo'    => $correo,
    'nombre'    => $nombre,
    'message'   => match($nuevo_estado) {
        'aprobada'  => 'Transacción aprobada exitosamente. (' . $razon_elegida . ')',
        'pendiente' => 'Transacción en proceso. (' . $razon_elegida . ')',
        default     => 'Transacción rechazada. (' . $razon_elegida . ')'
    },
    'reference' => $reference,
    'metodo'    => $metodo
];

unset($_SESSION['gw_pending']);
header("Location: ../retorno_gateway.php?orden=" . $orden_id);
exit();
?>