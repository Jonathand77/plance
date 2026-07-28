<?php

namespace Plance\Repositories\Contracts;

interface SuscripcionRepositoryInterface
{
    public function create(array $data): int;

    public function updateRequestId(int $id, string $requestId): void;

    public function updateEstadoYToken(int $id, string $estado, string $token): void;

    public function updateEstado(int $id, string $estado): void;

    public function findById(int $id): ?array;

    public function findByRequestId(string $requestId): ?array;

    public function findAllByUsuarioId(string $usuarioId): array;

    public function findAprobadasByUsuarioId(string $usuarioId): array;

    public function findByIdAprobadaYUsuarioId(int $id, string $usuarioId): ?array;

    public function actividadPorDiaByUsuarioId(string $usuarioId, int $dias): array;
}
