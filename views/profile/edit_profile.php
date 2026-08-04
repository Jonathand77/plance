<!DOCTYPE html>
<?php require_once '../php/theme_attr.php'; ?>
<html lang="es"<?= $data_theme_attr ?? '' ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil — <?= htmlspecialchars($row['usuario']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css?family=Barlow:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilos.css">
</head>
<link rel="stylesheet" href="../assets/css/pages/profile/edit_profile.css">

<body>

    <nav class="navbar navbar-dark navbar-expand-lg px-3 py-2">
        <a class="navbar-brand fw-bold" href="../index.php" style="color: var(--accent);">
            <img src="../assets/icons/iconoy.png" alt="Logo" style="width: 30px;">
        </a>
        <a href="index.php" class="btn-back-nav"><i class="bi bi-backspace-fill"></i> Volver al perfil</a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <span
                style="background-color: rgba(30,33,44,0.84); padding: 5px 12px; border-radius: 8px; font-weight: 600; color: var(--text-main);">
                <?= isset($_SESSION['usuario']) ? "Hola, " . htmlspecialchars($_SESSION['usuario']) : "Invitado" ?>
                <i class="bi bi-circle-fill" style="color: var(--color-secondary-1);"></i>
            </span>
            <a href="../php/cerrar_sesion.php" class="btn btn-sm"
                style="background: var(--accent); color: #0d0e10; font-weight: 700; border: none; border-radius: 8px; padding: 0.3rem 0.8rem; transition: all 0.2s;">Cerrar
                sesión</a>
        </div>
    </nav>

    <div class="edit-layout">

        <div class="page-title"><i class="bi bi-pencil-square"></i> Editar Perfil</div>

        <?php if ($msg): ?>
            <div class="alert-custom alert-<?= $msg_type ?>"><?= htmlspecialchars($msg) ?></div>
        <?php endif; ?>

        <!-- FOTO DE PERFIL -->
        <div class="pcard">
            <div class="pcard-title">📸 Foto de perfil</div>
            <div class="foto-section">

                <?php if (!empty($row['profile_image']) && file_exists('../uploads/' . $row['profile_image'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($row['profile_image']) ?>" class="avatar-img" alt="Foto">
                <?php else: ?>
                    <div class="avatar-initials"><?= strtoupper(substr($row['usuario'], 0, 1)) ?></div>
                <?php endif; ?>

                <div class="foto-info">
                    <form action="update.php" method="POST" enctype="multipart/form-data" id="fotoForm">
                        <input type="hidden" name="accion" value="foto">
                        <input type="hidden" name="redirect" value="edit_profile.php">
                        <input type="file" id="fotoInput" name="foto" accept="image/*"
                            onchange="document.getElementById('fotoForm').submit()">
                        <label for="fotoInput" class="btn-upload">
                            <i class="bi bi-camera-fill"></i> Cambiar foto
                        </label>
                    </form>
                    <p>JPG, PNG o WEBP · Máx. 2MB</p>
                </div>
            </div>
        </div>

        <!-- INFORMACIÓN PÚBLICA -->
        <div class="pcard">
            <div class="pcard-title">👤 Información pública</div>

            <form action="update.php" method="POST">
                <input type="hidden" name="accion" value="usuario">
                <input type="hidden" name="redirect" value="edit_profile.php">
                <div class="form-group">
                    <label class="form-label-custom">Nombre de usuario</label>
                    <input type="text" name="usuario" class="form-input"
                        value="<?= htmlspecialchars($row['usuario']) ?>" required minlength="3" maxlength="32">
                </div>
                <button type="submit" class="btn-save">Guardar</button>
            </form>

            <div style="height:1px;background:var(--border);margin:1.2rem 0;"></div>

            <form action="update.php" method="POST">
                <input type="hidden" name="accion" value="bio">
                <input type="hidden" name="redirect" value="edit_profile.php">
                <div class="form-group">
                    <label class="form-label-custom">Biografía</label>
                    <textarea name="bio" class="form-input" placeholder="Cuéntanos algo sobre ti..."
                        maxlength="250"><?= htmlspecialchars($row['bio'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn-save">Guardar</button>
            </form>

            <div style="height:1px;background:var(--border);margin:1.2rem 0;"></div>

            <form action="update.php" method="POST">
                <input type="hidden" name="accion" value="location">
                <input type="hidden" name="redirect" value="edit_profile.php">
                <div class="form-group">
                    <label class="form-label-custom">Ubicación</label>
                    <input type="text" name="location" class="form-input"
                        value="<?= htmlspecialchars($row['location'] ?? '') ?>" placeholder="Ej: Medellín, Colombia"
                        maxlength="100">
                </div>
                <button type="submit" class="btn-save">Guardar</button>
            </form>
        </div>

        <!-- INFORMACIÓN DE CUENTA -->
        <div class="pcard">
            <div class="pcard-title">🔐 Información de cuenta</div>

            <form action="update.php" method="POST">
                <input type="hidden" name="accion" value="correo">
                <input type="hidden" name="redirect" value="edit_profile.php">
                <div class="form-group">
                    <label class="form-label-custom">Correo electrónico</label>
                    <input type="email" name="correo" class="form-input" value="<?= htmlspecialchars($row['correo']) ?>"
                        required>
                </div>
                <button type="submit" class="btn-save">Guardar</button>
            </form>

            <div style="height:1px;background:var(--border);margin:1.2rem 0;"></div>

            <form action="update.php" method="POST">
                <input type="hidden" name="accion" value="password">
                <input type="hidden" name="redirect" value="edit_profile.php">
                <div class="form-group">
                    <label class="form-label-custom">Contraseña actual</label>
                    <input type="password" name="password_actual" class="form-input" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label class="form-label-custom">Nueva contraseña</label>
                    <input type="password" name="password_nuevo" class="form-input" placeholder="Mínimo 8 caracteres"
                        required minlength="8">
                </div>
                <div class="form-group">
                    <label class="form-label-custom">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmar" class="form-input"
                        placeholder="Repite la nueva contraseña" required>
                </div>
                <button type="submit" class="btn-save">Cambiar contraseña</button>
            </form>
        </div>

        <a href="index.php" class="btn-back"><i class="bi bi-arrow-left"></i> Volver al perfil</a>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>