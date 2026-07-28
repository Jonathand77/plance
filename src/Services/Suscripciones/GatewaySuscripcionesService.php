<?php

namespace Plance\Services\Suscripciones;

use PDOException;
use Plance\Repositories\Contracts\GatewaySuscripcionRepositoryInterface;
use Plance\Services\Ordenes\Exceptions\PersistenceException;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Services\Suscripciones\Exceptions\ValidationException;

class GatewaySuscripcionesService
{
    public function __construct(
        private GatewaySuscripcionRepositoryInterface $suscripciones,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function procesar(array $input): array
    {
        $servicio = trim((string) ($input['servicio'] ?? ''));
        $plan = trim((string) ($input['plan'] ?? ''));
        $precio = trim((string) ($input['precio'] ?? ''));
        $nombre = trim((string) ($input['nombre'] ?? ''));
        $correo = trim((string) ($input['correo'] ?? ''));
        $telefono = trim((string) ($input['telefono'] ?? ''));
        $tipoDoc = trim((string) ($input['tipo_doc'] ?? ''));
        $numDoc = trim((string) ($input['num_doc'] ?? ''));

        if ($servicio === '' || $plan === '' || $precio === '' || $nombre === '' || $correo === '' || $numDoc === '') {
            throw new ValidationException('❌ Faltan datos. Por favor completa todos los campos.');
        }

        $reference = 'GWSUB-' . strtoupper(bin2hex(random_bytes(4)));

        $body = [
            'payer' => [
                'name' => $nombre,
                'surname' => '',
                'email' => $correo,
                'documentType' => $tipoDoc,
                'document' => $numDoc,
                'mobile' => $telefono,
            ],
            'payment' => [
                'reference' => $reference,
                'description' => $servicio . ' — ' . $plan,
                'amount' => [
                    'currency' => 'COP',
                    'total' => (float) $precio,
                ],
                'subscribe' => true,
            ],
            'instrument' => [
                'card' => [
                    'number' => preg_replace('/\s/', '', $input['card_number'] ?? ''),
                    'expiration' => trim((string) ($input['card_expiry'] ?? '12/26')),
                    'cvv' => trim((string) ($input['card_cvv'] ?? '')),
                ],
            ],
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->processGateway($body, 'estandar');

        $gwMessage = $result['status']['message'] ?? 'Sin respuesta del servidor';
        $gwToken = $result['subscription']['token']['token'] ?? '';

        $estadoElegido = trim((string) ($input['estado_elegido'] ?? ''));

        if (in_array($estadoElegido, ['aprobada-token', 'aprobada-sin', 'pendiente', 'rechazada'], true)) {
            $nuevoEstado = match ($estadoElegido) {
                'aprobada-token', 'aprobada-sin' => 'aprobada',
                'pendiente' => 'pendiente',
                default => 'rechazada',
            };
            $status = match ($nuevoEstado) {
                'aprobada' => 'APPROVED',
                'pendiente' => 'PENDING',
                default => 'REJECTED',
            };
            $conToken = ($estadoElegido === 'aprobada-token');
            $token = $conToken ? (!empty($gwToken) ? $gwToken : 'TOK-' . strtoupper(bin2hex(random_bytes(8)))) : '';
        } else {
            $gwStatus = $result['status']['status'] ?? 'FAILED';
            $nuevoEstado = match ($gwStatus) {
                'APPROVED' => 'aprobada',
                'PENDING' => 'pendiente',
                default => 'rechazada',
            };
            $status = $gwStatus;
            $token = !empty($gwToken) ? $gwToken : '';
        }

        try {
            $ordenId = $this->suscripciones->create([
                'servicio' => $servicio,
                'plan' => $plan,
                'precio' => $precio,
                'nombre' => $nombre,
                'correo' => $correo,
                'telefono' => $telefono,
                'tipo_doc' => $tipoDoc,
                'num_doc' => $numDoc,
                'estado' => $nuevoEstado,
                'request_id' => $reference,
                'token' => $token,
            ]);
        } catch (PDOException $e) {
            throw new PersistenceException('❌ Error al guardar: ' . $e->getMessage());
        }

        return [
            'ordenId' => $ordenId,
            'status' => $status,
            'estado' => $nuevoEstado,
            'servicio' => $servicio,
            'plan' => $plan,
            'precio' => $precio,
            'nombre' => $nombre,
            'correo' => $correo,
            'reference' => $reference,
            'token' => $token,
            'message' => $gwMessage,
        ];
    }
}
