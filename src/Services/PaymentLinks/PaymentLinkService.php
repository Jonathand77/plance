<?php

namespace Plance\Services\PaymentLinks;

use Plance\Config\Env;
use Plance\Repositories\Contracts\PaymentLinkRepositoryInterface;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Services\PaymentLinks\Exceptions\ValidationException;

class PaymentLinkService
{
    public function __construct(
        private PaymentLinkRepositoryInterface $links,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input): array
    {
        $producto = trim((string) ($input['producto'] ?? ''));
        $precio = trim((string) ($input['precio'] ?? ''));
        $correo = trim((string) ($input['correo'] ?? ''));
        $nombre = trim((string) ($input['nombre'] ?? ''));

        if ($producto === '' || $precio === '' || $correo === '') {
            throw new ValidationException('❌ Faltan datos.');
        }

        $referencia = 'PL-' . strtoupper(bin2hex(random_bytes(4)));
        $descripcion = 'Kit deportivo: ' . $producto;
        $expiracion = date('Y-m-d H:i:s', strtotime('+24 hours'));

        $body = [
            'locale' => 'es_CO',
            'name' => $producto,
            'description' => $descripcion,
            'reference' => $referencia,
            'paymentsAllowed' => 12,
            'expirationDate' => $expiracion,
            'paymentExpiration' => 15,
            'payment' => [
                'amount' => [
                    'currency' => 'COP',
                    'total' => (float) $precio,
                ],
            ],
            'paymentMethod' => ['pse', 'visa', 'mastercard'],
            'notifyUrl' => Env::get('P2P_NOTIFY_URL', ''),
            'receiverEmails' => [$correo],
        ];

        $result = $this->client->createPaymentLink($body, 'estandar');

        $linkUrl = $result['url'] ?? $result['link'] ?? $result['data']['url'] ?? '';
        $linkId = $result['id'] ?? $result['linkId'] ?? '';
        $status = $result['status']['status'] ?? ($linkUrl ? 'OK' : 'ERROR');
        $estadoDb = $linkUrl ? 'activo' : 'error';

        $registroId = $this->links->create([
            'producto' => $producto,
            'precio' => $precio,
            'link_id' => (string) $linkId,
            'link_url' => $linkUrl,
            'referencia' => $referencia,
            'descripcion' => $descripcion,
            'estado' => $estadoDb,
            'expiracion' => $expiracion,
            'correo' => $correo,
        ]);

        return [
            'registroId' => $registroId,
            'producto' => $producto,
            'precio' => $precio,
            'correo' => $correo,
            'nombre' => $nombre,
            'referencia' => $referencia,
            'linkUrl' => $linkUrl,
            'linkId' => $linkId,
            'expiracion' => $expiracion,
            'status' => $status,
            'raw' => $result,
        ];
    }
}
