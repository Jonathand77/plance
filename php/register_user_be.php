<?php
require_once __DIR__ . '/conexion_be.php';
if (!isset($conexion)) {
    die("Error: database connection not initialized.");
}

// Sanitizar datos
$id         = mysqli_real_escape_string($conexion, $_POST['id'] ?? '');
$nombre     = mysqli_real_escape_string($conexion, $_POST['nombre'] ?? '');
$correo     = mysqli_real_escape_string($conexion, $_POST['correo'] ?? '');
$usuario    = mysqli_real_escape_string($conexion, $_POST['usuario'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

// Trim
$nombre = trim($nombre);

// Validar campos
if ($id === "" || $nombre === "" || $correo === "" || $usuario === "" || $contrasena === "") {
    echo "<script>alert('Por favor rellena todos los campos'); window.location='../index.php';</script>";
    exit();
}

// Validaciones
if (!preg_match('/^[0-9()+]{1,20}$/', $id)) {
    echo "<script>alert('La identificación solo puede contener números y paréntesis, entre 1 y 20 caracteres'); window.location='../index.php';</script>";
    exit();
}

if (strlen($nombre) < 5) {
    echo "<script>alert('El nombre debe tener al menos 5 caracteres'); window.location='../index.php';</script>";
    exit();
}

if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $nombre)) {
    echo "<script>alert('El nombre solo puede contener letras y espacios'); window.location='../index.php';</script>";
    exit();
}

if (str_word_count($nombre) < 2) {
    echo "<script>alert('Debes ingresar nombre y apellido'); window.location='../index.php';</script>";
    exit();
}

if (strlen($contrasena) < 8) {
    echo "<script>alert('La contraseña debe tener mínimo 8 caracteres'); window.location='../index.php';</script>";
    exit();
}
if (!preg_match('/[A-Z]/', $contrasena)) {
    echo "<script>alert('La contraseña debe tener al menos una letra mayúscula'); window.location='../index.php';</script>";
    exit();
}
if (!preg_match('/[a-z]/', $contrasena)) {
    echo "<script>alert('La contraseña debe tener al menos una letra minúscula'); window.location='../index.php';</script>";
    exit();
}
if (!preg_match('/[0-9]/', $contrasena)) {
    echo "<script>alert('La contraseña debe tener al menos un número'); window.location='../index.php';</script>";
    exit();
}
if (!preg_match('/[\W_]/', $contrasena)) {
    echo "<script>alert('La contraseña debe tener al menos un carácter especial'); window.location='../index.php';</script>";
    exit();
}

// Verificar correo
$verificar_correo = mysqli_query($conexion, "SELECT 1 FROM users WHERE correo = '$correo' LIMIT 1");
if (mysqli_num_rows($verificar_correo) > 0) {
    echo "<script>alert('Este correo ya está registrado'); window.location='../index.php';</script>";
    exit();
}

// Verificar usuario
$verificar_usuario = mysqli_query($conexion, "SELECT 1 FROM users WHERE usuario = '$usuario' LIMIT 1");
if (mysqli_num_rows($verificar_usuario) > 0) {
    echo "<script>alert('Este usuario ya está registrado'); window.location='../index.php';</script>";
    exit();
}

// Hash
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Insertar
$query = "INSERT INTO users (id, nombre, correo, usuario, contraseña, profile_image, location, bio)
VALUES ('$id', '$nombre', '$correo', '$usuario', '$contrasena_hash', 'assets/img/default.png', 'No especificada', '')";

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    echo "<script>alert('Usuario registrado exitosamente'); window.location='../index.php';</script>";
} else {
    echo "<script>alert('Error al registrar usuario'); window.location='../index.php';</script>";
}

mysqli_close($conexion);
?>