<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Tu CSS -->
    <link rel="stylesheet" href="assets/css/">
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

    .welcome {
        background-image: url(assets/images/bg13.jpg);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
    }

    .navbar-welcome {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        color: #ffffff;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .welcome-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 80px;
        text-align: center;
        color: white;
        opacity: 0;
        animation: fadeIn 1.5s ease-in-out forwards;
    }

    .card {
        background-color: rgba(30, 33, 44, 0.85);
        color: #fff;
        border: 1px solid var(--color-secondary-2);
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 108, 12, 0.15);
        border-color: var(--color-primary);
    }

    .btn {
        background-color: transparent;
        color: var(--color-secondary-5);
        transition: all 0.3s ease;
        font-weight: 600;
    }

    .btn:hover {
        color: var(--color-primary);
    }

    .dropdown-menu {
        background: var(--color-secondary-4);
        border: 1px solid var(--color-secondary-2);
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }

    .dropdown-item {
        color: var(--text-main);
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background: rgba(255, 108, 12, 0.08);
        color: var(--color-primary);
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .navbar-toggler {
        background-color: var(--color-primary) !important;
        border: none;
        padding: 0.3rem 0.6rem;
    }

    .navbar-toggler .navbar-toggler-icon {
        filter: brightness(0);
    }

    .collapse-nav {
        background-color: rgba(30, 33, 44, 0.75);
        border-radius: 10px;
        padding: 0.5rem 1rem;
    }

    .btn-login {
        background-color: var(--color-primary) !important;
        border-radius: 8px !important;
        color: #0d0e10 !important;
        font-weight: 700 !important;
        padding: 0.4rem 1.5rem !important;
        transition: all 0.3s ease !important;
        border: none !important;
    }

    .btn-login:hover {
        background-color: var(--color-secondary-3) !important;
        color: #fff !important;
    }

    .nav-link-dropdown {
        color: var(--color-primary) !important;
        border-radius: 5px !important;
        padding: 5px 10px !important;
        font-weight: 700 !important;
    }

    .nav-link-dropdown:hover {
        color: var(--color-primary) !important;
    }

    .dropdown-title {
        color: var(--color-primary);
        font-weight: 700;
    }

    .footer {
        background-color: rgba(30, 33, 44, 0.85);
        color: var(--text-main);
        text-align: center;
        padding: 0.8rem 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        border-top: 1px solid var(--color-secondary-2);
        font-size: 0.9rem;
    }

    .footer span {
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

    @media (max-width: 768px) {
        .welcome-content {
            padding-top: 100px;
        }

        .collapse-nav {
            background-color: rgba(30, 33, 44, 0.9);
            margin-top: 0.5rem;
        }

        .footer {
            font-size: 0.75rem;
            padding: 0.5rem 0;
        }
    }
</style>

<body class="welcome">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-welcome px-2 fixed-top">
        <div class="container">

            <!-- Logo -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="welcome.php">
                <img src="assets/icons/iconoy.png" alt="Icon" style="height: 35px;">
            </a>

            <!-- Botón responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse collapse-nav" id="navbarNav">

                <!-- 👇 IZQUIERDA (pegado al logo) -->
                <ul class="navbar-nav ms-3">
                    <li class="nav-item dropdown position-static">
                        <a class="nav-link dropdown-toggle nav-link-dropdown" href="#" role="button"
                            data-bs-toggle="dropdown">
                            Individuals
                        </a>

                        <div class="dropdown-menu w-100 mt-0 border-0 shadow">
                            <div class="container py-4">
                                <div class="row">

                                    <div class="col-md-4">
                                        <h6 class="fw-bold dropdown-title">Individuals</h6>
                                        <a class="dropdown-item" href="#">What we do</a>
                                        <a class="dropdown-item" href="#">Try for free</a>
                                        <a class="dropdown-item" href="#">View all plans</a>
                                    </div>

                                    <div class="col-md-4">
                                        <h6 class="fw-bold dropdown-title">Plans</h6>
                                        <a class="dropdown-item" href="#">Core Tech</a>
                                        <a class="dropdown-item" href="#">AI+</a>
                                        <a class="dropdown-item" href="#">Cloud+</a>
                                    </div>

                                    <div class="col-md-4">
                                        <h6 class="fw-bold dropdown-title">Features</h6>
                                        <a class="dropdown-item" href="#">Skill assessments</a>
                                        <a class="dropdown-item" href="#">Labs</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- 👇 DERECHA (empujado automáticamente) -->
                <div class="ms-auto">
                    <a href="index.php" class="btn btn-login">
                        Iniciar sesión
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- CONTENIDO -->
    <section class="welcome-content">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3" style="color: var(--text-main);">Bienvenido 👋</h1>
            <p class="lead mb-4" style="color: var(--color-secondary-5);">Tu panel ya está listo para comenzar.</p>

            <div class="row g-4 mt-3">
                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 style="color: var(--text-main);">Gestión</h5>
                        <p style="color: var(--color-secondary-5);">Administra tus datos fácilmente.</p>
                        <a href="info/gestion.php" class="btn mx-auto w-15">
                            Ver Más <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 style="color: var(--text-main);">Registros</h5>
                        <p style="color: var(--color-secondary-5);">Visualiza tus actividades en tiempo real.</p>
                        <a href="info/registros.php" class="btn mx-auto w-15">
                            Ver Más <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <h5 style="color: var(--text-main);">Configuración</h5>
                        <p style="color: var(--color-secondary-5);">Personaliza tu experiencia.</p>
                        <a href="info/experiencia.php" class="btn mx-auto w-15">
                            Ver Más <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p style="margin: 0;">&copy; <span>Evertec Placetopay SAS</span> - Medellín | Jonathan Fernandez | SAQ</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>