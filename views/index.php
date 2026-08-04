<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://googleapis.com" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<!-- Logica NAV -->
<?php
$nav_base = '';
$nav_back_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $nav_base . 'index.php';
$nav_back_text = 'Volver';

// Traer foto de perfil del usuario en sesión
$nav_avatar = '';
$nav_initials = '';

if (isset($_SESSION['user_id'])) {
    if (!isset($conexion)) {
        require_once $__publicDir . '/php/conexion_be.php';
    }
    if ($conexion) {
        $nav_uid = intval($_SESSION['user_id']);
        $nav_row = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT profile_image, usuario FROM users WHERE id = '$nav_uid'"));
        if ($nav_row) {
            $nav_initials = strtoupper(substr($nav_row['usuario'] ?? 'U', 0, 1));
            $img_path = $nav_base . 'uploads/' . ($nav_row['profile_image'] ?? '');
            if (!empty($nav_row['profile_image']) && file_exists($nav_base . 'uploads/' . $nav_row['profile_image'])) {
                $nav_avatar = $nav_base . 'uploads/' . htmlspecialchars($nav_row['profile_image']);
            }
        }
    }
}
?>

<!-- ESTILOS PROPIOS -->
<link rel="stylesheet" href="assets/css/pages/index.css">

<body class="home d-flex flex-column min-vh-100">
    <nav class="navbar navbar-dark navbar-expand-lg px-3 py-2">
        <a class="navbar-brand fw-bold" href="<?= $nav_base ?>index.php" style="color: var(--color-primary);">
            <img src="<?= $nav_base ?>assets/icons/iconoy.png" alt="Logo" style="width: 30px;">
        </a>

        <div class="ms-auto d-flex align-items-center gap-2">

            <!-- Nombre del usuario -->
            <span class="nav-username">
                <?= isset($_SESSION['usuario']) ? "Hola, " . htmlspecialchars($_SESSION['usuario']) : "Invitado" ?>
            </span>

            <?php if (isset($_SESSION['usuario'])): ?>
                <!-- Avatar clickeable → perfil -->
                <a href="<?= $nav_base ?>profile/index.php" class="nav-avatar-wrap" title="Mi perfil">
                    <?php if ($nav_avatar): ?>
                        <img src="<?= $nav_avatar ?>" class="nav-avatar-img" alt="Perfil">
                    <?php else: ?>
                        <div class="nav-avatar-initials"><?= $nav_initials ?: 'U' ?></div>
                    <?php endif; ?>
                </a>

                <!-- El desplegable a la derecha -->
                <div class="dropdown">
                    <button class="dropbtn">Opciones ▼</button>
                    <div class="dropdown-content">
                        <a href="<?= $nav_base ?>profile/index.php"><i class="bi bi-person-fill"></i> Perfiles</a>
                        <a href="<?= $nav_base ?>contactos.php"><i class="bi bi-envelope-fill"></i> Contactos</a>
                        <hr>
                        <a href="<?= $nav_base ?>php/cerrar_sesion.php" class="cerrar-sesion"><i
                                class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Invitado: la cuenta es opcional -->
                <div class="dropdown">
                    <button class="dropbtn">Opciones ▼</button>
                    <div class="dropdown-content">
                        <a href="<?= $nav_base ?>login.php"><i class="bi bi-box-arrow-in-right"></i> Iniciar sesión / Registrarse</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>

    <script src="assets/js/pages/index.js"></script>

    <div class="container-fluid px-2 py-5">
        <div class="home-card text-center p-5 mb-4">
            <h1 class="fw-bold" style="color: var(--text-main);">Bienvenido 👋</h1>
            <p class="text" style="color: var(--color-secondary-5);">Listo para continuar tu progreso</p>

            <!-- Barra de búsqueda tipo navegador -->
            <div class="d-flex justify-content-center mt-4">
                <div class="browser-search" role="search">
                    <span class="browser-search-icon"><i class="bi bi-search"></i></span>
                    <input id="quickSearch" class="browser-search-input" type="search"
                        placeholder="Buscar: Sesiones, Historial, Configuración..." autocomplete="off">
                </div>
            </div>
            <div id="quickSearchSuggestions" class="quick-suggestions" aria-label="Sugerencias"></div>
        </div>

        <!-- Speed Dial tipo navegador -->
        <div class="speed-dial-grid">

            <a href="sesiones.php" class="speed-dial-item" title="Sesiones">
                <div class="speed-dial-icon">
                    <i class="bi bi-cart-plus-fill" style="color: var(--color-primary);"></i>
                </div>
                <span class="speed-dial-label">Sesiones</span>
            </a>

            <a href="historial/historial.php" class="speed-dial-item" title="Historial">
                <div class="speed-dial-icon">
                    <i class="bi bi-file-text-fill" style="color: var(--color-primary);"></i>
                </div>
                <span class="speed-dial-label">Historial</span>
            </a>

            <a href="guias/guia.php" class="speed-dial-item" title="Guia">
                <div class="speed-dial-icon">
                    <i class="bi bi-book-half" style="color: var(--color-primary);"></i>
                </div>
                <span class="speed-dial-label">Guía</span>
            </a>

            <a href="settings/ajustes.php" class="speed-dial-item" title="Configuración">
                <div class="speed-dial-icon">
                    <i class="bi bi-gear-fill" style="color: var(--color-secondary-5);"></i>
                </div>
                <span class="speed-dial-label">Settings</span>
            </a>

        </div>
    </div>

    <script src="assets/js/pages/index-search.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>