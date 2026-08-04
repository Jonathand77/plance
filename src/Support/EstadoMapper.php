<?php

namespace Plance\Support;

/**
 * Centraliza el mapeo de estados de PlaceToPay a los estados persistidos en BD.
 * Existen dos variantes en uso a lo largo del proyecto, según el tipo de API:
 * Web Checkout (fromCheckout) y API Gateway (fromGateway) difieren en cómo
 * tratan REJECTED/CANCELED y en su valor por defecto.
 */
class EstadoMapper
{
    public static function fromCheckout(string $status): string
    {
        return match ($status) {
            'APPROVED', 'APPROVED_PARTIAL' => 'aprobada',
            'REJECTED' => 'rechazada',
            'PENDING' => 'pendiente',
            default => 'cancelada',
        };
    }

    public static function fromGateway(string $status): string
    {
        return match ($status) {
            'APPROVED', 'APPROVED_PARTIAL' => 'aprobada',
            'PENDING' => 'pendiente',
            default => 'rechazada',
        };
    }
}
