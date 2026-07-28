<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\OrdenRepositoryInterface;
use PDO;

class OrdenRepository implements OrdenRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO ordenes (request_id, producto, precio, jugador_id, correo, estado)
             VALUES (:request_id, :producto, :precio, :jugador_id, :correo, :estado)'
        );

        $stmt->execute([
            'request_id' => $data['request_id'] ?? 0,
            'producto' => $data['producto'],
            'precio' => $data['precio'],
            'jugador_id' => $data['jugador_id'],
            'correo' => $data['correo'] ?? null,
            'estado' => $data['estado'] ?? 'pendiente',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function findWcByCorreo(string $correo): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM ordenes
             WHERE correo = :correo AND monto_pagado IS NULL AND producto NOT LIKE '%+%'
             ORDER BY created_at DESC"
        );
        $stmt->execute(['correo' => $correo]);

        return $stmt->fetchAll();
    }

    public function findMixtoByCorreo(string $correo): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM ordenes
             WHERE correo = :correo AND (monto_pagado IS NOT NULL OR producto LIKE '%+%')
             ORDER BY created_at DESC"
        );
        $stmt->execute(['correo' => $correo]);

        return $stmt->fetchAll();
    }

    public function findAprobadasByCorreo(string $correo): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, producto AS nombre, precio, jugador_id AS usuario, created_at, estado, 'orden' AS tipo
             FROM ordenes WHERE estado = 'aprobada' AND correo = :correo
             ORDER BY created_at DESC"
        );
        $stmt->execute(['correo' => $correo]);

        return $stmt->fetchAll();
    }

    public function findByIdAprobadaYCorreo(int $id, string $correo): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *, 'orden' AS tipo FROM ordenes
             WHERE id = :id AND estado = 'aprobada' AND correo = :correo LIMIT 1"
        );
        $stmt->execute(['id' => $id, 'correo' => $correo]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function updateRequestId(int $id, int $requestId): void
    {
        $stmt = $this->pdo->prepare('UPDATE ordenes SET request_id = :request_id WHERE id = :id');
        $stmt->execute(['request_id' => $requestId, 'id' => $id]);
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE ordenes SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function updateEstadoYMontoPagado(int $id, string $estado, ?float $montoPagado): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE ordenes SET estado = :estado, monto_pagado = :monto_pagado WHERE id = :id'
        );
        $stmt->execute(['estado' => $estado, 'monto_pagado' => $montoPagado, 'id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM ordenes WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function countByCorreo(string $correo): int
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM ordenes WHERE correo = :correo');
        $stmt->execute(['correo' => $correo]);

        return (int) $stmt->fetchColumn();
    }

    public function countByCorreoYEstado(string $correo, string $estado): int
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM ordenes WHERE correo = :correo AND estado = :estado');
        $stmt->execute(['correo' => $correo, 'estado' => $estado]);

        return (int) $stmt->fetchColumn();
    }

    public function actividadPorDiaByCorreo(string $correo, int $dias): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT DATE(created_at) AS dia, COUNT(*) AS cnt FROM ordenes
             WHERE correo = :correo AND created_at >= DATE_SUB(NOW(), INTERVAL :dias DAY)
             GROUP BY dia'
        );
        $stmt->bindValue('correo', $correo);
        $stmt->bindValue('dias', $dias, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
