<?php

namespace Plance\Services\Suscripciones;

use Plance\Config\Env;
use Plance\Repositories\Contracts\SuscriptionRepositoryInterface;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Services\Suscripciones\Exceptions\SuscriptionNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;

class SuscriptionService
{
    public function __construct(
        private SuscriptionRepositoryInterface $suscriptions,
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
            throw new ValidationException('❌ Faltan datos.');
        }

        $subId = $this->suscriptions->create([
            'servicio' => $servicio,
            'plan' => $plan,
            'precio' => $precio,
            'usuario_id' => $usuarioId,
            'estado' => 'pendiente',
        ]);

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');
        $descripcion = substr(preg_replace('/[^a-zA-Z0-9 ]/u', '', $servicio . ' ' . $plan), 0, 80);

        $body = [
            'locale' => 'es_CO',
            'buyer' => ['email' => $usuarioId],
            'subscription' => [
                'reference' => 'SUB-' . $subId,
                'description' => $descripcion,
            ],
            'expiration' => date('c', strtotime('+30 minutes')),
            'returnUrl' => $baseUrl . '/retorno_suscription.php?sub=' . $subId,
            'notifyUrl' => Env::get('P2P_NOTIFY_URL', ''),
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->createSession($body, 'estandar');

        if (isset($result['processUrl'])) {
            $this->suscriptions->updateRequestId($subId, (string) ($result['requestId'] ?? ''));
        }

        return [
            'subId' => $subId,
            'processUrl' => $result['processUrl'] ?? null,
            'gatewayResult' => $result,
        ];
    }

    public function procesarRetorno(int $subId): array
    {
        $row = $this->suscriptions->findById($subId);

        if ($row === null || !($row['request_id'] ?? '')) {
            throw new SuscriptionNotFoundException();
        }

        $result = $this->client->querySession($row['request_id'], 'estandar');
        $statusP2p = $result['status']['status'] ?? 'UNKNOWN';

        $token = '';
        if (isset($result['subscription']['instrument']) && is_array($result['subscription']['instrument'])) {
            foreach ($result['subscription']['instrument'] as $item) {
                if (($item['keyword'] ?? '') === 'token') {
                    $token = $item['value'] ?? '';
                    break;
                }
            }
        }

        $nuevoEstado = match ($statusP2p) {
            'APPROVED' => 'aprobada',
            'REJECTED' => 'rechazada',
            'PENDING' => 'pendiente',
            default => 'cancelada',
        };

        $this->suscriptions->updateEstadoYToken($subId, $nuevoEstado, $token);

        return [
            'subId' => $subId,
            'statusP2p' => $statusP2p,
            'nuevoEstado' => $nuevoEstado,
            'token' => $token,
            'subs' => $row,
        ];
    }
}
