<?php

namespace Plance\Services\Profile;

use Plance\Repositories\Contracts\UserRepositoryInterface;
use Plance\Services\Profile\Exceptions\ValidationException;

class ProfileService
{
    private string $uploadsDir;

    public function __construct(private UserRepositoryInterface $users, ?string $uploadsDir = null)
    {
        $this->uploadsDir = $uploadsDir ?? dirname(__DIR__, 3) . '/uploads/';
    }

    public function actualizarFoto(int $userId, array $foto): string
    {
        if (($foto['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            throw new ValidationException('❌ Error al subir la imagen.');
        }

        $extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));
        $permitidos = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $permitidos, true)) {
            throw new ValidationException('❌ Solo se permiten imágenes JPG, PNG o WEBP.');
        }

        if ($foto['size'] > 2 * 1024 * 1024) {
            throw new ValidationException('❌ La imagen no puede superar 2MB.');
        }

        $nombreArchivo = 'avatar_' . $userId . '_' . time() . '.' . $extension;
        $destino = $this->uploadsDir . $nombreArchivo;

        if (!move_uploaded_file($foto['tmp_name'], $destino)) {
            throw new ValidationException('❌ No se pudo guardar la imagen.');
        }

        $this->users->updateProfileImage($userId, $nombreArchivo);

        return '✅ Foto de perfil actualizada.';
    }

    public function actualizarUsuario(int $userId, string $nuevo): string
    {
        $nuevo = trim($nuevo);

        if ($nuevo === '' || strlen($nuevo) < 3) {
            throw new ValidationException('❌ El nombre debe tener al menos 3 caracteres.');
        }

        if ($this->users->existsByUsuarioExcluyendoId($nuevo, $userId)) {
            throw new ValidationException('❌ Ese nombre de usuario ya está en uso.');
        }

        $this->users->updateUsuario($userId, $nuevo);

        return '✅ Nombre de usuario actualizado.';
    }

    public function actualizarCorreo(int $userId, string $nuevo): string
    {
        $nuevo = trim($nuevo);

        if (!filter_var($nuevo, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('❌ El correo no tiene un formato válido.');
        }

        if ($this->users->existsByCorreoExcluyendoId($nuevo, $userId)) {
            throw new ValidationException('❌ Ese correo ya está registrado.');
        }

        $this->users->updateCorreo($userId, $nuevo);

        return '✅ Correo actualizado correctamente.';
    }

    public function actualizarBio(int $userId, string $bio): string
    {
        $bio = substr(trim($bio), 0, 250);
        $this->users->updateBio($userId, $bio);

        return '✅ Biografía actualizada.';
    }

    public function actualizarLocation(int $userId, string $location): string
    {
        $location = substr(trim($location), 0, 100);
        $this->users->updateLocation($userId, $location);

        return '✅ Ubicación actualizada.';
    }

    public function actualizarBioYLocation(int $userId, string $bio, string $location): void
    {
        $this->users->updateBioYLocation($userId, trim($bio), trim($location));
    }

    public function actualizarPassword(int $userId, string $actual, string $nuevo, string $confirmar): string
    {
        $user = $this->users->findById($userId);

        if ($user === null || !password_verify($actual, $user['contraseña'])) {
            throw new ValidationException('❌ La contraseña actual es incorrecta.');
        }

        if ($nuevo !== $confirmar) {
            throw new ValidationException('❌ Las contraseñas nuevas no coinciden.');
        }

        if (strlen($nuevo) < 8 || !preg_match('/[A-Z]/', $nuevo) || !preg_match('/[0-9]/', $nuevo)) {
            throw new ValidationException('❌ La contraseña debe tener mínimo 8 caracteres, una mayúscula y un número.');
        }

        $this->users->updatePassword($userId, password_hash($nuevo, PASSWORD_DEFAULT));

        return '✅ Contraseña actualizada correctamente.';
    }
}
