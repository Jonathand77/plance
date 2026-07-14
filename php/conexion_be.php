<?php
//$conexion = mysqli_connect("127.0.0.1", "root", "root", "place_bsd", 3306);
$conexion = mysqli_connect("localhost", "root", "root", "place_bsd");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>