<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\Contracts\GatewaySuscripcionRepositoryInterface;
use PDO;

class GatewaySuscripcionRepository implements GatewaySuscripcionRepositoryInterface, ActualizaEstadoInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO gateway_suscripciones
                (servicio, plan, precio, nombre, correo, telefono, tipo_doc, num_doc, estado, request_id, token)
             VALUES
                (:servicio, :plan, :precio, :nombre, :correo, :telefono, :tipo_doc, :num_doc,
                 :estado, :request_id, :token)'
        );

        $stmt->execute([
            'servicio' => $data['servicio'],
            'plan' => $data['plan'],
            'precio' => $data['precio'],
            'nombre' => $data['nombre'],
            'correo' => $data['correo'],
            'telefono' => $data['telefono'],
            'tipo_doc' => $data['tipo_doc'],
            'num_doc' => $data['num_doc'],
            'estado' => $data['estado'],
            'request_id' => $data['request_id'],
            'token' => $data['token'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE gateway_suscripciones SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findByRequestId(string $requestId): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM gateway_suscripciones WHERE request_id = :request_id LIMIT 1');
        $stmt->execute(['request_id' => $requestId]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }

    public function findAllByCorreo(string $correo): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM gateway_suscripciones WHERE correo = :correo ORDER BY created_at DESC'
        );
        $stmt->execute(['correo' => $correo]);

        return $stmt->fetchAll();
    }
}
