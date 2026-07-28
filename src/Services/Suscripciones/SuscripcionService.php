<?php

namespace Plance\Services\Suscripciones;

use Plance\Config\Env;
use Plance\Repositories\Contracts\SuscripcionRepositoryInterface;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Services\Suscripciones\Exceptions\SuscripcionNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;

class SuscripcionService
{
    public function __construct(
        private SuscripcionRepositoryInterface $suscripciones,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input): array
    {
        $plataforma = trim((string) ($input['plataforma'] ?? ''));
        $plan = trim((string) ($input['plan'] ?? ''));
        $precio = trim((string) ($input['precio'] ?? ''));
        $usuarioId = trim((string) ($input['usuario_id'] ?? ''));

        if ($plataforma === '' || $plan === '' || $precio === '' || $usuarioId === '') {
            throw new ValidationException('❌ Faltan datos. Por favor vuelve y completa todos los campos.');
        }

        $subId = $this->suscripciones->create([
            'plataforma' => $plataforma,
            'plan' => $plan,
            'precio' => $precio,
            'usuario_id' => $usuarioId,
            'estado' => 'pendiente',
        ]);

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');
        $descripcion = substr(preg_replace('/[^a-zA-Z0-9 ]/u', '', $plataforma . ' ' . $plan), 0, 80);

        $body = [
            'locale' => 'es_CO',
            'buyer' => ['email' => $usuarioId],
            'payment' => [
                'reference' => 'SUB-' . $subId,
                'description' => $descripcion,
                'amount' => [
                    'currency' => 'COP',
                    'total' => (float) $precio,
                ],
                'subscribe' => true,
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'returnUrl' => $baseUrl . '/retorno_subs.php?sub=' . $subId,
            'notifyUrl' => Env::get('P2P_NOTIFY_URL', ''),
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->createSession($body, 'estandar');

        if (isset($result['processUrl'])) {
            $this->suscripciones->updateRequestId($subId, (string) ($result['requestId'] ?? ''));
        }

        return [
            'subId' => $subId,
            'processUrl' => $result['processUrl'] ?? null,
            'gatewayResult' => $result,
        ];
    }

    public function procesarRetorno(int $subId): array
    {
        $row = $this->suscripciones->findById($subId);

        if ($row === null) {
            throw new SuscripcionNotFoundException();
        }

        $requestId = $row['request_id'] ?? '';

        if (!$requestId) {
            throw new SuscripcionNotFoundException();
        }

        $result = $this->client->querySession($requestId, 'estandar');
        $statusP2p = $result['status']['status'] ?? 'UNKNOWN';

        $nuevoEstado = match ($statusP2p) {
            'APPROVED' => 'aprobada',
            'REJECTED' => 'rechazada',
            'PENDING' => 'pendiente',
            default => 'cancelada',
        };

        $token = $this->extraerTokenTresNiveles($result);

        $this->suscripciones->updateEstadoYToken($subId, $nuevoEstado, $token);

        return [
            'subId' => $subId,
            'statusP2p' => $statusP2p,
            'nuevoEstado' => $nuevoEstado,
            'token' => $token,
            'subs' => $row,
        ];
    }

    public function iniciarTokenizacion(int $subId): array
    {
        $row = $this->suscripciones->findById($subId);

        if ($row === null) {
            throw new SuscripcionNotFoundException();
        }

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');

        $body = [
            'locale' => 'es_CO',
            'buyer' => ['email' => $row['usuario_id']],
            'subscription' => [
                'reference' => 'TOKEN-SUB-' . $subId,
                'description' => 'Guardar tarjeta para ' . $row['plataforma'] . ' ' . $row['plan'],
            ],
            'expiration' => date('c', strtotime('+30 minutes')),
            'returnUrl' => $baseUrl . '/retorno_token.php?sub=' . $subId,
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->createSession($body, 'estandar');

        return [
            'subId' => $subId,
            'processUrl' => $result['processUrl'] ?? null,
            'requestId' => $result['requestId'] ?? '',
            'gatewayResult' => $result,
        ];
    }

    public function procesarRetornoTokenizacion(int $subId, string $requestId): array
    {
        $result = $this->client->querySession($requestId, 'estandar');
        $token = $this->extraerTokenUnNivel($result);

        if ($token !== '') {
            $this->suscripciones->updateEstadoYToken($subId, 'aprobada', $token);
        }

        return [
            'subId' => $subId,
            'token' => $token,
        ];
    }

    private function extraerTokenTresNiveles(array $result): string
    {
        $token = $this->buscarTokenEnLista($result['subscription']['instrument'] ?? null);

        if ($token === '') {
            $token = $this->buscarTokenEnLista($result['payment'][0]['subscription'] ?? null);
        }

        if ($token === '') {
            $token = $this->buscarTokenEnLista($result['payment'][0]['processorFields'] ?? null);
        }

        return $token;
    }

    private function extraerTokenUnNivel(array $result): string
    {
        return $this->buscarTokenEnLista($result['subscription']['instrument'] ?? null);
    }

    private function buscarTokenEnLista(mixed $lista): string
    {
        if (!is_array($lista)) {
            return '';
        }

        foreach ($lista as $item) {
            if (($item['keyword'] ?? '') === 'token') {
                return $item['value'] ?? '';
            }
        }

        return '';
    }
}
