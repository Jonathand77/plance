<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\UserRepositoryInterface;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function findByEmail(string $correo): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE correo = :correo LIMIT 1');
        $stmt->execute(['correo' => $correo]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findByUsername(string $usuario): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE usuario = :usuario LIMIT 1');
        $stmt->execute(['usuario' => $usuario]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
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
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (id, nombre, correo, usuario, contraseña, profile_image, location, bio)
             VALUES (:id, :nombre, :correo, :usuario, :contrasena, :profile_image, :location, :bio)'
        );

        return $stmt->execute([
            'id' => $data['id'],
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'usuario' => $data['usuario'],
            'contrasena' => $data['contrasena_hash'],
            'profile_image' => $data['profile_image'] ?? 'assets/img/default.png',
            'location' => $data['location'] ?? 'No especificada',
            'bio' => $data['bio'] ?? '',
        ]);
    }

    public function updateProfileImage(int $id, string $profileImage): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET profile_image = :profile_image WHERE id = :id');
        $stmt->execute(['profile_image' => $profileImage, 'id' => $id]);
    }

    public function updateUsuario(int $id, string $usuario): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET usuario = :usuario WHERE id = :id');
        $stmt->execute(['usuario' => $usuario, 'id' => $id]);
    }

    public function updateCorreo(int $id, string $correo): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET correo = :correo WHERE id = :id');
        $stmt->execute(['correo' => $correo, 'id' => $id]);
    }

    public function updateBio(int $id, string $bio): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET bio = :bio WHERE id = :id');
        $stmt->execute(['bio' => $bio, 'id' => $id]);
    }

    public function updateLocation(int $id, string $location): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET location = :location WHERE id = :id');
        $stmt->execute(['location' => $location, 'id' => $id]);
    }

    public function updateBioYLocation(int $id, string $bio, string $location): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET bio = :bio, location = :location WHERE id = :id');
        $stmt->execute(['bio' => $bio, 'location' => $location, 'id' => $id]);
    }

    public function updatePassword(int $id, string $hash): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET contraseña = :contrasena WHERE id = :id');
        $stmt->execute(['contrasena' => $hash, 'id' => $id]);
    }

    public function existsByCorreoExcluyendoId(string $correo, int $excludeId): bool
    {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE correo = :correo AND id != :id LIMIT 1');
        $stmt->execute(['correo' => $correo, 'id' => $excludeId]);

        return $stmt->fetch() !== false;
    }

    public function existsByUsuarioExcluyendoId(string $usuario, int $excludeId): bool
    {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE usuario = :usuario AND id != :id LIMIT 1');
        $stmt->execute(['usuario' => $usuario, 'id' => $excludeId]);

        return $stmt->fetch() !== false;
    }
}
