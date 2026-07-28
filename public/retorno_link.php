<?php
session_start();


$data = $_SESSION['link_result'] ?? null;
unset($_SESSION['link_result']);

if (!$data) {
    header("Location: index.php");
    exit();
}

$link_url = $data['link_url'] ?? '';
$producto = $data['producto'] ?? '';
$precio = $data['precio'] ?? 0;
$correo = $data['correo'] ?? '';
$nombre = $data['nombre'] ?? '';
$referencia = $data['referencia'] ?? '';
$expiracion = $data['expiracion'] ?? '';
$link_id = $data['link_id'] ?? '';
$exito = !empty($link_url);

// Definir visual según resultado - usando nueva paleta
if ($exito) {
    $icono = '🔗';
    $titulo = '¡Link generado!';
    $mensaje = 'Tu link de pago fue creado exitosamente. Compártelo por correo, WhatsApp o redes sociales.';
    $color = '#0062A8';
    $bg_icon = 'rgba(0,98,168,0.15)';
} else {
    $icono = '❌';
    $titulo = 'Error al generar';
    $mensaje = 'No se pudo generar el link de pago. Intenta de nuevo.';
    $color = '#dc3545';
    $bg_icon = 'rgba(220,53,69,0.15)';
}
?>
<!DOCTYPE html>
<html lang="es">

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

            /* Variables específicas del componente */
            --bg-base: #0d0e10;
            --bg-surface: #16181c;
            --bg-card: #1E2128;
            --border: #4C5F71;
            --text-primary: #f0f1f3;
            --text-secondary: #7D868C;
            --font-display: 'Barlow', sans-serif;
            --font-body: 'Barlow', sans-serif;
            --color-success: #00CFB4;
            --color-danger: #dc3545;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-primary);
            font-family: var(--font-body);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .result-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2.5rem 2rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
            animation: fadeUp 0.4s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-icon {
            font-size: 3rem;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            background: <?= $bg_icon ?>;
        }

        .result-title {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 800;
            color: <?= $color ?>;
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }

        .result-message {
            font-size: 0.95rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }

        /* Link box */
        .link-box {
            background: rgba(0, 98, 168, 0.08);
            border: 1px solid rgba(0, 98, 168, 0.25);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .link-box-label {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--color-secondary-3);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .link-url {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .link-url-text {
            font-size: 0.8rem;
            color: var(--color-secondary-3);
            word-break: break-all;
            flex: 1;
            line-height: 1.4;
        }

        .btn-copy {
            background: rgba(0, 98, 168, 0.2);
            border: 1px solid rgba(0, 98, 168, 0.4);
            color: var(--color-secondary-3);
            border-radius: 6px;
            padding: 0.3rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.2s;
            font-family: var(--font-body);
        }

        .btn-copy:hover {
            background: rgba(0, 98, 168, 0.35);
        }

        .btn-copy.copied {
            background: rgba(0, 207, 180, 0.2);
            border-color: rgba(0, 207, 180, 0.4);
            color: var(--color-success);
        }

        /* Share buttons */
        .share-title {
            font-family: var(--font-display);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 0.6rem;
        }

        .share-btns {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .share-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            font-family: var(--font-body);
        }

        .share-btn:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .share-btn.wa {
            background: rgba(37, 211, 102, 0.15);
            color: #25d366;
            border: 1px solid rgba(37, 211, 102, 0.3);
        }

        .share-btn.wa:hover {
            background: rgba(37, 211, 102, 0.25);
        }

        .share-btn.open {
            background: rgba(0, 98, 168, 0.15);
            color: var(--color-secondary-3);
            border: 1px solid rgba(0, 98, 168, 0.3);
        }

        .share-btn.open:hover {
            background: rgba(0, 98, 168, 0.25);
        }

        /* Detalles */
        .order-details {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.4rem 0;
            font-size: 0.875rem;
            border-bottom: 1px solid var(--border);
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .order-row span:first-child {
            color: var(--text-secondary);
        }

        .order-row span:last-child {
            font-weight: 600;
            color: var(--text-primary);
        }

        .precio-link {
            color: var(--color-secondary-3);
            font-size: 1.05rem;
            font-weight: 700;
        }

        .fecha-expiracion {
            color: var(--color-primary);
        }

        .btn-home {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: <?= $color ?>;
            color: #0d0e10;
            border: none;
            border-radius: 8px;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
            margin-right: 0.5rem;
        }

        .btn-home:hover {
            opacity: 0.85;
            color: #0d0e10;
            text-decoration: none;
            background: <?= $color ?>;
        }

        .btn-volver {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: transparent;
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-volver:hover {
            border-color: <?= $color ?>;
            color: <?= $color ?>;
            text-decoration: none;
        }
    </style>
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

    <script>
        function copyLink() {
            const text = document.getElementById('linkText').textContent.trim();
            navigator.clipboard.writeText(text).then(function () {
                const btn = document.getElementById('btnCopy');
                btn.classList.add('copied');
                btn.innerHTML = '<i class="bi bi-check2"></i> Copiado';
                setTimeout(function () {
                    btn.classList.remove('copied');
                    btn.innerHTML = '<i class="bi bi-clipboard"></i> Copiar';
                }, 2000);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>