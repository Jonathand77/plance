<?php

require_once 'conexion_be.php';
require_once __DIR__ . '/../../php/http_client.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }
}

//por si algun pobre diablo quiere pasarse de listo y acceder a esta página sin enviar el formulario, lo redirigimos a la página de inicio
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../home.php");
    exit();
}
// Datos del formulario
$producto = $_POST['producto'];
$precio = $_POST['precio'];
$jugador_id = $_POST['jugador_id'];
// Estado inicial
$estado = "pendiente";
// Guardar orden en BD
$query = "INSERT INTO ordenes (producto, precio, jugador_id, estado) 
          VALUES ('$producto', '$precio', '$jugador_id', '$estado')";
$resultado = mysqli_query($conexion, $query);
// Obtener ID de la orden
$order_id = mysqli_insert_id($conexion);
//Hagamos validaciones básicas :D
if (empty($_POST['jugador_id']) || empty($_POST['producto']) || empty($_POST['precio'])) {
    echo "Faltan datos";
    exit();
}
if (!$resultado) {
    die("Error al crear la orden: " . mysqli_error($conexion));
}
// 🔥 AQUÍ VA WEB CHECKOUT (luego lo metemos)
//AHORA SI, LLEGO LA HORA DE LA INTEGRACION >:3, aquí es donde se haría la llamada a la API de PlaceToPay para iniciar el proceso de pago, usando los datos de la orden que acabamos de crear. Luego, dependiendo de la respuesta de PlaceToPay, actualizaríamos el estado de la orden en la base de datos (por ejemplo, a "pagada" si el pago fue exitoso).

//Empezemos

// 🔥 Configuración de PlaceToPa
$login = "2d9eaf1e662518756a3d78806543af5b";
$secretKey = "3YC5brb5eAR4xBGQ";
$url = "https://checkout-test.placetopay.com/api/session";


//AUTH
$seed = date('c');
$nonce = bin2hex(random_bytes(16));
$tranKey = base64_encode(hash('sha256', $nonce . $seed . $secretKey, true));
$nonceBase64 = base64_encode($nonce);


//REQUEST (EL CUERPO)
$data = [
    "auth" => [
        "login" => $login,
        "tranKey" => $tranKey,
        "nonce" => $nonceBase64,
        "seed" => $seed
    ],
    "payment" => [
        "reference" => (string)$order_id,
        "description" => $producto,
        "amount" => [
            "currency" => "COP",
            "total" => (float)$precio
        ]
    ],
    "expiration" => date('c', strtotime('+1 hour')),
    "returnUrl" => "http://localhost/plance/retorno.php",
    "ipAddress" => $_SERVER['REMOTE_ADDR'],
    "userAgent" => $_SERVER['HTTP_USER_AGENT']
];

//consumir API de PlaceToPay
[$response] = p2p_json_post($url, $data);

$result = json_decode($response, true);




// Por ahora prueba básica:
if (isset($result['processUrl'])) {
    header("Location: " . $result['processUrl']);
    exit();
} else {
    echo "Error al crear sesión<br>";
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}
?>