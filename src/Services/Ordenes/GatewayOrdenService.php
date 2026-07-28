<?php

namespace Plance\Services\Ordenes;

use PDOException;
use Plance\Repositories\Contracts\GatewayOrdenRepositoryInterface;
use Plance\Services\Ordenes\Exceptions\PersistenceException;
use Plance\Services\Ordenes\Exceptions\ValidationException;
use Plance\Services\Payments\PlaceToPayClient;

class GatewayOrdenService
{
    public function __construct(
        private GatewayOrdenRepositoryInterface $ordenes,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function procesar(array $input): array
    {
        $producto = trim((string) ($input['producto'] ?? ''));
        $precio = trim((string) ($input['precio'] ?? ''));
        $jugadorId = trim((string) ($input['jugador_id'] ?? ''));
        $metodo = trim((string) ($input['metodo'] ?? 'tarjeta'));
        $tipoDoc = trim((string) ($input['tipo_doc'] ?? ''));
        $numDoc = trim((string) ($input['num_doc'] ?? ''));
        $correo = trim((string) ($input['correo'] ?? ''));
        $telefono = trim((string) ($input['telefono'] ?? ''));
        $nombre = trim((string) ($input['card_name'] ?? $input['nombre'] ?? ''));

        if ($producto === '' || $precio === '' || $jugadorId === '') {
            throw new ValidationException('❌ Faltan datos principales.');
        }

        $reference = 'GW-BS-' . strtoupper(bin2hex(random_bytes(4)));

        $cardNumber = preg_replace('/\s/', '', $input['card_number'] ?? '');
        $cardExpiry = trim((string) ($input['card_expiry'] ?? '12/26'));
        $cardCvv = trim((string) ($input['card_cvv'] ?? ''));

        if ($metodo === 'tarjeta') {
            $instrument = [
                'card' => [
                    'number' => $cardNumber,
                    'expiration' => $cardExpiry,
                    'cvv' => $cardCvv,
                ],
            ];
        } else {
            $instrument = [
                'bank' => [
                    'code' => trim((string) ($input['cuenta_banco'] ?? 'BANCOLOMBIA')),
                    'account' => trim((string) ($input['num_cuenta'] ?? '')),
                ],
            ];
        }

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
                'description' => $producto,
                'amount' => [
                    'currency' => 'COP',
                    'total' => (float) $precio,
                ],
            ],
            'instrument' => $instrument,
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->processGateway($body, 'estandar');

        $gwReason = $result['status']['reason'] ?? '';
        $gwMessage = $result['status']['message'] ?? 'Sin respuesta del servidor';

        // Estado elegido por el usuario en estados-gateway.php (demo) tiene prioridad
        $estadoElegido = trim((string) ($input['estado_elegido'] ?? ''));

        if (in_array($estadoElegido, ['aprobada', 'pendiente', 'rechazada'], true)) {
            $nuevoEstado = $estadoElegido;
            $status = match ($nuevoEstado) {
                'aprobada' => 'APPROVED',
                'pendiente' => 'PENDING',
                default => 'REJECTED',
            };
            $gwStatus = $status;
        } else {
            $gwStatus = $result['status']['status'] ?? 'FAILED';
            $nuevoEstado = match ($gwStatus) {
                'APPROVED' => 'aprobada',
                'PENDING' => 'pendiente',
                default => 'rechazada',
            };
            $status = $gwStatus;
        }

        try {
            $ordenId = $this->ordenes->create([
                'producto' => $producto,
                'precio' => $precio,
                'nombre' => $nombre,
                'correo' => $correo,
                'telefono' => $telefono,
                'tipo_doc' => $tipoDoc,
                'num_doc' => $numDoc,
                'estado' => $nuevoEstado,
                'request_id' => $reference,
            ]);
        } catch (PDOException $e) {
            throw new PersistenceException('❌ Error al guardar: ' . $e->getMessage());
        }

        return [
            'ordenId' => $ordenId,
            'status' => $status,
            'estado' => $nuevoEstado,
            'producto' => $producto,
            'precio' => $precio,
            'correo' => $correo,
            'nombre' => $nombre,
            'message' => $gwMessage,
            'razon' => $gwReason,
            'gwStatus' => $gwStatus,
            'reference' => $reference,
            'metodo' => $metodo,
        ];
    }
}
