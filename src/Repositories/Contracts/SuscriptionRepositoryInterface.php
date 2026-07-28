<?php

namespace Plance\Repositories\Contracts;

interface SuscriptionRepositoryInterface
{
    public function create(array $data): int;

    public function updateRequestId(int $id, string $requestId): void;

    public function updateEstadoYToken(int $id, string $estado, string $token): void;

    public function updateEstado(int $id, string $estado): void;

    public function findById(int $id): ?array;

    public function findAllByUsuarioId(string $usuarioId): array;
}
