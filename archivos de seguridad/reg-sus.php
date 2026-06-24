<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion) die("Error de conexión: " . mysqli_connect_error());
}

// Traer solo las suscripciones del usuario en sesión (por correo)
$correo_sesion = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

// Determinar modo
$modo = $_GET['modo'] ?? 'wc-sub';

switch ($modo) {
    case 'wc-rec':
        $resultado = mysqli_query($conexion, "SELECT *, 'wc-rec' as modo FROM suscription_rec WHERE usuario_id = '$correo_sesion' ORDER BY created_at DESC");
        break;
    case 'wc-pura':
        $resultado = mysqli_query($conexion, "SELECT *, 'wc-pura' as modo FROM suscription WHERE usuario_id = '$correo_sesion' ORDER BY created_at DESC");
        break;
    case 'gw-sub':
        $resultado = mysqli_query($conexion, "SELECT *, 'gw-sub' as modo FROM gateway_suscripciones WHERE correo = '$correo_sesion' ORDER BY created_at DESC");
        break;
    case 'gw-pura':
        $resultado = mysqli_query($conexion, "SELECT *, 'gw-pura' as modo FROM gateway_suscription WHERE correo = '$correo_sesion' ORDER BY created_at DESC");
        break;
    default: // wc-sub
        $resultado = mysqli_query($conexion, "SELECT *, 'wc-sub' as modo FROM suscripciones WHERE usuario_id = '$correo_sesion' ORDER BY created_at DESC");
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial — Suscripciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

</head>
<style>
    body {
        /* background-image: url(../assets/images/bg26.jpg); */
        background-color: #000000;
        color: white;
        background-repeat: no-repeat;
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
        font-family: 'Barlow', sans-serif;
    }
    .navbar {
        background-color: #0f0f0fa9 !important;
        backdrop-filter: blur(8px);
    }
    .tabla-container {
        background: rgb(15, 15, 15);
        border-radius: 12px;
        padding: 1.5rem;
        margin: 2rem auto;
        max-width: 1100px;
        backdrop-filter: blur(8px);
    }
    .tabla-titulo {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #0062A8;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .table {
        color: white;
        border-color: rgba(255,255,255,0.1);
    }
    .table thead th {
        background: rgb(0, 0, 0);
        color: #8a00fc;
        border-color: rgba(255,255,255,0.1);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
    }
    .table tbody tr {
        border-color: rgba(255,255,255,0.07);
        transition: background 0.15s;
    }
    .table tbody tr:hover { background: rgba(255,255,255,0.05); }
    .table tbody td { border-color: rgba(255,255,255,0.07); font-size: 0.88rem; vertical-align: middle; background: #1312129a; color: white; }

    .badge-aprobada  { background: rgba(62,207,142,0.2);  color: #3ecf8e; }
    .badge-pendiente { background: rgba(240,180,41,0.2);  color: #FF6C0C; }
    .badge-rechazada { background: rgba(224,82,82,0.2);   color: #e05252; }
    .badge-cancelada { background: rgba(138,141,150,0.2); color: #8a8d96; }

    .estado-pill {
        display: inline-block;
        padding: 0.2rem 0.65rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .sin-registros {
        text-align: center;
        padding: 3rem;
        color: #8a8d96;
        font-size: 0.95rem;
    }
    .modo-tabs-group { margin-bottom: 1.2rem; }
    .modo-tabs-label {
        font-size: 0.72rem; font-weight: 700; letter-spacing: 0.08em;
        text-transform: uppercase; color: #555860; margin-bottom: 0.4rem;
    }
    .modo-tabs { display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.6rem; }
    .modo-tab {
        padding: 0.4rem 0.85rem; border-radius: 8px;
        font-size: 0.79rem; font-weight: 700; text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.3rem;
        transition: all 0.2s; border: 1.5px solid rgba(255,255,255,0.08);
        color: #8a8d96; background: rgba(255,255,255,0.02);
    }
    .modo-tab:hover { text-decoration: none; color: #f0f1f3; }
    .modo-tab.active-purple { border-color: #0062A8; background: rgba(168,85,247,0.1); color: #0062A8; }
    .modo-tab.active-blue   { border-color: #0062A8; background: rgba(77,159,255,0.1); color: #0062A8; }
    .modo-tab.active-green  { border-color: #3ecf8e; background: rgba(62,207,142,0.1); color: #3ecf8e; }
    .modo-tab.active-orange { border-color: #f59e0b; background: rgba(245,158,11,0.1); color: #f59e0b; }
    .tabs-divider { height: 1px; background: rgba(255,255,255,0.06); margin: 0.6rem 0; }
    .btn-verificar {
        background: rgba(168,85,247,0.15);
        border: 1px solid rgba(168,85,247,0.4);
        color: #0062A8;
        border-radius: 6px;
        padding: 0.2rem 0.6rem;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-verificar:hover { background: rgba(168,85,247,0.3); color: #0062A8; text-decoration: none; }
    .alert-verify {
        background: rgba(62,207,142,0.12); color: #3ecf8e;
        border: 1px solid rgba(62,207,142,0.3);
        border-radius: 8px; padding: 0.75rem 1rem;
        margin-bottom: 1rem; font-size: 0.88rem;
    }
</style>
<body>
    <?php
        $nav_back_url  = "historial.php";
        $nav_back_text = "Atras";
        $nav_base      = "../";
        require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo"><i class="fa-solid fa-credit-card" style="color: rgb(153, 0, 255);"></i>
         Historial de Suscripciones
        </div>

        <!-- TABS Web Checkout -->
        <div class="modo-tabs-group">
            <div class="modo-tabs-label"><i class="bi bi-display"></i> Web Checkout</div>
            <div class="modo-tabs">
                <a href="reg-sus.php?modo=wc-sub"  class="modo-tab <?= $modo === 'wc-sub'  ? 'active-purple' : '' ?>"><i class="bi bi-tv"></i> Pago + Suscripción</a>
                <a href="reg-sus.php?modo=wc-rec"  class="modo-tab <?= $modo === 'wc-rec'  ? 'active-blue'   : '' ?>"><i class="fa-solid fa-credit-card"></i> Recurrentes</a>
                <a href="reg-sus.php?modo=wc-pura" class="modo-tab <?= $modo === 'wc-pura' ? 'active-green'  : '' ?>"><i class="bi bi-key"></i>  Suscripción pura</a>
            </div>
            <div class="tabs-divider"></div>
            <div class="modo-tabs-label">⚡ API Gateway</div>
            <div class="modo-tabs">
                <a href="reg-sus.php?modo=gw-sub"  class="modo-tab <?= $modo === 'gw-sub'  ? 'active-orange' : '' ?>"><i class="bi bi-tv"></i> Pago + Suscripción</a>
                <a href="reg-sus.php?modo=gw-pura" class="modo-tab <?= $modo === 'gw-pura' ? 'active-orange' : '' ?>"><i class="bi bi-key"></i>  Suscripción pura</a>
            </div>
        </div>

        <?php
        if (!empty($_SESSION['verify_msg'])) {
            echo '<div class="alert-verify">' . htmlspecialchars($_SESSION['verify_msg']) . '</div>';
            unset($_SESSION['verify_msg']);
        }
        ?>

        <?php if (mysqli_num_rows($resultado) > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <?php if (in_array($modo, ['wc-sub'])): ?>
                    <tr><th>#ID</th><th>Plataforma</th><th>Plan</th><th>Correo</th><th>Precio</th><th>Token</th><th>Estado</th><th>Fecha</th><th>Acción</th></tr>
                    <?php elseif ($modo === 'wc-rec'): ?>
                    <tr><th>#ID</th><th>Servicio</th><th>Plan</th><th>Correo</th><th>Precio/mes</th><th>Periodicidad</th><th>Próx. cobro</th><th>Fin</th><th>Estado</th><th>Fecha</th></tr>
                    <?php elseif ($modo === 'wc-pura'): ?>
                    <tr><th>#ID</th><th>Servicio</th><th>Plan</th><th>Correo</th><th>Precio</th><th>Token</th><th>Estado</th><th>Fecha</th></tr>
                    <?php elseif ($modo === 'gw-sub'): ?>
                    <tr><th>#ID</th><th>Servicio</th><th>Plan</th><th>Nombre</th><th>Correo</th><th>Precio</th><th>Token</th><th>Estado</th><th>Fecha</th></tr>
                    <?php elseif ($modo === 'gw-pura'): ?>
                    <tr><th>#ID</th><th>Servicio</th><th>Plan</th><th>Nombre</th><th>Correo</th><th>Precio</th><th>Token</th><th>Estado</th><th>Fecha</th></tr>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><span style="color:#8a8d96;">#<?= htmlspecialchars($row['id']) ?></span></td>

                        <?php if ($modo === 'wc-sub'): ?>
                        <td><?= htmlspecialchars($row['plataforma']) ?></td>
                        <td><?= htmlspecialchars($row['plan']) ?></td>
                        <td><code style="color:#0062A8;"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                        <td style="color:#0062A8;font-weight:700;">$<?= number_format($row['precio'],0,',','.') ?> COP</td>
                        <td style="color:<?= !empty($row['token']) ? '#3ecf8e' : '#555860' ?>; font-size:0.78rem;"><?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                        <td><span class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span></td>
                        <td style="color:#8a8d96;font-size:0.8rem;"><?= htmlspecialchars($row['created_at']) ?></td>
                        <td>
                            <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                            <a href="../php/verificar_pago.php?tabla=suscripciones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-sub" class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                            <?php else: ?><span style="color:#555860;font-size:0.75rem;">—</span><?php endif; ?>
                        </td>

                        <?php elseif ($modo === 'wc-rec'): ?>
                        <td><?= htmlspecialchars($row['servicio']) ?></td>
                        <td><?= htmlspecialchars($row['plan']) ?></td>
                        <td><code style="color:#0062A8;"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                        <td style="color:#0062A8;font-weight:700;">$<?= number_format($row['precio'],0,',','.') ?> COP</td>
                        <td><span style="background:rgba(77,159,255,0.12);color:#0062A8;font-size:0.72rem;padding:0.1rem 0.4rem;border-radius:3px;"><?= $row['periodicidad'] === 'Y' ? 'Anual' : 'Mensual' ?></span></td>
                        <td style="color:#f0f1f3;"><?= !empty($row['next_payment']) ? htmlspecialchars($row['next_payment']) : '—' ?></td>
                        <td style="color:#FF6C0C;"><?= !empty($row['fecha_fin']) ? htmlspecialchars($row['fecha_fin']) : '—' ?></td>
                        <td><span class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span></td>
                        <td style="color:#8a8d96;font-size:0.8rem;"><?= htmlspecialchars($row['created_at']) ?></td>

                        <?php elseif ($modo === 'wc-pura'): ?>
                        <td><?= htmlspecialchars($row['servicio']) ?></td>
                        <td><?= htmlspecialchars($row['plan']) ?></td>
                        <td><code style="color:#3ecf8e;"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                        <td style="color:#3ecf8e;font-weight:700;">$<?= number_format($row['precio'],0,',','.') ?> COP</td>
                        <td style="color:<?= !empty($row['token']) ? '#3ecf8e' : '#555860' ?>;font-size:0.78rem;"><?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                        <td><span class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span></td>
                        <td style="color:#8a8d96;font-size:0.8rem;"><?= htmlspecialchars($row['created_at']) ?></td>

                        <?php elseif ($modo === 'gw-sub'): ?>
                        <td><?= htmlspecialchars($row['servicio']) ?></td>
                        <td><?= htmlspecialchars($row['plan']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><code style="color:#f59e0b;"><?= htmlspecialchars($row['correo']) ?></code></td>
                        <td style="color:#f59e0b;font-weight:700;">$<?= number_format($row['precio'],0,',','.') ?> COP</td>
                        <td style="color:<?= !empty($row['token']) ? '#3ecf8e' : '#555860' ?>;font-size:0.78rem;"><?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                        <td><span class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span></td>
                        <td style="color:#8a8d96;font-size:0.8rem;"><?= htmlspecialchars($row['created_at']) ?></td>

                        <?php elseif ($modo === 'gw-pura'): ?>
                        <td><?= htmlspecialchars($row['servicio']) ?></td>
                        <td><?= htmlspecialchars($row['plan']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><code style="color:#f59e0b;"><?= htmlspecialchars($row['correo']) ?></code></td>
                        <td style="color:#f59e0b;font-weight:700;">$<?= number_format($row['precio'],0,',','.') ?> COP</td>
                        <td style="color:<?= !empty($row['token']) ? '#3ecf8e' : '#555860' ?>;font-size:0.78rem;"><?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                        <td><span class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span></td>
                        <td style="color:#8a8d96;font-size:0.8rem;"><?= htmlspecialchars($row['created_at']) ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-inbox" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes registros en esta categoría aún.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
