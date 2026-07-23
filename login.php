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

<style>
    :root {
        /* Nueva paleta estandarizada */
        --color-primary: #FF6C0C;
        --color-secondary-1: #00CFB4;
        --color-secondary-2: #4C5F71;
        --color-secondary-3: #0062A8;
        --color-secondary-4: #1E212C;
        --color-secondary-5: #7D868C;
        --text-main: #f1f5f9;
    }

    /* Ajustes específicos para el login */
    .contenedor__todo {
        width: 100%;
        max-width: 800px;
        margin: auto;
        position: relative;
        padding-top: 60px;
    }

    .caja__trasera {
        width: 100%;
        padding: 10px 20px;
        display: flex;
        justify-content: center;
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        background-color: rgba(30, 33, 44, 0.7);
        border: 1px solid var(--color-secondary-2);
        border-radius: 16px;
    }

    .caja__trasera div {
        margin: 100px 40px;
        color: white;
        transition: all 500ms;
    }

    .caja__trasera div p,
    .caja__trasera button {
        margin-top: 30px;
    }

    .caja__trasera div h3 {
        font-weight: 400;
        font-size: 26px;
    }

    .caja__trasera div p {
        font-size: 16px;
        font-weight: 300;
    }

    .caja__trasera button {
        padding: 10px 40px;
        border: 2px solid var(--color-primary);
        font-size: 14px;
        background: transparent;
        font-weight: 600;
        cursor: pointer;
        color: white;
        outline: none;
        transition: all 300ms;
        border-radius: 8px;
    }

    .caja__trasera button:hover {
        background: var(--color-primary);
        color: #000000;
    }

    .contenedor__login-register {
        display: flex;
        align-items: center;
        width: 100%;
        max-width: 380px;
        position: relative;
        top: -185px;
        left: 10px;
        transition: left 500ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
    }

    .contenedor__login-register form {
        width: 100%;
        padding: 80px 20px;
        background: linear-gradient(to bottom, var(--color-secondary-4), #0d0e10);
        position: absolute;
        border-radius: 20px;
        border: 1px solid var(--color-secondary-2);
    }

    .contenedor__login-register form h2 {
        font-size: 30px;
        text-align: center;
        margin-bottom: 20px;
        color: var(--color-primary);
    }

    .contenedor__login-register form input {
        width: 100%;
        margin-top: 20px;
        padding: 10px;
        border: 1px solid var(--color-secondary-2);
        background: rgba(30, 33, 44, 0.6);
        font-size: 16px;
        outline: none;
        color: #ffffff;
        border-radius: 8px;
        transition: border-color 0.3s ease;
    }

    .contenedor__login-register form input:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(255, 108, 12, 0.15);
    }

    .contenedor__login-register form button {
        padding: 10px 40px;
        margin-top: 40px;
        border: none;
        font-size: 14px;
        background-color: var(--color-primary);
        font-weight: 600;
        cursor: pointer;
        color: #ffffff;
        outline: none;
        border-radius: 8px;
        transition: all 300ms;
        height: 40px;
        width: 100%;
    }

    .contenedor__login-register form button:hover {
        background: var(--color-secondary-3);
        color: #fff;
    }

    .formulario__login {
        opacity: 1;
        display: block;
    }

    .formulario__register {
        display: none;
    }

    .btn-volver {
        background: var(--color-primary) !important;
        color: #0d0e10 !important;
        border: none !important;
        height: 40px;
        width: 100%;
        margin-top: 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 300ms;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-volver:hover {
        background: var(--color-secondary-3) !important;
        color: #fff !important;
    }

    .login-logo {
        filter: brightness(0) saturate(100%) invert(60%) sepia(89%) saturate(3000%) hue-rotate(0deg) brightness(100%) contrast(100%);
    }

    .strength-bar {
        height: 8px;
        width: 100%;
        background: var(--color-secondary-2);
        margin-top: 5px;
        border-radius: 4px;
        overflow: hidden;
    }

    .strength-bar-fill {
        height: 100%;
        width: 0%;
        transition: 0.3s;
        border-radius: 4px;
    }

    .toggle-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        color: var(--color-secondary-5);
        transition: color 0.3s;
        z-index: 5;
    }

    .toggle-icon:hover {
        color: var(--color-primary);
    }

    .form-control-password {
        position: relative;
    }

    .form-control-password input {
        width: 100%;
        padding-right: 40px;
    }

    @media screen and (max-width: 850px) {
        .contenedor__todo {
            padding-top: 30px;
        }

        .caja__trasera {
            max-width: 350px;
            height: 300px;
            flex-direction: column;
            margin: auto;
        }

        .caja__trasera div {
            margin: 0px;
            position: absolute;
        }

        .contenedor__login-register {
            top: -10px;
            left: -5px;
            margin: auto;
        }

        .contenedor__login-register form {
            position: relative;
        }
    }
</style>

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