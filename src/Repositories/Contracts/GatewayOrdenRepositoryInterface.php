<?php

namespace Plance\Repositories\Contracts;

interface GatewayOrdenRepositoryInterface
{
    public function create(array $data): int;

    public function updateEstado(int $id, string $estado): void;

    public function findByRequestId(string $requestId): ?array;

    public function findAllByCorreo(string $correo): array;
}
