<!DOCTYPE html>
<?php require_once 'php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link de Pago | Plance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link rel="stylesheet" href="assets/css/pages/retorno_link.css">
</head>

<body>
    <div class="result-card">
        <div class="result-icon"><?= $icono ?></div>
        <div class="result-title"><?= $titulo ?></div>
        <p class="result-message"><?= $mensaje ?></p>

        <?php if ($exito): ?>
            <!-- Link box -->
            <div class="link-box">
                <div class="link-box-label">🔗 Tu link de pago</div>
                <div class="link-url">
                    <span class="link-url-text" id="linkText"><?= htmlspecialchars($link_url) ?></span>
                    <button class="btn-copy" id="btnCopy" onclick="copyLink()">
                        <i class="bi bi-clipboard"></i> Copiar
                    </button>
                </div>
            </div>

            <!-- Botones compartir -->
            <div class="share-title">Compartir link</div>
            <div class="share-btns">
                <a href="https://wa.me/?text=<?= urlencode('¡Aquí está tu link de pago para ' . $producto . '! ' . $link_url) ?>"
                    target="_blank" class="share-btn wa">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                <a href="<?= htmlspecialchars($link_url) ?>" target="_blank" class="share-btn open">
                    <i class="bi bi-box-arrow-up-right"></i> Abrir link
                </a>
            </div>
        <?php endif; ?>

        <!-- Detalles -->
        <div class="order-details">
            <div class="order-row"><span>Producto</span><span><?= htmlspecialchars($producto) ?></span></div>
            <div class="order-row"><span>Precio</span><span
                    class="precio-link">$<?= number_format((float) $precio, 0, ',', '.') ?> COP</span></div>
            <div class="order-row"><span>Comprador</span><span><?= htmlspecialchars($nombre) ?></span></div>
            <div class="order-row"><span>Correo</span><span><?= htmlspecialchars($correo) ?></span></div>
            <div class="order-row"><span>Referencia</span><span
                    style="font-size:0.78rem;color:var(--text-secondary);"><?= htmlspecialchars($referencia) ?></span>
            </div>
            <?php if ($expiracion): ?>
                <div class="order-row"><span>Expira</span><span
                        class="fecha-expiracion"><?= htmlspecialchars($expiracion) ?></span></div>
            <?php endif; ?>
            <div class="order-row">
                <span>Estado</span>
                <span style="color:<?= $exito ? 'var(--color-secondary-3)' : 'var(--color-danger)' ?>;font-weight:700;">
                    <?= $exito ? '🔗 LINK ACTIVO' : '❌ ERROR' ?>
                </span>
            </div>
        </div>

        <a href="index.php" class="btn-home">← Inicio</a>
        <a href="textil/pl.php" class="btn-volver">Ver tienda</a>
    </div>

    <script src="assets/js/pages/retorno_link.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>