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
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/detalle_reverso.css">

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