<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kits Deportivos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800&family=Barlow:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Tu CSS -->
    <link rel="stylesheet"
        href="../assets/css/estilos.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/estilos.css'); ?>">
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

    body {
        color: white;
        background-color: #0d0e10;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Barlow', sans-serif;
    }

    .card {
        background: linear-gradient(rgba(30, 33, 44, 0.85) 0%, rgba(13, 14, 16, 0.9));
        background-size: cover;
        color: #e4e4e4;
        border: 1px solid var(--color-secondary-2);
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        align-items: center;
        position: relative;
        overflow: visible;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(255, 108, 12, 0.3);
        border-color: var(--color-primary);
    }

    .card-img-top {
        border-radius: 15px 15px 0 0;
        height: 200px;
        width: 100%;
        object-fit: cover;
    }

    main {
        flex: 1;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        color: #ffffff;
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .back:hover {
        background: var(--color-primary);
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(255, 108, 12, 0.4);
    }

    /* Etiqueta "API Link de pagos" centrada */
    .linkp {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background-color: var(--color-secondary-3);
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0.05em;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        z-index: 10;
        box-shadow: 0 2px 10px rgba(0, 98, 168, 0.3);
        white-space: nowrap;
        pointer-events: none;
    }

    .servicio1 {
        background: var(--color-secondary-3);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        display: inline-block;
    }

    .servicio2 {
        background: var(--color-primary);
        color: #0d0e10;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        display: inline-block;
    }

    /* Filtro servicio (botones) */
    .servicio-toggle {
        display: inline-flex;
        overflow: hidden;
        border-radius: 12px;
        border: 1px solid var(--color-secondary-2);
        background: rgba(0, 0, 0, 0.3);
    }

    .servicio-btn {
        border: 0;
        padding: 0.6rem 1.2rem;
        background: transparent;
        color: var(--text-main);
        font-weight: 700;
        letter-spacing: 0.02em;
        cursor: pointer;
        transition: background 0.2s ease, color 0.2s ease;
        line-height: 1;
    }

    .servicio-btn+.servicio-btn {
        border-left: 1px solid var(--color-secondary-2);
    }

    .servicio-btn.active {
        background: rgba(0, 98, 168, 0.12);
        color: var(--color-secondary-3);
    }

    .servicio-btn:hover {
        background: rgba(0, 98, 168, 0.06);
        color: var(--color-secondary-3);
    }

    .btn-productos {
        background-color: rgba(30, 33, 44, 0.6) !important;
        color: #ffffff !important;
        border: 1px solid var(--color-secondary-2) !important;
        transition: all 0.3s ease !important;
        border-radius: 8px !important;
        padding: 0.4rem 1.2rem !important;
    }

    .btn-productos:hover {
        background-color: var(--color-secondary-3) !important;
        color: #ffffff !important;
        border-color: var(--color-secondary-3) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 98, 168, 0.3);
    }

    .card-body {
        padding: 1.2rem;
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .card-title {
        color: var(--text-main);
        margin-top: 0.5rem;
    }

    .card-text {
        color: var(--color-secondary-5);
        font-size: 0.9rem;
    }

    /* Contenedor de la imagen para mantener la relación */
    .card-img-wrapper {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 15px 15px 0 0;
    }
</style>

<body class="d-flex flex-column min-vh-100">

    <?php
    $nav_back_url = "textiles.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <section>
        <div class="container mt-5">
            <h1 class="text-center mb-3" style="color: var(--text-main);">Kits Deportivos</h1>

            <!-- Botones para filtrar por servicio PlaceToPay -->
            <div class="d-flex justify-content-center mb-4">
                <div class="servicio-toggle" role="group" aria-label="Filtrar ropa por servicio">
                    <button type="button" class="servicio-btn active" data-filter="web">API Link de pagos</button>
                    <button type="button" class="servicio-btn" data-filter="api">N/A</button>
                </div>
            </div>

            <div class="row" style="text-align: center;" id="games-row">

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://kickbol.com/wp-content/uploads/2023/08/English-Premier-League-1.png"
                                class="card-img-top" alt="Premier League">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">Premier League</h5>
                            <p class="card-text">Compra Equipaciones de tus equipos ingleses favoritos</p>
                            <a href="../textil/pl.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://logowik.com/content/uploads/images/laliga-santander5892.logowik.com.webp"
                                class="card-img-top" alt="La Liga">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">La Liga</h5>
                            <p class="card-text">Compra Equipaciones de tus equipos españoles favoritos</p>
                            <a href="../textil/laliga.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://logowik.com/content/uploads/blog/bundesliga-football-clubs-and-logos3600.logowik.com.webp"
                                class="card-img-top" alt="Bundesliga">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">Bundesliga</h5>
                            <p class="card-text">Compra equipaciones de tus equipos alemanes favoritos</p>
                            <a href="../textil/bundesliga.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4" data-servicio="web">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <img src="https://1000logos.net/wp-content/uploads/2019/01/Italian-Serie-A-Logo.png"
                                class="card-img-top" alt="Serie A">
                        </div>
                        <div class="linkp">API Link de pagos</div>
                        <div class="card-body">
                            <div class="servicio1">API Link de pagos</div>
                            <h5 class="card-title">Serie A</h5>
                            <p class="card-text">Compra equipaciones de tus equipos italianos favoritos</p>
                            <a href="../textil/seriea.php" class="btn btn-productos">Productos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        (function () {
            const buttons = Array.from(document.querySelectorAll('.servicio-btn'));
            const cards = Array.from(document.querySelectorAll('[data-servicio]'));

            function applyFilter(filter) {
                cards.forEach(card => {
                    const svc = card.getAttribute('data-servicio');
                    card.style.display = (svc === filter) ? '' : 'none';
                });
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    applyFilter(btn.getAttribute('data-filter'));
                });
            });

            // Default: API Link de pagos
            applyFilter('web');
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>