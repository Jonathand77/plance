<?php

namespace Plance\Services\Ordenes;

use Plance\Config\Env;
use Plance\Repositories\Contracts\OrdenRepositoryInterface;
use Plance\Services\Ordenes\Exceptions\ValidationException;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Support\EstadoMapper;

class PagoMixtoService
{
    public function __construct(
        private OrdenRepositoryInterface $ordenes,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input, string $usuarioCorreo = ''): array
    {
        $jugadorId = trim((string) ($input['jugador_id'] ?? ''));
        $productos = trim((string) ($input['productos'] ?? ''));
        $total = (float) ($input['total'] ?? 0);
        $montoParcial = (float) ($input['monto_parcial'] ?? $total);
        $allowPartial = ($input['allow_partial'] ?? '0') === '1';

        if ($jugadorId === '' || $productos === '' || $total <= 0) {
            throw new ValidationException('❌ Faltan datos principales.');
        }

        $reference = 'MIX-' . strtoupper(bin2hex(random_bytes(4)));
        $montoACobrar = $allowPartial ? $montoParcial : $total;
        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');

        $body = [
            'payment' => [
                'reference' => $reference,
                'description' => $productos,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $montoACobrar,
                ],
                'allowPartial' => $allowPartial,
            ],
            'expiration' => date('c', strtotime('+30 minutes')),
            'returnUrl' => $baseUrl . '/retorno_mixto.php',
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
            'locale' => 'es_CO',
        ];

        $result = $this->client->createSession($body, 'estandar');

        $status = $result['status']['status'] ?? 'FAILED';
        $message = $result['status']['message'] ?? 'Sin respuesta';
        $requestId = $result['requestId'] ?? null;
        $processUrl = $result['processUrl'] ?? null;

        $estadoDb = ($status === 'OK') ? 'pendiente' : 'rechazada';

        $ordenId = $this->ordenes->create([
            'request_id' => (int) ($requestId ?? 0),
            'producto' => $productos,
            'precio' => $total,
            'jugador_id' => $jugadorId,
            'correo' => $usuarioCorreo !== '' ? $usuarioCorreo : null,
            'estado' => $estadoDb,
        ]);

        return [
            'ordenId' => $ordenId,
            'productos' => $productos,
            'total' => $total,
            'montoParcial' => $montoParcial,
            'allowPartial' => $allowPartial,
            'reference' => $reference,
            'requestId' => $requestId,
            'processUrl' => $processUrl,
            'status' => $status,
            'message' => $message,
        ];
    }

    public function continuar(int $ordenId): array
    {
        $row = $this->ordenes->findById($ordenId);

        if ($row === null) {
            throw new ValidationException('Orden no encontrada.');
        }

        $total = (float) $row['precio'];
        $montoPagado = (float) $row['monto_pagado'];
        $saldoRest = $total - $montoPagado;

        if ($saldoRest <= 0) {
            throw new ValidationException('La orden ya no tiene saldo pendiente.');
        }

        $reference = 'MIX-CONT-' . strtoupper(bin2hex(random_bytes(4)));
        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');

        $body = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Saldo restante: ' . $row['producto'],
                'amount' => [
                    'currency' => 'COP',
                    'total' => $saldoRest,
                ],
            ],
            'expiration' => date('c', strtotime('+30 minutes')),
            'returnUrl' => $baseUrl . '/retorno_continuar.php?orden_id=' . $ordenId,
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
            'locale' => 'es_CO',
        ];

        $result = $this->client->createSession($body, 'estandar');

        $status = $result['status']['status'] ?? 'FAILED';
        $processUrl = $result['processUrl'] ?? null;
        $requestId = $result['requestId'] ?? null;

        return [
            'ordenId' => $ordenId,
            'productos' => $row['producto'],
            'total' => $total,
            'montoPagado' => $montoPagado,
            'saldoRest' => $saldoRest,
            'reference' => $reference,
            'requestId' => $requestId,
            'processUrl' => $processUrl,
            'status' => $status,
        ];
    }

    public function procesarContinuarRetorno(array $data, ?int $fallbackOrdenId): array
    {
        $ordenId = (int) ($data['orden_id'] ?? $fallbackOrdenId ?? 0);

        if ($ordenId === 0) {
            throw new ValidationException('Orden no especificada.');
        }

        $row = $this->ordenes->findById($ordenId);

        if ($row === null) {
            throw new ValidationException('Orden no encontrada.');
        }

        $total = (float) $row['precio'];
        $montoPrevio = (float) $row['monto_pagado'];
        $saldoRest = $total - $montoPrevio;
        $requestId = $data['requestId'] ?? null;

        $nuevoEstado = 'pendiente';
        $montoAhora = $saldoRest;
        $montoFinal = $montoPrevio;
        $saldoFinal = $saldoRest;

        if ($requestId) {
            $gwData = $this->client->querySession($requestId, 'estandar');
            $gwStatus = $gwData['status']['status'] ?? 'PENDING';

            if (!empty($gwData['payment'])) {
                $pago = $gwData['payment'][0] ?? [];
                $montoAhora = (float) ($pago['amount']['from']['total'] ?? $saldoRest);
                $gwStatus = $pago['status']['status'] ?? $gwStatus;
            }

            $nuevoEstado = EstadoMapper::fromGateway($gwStatus);

            if ($nuevoEstado === 'aprobada') {
                $montoFinal = $montoPrevio + $montoAhora;
                $saldoFinal = $total - $montoFinal;
                $estadoOrden = $saldoFinal <= 0 ? 'aprobada' : 'pendiente';
                $this->ordenes->updateEstadoYMontoPagado($ordenId, $estadoOrden, $montoFinal);
            }
        }

        return [
            'ordenId' => $ordenId,
            'row' => $row,
            'total' => $total,
            'montoPrevio' => $montoPrevio,
            'saldoFinal' => $saldoFinal,
            'montoAhora' => $montoAhora,
            'nuevoEstado' => $nuevoEstado,
        ];
    }

    public function procesarRetorno(array $mix): array
    {
        $ordenId = (int) ($mix['orden_id'] ?? 0);
        $productos = $mix['productos'] ?? '';
        $total = (float) ($mix['total'] ?? 0);
        $montoParcial = $mix['monto_parcial'] ?? $total;
        $allowPartial = $mix['allow_partial'] ?? false;
        $reference = $mix['reference'] ?? '';
        $requestId = $mix['requestId'] ?? null;

        $nuevoEstado = 'pendiente';
        $estadoFinal = 'PENDING';
        $montoPagado = null;

        if ($requestId) {
            $data = $this->client->querySession($requestId, 'estandar');
            $estadoFinal = $data['status']['status'] ?? 'PENDING';

            if (!empty($data['payment'])) {
                $pago = $data['payment'][0] ?? [];
                $montoPagado = $pago['amount']['from']['total'] ?? $montoParcial;
                $estadoFinal = $pago['status']['status'] ?? $estadoFinal;
            }

            $nuevoEstado = match ($estadoFinal) {
                'APPROVED' => 'aprobada',
                'PENDING' => 'pendiente',
                default => 'rechazada',
            };

            $this->ordenes->updateEstadoYMontoPagado(
                $ordenId,
                $nuevoEstado,
                $montoPagado ? (float) $montoPagado : null
            );
        }

        return [
            'ordenId' => $ordenId,
            'productos' => $productos,
            'total' => $total,
            'montoParcial' => $montoParcial,
            'allowPartial' => $allowPartial,
            'reference' => $reference,
            'nuevoEstado' => $nuevoEstado,
            'estadoFinal' => $estadoFinal,
            'montoPagado' => $montoPagado,
        ];
    }
}
