<?php
session_start();
require_once __DIR__ . '/conexion_be.php';

$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

// Leer POST de forma segura
$correo     = mysqli_real_escape_string($conexion, $_POST['correo'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

// Validar campos
if ($correo === '' || $contrasena === '') {
    echo "
        <script>
            alert('Rellene todos los campos');
            window.location = '../index.php';
        </script>
    ";
    exit();
}

// Buscar usuario por correo
$query = "SELECT * FROM users WHERE correo = '$correo' LIMIT 1";
$resultado = mysqli_query($conexion, $query);

if ($row = mysqli_fetch_assoc($resultado)) {
    if (password_verify($contrasena, $row['contrasena'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['usuario'] = $row['usuario'];
        $_SESSION['correo']  = $row['correo'];

        header("Location: ../home.php");
        exit();
    } else {
        echo "
            <script>
                alert('Contraseña incorrecta');
                window.location = '../index.php';
            </script>
        ";
        exit();
    }
} else {
    echo "
        <script>
            alert('Usuario no encontrado');
            window.location = '../index.php';
        </script>
    ";
    exit();
}
?>