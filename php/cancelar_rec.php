<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}
require_once 'conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

$rec_id = intval($_GET['id'] ?? 0);
$redirect = '../historial/reg-rec.php';

if (!$rec_id) {
    header("Location: $redirect");
    exit();
}

// Verificar que la recurrencia pertenece al usuario en sesión
$rec_id_safe = mysqli_real_escape_string($conexion, $rec_id);
$correo_safe = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

$rec = mysqli_fetch_assoc(mysqli_query(
    $conexion,
    "SELECT * FROM recurrencias WHERE id = '$rec_id_safe' AND usuario_id = '$correo_safe'"
));

if (!$rec) {
    $_SESSION['cancel_msg'] = '❌ No se encontró la membresía o no tienes permisos para cancelarla.';
    header("Location: $redirect");
    exit();
}

// Verificar que esté aprobada
if (strtolower($rec['estado']) !== 'aprobada') {
    $_SESSION['cancel_msg'] = '❌ Solo se pueden cancelar membresías activas (aprobadas).';
    header("Location: $redirect");
    exit();
}

// Actualizar estado a cancelada en BD
mysqli_query(
    $conexion,
    "UPDATE recurrencias SET estado = 'cancelada' WHERE id = '$rec_id_safe'"
);

$_SESSION['cancel_msg'] = '🚫 Membresía #' . $rec_id . ' (' . $rec['servicio'] . ' — ' . $rec['plan'] . ') cancelada correctamente.';
header("Location: $redirect");
exit();
?>