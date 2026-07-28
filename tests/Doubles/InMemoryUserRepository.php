<?php

namespace Plance\Tests\Doubles;

use Plance\Repositories\Contracts\UserRepositoryInterface;

final class InMemoryUserRepository implements UserRepositoryInterface
{
    private array $usersById = [];

    public function findByEmail(string $correo): ?array
    {
        foreach ($this->usersById as $user) {
            if ($user['correo'] === $correo) {
                return $user;
            }
        }

        return null;
    }

    public function findByUsername(string $usuario): ?array
    {
        foreach ($this->usersById as $user) {
            if ($user['usuario'] === $usuario) {
                return $user;
            }
        }

        return null;
    }

    public function findById(int $id): ?array
    {
        return $this->usersById[$id] ?? null;
    }

    public function existsByEmail(string $correo): bool
    {
        return $this->findByEmail($correo) !== null;
    }

    public function existsByUsername(string $usuario): bool
    {
        return $this->findByUsername($usuario) !== null;
    }

    public function create(array $data): bool
    {
        $this->usersById[$data['id']] = [
            'id' => $data['id'],
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'usuario' => $data['usuario'],
            'contraseña' => $data['contrasena_hash'],
        ];

        return true;
    }

    public function updateProfileImage(int $id, string $profileImage): void
    {
        $this->usersById[$id]['profile_image'] = $profileImage;
    }

    public function updateUsuario(int $id, string $usuario): void
    {
        $this->usersById[$id]['usuario'] = $usuario;
    }

    public function updateCorreo(int $id, string $correo): void
    {
        $this->usersById[$id]['correo'] = $correo;
    }

    public function updateBio(int $id, string $bio): void
    {
        $this->usersById[$id]['bio'] = $bio;
    }

    public function updateLocation(int $id, string $location): void
    {
        $this->usersById[$id]['location'] = $location;
    }

    public function updateBioYLocation(int $id, string $bio, string $location): void
    {
        $this->usersById[$id]['bio'] = $bio;
        $this->usersById[$id]['location'] = $location;
    }

    public function updatePassword(int $id, string $hash): void
    {
        $this->usersById[$id]['contraseña'] = $hash;
    }

    public function existsByCorreoExcluyendoId(string $correo, int $excludeId): bool
    {
        foreach ($this->usersById as $user) {
            if ($user['correo'] === $correo && $user['id'] !== $excludeId) {
                return true;
            }
        }

        return false;
    }

    public function existsByUsuarioExcluyendoId(string $usuario, int $excludeId): bool
    {
        foreach ($this->usersById as $user) {
            if ($user['usuario'] === $usuario && $user['id'] !== $excludeId) {
                return true;
            }
        }

        return false;
    }
}
