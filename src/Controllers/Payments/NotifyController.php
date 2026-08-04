<?php

namespace Plance\Controllers\Payments;

use Plance\Services\Payments\Exceptions\InvalidPayloadException;
use Plance\Services\Payments\NotifyService;

class NotifyController
{
    public function __construct(private NotifyService $service = new NotifyService())
    {
    }

    /**
     * @param array<string, string> $headers
     * @return array{status: int, body: string}
     */
    public function handle(string $method, string $rawBody, array $headers): array
    {
        if (in_array($method, ['GET', 'HEAD'], true)) {
            return ['status' => 200, 'body' => json_encode(['status' => 'OK', 'message' => 'Endpoint de notificaciones activo'])];
        }

        if ($method !== 'POST') {
            return ['status' => 405, 'body' => 'Método no permitido'];
        }

        $data = json_decode($rawBody, true);

        if (empty($data) || !is_array($data)) {
            return ['status' => 400, 'body' => 'Sin datos'];
        }

        $signature = $headers['X-Signature'] ?? $headers['x-signature'] ?? '';

        if (($data['type'] ?? '') === 'chargeback.created') {
            if ($signature === '' || !$this->service->validarFirmaChargeback($signature, $rawBody)) {
                return ['status' => 403, 'body' => 'Firma inválida'];
            }

            error_log('notify.php: chargeback recibido');

            return ['status' => 200, 'body' => json_encode(['status' => 'OK'])];
        }

        if ($signature === '') {
            return ['status' => 401, 'body' => 'Sin firma'];
        }

        if (!$this->service->validarFirma($signature, $data)) {
            return ['status' => 403, 'body' => 'Firma inválida'];
        }

        try {
            $this->service->procesar($data);
        } catch (InvalidPayloadException $e) {
            return ['status' => 400, 'body' => $e->getMessage()];
        } catch (\Throwable $e) {
            error_log('notify.php: ' . $e->getMessage());

            return ['status' => 500, 'body' => 'Error interno'];
        }

        return ['status' => 200, 'body' => json_encode(['status' => 'OK'])];
    }
}
