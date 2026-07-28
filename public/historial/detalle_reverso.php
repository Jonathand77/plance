<?php
session_start();
require_once __DIR__ . '/../../src/bootstrap.php';

use Plance\Controllers\Historial\ReversosController;

if (!isset($_SESSION['usuario'])) {
    header('Location: ../login.php');
    exit();
}

$__view = (new ReversosController())->handleDetalle($_GET);

$id = $__view['id'];
$tipo = $__view['tipo'];
$trx = $__view['trx'];
$nombre = $__view['nombre'];
$usuario = $__view['usuario'];
$msg = $__view['msg'];
$msg_type = $__view['msgType'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle — Reverso #<?= $id ?></title>
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
        -webkit-font-smoothing: antialiased;
    }

    .navbar {
        background-color: rgba(30, 33, 44, 0.85) !important;
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--border);
    }

    .detalle-layout {
        max-width: 960px;
        margin: 2rem auto;
        padding: 0 1.5rem 3rem;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        align-items: start;
    }

    .pcard {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.6rem 2rem;
    }

    .pcard-title {
        font-family: var(--font-display);
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid var(--border);
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.7rem 0;
        font-size: 0.95rem;
        border-bottom: 1px solid rgba(76, 95, 113, 0.25);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row span:first-child {
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.9rem;
    }

    .info-row span:last-child {
        font-weight: 600;
        color: var(--text-primary);
        text-align: right;
        max-width: 65%;
        font-size: 0.95rem;
        word-break: break-word;
    }

    .estado-badge {
        display: inline-block;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        font-family: var(--font-display);
        letter-spacing: 0.05em;
        background: rgba(0, 207, 180, 0.15);
        color: var(--color-secondary-1);
        white-space: nowrap;
        pointer-events: none;
    }

    /* Botón opciones */
    .opciones-wrap {
        position: relative;
    }

    .btn-opciones {
        width: 100%;
        padding: 0.85rem 1.2rem;
        background: var(--color-danger);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-family: var(--font-display);
        font-size: 1.05rem;
        font-weight: 800;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: background 0.2s;
    }

    .btn-opciones:hover {
        background: #b02a37;
    }

    .opciones-menu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        z-index: 99;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
        animation: dropFade 0.15s ease;
    }

    @keyframes dropFade {
        from {
            opacity: 0;
            transform: translateY(-6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .opciones-menu.show {
        display: block;
    }

    .opcion-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.85rem 1.2rem;
        font-size: 0.95rem;
        color: var(--text-primary);
        cursor: pointer;
        transition: background 0.15s;
        text-decoration: none;
        border-bottom: 1px solid var(--border);
    }

    .opcion-item:last-child {
        border-bottom: none;
    }

    .opcion-item:hover {
        background: rgba(255, 255, 255, 0.05);
        text-decoration: none;
    }

    .opcion-item.danger {
        color: var(--color-danger);
    }

    .opcion-item.danger:hover {
        background: rgba(220, 53, 69, 0.1);
    }

    /* Info box reverso */
    .reverso-info {
        background: rgba(220, 53, 69, 0.08);
        border: 1px solid rgba(220, 53, 69, 0.2);
        border-radius: 10px;
        padding: 1rem 1.2rem;
        margin-top: 1.2rem;
        font-size: 0.85rem;
        color: var(--color-danger);
        line-height: 1.6;
    }

    .reverso-info i {
        margin-right: 0.4rem;
    }

    .alert-success-custom {
        background: rgba(0, 207, 180, 0.12);
        color: var(--color-secondary-1);
        border: 1px solid rgba(0, 207, 180, 0.3);
        border-radius: 10px;
        padding: 1rem 1.2rem;
        margin-bottom: 1rem;
        font-size: 0.92rem;
    }

    .alert-error-custom {
        background: rgba(220, 53, 69, 0.12);
        color: var(--color-danger);
        border: 1px solid rgba(220, 53, 69, 0.3);
        border-radius: 10px;
        padding: 1rem 1.2rem;
        margin-bottom: 1rem;
        font-size: 0.92rem;
    }

    /* Modal carta */
    .modal-carta-btn {
        background: var(--color-primary);
        color: #0d0e10;
        border: none;
        border-radius: 10px;
        padding: 0.75rem;
        font-family: var(--font-display);
        font-weight: 800;
        font-size: 0.95rem;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.2s;
    }

    .modal-carta-btn:hover {
        background: var(--color-secondary-3);
        color: #fff;
    }

    /* Badge de tipo */
    .tipo-badge {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: rgba(255, 108, 12, 0.12);
        color: var(--color-primary);
        white-space: nowrap;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .detalle-layout {
            grid-template-columns: 1fr;
            padding: 0 1rem 2rem;
        }

        .pcard {
            padding: 1.2rem 1.2rem;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.3rem;
            padding: 0.6rem 0;
        }

        .info-row span:last-child {
            text-align: left;
            max-width: 100%;
            width: 100%;
        }
    }
</style>

<body>
    <?php
    $nav_back_url = "reversos.php";
    $nav_back_text = "Volver";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <?php if ($msg): ?>
        <div style="max-width:960px;margin:1rem auto;padding:0 1.5rem;">
            <div class="alert-<?= $msg_type === 'success' ? 'success' : 'error' ?>-custom">
                <?= htmlspecialchars($msg) ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="detalle-layout">

        <!-- IZQUIERDA: Info transacción -->
        <div>
            <div class="pcard" style="margin-bottom:1.5rem;">
                <div class="pcard-title">📋 Información de la transacción</div>

                <div class="info-row">
                    <span>ID Transacción</span>
                    <span><strong>#<?= htmlspecialchars($trx['id']) ?></strong></span>
                </div>
                <div class="info-row">
                    <span>Tipo</span>
                    <span>
                        <?php if ($tipo === 'orden'): ?>
                            <span class="tipo-badge">🎮 Pago Básico</span>
                        <?php elseif ($tipo === 'suscripcion'): ?>
                            <span class="tipo-badge"
                                style="background:rgba(0,207,180,0.12); color:var(--color-secondary-1);">📺
                                Suscripción</span>
                        <?php else: ?>
                            <span class="tipo-badge"
                                style="background:rgba(0,98,168,0.12); color:var(--color-secondary-3);"><i
                                    class="bi bi-calendar-check-fill"></i> Recurrencia</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-row">
                    <span>Producto / Servicio</span>
                    <span><?= htmlspecialchars($nombre) ?></span>
                </div>
                <div class="info-row">
                    <span>Estado</span>
                    <span><span class="estado-badge">✅ APROBADA</span></span>
                </div>
                <div class="info-row">
                    <span>Fecha</span>
                    <span><?= htmlspecialchars($trx['created_at']) ?></span>
                </div>
                <div class="info-row" style="border-bottom: none; padding-top: 0.8rem; margin-top: 0.2rem;">
                    <span style="font-size: 1rem; font-weight: 600;">Total pagado</span>
                    <span
                        style="color:var(--color-secondary-1); font-size: 1.4rem; font-weight: 800;">$<?= number_format($trx['precio'], 0, ',', '.') ?>
                        COP</span>
                </div>
            </div>

            <div class="pcard">
                <div class="pcard-title"><i class="bi bi-person-vcard-fill"></i> Información del pagador</div>
                <div class="info-row">
                    <span>Usuario / Correo</span>
                    <span><strong><?= htmlspecialchars($usuario) ?></strong></span>
                </div>
                <div class="info-row" style="border-bottom: none;">
                    <span>Request ID</span>
                    <span style="font-size:0.8rem; color:var(--text-secondary); font-weight:400;">
                        <?= !empty($trx['request_id']) ? htmlspecialchars(substr($trx['request_id'], 0, 24)) . '…' : 'N/A' ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- DERECHA: Opciones -->
        <div>
            <div class="pcard">
                <div class="pcard-title">⚙️ Acciones</div>

                <div class="opciones-wrap">
                    <button class="btn-opciones" onclick="toggleOpciones()">
                        <span>Opciones</span>
                        <i class="bi bi-chevron-down" id="chevron"></i>
                    </button>

                    <div class="opciones-menu" id="opcionesMenu">

                        <!-- Imprimir comprobante -->
                        <a href="javascript:void(0)" onclick="imprimirComprobante()" class="opcion-item">
                            <i class="bi bi-printer-fill"></i> Imprimir comprobante
                        </a>

                        <!-- Carta de reverso -->
                        <a href="javascript:void(0)" onclick="cartaReverso()" class="opcion-item">
                            <i class="bi bi-file-text-fill"></i> Carta de reverso
                        </a>

                        <!-- Reversar transacción -->
                        <a href="javascript:void(0)" onclick="confirmarReverso(<?= $id ?>, '<?= $tipo ?>')"
                            class="opcion-item danger">
                            <i class="bi bi-arrow-counterclockwise"></i> Reversar transacción
                        </a>

                    </div>
                </div>

                <div class="reverso-info">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <strong>Importante:</strong> El reverso solo está disponible antes de la hora de corte del día. Una
                    vez reversada la transacción, el dinero será devuelto automáticamente.
                </div>
            </div>
        </div>

    </div>

    <!-- Modal carta de reverso -->
    <div id="modalCarta"
        style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.75); z-index:999; align-items:center; justify-content:center; backdrop-filter:blur(4px);">
        <div
            style="background:var(--bg-surface); border:1px solid var(--border); border-radius:16px; padding:2rem 2rem; max-width:520px; width:92%; font-family:'Barlow',sans-serif; max-height:90vh; overflow-y:auto;">
            <h3
                style="font-family:'Barlow',sans-serif; font-size:1.4rem; font-weight:800; color:var(--text-primary); margin-bottom:1.2rem;">
                📄 Carta de Reverso
            </h3>
            <div
                style="background:var(--bg-card); border-radius:10px; padding:1.4rem; font-size:0.88rem; color:var(--text-secondary); line-height:1.8;">
                <p style="color:var(--text-primary); font-weight:600; margin-bottom:0.5rem;">Señores PlaceToPay /
                    Evertec:</p>
                <p>Por medio de la presente, el usuario <strong
                        style="color:var(--text-primary);"><?= htmlspecialchars($usuario) ?></strong> solicita
                    formalmente el reverso de la transacción con los siguientes datos:</p>
                <br>
                <p>• <strong style="color:var(--text-primary);">ID Transacción:</strong>
                    #<?= htmlspecialchars($trx['id']) ?></p>
                <p>• <strong style="color:var(--text-primary);">Producto:</strong> <?= htmlspecialchars($nombre) ?></p>
                <p>• <strong style="color:var(--text-primary);">Valor:</strong>
                    $<?= number_format($trx['precio'], 0, ',', '.') ?> COP</p>
                <p>• <strong style="color:var(--text-primary);">Fecha:</strong>
                    <?= htmlspecialchars($trx['created_at']) ?></p>
                <br>
                <p>Atentamente,<br><strong
                        style="color:var(--text-primary);"><?= htmlspecialchars($_SESSION['usuario']) ?></strong></p>
            </div>
            <div style="display:flex; gap:0.8rem; margin-top:1.5rem;">
                <button onclick="window.print()" class="modal-carta-btn" style="flex:1;">
                    🖨️ Imprimir
                </button>
                <button onclick="document.getElementById('modalCarta').style.display='none'"
                    style="flex:1; padding:0.75rem; background:transparent; color:var(--text-secondary); border:1px solid var(--border); border-radius:10px; font-family:'Barlow',sans-serif; font-weight:700; font-size:0.95rem; text-transform:uppercase; cursor:pointer; transition:border-color 0.2s;">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleOpciones() {
            const menu = document.getElementById('opcionesMenu');
            const chevron = document.getElementById('chevron');
            menu.classList.toggle('show');
            chevron.className = menu.classList.contains('show')
                ? 'bi bi-chevron-up' : 'bi bi-chevron-down';
        }

        // Cerrar menú si click fuera
        document.addEventListener('click', function (e) {
            if (!e.target.closest('.opciones-wrap')) {
                document.getElementById('opcionesMenu').classList.remove('show');
                document.getElementById('chevron').className = 'bi bi-chevron-down';
            }
        });

        function imprimirComprobante() {
            window.print();
        }

        function cartaReverso() {
            document.getElementById('modalCarta').style.display = 'flex';
            document.getElementById('opcionesMenu').classList.remove('show');
        }

        function confirmarReverso(id, tipo) {
            document.getElementById('opcionesMenu').classList.remove('show');
            if (confirm('⚠️ ¿Estás seguro de reversar esta transacción?\n\nEsta acción devolverá el dinero al cliente y no se puede deshacer.')) {
                window.location.href = '../php/procesar_reverso.php?id=' + id + '&tipo=' + tipo;
            }
        }

        // Cerrar modal con ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.getElementById('modalCarta').style.display = 'none';
            }
        });
    </script>
</body>

</html>