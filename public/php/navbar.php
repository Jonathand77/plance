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

<style>
    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .navbar-brand img {
        filter: brightness(0) saturate(100%) invert(60%) sepia(89%) saturate(3000%) hue-rotate(0deg) brightness(100%) contrast(100%);
    }

    /* ── NAVBAR AVATAR ── */
    .nav-avatar-wrap {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .nav-avatar-wrap:hover {
        text-decoration: none;
    }

    .nav-avatar-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--color-primary);
        transition: border-color 0.2s, transform 0.2s;
    }

    .nav-avatar-img:hover {
        border-color: var(--text-main);
        transform: scale(1.08);
    }

    .nav-avatar-initials {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary), #c99010);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
        color: #0d0e10;
        border: 2px solid var(--color-primary);
        transition: border-color 0.2s, transform 0.2s;
        flex-shrink: 0;
    }

    .nav-avatar-initials:hover {
        border-color: var(--text-main);
        transform: scale(1.08);
    }

    .nav-username {
        background-color: rgba(30, 33, 44, 0.84);
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 600;
        color: var(--text-main);
        font-size: 0.9rem;
    }

    /* ── DROPDOWN ── */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background: rgba(30, 33, 44, 0.84);
        color: var(--color-primary);
        border: 1.5px solid rgba(255, 108, 12, 0.3);
        border-radius: 8px;
        padding: 6px 14px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .dropbtn:hover {
        border-color: var(--color-primary);
        background: rgba(255, 108, 12, 0.10);
    }

    .dropdown-content {
        display: none;
        position: absolute;
        left: 0;
        top: calc(100% + 6px);
        background: var(--color-secondary-4);
        border: 1px solid var(--color-secondary-2);
        border-radius: 10px;
        min-width: 170px;
        z-index: 999;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        animation: dropFade 0.15s ease;
    }

    @keyframes dropFade {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-content a {
        display: block;
        padding: 0.6rem 1rem;
        color: var(--text-main);
        font-size: 0.87rem;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.15s, color 0.15s;
    }

    .dropdown-content a:hover {
        background: rgba(255, 108, 12, 0.10);
        color: var(--color-primary);
        text-decoration: none;
    }

    .dropdown-content hr {
        border-color: var(--color-secondary-2);
        margin: 0.2rem 0;
    }

    .dropdown-content .cerrar-sesion {
        color: var(--color-danger) !important;
    }

    .dropdown-content .cerrar-sesion:hover {
        background: rgba(220, 53, 69, 0.10) !important;
        color: var(--color-danger) !important;
    }

    .dropdown.open .dropdown-content {
        display: block;
    }

    /* Botón Volver */
    .btn-back-nav {
        color: var(--color-primary);
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
    }

    .btn-back-nav:hover {
        background: rgba(255, 108, 12, 0.10);
        color: var(--color-primary);
    }

    /* Responsive */
    @media (max-width: 600px) {
        .nav-username {
            font-size: 0.75rem;
            padding: 3px 8px;
        }

        .dropbtn {
            font-size: 0.7rem;
            padding: 4px 10px;
        }

        .navbar {
            padding: 0.3rem 0.5rem !important;
        }
    }
</style>

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