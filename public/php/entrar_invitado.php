<?php

session_start();

// Si ya hay un usuario logueado, ir directo a home
if (isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

// Marcar la sesión como invitado: acceso sin cuenta, sin historial en BD
$_SESSION['invitado'] = true;

header('Location: ../index.php');
exit();
