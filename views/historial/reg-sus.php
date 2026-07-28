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

    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/historial/reg-sus.css">

<body>
    <?php
    $nav_back_url = "historial.php";
    $nav_back_text = "Atras";
    $nav_base = "../";
    require_once '../php/navbar.php';
    ?>

    <div class="tabla-container">
        <div class="tabla-titulo">
            <i class="fa-solid fa-credit-card" style="color: var(--color-secondary-3);"></i>
            Historial de Suscripciones
        </div>

        <!-- TABS Web Checkout -->
        <div class="modo-tabs-group">
            <div class="modo-tabs-label"><i class="bi bi-display"></i> Web Checkout</div>
            <div class="modo-tabs">
                <a href="reg-sus.php?modo=wc-sub" class="modo-tab <?= $modo === 'wc-sub' ? 'active-purple' : '' ?>"><i
                        class="bi bi-tv"></i> Pago + Suscripción</a>
                <a href="reg-sus.php?modo=wc-rec" class="modo-tab <?= $modo === 'wc-rec' ? 'active-blue' : '' ?>"><i
                        class="fa-solid fa-credit-card"></i> Recurrentes</a>
                <a href="reg-sus.php?modo=wc-pura" class="modo-tab <?= $modo === 'wc-pura' ? 'active-green' : '' ?>"><i
                        class="bi bi-key"></i> Suscripción pura</a>
            </div>
            <div class="tabs-divider"></div>
            <div class="modo-tabs-label"><i class="bi bi-code-slash"></i> API Gateway</div>
            <div class="modo-tabs">
                <a href="reg-sus.php?modo=gw-sub" class="modo-tab <?= $modo === 'gw-sub' ? 'active-orange' : '' ?>"><i
                        class="bi bi-tv"></i> Pago + Suscripción</a>
                <a href="reg-sus.php?modo=gw-pura" class="modo-tab <?= $modo === 'gw-pura' ? 'active-orange' : '' ?>"><i
                        class="bi bi-key"></i> Suscripción pura</a>
            </div>
        </div>

        <?php if (!empty($verify_msg)): ?>
            <div class="alert-verify"><?= htmlspecialchars($verify_msg) ?></div>
        <?php endif; ?>

        <?php if (count($registros) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <?php if (in_array($modo, ['wc-sub'])): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Plataforma</th>
                                <th>Plan</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'wc-rec'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Correo</th>
                                <th>Precio/mes</th>
                                <th>Periodicidad</th>
                                <th>Próx. cobro</th>
                                <th>Fin</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'wc-pura'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'gw-sub'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php elseif ($modo === 'gw-pura'): ?>
                            <tr>
                                <th>#ID</th>
                                <th>Servicio</th>
                                <th>Plan</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Precio</th>
                                <th>Token</th>
                                <th>Estado</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        <?php endif; ?>
                    </thead>
                    <tbody>
                        <?php foreach ($registros as $row): ?>
                            <tr>
                                <td><span class="codigo-id">#<?= htmlspecialchars($row['id']) ?></span></td>

                                <?php if ($modo === 'wc-sub'): ?>
                                    <td><?= htmlspecialchars($row['plataforma']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=suscripciones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-sub"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'wc-rec'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td><span
                                            class="periodicidad-badge"><?= $row['periodicidad'] === 'Y' ? 'Anual' : 'Mensual' ?></span>
                                    </td>
                                    <td style="color:var(--text-main);">
                                        <?= !empty($row['next_payment']) ? htmlspecialchars($row['next_payment']) : '—' ?></td>
                                    <td style="color:var(--color-primary);">
                                        <?= !empty($row['fecha_fin']) ? htmlspecialchars($row['fecha_fin']) : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=suscription_rec&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-rec"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'wc-pura'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><code class="codigo-correo"><?= htmlspecialchars($row['usuario_id']) ?></code></td>
                                    <td class="precio-link">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=suscription&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=wc-pura"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'gw-sub'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><code class="codigo-correo-gw"><?= htmlspecialchars($row['correo']) ?></code></td>
                                    <td class="precio-gw">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=gateway_suscripciones&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=gw-sub"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>

                                <?php elseif ($modo === 'gw-pura'): ?>
                                    <td><?= htmlspecialchars($row['servicio']) ?></td>
                                    <td><?= htmlspecialchars($row['plan']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><code class="codigo-correo-gw"><?= htmlspecialchars($row['correo']) ?></code></td>
                                    <td class="precio-gw">$<?= number_format($row['precio'], 0, ',', '.') ?> COP</td>
                                    <td class="<?= !empty($row['token']) ? 'token-guardado' : 'token-vacio' ?>">
                                        <?= !empty($row['token']) ? '✅ Guardado' : '—' ?></td>
                                    <td><span
                                            class="estado-pill badge-<?= strtolower($row['estado']) ?>"><?= strtoupper($row['estado']) ?></span>
                                    </td>
                                    <td class="fecha-creacion"><?= htmlspecialchars($row['created_at']) ?></td>
                                    <td>
                                        <?php if (strtolower($row['estado']) === 'pendiente' && !empty($row['request_id'])): ?>
                                            <a href="../php/verificar_pago.php?tabla=gateway_suscription&id=<?= $row['id'] ?>&request_id=<?= urlencode($row['request_id']) ?>&redirect=../historial/reg-sus.php?modo=gw-pura"
                                                class="btn-verificar"><i class="bi bi-arrow-repeat"></i> Verificar</a>
                                        <?php else: ?><span
                                                style="color:var(--color-secondary-2);font-size:0.75rem;">—</span><?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
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