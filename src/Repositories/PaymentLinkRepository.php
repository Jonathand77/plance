<?php

namespace Plance\Repositories;

use Plance\Config\Database;
use Plance\Repositories\Contracts\PaymentLinkRepositoryInterface;
use PDO;

class PaymentLinkRepository implements PaymentLinkRepositoryInterface
{
    private PDO $pdo;

    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? Database::pdo();
    }

    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO payment_link
                (producto, precio, link_id, link_url, referencia, descripcion, estado, expiracion, correo)
             VALUES
                (:producto, :precio, :link_id, :link_url, :referencia, :descripcion, :estado, :expiracion, :correo)'
        );

        $stmt->execute([
            'producto' => $data['producto'],
            'precio' => $data['precio'],
            'link_id' => $data['link_id'],
            'link_url' => $data['link_url'],
            'referencia' => $data['referencia'],
            'descripcion' => $data['descripcion'],
            'estado' => $data['estado'],
            'expiracion' => $data['expiracion'],
            'correo' => $data['correo'],
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function updateEstado(int $id, string $estado): void
    {
        $stmt = $this->pdo->prepare('UPDATE payment_link SET estado = :estado WHERE id = :id');
        $stmt->execute(['estado' => $estado, 'id' => $id]);
    }

    public function findAllByCorreo(string $correo): array
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM payment_link WHERE correo = :correo ORDER BY created_at DESC'
        );
        $stmt->execute(['correo' => $correo]);

        return $stmt->fetchAll();
    }

    public function findByReferencia(string $referencia): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM payment_link WHERE referencia = :referencia LIMIT 1');
        $stmt->execute(['referencia' => $referencia]);
        $row = $stmt->fetch();

        return $row === false ? null : $row;
    }
}
