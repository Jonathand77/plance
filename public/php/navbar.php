<?php
/**
 * navbar.php — Navbar reutilizable
 * 
 * Variables que puedes definir ANTES de incluir este archivo:
 * $nav_back_url  → URL del botón "Volver"        (default: index.php)
 * $nav_back_text → Texto del botón "Volver"       (default: "Volver")
 * $nav_base      → Ruta base hacia la raíz        (default: "../")
 *
 * Ejemplo de uso en cualquier página:
 *   $nav_back_url  = "../index.php";
 *   $nav_back_text = "Volver";
 *   $nav_base      = "../";
 *   require_once '../php/navbar.php';
 */

// Valores por defecto
$nav_back_url = $nav_back_url ?? 'index.php';
$nav_back_text = $nav_back_text ?? 'Volver';
$nav_base = $nav_base ?? '../';

// Traer foto de perfil del usuario en sesión
$nav_avatar = '';
$nav_initials = '';

if (isset($_SESSION['user_id'])) {
    // Reutilizar conexión si ya existe, si no crear una
    if (!isset($conexion)) {
        require_once __DIR__ . '/conexion_be.php';
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

<link rel="stylesheet" href="<?= $nav_base ?>assets/css/components/navbar.css">

<nav class="navbar navbar-dark navbar-expand-lg px-3 py-2">
    <a class="navbar-brand fw-bold" href="<?= $nav_base ?>index.php" style="color: var(--color-primary);">
        <img src="<?= $nav_base ?>assets/icons/iconoy.png" alt="Logo" style="width: 50px;">
    </a>

    <!-- BOTON DE RETROCESO -->
    <a href="<?= htmlspecialchars($nav_back_url) ?>" class="btn-back-nav">
        <i class="fa-solid fa-circle-arrow-left fs-6"></i> <?= htmlspecialchars($nav_back_text) ?>
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
                    <a href="<?= $nav_base ?>profile/index.php"><i class="bi bi-person-fill"></i> Perfil</a>
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

<script>
    (function () {
        document.querySelectorAll('.navbar .dropdown').forEach(function (dd) {
            var btn = dd.querySelector('.dropbtn');
            if (!btn) return;
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var wasOpen = dd.classList.contains('open');
                document.querySelectorAll('.dropdown.open').forEach(function (o) { o.classList.remove('open'); });
                if (!wasOpen) dd.classList.add('open');
            });
        });
        document.addEventListener('click', function () {
            document.querySelectorAll('.dropdown.open').forEach(function (o) { o.classList.remove('open'); });
        });
    })();
</script>