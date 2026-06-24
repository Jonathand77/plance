<?php
require __DIR__ . '/php/conexion_be.php';
var_dump(isset($conexion));
if (isset($conexion)) {
    echo 'connected? ' . (mysqli_ping($conexion) ? 'yes' : 'no') . PHP_EOL;
}
?>