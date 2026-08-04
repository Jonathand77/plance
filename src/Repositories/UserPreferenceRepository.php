<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use PDO;

class UserPreferenceRepository
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function obtenerTema(string $correo): ?string
    {
        $stmt = $this->pdo->prepare(
            'SELECT tema FROM user_preferences WHERE usuario_correo = :correo LIMIT 1'
        );
        $stmt->execute(['correo' => $correo]);
        $row = $stmt->fetch();

        return $row === false ? null : $row['tema'];
    }

    public function guardarTema(string $correo, string $tema): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO user_preferences (usuario_correo, tema) VALUES (:correo, :tema)
             ON DUPLICATE KEY UPDATE tema = VALUES(tema)'
        );
        $stmt->execute(['correo' => $correo, 'tema' => $tema]);
    }
}
