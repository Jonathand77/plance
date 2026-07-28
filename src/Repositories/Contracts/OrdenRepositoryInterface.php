<?php

namespace Plance\Repositories\Contracts;

interface OrdenRepositoryInterface
{
    public function create(array $data): int;

    public function updateRequestId(int $id, int $requestId): void;

    public function updateEstado(int $id, string $estado): void;

    public function updateEstadoYMontoPagado(int $id, string $estado, ?float $montoPagado): void;

    public function findById(int $id): ?array;

    public function findByRequestId(int $requestId): ?array;

    public function findWcByCorreo(string $correo): array;

    public function findMixtoByCorreo(string $correo): array;

    public function findAprobadasByCorreo(string $correo): array;

    public function findByIdAprobadaYCorreo(int $id, string $correo): ?array;

    public function countByCorreo(string $correo): int;

    public function countByCorreoYEstado(string $correo, string $estado): int;

    public function actividadPorDiaByCorreo(string $correo, int $dias): array;
}
