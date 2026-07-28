<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placetopay</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <link rel="stylesheet"
        href="assets/css/estilos.css?v=<?php echo filemtime(__DIR__ . '/assets/css/estilos.css'); ?>">
</head>

<link rel="stylesheet" href="assets/css/pages/login.css">

<body>
    <main>
        <div class="contenedor__todo">

            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>

                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>


            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
                <form action="php/login_user_be.php" method="POST" class="formulario__login">
                    <img src="assets/icons/iconoy.png" alt="Logo de EV" class="login-logo"
                        style="width: 50px; height: 50px; margin-bottom: 20px; align-self: center; display: block; margin-left: auto; margin-right: auto;">
                    <h2>Iniciar Sesión</h2>
                    <input type="text" placeholder="correo" name="correo">
                    <div class="form-control-password">
                        <input type="password" id="loginpassword" name="contrasena" required placeholder="contraseña">
                        <i id="toggleIconLogin" class="bi bi-eye toggle-icon"></i>
                    </div>
                    <button>Entrar</button>
                    <a href="index.php" class="btn-volver">
                        <i class="bi bi-backspace-fill"></i> Volver a la aplicación
                    </a>
                </form>

                <!--Register-->
                <form action="php/register_user_be.php" METHOD="POST" class="formulario__register">
                    <img src="assets/icons/iconoy.png" alt="Logo de EV" class="login-logo"
                        style="width: 50px; height: 50px; margin-bottom: 20px; align-self: center; display: block; margin-left: auto; margin-right: auto;">
                    <h2>Regístrarse</h2>
                    <input type="text" placeholder="identificacion" name="id" pattern="[0-9]+">
                    <input type="text" placeholder="nombre y apellido" name="nombre"
                        pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}">
                    <input type="email" placeholder="correo" name="correo">
                    <input type="text" placeholder="usuario" name="usuario">

                    <div class="form-control-password">
                        <input type="password" id="registerPassword" name="contrasena" required
                            placeholder="contraseña">
                        <i id="toggleIcon" class="bi bi-eye toggle-icon"></i>
                    </div>

                    <h6 style="color: var(--color-primary); text-align: center; margin-top: 10px;">Sugerencia</h6>
                    <i class="bi bi-exclamation-circle" style="color: var(--color-primary);"></i>
                    <small style="color: var(--color-secondary-5); font-size: 12px;">
                        Tu contraseña debe tener mínimo 8 caracteres, mayúscula, número y símbolo
                    </small>

                    <!-- BARRA DE FUERZA -->
                    <div class="strength-bar">
                        <div id="strengthLevel" class="strength-bar-fill"></div>
                    </div>
                    <small id="strengthText" style="color: var(--color-secondary-5);"></small>
                    <button>Regístrarse</button>
                </form>

            </div>
        </div>
    </main>

    <script src="assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>