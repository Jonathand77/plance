<?php

namespace Plance\Services\Ordenes\Exceptions;

class GatewaySessionException extends \RuntimeException
{
    public function __construct(private int $orderId, private array $gatewayResult)
    {
        parent::__construct('No se pudo iniciar la sesión de pago con PlaceToPay.');
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getGatewayResult(): array
    {
        return $this->gatewayResult;
    }
}
