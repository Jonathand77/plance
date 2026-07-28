<?php

namespace Plance\Repositories\Contracts;

interface PaymentLinkRepositoryInterface
{
    public function create(array $data): int;

    public function findAllByCorreo(string $correo): array;
}
