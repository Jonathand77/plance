<?php

namespace Plance\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function findByEmail(string $correo): ?array;

    public function findByUsername(string $usuario): ?array;

    public function findById(int $id): ?array;

    public function existsByEmail(string $correo): bool;

    public function existsByUsername(string $usuario): bool;

    public function create(array $data): bool;

    public function updateProfileImage(int $id, string $profileImage): void;

    public function updateUsuario(int $id, string $usuario): void;

    public function updateCorreo(int $id, string $correo): void;

    public function updateBio(int $id, string $bio): void;

    public function updateLocation(int $id, string $location): void;

    public function updateBioYLocation(int $id, string $bio, string $location): void;

    public function updatePassword(int $id, string $hash): void;

    public function existsByCorreoExcluyendoId(string $correo, int $excludeId): bool;

    public function existsByUsuarioExcluyendoId(string $usuario, int $excludeId): bool;
}
