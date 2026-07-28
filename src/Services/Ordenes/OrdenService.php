<?php

namespace Plance\Services\Ordenes;

use Plance\Config\Env;
use Plance\Repositories\Contracts\OrdenRepositoryInterface;
use Plance\Services\Ordenes\Exceptions\GatewaySessionException;
use Plance\Services\Ordenes\Exceptions\ValidationException;
use Plance\Services\Payments\PlaceToPayClient;

class OrdenService
{
    public function __construct(
        private OrdenRepositoryInterface $ordenes,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input, string $usuarioCorreo = ''): array
    {
        $producto = trim((string) ($input['producto'] ?? ''));
        $precio = trim((string) ($input['precio'] ?? ''));
        $jugadorId = trim((string) ($input['jugador_id'] ?? ''));

        if ($producto === '' || $precio === '' || $jugadorId === '') {
            throw new ValidationException('❌ Faltan datos. Por favor vuelve y completa todos los campos.');
        }

        $orderId = $this->ordenes->create([
            'producto' => $producto,
            'precio' => $precio,
            'jugador_id' => $jugadorId,
            'correo' => $usuarioCorreo !== '' ? $usuarioCorreo : null,
            'estado' => 'pendiente',
        ]);

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');

        $body = [
            'payment' => [
                'reference' => 'ORD-' . str_pad((string) $orderId, 6, '0', STR_PAD_LEFT),
                'description' => substr(preg_replace('/[^a-zA-Z0-9 ]/u', '', $producto), 0, 80),
                'amount' => [
                    'currency' => 'COP',
                    'total' => (float) $precio,
                ],
            ],
            'expiration' => date('c', strtotime('+1 hour')),
            'returnUrl' => $baseUrl . '/retorno.php?order=' . $orderId,
            'notifyUrl' => Env::get('P2P_NOTIFY_URL', ''),
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->createSession($body, 'estandar');

        if (!isset($result['processUrl'])) {
            throw new GatewaySessionException($orderId, $result);
        }

        $requestId = (int) ($result['requestId'] ?? 0);
        $this->ordenes->updateRequestId($orderId, $requestId);

        return [
            'orderId' => $orderId,
            'requestId' => $requestId,
            'processUrl' => $result['processUrl'],
        ];
    }

    public function procesarRetorno(int $orderId, string $requestId): array
    {
        $result = $this->client->querySession($requestId, 'estandar');
        $statusP2p = $result['status']['status'] ?? 'UNKNOWN';

        $nuevoEstado = match ($statusP2p) {
            'APPROVED' => 'aprobada',
            'REJECTED' => 'rechazada',
            'PENDING' => 'pendiente',
            default => 'cancelada',
        };

        $this->ordenes->updateEstado($orderId, $nuevoEstado);

        return [
            'orderId' => $orderId,
            'statusP2p' => $statusP2p,
            'nuevoEstado' => $nuevoEstado,
            'orden' => $this->ordenes->findById($orderId),
        ];
    }
}
