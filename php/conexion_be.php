<?php
$conexion = mysqli_connect("localhost", "root", "root", "place_bsd");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>