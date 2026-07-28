<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\SuscripcionRepositoryInterface;
use PDO;

class SuscripcionRepository implements SuscripcionRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO suscripciones (request_id, token, plataforma, plan, precio, usuario_id, estado)
             VALUES ('', '', :plataforma, :plan, :precio, :usuario_id, :estado)"
        );

        $stmt->execute([
            'plataforma' => $data['plataforma'],
            'plan' => $data['plan'],
            'precio' => $data['precio'],
            'usuario_id' => $data['usuario_id'],
            'estado' => $data['estado'] ?? 'pendiente',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateRequestId(int $id, string $requestId): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscripciones SET request_id = :request_id WHERE id = :id');
        $stmt->execute(['request_id' => $requestId, 'id' => $id]);
    }

    public function updateEstadoYToken(int $id, string $estado, string $token): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscripciones SET estado = :estado, token = :token WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'token' => $token, 'id' => $id]);
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE suscripciones SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM suscripciones WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findAllByUsuarioId(string $usuarioId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM suscripciones WHERE usuario_id = :usuario_id ORDER BY created_at DESC'
        );
        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll();
    }

    public function findAprobadasByUsuarioId(string $usuarioId): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, CONCAT(plataforma, ' — ', plan) AS nombre, precio, usuario_id AS usuario,
                    created_at, estado, 'suscripcion' AS tipo
             FROM suscripciones WHERE estado = 'aprobada' AND usuario_id = :usuario_id
             ORDER BY created_at DESC"
        );
        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll();
    }

    public function findByIdAprobadaYUsuarioId(int $id, string $usuarioId): ?array
    {
        $stmt = $this->pdo->prepare(
            "SELECT *, 'suscripcion' AS tipo FROM suscripciones
             WHERE id = :id AND estado = 'aprobada' AND usuario_id = :usuario_id LIMIT 1"
        );
        $stmt->execute(['id' => $id, 'usuario_id' => $usuarioId]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function actividadPorDiaByUsuarioId(string $usuarioId, int $dias): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT DATE(created_at) AS dia, COUNT(*) AS cnt FROM suscripciones
             WHERE usuario_id = :usuario_id AND created_at >= DATE_SUB(NOW(), INTERVAL :dias DAY)
             GROUP BY dia'
        );
        $stmt->bindValue('usuario_id', $usuarioId);
        $stmt->bindValue('dias', $dias, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
