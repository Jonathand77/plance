<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\SuscriptionRepositoryInterface;
use PDO;

class SuscriptionRepository implements SuscriptionRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO suscription (servicio, plan, precio, usuario_id, estado, request_id, token)
             VALUES (:servicio, :plan, :precio, :usuario_id, :estado, \'\', \'\')'
        );

        $stmt->execute([
            'servicio' => $data['servicio'],
            'plan' => $data['plan'],
            'precio' => $data['precio'],
            'usuario_id' => $data['usuario_id'],
            'estado' => $data['estado'] ?? 'pendiente',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateRequestId(int $id, string $requestId): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscription SET request_id = :request_id WHERE id = :id');
        $stmt->execute(['request_id' => $requestId, 'id' => $id]);
    }

    public function updateEstadoYToken(int $id, string $estado, string $token): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscription SET estado = :estado, token = :token WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'token' => $token, 'id' => $id]);
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscription SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM suscription WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findByRequestId(string $requestId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM suscription WHERE request_id = :request_id LIMIT 1');
        $stmt->execute(['request_id' => $requestId]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findAllByUsuarioId(string $usuarioId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM suscription WHERE usuario_id = :usuario_id ORDER BY created_at DESC'
        );
        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll();
    }
}
