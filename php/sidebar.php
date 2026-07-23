<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plance - Configuración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic" rel="stylesheet" />
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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0d0e10;
            color: var(--text-main);
            font-family: 'Barlow', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--color-secondary-4) 0%, #0d0e10 100%);
            border-right: 1px solid var(--color-secondary-2);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1.5rem 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        /* Logo / Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0 1.5rem 1.5rem;
            border-bottom: 1px solid var(--color-secondary-2);
            margin-bottom: 1.5rem;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--color-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 800;
            color: #0d0e10;
            flex-shrink: 0;
        }

        .sidebar-brand .brand-name {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: 0.04em;
        }

        .sidebar-brand .brand-name span {
            color: var(--color-primary);
        }

        /* Navegación */
        .sidebar-nav {
            flex: 1;
            padding: 0 0.8rem;
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 0.2rem;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.7rem 1rem;
            color: var(--color-secondary-5);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.92rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .sidebar-nav li a i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-nav li a:hover {
            background: rgba(255, 108, 12, 0.08);
            color: var(--color-primary);
            border-color: rgba(255, 108, 12, 0.15);
        }

        .sidebar-nav li a.active {
            background: rgba(255, 108, 12, 0.12);
            color: var(--color-primary);
            border-color: var(--color-primary);
            font-weight: 700;
        }

        /* Badge de notificaciones */
        .sidebar-nav li a .badge-nav {
            margin-left: auto;
            background: var(--color-primary);
            color: #0d0e10;
            font-size: 0.65rem;
            font-weight: 800;
            padding: 0.15rem 0.5rem;
            border-radius: 20px;
        }

        /* Footer del sidebar */
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--color-secondary-2);
            margin-top: auto;
        }

        .sidebar-footer .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-footer .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-primary), #c99010);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.8rem;
            color: #0d0e10;
            flex-shrink: 0;
        }

        .sidebar-footer .user-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .sidebar-footer .user-email {
            font-size: 0.72rem;
            color: var(--color-secondary-5);
        }

        .sidebar-footer .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.6rem;
            padding: 0.4rem 0.8rem;
            background: rgba(220, 53, 69, 0.10);
            border: 1px solid rgba(220, 53, 69, 0.25);
            color: #dc3545;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            width: 100%;
            justify-content: center;
        }

        .sidebar-footer .btn-logout:hover {
            background: rgba(220, 53, 69, 0.20);
            border-color: #dc3545;
        }

        /* ── CONTENIDO ── */
        .content {
            margin-left: 260px;
            padding: 2rem;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem;
            }

            /* Botón hamburguesa */
            .menu-toggle {
                display: flex !important;
            }
        }

        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 200;
            background: var(--color-secondary-4);
            border: 1px solid var(--color-secondary-2);
            color: var(--text-main);
            padding: 0.5rem 0.7rem;
            border-radius: 8px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .menu-toggle:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
        }

        /* Overlay para móvil */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>

<body>

    <!-- Botón hamburguesa para móvil -->
    <button class="menu-toggle" id="menuToggle" aria-label="Abrir menú">
        <i class="bi bi-list"></i>
    </button>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar" id="sidebar">

        <!-- Brand / Logo -->
        <div class="sidebar-brand">
            <div class="brand-icon">P</div>
            <div class="brand-name">Pl<span>ance</span></div>
        </div>

        <!-- Navegación -->
        <ul class="sidebar-nav">
            <li>
                <a href="index.php" class="active">
                    <i class="bi bi-house-fill"></i>
                    Inicio
                </a>
            </li>
            <li>
                <a href="config.php">
                    <i class="bi bi-gear-fill"></i>
                    Configuración
                    <span class="badge-nav">3</span>
                </a>
            </li>
            <li>
                <a href="perfil.php">
                    <i class="bi bi-person-fill"></i>
                    Perfil
                </a>
            </li>
            <li>
                <a href="historial.php">
                    <i class="bi bi-clock-history"></i>
                    Historial
                </a>
            </li>
            <li>
                <a href="gestion.php">
                    <i class="bi bi-grid-fill"></i>
                    Gestión
                </a>
            </li>
        </ul>

        <!-- Footer con usuario -->
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">U</div>
                <div>
                    <div class="user-name">Usuario</div>
                    <div class="user-email">usuario@ejemplo.com</div>
                </div>
            </div>
            <a href="logout.php" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </a>
        </div>

    </aside>

    <!-- ── CONTENIDO PRINCIPAL ── -->
    <main class="content">
        <!-- Aquí irá el contenido de la página -->
        <h1 style="font-size: 2rem; font-weight: 800; color: var(--text-main);">
            Configuración
        </h1>
        <p style="color: var(--color-secondary-5); font-size: 1.05rem; margin-top: 0.5rem;">
            Panel de administración y configuración de Plance.
        </p>
    </main>

    <script>
        // Toggle sidebar en móvil
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('menuToggle');

        function toggleSidebar() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        if (toggle) {
            toggle.addEventListener('click', toggleSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', toggleSidebar);
        }

        // Cerrar sidebar al hacer click en un enlace (móvil)
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                }
            });
        });

        // Marcar enlace activo según la URL actual
        document.querySelectorAll('.sidebar-nav a').forEach(link => {
            if (window.location.pathname.includes(link.getAttribute('href'))) {
                link.classList.add('active');
            }
        });
    </script>

</body>

</html>