<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\GatewayOrdenRepositoryInterface;
use PDO;

class GatewayOrdenRepository implements GatewayOrdenRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO gateway_ordenes
                (producto, precio, nombre, correo, telefono, tipo_doc, num_doc, estado, request_id)
             VALUES
                (:producto, :precio, :nombre, :correo, :telefono, :tipo_doc, :num_doc, :estado, :request_id)'
        );

        $stmt->execute([
            'producto' => $data['producto'],
            'precio' => $data['precio'],
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
            'tipo_doc' => $data['tipo_doc'],
            'num_doc' => $data['num_doc'],
            'estado' => $data['estado'],
            'request_id' => $data['request_id'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE gateway_ordenes SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findAllByCorreo(string $correo): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM gateway_ordenes WHERE correo = :correo ORDER BY created_at DESC'
        );
        $stmt->execute(['correo' => $correo]);

        return $stmt->fetchAll();
    }
}
