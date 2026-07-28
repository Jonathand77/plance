<?php

namespace Plance\Repositories\Contracts;

interface SuscriptionRecRepositoryInterface
{
    public function create(array $data): int;

    public function updateRequestId(int $id, string $requestId): void;

    public function updateEstadoYFechaFin(int $id, string $estado, ?string $fechaFin): void;

    public function findById(int $id): ?array;

    public function findByRequestId(string $requestId): ?array;

    public function findAllByUsuarioId(string $usuarioId): array;
}
