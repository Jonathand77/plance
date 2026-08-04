<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guía</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Tu CSS -->
    <link rel="stylesheet"
        href="../assets/css/estilos.css?v=<?php echo filemtime($__publicDir . '/../assets/css/estilos.css'); ?>">
</head>

<link rel="stylesheet" href="../assets/css/pages/guias/guia.css">


<body class="d-flex flex-column min-vh-100">

    <?php
    $nav_back_url = "../index.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="guide-hero">
        <h4 class="guide-title">Guías</h4>
        <p class="guide-subtitle">Explora la documentación principal de tu proyecto en un formato visual inspirado en la
            documentación oficial. Elige la guía de usuario o la guía técnica para continuar.</p>
    </div>

    <section class="guide-section">
        <div class="guide-grid">

            <a href="guia-user.php" class="doc-card doc-card--user">
                <div class="doc-card-visual">
                    <div class="visual-window"></div>
                    <span class="mini-lines"></span>
                </div>
                <div class="doc-card-body">
                    <h2 class="doc-card-title">Guía Usuario</h2>
                    <p class="doc-card-text">Conoce el flujo de compra, la experiencia del comprador y la navegación
                        básica para entender cómo interactúa el usuario con la plataforma.</p>
                    <div class="doc-card-link">
                        <span>Ver Guía</span>
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
            </a>

            <a href="guia-developer.php" class="doc-card doc-card--developer">
                <div class="doc-card-visual">
                    <div class="visual-panel"></div>
                    <span class="mini-tag tag-api">API</span>
                    <span class="mini-tag tag-dev">DEV</span>
                    <span class="mini-tag tag-user">SDK</span>
                </div>
                <div class="doc-card-body">
                    <h2 class="doc-card-title">Guía Developer</h2>
                    <p class="doc-card-text">Accede a la parte técnica de la integración, estructura del proyecto y
                        recursos clave para implementar los servicios de PlacetoPay de forma ordenada.</p>
                    <div class="doc-card-link">
                        <span>Ver Guía</span>
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </div>
            </a>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/validaciones.js"></script>
</body>

</html>