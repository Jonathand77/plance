<?php
$conexion = mysqli_connect("localhost", "root", "", "place_bsd");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
