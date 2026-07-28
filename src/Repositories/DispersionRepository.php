<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\DispersionRepositoryInterface;
use PDO;

class DispersionRepository implements DispersionRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO dispersiones
                (destino, descripcion, precio_total, precio_base, impuesto, moneda, usuario_id, estado, request_id)
             VALUES
                (:destino, :descripcion, :precio_total, :precio_base, :impuesto,
                 :moneda, :usuario_id, :estado, :request_id)'
        );

        $stmt->execute([
            'destino' => $data['destino'],
            'descripcion' => $data['descripcion'],
            'precio_total' => $data['precio_total'],
            'precio_base' => $data['precio_base'],
            'impuesto' => $data['impuesto'],
            'moneda' => $data['moneda'] ?? 'COP',
            'usuario_id' => $data['usuario_id'] ?? '',
            'estado' => $data['estado'] ?? 'pendiente',
            'request_id' => $data['request_id'] ?? '',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateRequestId(int $id, string $requestId): void
    {
        $stmt = $this->pdo->prepare('UPDATE dispersiones SET request_id = :request_id WHERE id = :id');
        $stmt->execute(['request_id' => $requestId, 'id' => $id]);
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE dispersiones SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM dispersiones WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findAllByUsuarioId(string $usuarioId): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM dispersiones WHERE usuario_id = :usuario_id ORDER BY created_at DESC'
        );
        $stmt->execute(['usuario_id' => $usuarioId]);

        return $stmt->fetchAll();
    }
}
