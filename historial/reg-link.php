<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

// Links de pago generados (API Link de pagos — PlacetoPay)
$resultado = mysqli_query($conexion, "SELECT * FROM payment_link ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Links de Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
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
        --text-main: #000000;
    }

    body {
        background-color: #0d0e10;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Barlow', sans-serif;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--color-secondary-2);
    }

    .tabla-container {
        background: rgba(30, 33, 44, 0.85);
        border-radius: 14px;
        padding: 1.8rem;
        margin: 2rem auto;
        max-width: 1200px;
        backdrop-filter: blur(8px);
        border: 1px solid var(--color-secondary-2);
    }

    .tabla-titulo {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        color: var(--color-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        color: var(--color-secondary-5);
        background: var(--color-secondary-4);
        border-color: rgba(255, 255, 255, 0.08);
    }

    .table thead th {
        background: rgba(0, 0, 0, 0.6);
        color: var(--color-primary);
        border-color: rgba(255, 255, 255, 0.08);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        padding: 0.8rem 0.6rem;
    }

    .table tbody tr {
        border-color: rgba(255, 255, 255, 0.05);
        color: var(--color-primary-5);
        background-color: rgba(0, 0, 0, 0.3);
        transition: background 0.2s;
    }

    .table tbody tr:hover {
        background: rgba(255, 108, 12, 0.06);
    }

    .table tbody td {
        border-color: rgba(255, 255, 255, 0.05);
        font-size: 0.88rem;
        vertical-align: middle;
        color: var(--text-main);
        padding: 0.7rem 0.6rem;
    }

    /* Badges de estado usando la nueva paleta */
    .badge-activo {
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
    }

    .badge-error {
        background: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .badge-expirado {
        background: rgba(125, 134, 140, 0.15);
        color: var(--color-secondary-5);
    }

    .badge-pendiente {
        background: rgba(255, 108, 12, 0.15);
        color: var(--color-primary);
    }

    .estado-pill {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .sin-registros {
        text-align: center;
        padding: 3rem;
        color: var(--color-secondary-5);
        font-size: 0.95rem;
    }

    .sin-registros i {
        color: var(--color-secondary-2);
    }

    .btn-link-action {
        background: rgba(255, 108, 12, 0.12);
        border: 1px solid rgba(255, 108, 12, 0.25);
        color: var(--color-primary);
        border-radius: 6px;
        padding: 0.25rem 0.7rem;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s;
        white-space: nowrap;
        font-family: 'Barlow', sans-serif;
    }

    .btn-link-action:hover {
        background: rgba(255, 108, 12, 0.25);
        color: var(--color-primary);
        text-decoration: none;
        border-color: var(--color-primary);
    }

    .btn-link-action.copied {
        background: rgba(0, 207, 180, 0.15);
        border-color: rgba(0, 207, 180, 0.3);
        color: var(--color-secondary-1);
    }

    .codigo-ref {
        color: var(--color-secondary-3);
        font-size: 0.8rem;
        background: rgba(0, 98, 168, 0.08);
        padding: 0.15rem 0.4rem;
        border-radius: 4px;
    }

    .codigo-correo {
        color: var(--color-secondary-5);
        font-size: 0.8rem;
    }

    .precio-link {
        color: var(--color-primary);
        font-weight: 700;
    }

    .fecha-expira {
        color: var(--color-secondary-5);
        font-size: 0.8rem;
    }

    .fecha-creacion {
        color: var(--color-secondary-5);
        font-size: 0.8rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tabla-container {
            padding: 1rem;
            margin: 1rem 0.5rem;
        }

        .table thead th {
            font-size: 0.65rem;
            padding: 0.5rem 0.3rem;
        }

        .table tbody td {
            font-size: 0.75rem;
            padding: 0.5rem 0.3rem;
        }

        .btn-link-action {
            font-size: 0.65rem;
            padding: 0.15rem 0.4rem;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="fa-solid fa-link" style="color: var(--color-primary);"></i>
            Historial de Links de Pago
        </div>

        <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Referencia</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Pagos</th>
                            <th>Expira</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultado)):
                            $estado = strtolower($row['estado']);
                            $expirado = !empty($row['expiracion']) && strtotime($row['expiracion']) < time();
                            if ($estado === 'activo' && $expirado)
                                $estado_show = 'expirado';
                            else
                                $estado_show = $estado;
                            ?>
                            <tr>
                                <td><span style="color:var(--color-secondary-5);">#<?= htmlspecialchars($row['id']) ?></span>
                                </td>
                                <td><?= htmlspecialchars($row['producto']) ?></td>
                                <td class="precio-link">$<?= number_format((float) $row['precio'], 0, ',', '.') ?> COP</td>
                                <td><code class="codigo-ref"><?= htmlspecialchars($row['referencia']) ?></code></td>
                                <td><code class="codigo-correo"><?= htmlspecialchars($row['correo']) ?></code></td>
                                <td>
                                    <span class="estado-pill badge-<?= $estado_show ?>">
                                        <?= strtoupper($estado_show) ?>
                                    </span>
                                </td>
                                <td style="text-align:center; color:var(--text-main);"><?= (int) ($row['pagos_usados'] ?? 0) ?>
                                </td>
                                <td class="fecha-expira">
                                    <?= !empty($row['expiracion']) ? htmlspecialchars($row['expiracion']) : '—' ?></td>
                                <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                <td>
                                    <?php if (!empty($row['link_url']) && $estado === 'activo' && !$expirado): ?>
                                        <div style="display:flex; gap:0.3rem; flex-wrap:wrap;">
                                            <a href="<?= htmlspecialchars($row['link_url']) ?>" target="_blank"
                                                class="btn-link-action">
                                                <i class="bi bi-box-arrow-up-right"></i> Abrir
                                            </a>
                                            <button type="button" class="btn-link-action btn-copy"
                                                data-link="<?= htmlspecialchars($row['link_url'], ENT_QUOTES) ?>"
                                                onclick="copyLink(this)">
                                                <i class="bi bi-clipboard"></i> Copiar
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <span style="color:var(--color-secondary-2); font-size:0.75rem;">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No hay links de pago generados aún.
            </div>
        <?php endif; ?>
    </div>

    <script>
        function copyLink(btn) {
            const link = btn.getAttribute('data-link');
            navigator.clipboard.writeText(link).then(function () {
                const original = btn.innerHTML;
                btn.classList.add('copied');
                btn.innerHTML = '<i class="bi bi-check2"></i> Copiado';
                setTimeout(function () {
                    btn.classList.remove('copied');
                    btn.innerHTML = original;
                }, 2000);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>