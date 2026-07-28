<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment API Explorer | Guía Developer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css" />

    <link rel="stylesheet" href="<?= $mockupBase ?>/css/base/variables.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/base/reset.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/base/layout.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/components/welcome/welcome.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/components/topbar/topbar.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/components/sidebar/sidebar.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/components/request/request.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/components/response/response.css" />
    <link rel="stylesheet" href="<?= $mockupBase ?>/css/components/popup/popup.css" />
</head>

<body>
    <div id="templateRoot"></div>

    <script>
        window.MOCKUP_DEV_BASE = '<?= $mockupBase ?>';
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="module" src="<?= $mockupBase ?>/js/core/template-loader.js"></script>
    <script type="module" src="<?= $mockupBase ?>/js/app.js"></script>
</body>

</html>
