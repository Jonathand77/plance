<?php

namespace Plance\Repositories\Contracts;

interface PaymentLinkRepositoryInterface
{
    public function create(array $data): int;

    public function updateEstado(int $id, string $estado): void;

    public function findAllByCorreo(string $correo): array;

    public function findByReferencia(string $referencia): ?array;
}
