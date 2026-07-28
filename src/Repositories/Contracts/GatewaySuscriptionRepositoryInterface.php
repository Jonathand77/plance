<?php

namespace Plance\Repositories\Contracts;

interface GatewaySuscriptionRepositoryInterface
{
    public function create(array $data): int;

    public function updateEstado(int $id, string $estado): void;

    public function findAllByCorreo(string $correo): array;
}
