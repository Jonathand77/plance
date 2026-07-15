<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../php/conexion_be.php';
if (!isset($conexion)) {
    $conexion = mysqli_connect('localhost', 'root', 'root', 'place_bsd');
    if (!$conexion)
        die("Error de conexión: " . mysqli_connect_error());
}

$correo = mysqli_real_escape_string($conexion, $_SESSION['correo'] ?? '');

// Traer ordenes aprobadas
$ordenes = mysqli_query($conexion, "SELECT id, producto as nombre, precio, jugador_id as usuario, created_at, estado, 'orden' as tipo FROM ordenes WHERE estado = 'aprobada' ORDER BY created_at DESC");

// Traer suscripciones aprobadas del usuario
$suscripciones = mysqli_query($conexion, "SELECT id, CONCAT(plataforma, ' — ', plan) as nombre, precio, usuario_id as usuario, created_at, estado, 'suscripcion' as tipo FROM suscripciones WHERE estado = 'aprobada' AND usuario_id = '$correo' ORDER BY created_at DESC");

// Traer recurrencias aprobadas del usuario
$recurrencias = mysqli_query($conexion, "SELECT id, CONCAT(servicio, ' — ', plan) as nombre, precio, usuario_id as usuario, created_at, estado, 'recurrencia' as tipo FROM recurrencias WHERE estado = 'aprobada' AND usuario_id = '$correo' ORDER BY created_at DESC");

// Unir en un array
$transacciones = [];
while ($row = mysqli_fetch_assoc($ordenes))
    $transacciones[] = $row;
while ($row = mysqli_fetch_assoc($suscripciones))
    $transacciones[] = $row;
while ($row = mysqli_fetch_assoc($recurrencias))
    $transacciones[] = $row;

// Ordenar por fecha desc
usort($transacciones, fn($a, $b) => strtotime($b['created_at']) - strtotime($a['created_at']));

// Mensaje
$msg = $_SESSION['reverso_msg'] ?? '';
$msg_type = $_SESSION['reverso_msg_type'] ?? '';
unset($_SESSION['reverso_msg'], $_SESSION['reverso_msg_type']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reversos — Transacciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
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
        --color-danger: #dc3545;
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
        max-width: 1100px;
        backdrop-filter: blur(8px);
        border: 1px solid var(--color-secondary-2);
    }

    .tabla-titulo {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.2rem;
        color: var(--color-danger);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        color: white;
        border-color: rgba(255, 255, 255, 0.08);
    }

    .table thead th {
        background: rgba(220, 53, 69, 0.10);
        color: var(--color-danger);
        border-color: rgba(255, 255, 255, 0.08);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        font-weight: 700;
        padding: 0.8rem 0.6rem;
    }

    .table tbody tr {
        border-color: rgba(255, 255, 255, 0.05);
        background-color: rgba(0, 0, 0, 0.3);
        transition: background 0.2s;
    }

    .table tbody tr:hover {
        background: rgba(220, 53, 69, 0.05);
    }

    .table tbody td {
        border-color: rgba(255, 255, 255, 0.05);
        font-size: 0.88rem;
        vertical-align: middle;
        color: var(--text-main);
        padding: 0.7rem 0.6rem;
    }

    .tipo-badge {
        display: inline-block;
        padding: 0.15rem 0.55rem;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .tipo-orden {
        background: rgba(255, 108, 12, 0.15);
        color: var(--color-primary);
    }

    .tipo-suscripcion {
        background: rgba(0, 98, 168, 0.15);
        color: var(--color-secondary-3);
    }

    .tipo-recurrencia {
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
    }

    .badge-aprobada {
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
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

    .btn-detalle {
        background: rgba(220, 53, 69, 0.12);
        border: 1px solid rgba(220, 53, 69, 0.25);
        color: var(--color-danger);
        border-radius: 6px;
        padding: 0.25rem 0.7rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        transition: all 0.2s;
        font-family: 'Barlow', sans-serif;
    }

    .btn-detalle:hover {
        background: rgba(220, 53, 69, 0.25);
        color: var(--color-danger);
        text-decoration: none;
        border-color: var(--color-danger);
    }

    .alert-success-custom {
        background: rgba(0, 207, 180, 0.12);
        color: var(--color-secondary-1);
        border: 1px solid rgba(0, 207, 180, 0.3);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.88rem;
    }

    .alert-error-custom {
        background: rgba(220, 53, 69, 0.12);
        color: var(--color-danger);
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.88rem;
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

    .codigo-usuario {
        color: var(--color-secondary-5);
    }

    .precio-aprobado {
        color: var(--color-secondary-1);
        font-weight: 700;
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

        .btn-detalle {
            font-size: 0.65rem;
            padding: 0.15rem 0.4rem;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="bi bi-arrow-counterclockwise"></i> Transacciones para Reverso
        </div>

        <?php if ($msg): ?>
            <div class="alert-<?= $msg_type === 'success' ? 'success' : 'error' ?>-custom">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

        <?php if (count($transacciones) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Tipo</th>
                            <th>Producto / Servicio</th>
                            <th>Usuario</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transacciones as $trx): ?>
                            <tr>
                                <td><span style="color:var(--color-secondary-5);">#<?= htmlspecialchars($trx['id']) ?></span>
                                </td>
                                <td>
                                    <span class="tipo-badge tipo-<?= $trx['tipo'] ?>">
                                        <?= $trx['tipo'] === 'orden' ? '<i class="bi bi-controller"></i> Juego' : ($trx['tipo'] === 'suscripcion' ? '<i class="bi bi-tv"></i> Suscripción' : '🔄 Recurrencia') ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($trx['nombre']) ?></td>
                                <td><code class="codigo-usuario"><?= htmlspecialchars($trx['usuario']) ?></code></td>
                                <td class="precio-aprobado">$<?= number_format($trx['precio'], 0, ',', '.') ?> COP</td>
                                <td>
                                    <span class="estado-pill badge-<?= strtolower($trx['estado']) ?>">
                                        <?= strtoupper($trx['estado']) ?>
                                    </span>
                                </td>
                                <td class="fecha-creacion"><?= htmlspecialchars($trx['created_at']) ?></td>
                                <td>
                                    <a href="detalle_reverso.php?id=<?= $trx['id'] ?>&tipo=<?= $trx['tipo'] ?>"
                                        class="btn-detalle">
                                        <i class="bi bi-eye-fill"></i> Ver detalle
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="sin-registros">
                <i class="bi bi-arrow-counterclockwise" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                No tienes transacciones aprobadas disponibles para reverso.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>