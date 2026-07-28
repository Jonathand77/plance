<?php

namespace Plance\Services\Auth;

use Plance\Repositories\Contracts\UserRepositoryInterface;
use Plance\Services\Auth\Exceptions\AuthException;
use Plance\Services\Auth\Exceptions\DuplicateUserException;
use Plance\Services\Auth\Exceptions\InvalidCredentialsException;
use Plance\Services\Auth\Exceptions\UserNotFoundException;
use Plance\Services\Auth\Exceptions\ValidationException;
use PDOException;

class AuthService
{
    public function __construct(private UserRepositoryInterface $users)
    {
    }

    public function login(string $correo, string $contrasena): array
    {
        if ($correo === '' || $contrasena === '') {
            throw new ValidationException('Rellene todos los campos');
        }

        $user = $this->users->findByEmail($correo);

        if ($user === null) {
            throw new UserNotFoundException('Usuario no encontrado');
        }

        if (!password_verify($contrasena, $user['contraseña'])) {
            throw new InvalidCredentialsException('Contraseña incorrecta');
        }

        return $user;
    }

    public function register(array $input): void
    {
        $id = trim((string) ($input['id'] ?? ''));
        $nombre = trim((string) ($input['nombre'] ?? ''));
        $correo = trim((string) ($input['correo'] ?? ''));
        $usuario = trim((string) ($input['usuario'] ?? ''));
        $contrasena = (string) ($input['contrasena'] ?? '');

        if ($id === '' || $nombre === '' || $correo === '' || $usuario === '' || $contrasena === '') {
            throw new ValidationException('Por favor rellena todos los campos');
        }

        if (!preg_match('/^[0-9()+]{1,20}$/', $id)) {
            throw new ValidationException(
                'La identificación solo puede contener números y paréntesis, entre 1 y 20 caracteres'
            );
        }

        if (strlen($nombre) < 5) {
            throw new ValidationException('El nombre debe tener al menos 5 caracteres');
        }

        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $nombre)) {
            throw new ValidationException('El nombre solo puede contener letras y espacios');
        }

        if (str_word_count($nombre) < 2) {
            throw new ValidationException('Debes ingresar nombre y apellido');
        }

        if (strlen($contrasena) < 8) {
            throw new ValidationException('La contraseña debe tener mínimo 8 caracteres');
        }

        if (!preg_match('/[A-Z]/', $contrasena)) {
            throw new ValidationException('La contraseña debe tener al menos una letra mayúscula');
        }

        if (!preg_match('/[a-z]/', $contrasena)) {
            throw new ValidationException('La contraseña debe tener al menos una letra minúscula');
        }

        if (!preg_match('/[0-9]/', $contrasena)) {
            throw new ValidationException('La contraseña debe tener al menos un número');
        }

        if (!preg_match('/[\W_]/', $contrasena)) {
            throw new ValidationException('La contraseña debe tener al menos un carácter especial');
        }

        if ($this->users->existsByEmail($correo)) {
            throw new DuplicateUserException('Este correo ya está registrado');
        }

        if ($this->users->existsByUsername($usuario)) {
            throw new DuplicateUserException('Este usuario ya está registrado');
        }

        try {
            $this->users->create([
                'id' => $id,
                'nombre' => $nombre,
                'correo' => $correo,
                'usuario' => $usuario,
                'contrasena_hash' => password_hash($contrasena, PASSWORD_DEFAULT),
            ]);
        } catch (PDOException $e) {
            throw new AuthException('Error al registrar usuario', 0, $e);
        }
    }
}
