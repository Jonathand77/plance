<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\ReservacionRepositoryInterface;
use PDO;

class ReservacionRepository implements ReservacionRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO reservaciones (habitacion, descripcion, precio, moneda, usuario_id, estado, request_id)
             VALUES (:habitacion, :descripcion, :precio, :moneda, :usuario_id, :estado, :request_id)'
        );

        $stmt->execute([
            'habitacion' => $data['habitacion'],
            'descripcion' => $data['descripcion'],
            'precio' => $data['precio'],
            'moneda' => $data['moneda'] ?? 'COP',
            'usuario_id' => $data['usuario_id'] ?? '',
            'estado' => $data['estado'] ?? 'pendiente',
            'request_id' => $data['request_id'] ?? '',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateRequestId(int $id, string $requestId): void
    {
        $stmt = $this->pdo->prepare('UPDATE reservaciones SET request_id = :request_id WHERE id = :id');
        $stmt->execute(['request_id' => $requestId, 'id' => $id]);
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE reservaciones SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reservaciones WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findByRequestId(string $requestId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reservaciones WHERE request_id = :request_id LIMIT 1');
        $stmt->execute(['request_id' => $requestId]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findAllByUsuarioId(string $usuarioId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM reservaciones WHERE usuario_id = :usuario_id ORDER BY created_at DESC'
        );
        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll();
    }
}
