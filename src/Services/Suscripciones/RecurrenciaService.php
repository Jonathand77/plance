<?php

namespace Plance\Services\Suscripciones;

use Plance\Config\Env;
use Plance\Repositories\Contracts\RecurrenciaRepositoryInterface;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Services\Suscripciones\Exceptions\RecurrenciaNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;

class RecurrenciaService
{
    public function __construct(
        private RecurrenciaRepositoryInterface $recurrencias,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input): array
    {
        $servicio = trim((string) ($input['servicio'] ?? ''));
        $plan = trim((string) ($input['plan'] ?? ''));
        $precio = trim((string) ($input['precio'] ?? ''));
        $usuarioId = trim((string) ($input['usuario_id'] ?? ''));

        if ($servicio === '' || $plan === '' || $precio === '' || $usuarioId === '') {
            throw new ValidationException('❌ Faltan datos. Por favor vuelve y completa todos los campos.');
        }

        $nextPayment = date('Y-m-d', strtotime('+1 month'));
        $fechaFin = date('Y-m-d', strtotime('+12 months'));

        $recId = $this->recurrencias->create([
            'servicio' => $servicio,
            'plan' => $plan,
            'precio' => $precio,
            'usuario_id' => $usuarioId,
            'estado' => 'pendiente',
            'periodicidad' => 'M',
            'next_payment' => $nextPayment,
            'fecha_fin' => $fechaFin,
        ]);

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');
        $descripcion = substr(preg_replace('/[^a-zA-Z0-9 ]/u', '', $servicio . ' ' . $plan), 0, 80);

        $body = [
            'locale' => 'es_CO',
            'buyer' => ['email' => $usuarioId],
            'payment' => [
                'reference' => 'REC-' . $recId,
                'description' => $descripcion,
                'amount' => [
                    'currency' => 'COP',
                    'total' => (float) $precio,
                ],
                'recurring' => [
                    'periodicity' => 'M',
                    'interval' => '1',
                    'nextPayment' => $nextPayment,
                    'maxPeriods' => 12,
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'returnUrl' => $baseUrl . '/retorno_rec.php?rec=' . $recId,
            'notifyUrl' => Env::get('P2P_NOTIFY_URL', ''),
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->createSession($body, 'estandar');

        if (isset($result['processUrl'])) {
            $this->recurrencias->updateRequestId($recId, (string) ($result['requestId'] ?? ''));
        }

        return [
            'recId' => $recId,
            'processUrl' => $result['processUrl'] ?? null,
            'gatewayResult' => $result,
        ];
    }

    public function procesarRetorno(int $recId): array
    {
        $row = $this->recurrencias->findById($recId);

        if ($row === null || !($row['request_id'] ?? '')) {
            throw new RecurrenciaNotFoundException();
        }

        $result = $this->client->querySession($row['request_id'], 'estandar');
        $statusP2p = $result['status']['status'] ?? 'UNKNOWN';

        $nuevoEstado = match ($statusP2p) {
            'APPROVED' => 'aprobada',
            'REJECTED' => 'rechazada',
            'PENDING' => 'pendiente',
            default => 'cancelada',
        };

        $fechaFin = null;
        if ($nuevoEstado === 'aprobada') {
            $fechaFin = date('Y-m-d', strtotime('+12 months'));
        }

        $this->recurrencias->updateEstadoYFechaFin($recId, $nuevoEstado, $fechaFin);

        return [
            'recId' => $recId,
            'statusP2p' => $statusP2p,
            'nuevoEstado' => $nuevoEstado,
            'rec' => $row,
        ];
    }
}
