<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

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
        require_once __DIR__ . '/php/conexion_be.php';
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
<style>
    :root {
    }

    body {
        background-color: #0d0e10;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        font-family: calibri, sans-serif;
    }

    .home-card {
        background: transparent;
        border-radius: 20px;
        margin: 0;
        padding-bottom: 10px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(255, 108, 12, 0.5);
    }

    .card-img-top {
        border-radius: 15px 15px 0 0;
        height: 200px;
        width: 100%;
        object-fit: cover;
    }

    .navbar-welcome.scrolled {
        background-color: rgba(30, 33, 44, 0.95) !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .img-logo {
        margin-bottom: 20px;
        align-self: center;
    }

    .navbar.scrolled {
        background-color: rgba(30, 33, 44, 0.95) !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .navbar-brand img {
        filter: brightness(0) saturate(100%) invert(60%) sepia(89%) saturate(3000%) hue-rotate(0deg) brightness(100%) contrast(100%);
    }

    /* ── SPEED DIAL (iconos tipo navegador) ── */
    .speed-dial-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 28px;
        padding: 10px 0 20px;
    }

    .speed-dial-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        cursor: pointer;
        animation: fadeIn 0.6s ease forwards;
        opacity: 0;
    }

    .speed-dial-item:nth-child(1) {
        animation-delay: 0.1s;
    }

    .speed-dial-item:nth-child(2) {
        animation-delay: 0.2s;
    }

    .speed-dial-item:nth-child(3) {
        animation-delay: 0.3s;
    }

    .speed-dial-icon {
        width: 72px;
        height: 72px;
        border-radius: 18px;
        background: rgba(30, 33, 44, 0.85);
        border: 1px solid var(--color-secondary-2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: all 0.22s ease;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(6px);
    }

    .speed-dial-item:hover .speed-dial-icon {
        transform: translateY(-6px) scale(1.08);
        border-color: rgba(255, 108, 12, 0.5);
        box-shadow: 0 8px 28px rgba(255, 108, 12, 0.25);
        background: rgba(255, 108, 12, 0.08);
    }

    .speed-dial-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.75);
        text-align: center;
        max-width: 80px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        transition: color 0.2s;
    }

    .speed-dial-item:hover .speed-dial-label {
        color: var(--color-primary);
    }

    main {
        flex: 1;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        color: #ffff;
        border-bottom: 1px solid var(--color-secondary-2);
    }

    /* Estilos para el avatar en la barra de navegación */
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
        border-color: #fff;
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
        border-color: #fff;
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
        background: rgba(255, 108, 12, 0.1);
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
        margin-top: 1px;
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
        background: rgba(255, 108, 12, 0.1);
        color: var(--color-primary);
        text-decoration: none;
    }

    .dropdown-content hr {
        border-color: var(--color-secondary-2);
        margin: 0.2rem 0;
    }

    .dropdown-content .cerrar-sesion {
        color: #dc3545 !important;
    }

    .dropdown-content .cerrar-sesion:hover {
        background: rgba(220, 53, 69, 0.1) !important;
        color: #dc3545 !important;
    }

    .dropdown.open .dropdown-content {
        display: block;
    }

    /* Search estilo navegador */
    .browser-search {
        width: min(720px, 92vw);
        background: rgba(0, 0, 0, 0.35);
        border: 1px solid var(--color-secondary-2);
        border-radius: 999px;
        display: flex;
        align-items: center;
        padding: 10px 14px;
        gap: 10px;
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
    }

    .browser-search-icon {
        color: var(--color-primary);
        display: flex;
    }

    .browser-search-input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        color: #fff;
        font-size: 0.95rem;
    }

    .browser-search-input::placeholder {
        color: rgba(255, 255, 255, 0.55);
    }

    .quick-suggestions {
        width: min(720px, 92vw);
        margin: 10px auto 0;
        background: rgba(10, 10, 10, 0.92);
        border: 1px solid var(--color-secondary-2);
        border-radius: 14px;
        overflow: hidden;
        display: none;
        backdrop-filter: blur(8px);
    }

    .quick-suggestions a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        color: var(--text-main);
        text-decoration: none;
        font-weight: 600;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
    }

    .quick-suggestions a:first-child {
        border-top: none;
    }

    .quick-suggestions a:hover {
        background: rgba(255, 108, 12, 0.10);
        color: var(--color-primary);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

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

    <script>
        (function () {
            const input = document.getElementById('quickSearch');
            const box = document.getElementById('quickSearchSuggestions');
            if (!input || !box) return;

            const items = [
                { key: 'sesiones', label: 'Sesiones', href: 'sesiones.php', icon: 'bi bi-cart-plus-fill' },
                { key: 'historial', label: 'Historial', href: 'historial/historial.php', icon: 'bi bi-file-text-fill' },
                { key: 'configuracion', label: 'Configuración', href: 'profile/index.php', icon: 'bi bi-gear-fill' },
                { key: 'perfil', label: 'Mi Perfil', href: 'profile/index.php', icon: 'bi bi-person-badge' },
                { key: 'juegos', label: 'Juegos', href: 'games/juegos.php', icon: 'bi bi-controller' },
                { key: 'plataformas', label: 'Plataformas', href: 'plataformas/suscripciones.php', icon: 'bi bi-tv' },
                { key: 'dispersiones', label: 'Dispersiones', href: 'dispersiones/dispersion.php', icon: 'bi bi-airplane-fill' },
                { key: 'reservaciones', label: 'Reservaciones', href: 'reservasiones/reservas.php', icon: 'bi bi-building-fill' },
            ];

            function norm(s) { return (s || '').toLowerCase().trim(); }

            function render(list) {
                box.innerHTML = '';
                if (!list.length) { box.style.display = 'none'; return; }
                list.forEach(it => {
                    const a = document.createElement('a');
                    a.href = it.href;
                    a.innerHTML = `<i class="${it.icon}" style="color:var(--color-primary);"></i> <span>${it.label}</span>`;
                    box.appendChild(a);
                });
                box.style.display = 'block';
            }

            input.addEventListener('input', () => {
                const q = norm(input.value);
                if (!q) { box.style.display = 'none'; return; }
                const matches = items.filter(it => it.key.includes(q) || norm(it.label).includes(q)).slice(0, 5);
                render(matches);
            });

            document.addEventListener('click', (e) => {
                if (!box.contains(e.target) && e.target !== input) box.style.display = 'none';
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    const q = norm(input.value);
                    const first = items.find(it => it.key.includes(q) || norm(it.label).includes(q));
                    if (first) window.location.href = first.href;
                }
            });
        })();
    </script>
    <script src="assets/js/script.js"></script>
</body>

</html>