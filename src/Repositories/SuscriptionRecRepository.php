<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\SuscriptionRecRepositoryInterface;
use PDO;

class SuscriptionRecRepository implements SuscriptionRecRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO suscription_rec
                (servicio, plan, precio, usuario_id, estado, periodicidad, next_payment, fecha_fin, request_id)
             VALUES
                (:servicio, :plan, :precio, :usuario_id, :estado, :periodicidad, :next_payment, :fecha_fin, '')"
        );

        $stmt->execute([
            'servicio' => $data['servicio'],
            'plan' => $data['plan'],
            'precio' => $data['precio'],
            'usuario_id' => $data['usuario_id'],
            'estado' => $data['estado'] ?? 'pendiente',
            'periodicidad' => $data['periodicidad'] ?? 'M',
            'next_payment' => $data['next_payment'],
            'fecha_fin' => $data['fecha_fin'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateRequestId(int $id, string $requestId): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscription_rec SET request_id = :request_id WHERE id = :id');
        $stmt->execute(['request_id' => $requestId, 'id' => $id]);
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscription_rec SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function updateEstadoYFechaFin(int $id, string $estado, ?string $fechaFin): void
    {
        if ($fechaFin === null) {
            $stmt = $this->pdo->prepare('UPDATE suscription_rec SET estado = :estado WHERE id = :id');
            $stmt->execute(['estado' => $estado, 'id' => $id]);

            return;
        }

        $stmt = $this->pdo->prepare(
            'UPDATE suscription_rec SET estado = :estado, fecha_fin = :fecha_fin WHERE id = :id'
        );
        $stmt->execute(['estado' => $estado, 'fecha_fin' => $fechaFin, 'id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM suscription_rec WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findAllByUsuarioId(string $usuarioId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM suscription_rec WHERE usuario_id = :usuario_id ORDER BY created_at DESC'
        );
        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll();
    }
}
