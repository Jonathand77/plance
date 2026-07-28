<?php

namespace Plance\Services\Historial;

use Plance\Repositories\Contracts\ActualizaEstadoInterface;
use Plance\Repositories\DispersionRepository;
use Plance\Repositories\GatewayOrdenRepository;
use Plance\Repositories\GatewaySuscripcionRepository;
use Plance\Repositories\GatewaySuscriptionRepository;
use Plance\Repositories\OrdenRepository;
use Plance\Repositories\RecurrenciaRepository;
use Plance\Repositories\ReservacionRepository;
use Plance\Repositories\SuscripcionRepository;
use Plance\Repositories\SuscriptionRecRepository;
use Plance\Repositories\SuscriptionRepository;
use Plance\Services\Historial\Exceptions\ValidationException;
use Plance\Services\Payments\PlaceToPayClient;

class VerificarPagoService
{
    private const TABLAS_PERMITIDAS = [
        'ordenes', 'suscripciones', 'recurrencias', 'suscription_rec', 'suscription',
        'gateway_suscripciones', 'gateway_suscription', 'gateway_ordenes', 'dispersiones', 'reservaciones',
    ];

    public function __construct(private PlaceToPayClient $client = new PlaceToPayClient())
    {
    }

    public function verificar(string $tabla, int $id, string $requestId): string
    {
        if (!in_array($tabla, self::TABLAS_PERMITIDAS, true) || !$id || $requestId === '') {
            throw new ValidationException();
        }

        $tipo = match ($tabla) {
            'dispersiones' => 'dispersion',
            'reservaciones' => 'reservaciones',
            default => 'estandar',
        };

        $result = $this->client->querySession($requestId, $tipo);
        $statusP2p = $result['status']['status'] ?? 'UNKNOWN';

        $nuevoEstado = match ($statusP2p) {
            'APPROVED' => 'aprobada',
            'REJECTED' => 'rechazada',
            'PENDING' => 'pendiente',
            default => 'cancelada',
        };

        $this->repositorioPara($tabla)->updateEstado($id, $nuevoEstado);

        return $nuevoEstado;
    }

    private function repositorioPara(string $tabla): ActualizaEstadoInterface
    {
        return match ($tabla) {
            'ordenes' => new OrdenRepository(),
            'suscripciones' => new SuscripcionRepository(),
            'recurrencias' => new RecurrenciaRepository(),
            'suscription_rec' => new SuscriptionRecRepository(),
            'suscription' => new SuscriptionRepository(),
            'gateway_suscripciones' => new GatewaySuscripcionRepository(),
            'gateway_suscription' => new GatewaySuscriptionRepository(),
            'gateway_ordenes' => new GatewayOrdenRepository(),
            'dispersiones' => new DispersionRepository(),
            'reservaciones' => new ReservacionRepository(),
        };
    }
}
