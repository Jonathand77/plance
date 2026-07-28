<?php

namespace Plance\Repositories\Contracts;

interface GatewaySuscripcionRepositoryInterface
{
    public function create(array $data): int;

    public function updateEstado(int $id, string $estado): void;

    public function findAllByCorreo(string $correo): array;
}
