<?php

namespace Plance\Services\Dispersiones;

use Plance\Config\Env;
use Plance\Repositories\Contracts\DispersionRepositoryInterface;
use Plance\Services\Dispersiones\Exceptions\DispersionNotFoundException;
use Plance\Services\Dispersiones\Exceptions\ValidationException;
use Plance\Services\Payments\PlaceToPayClient;

class DispersionService
{
    public function __construct(
        private DispersionRepositoryInterface $dispersiones,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input, string $usuarioCorreo): array
    {
        $destino = trim((string) ($input['destino'] ?? ''));
        $base = (float) ($input['base'] ?? 0);
        $impuesto = (float) ($input['impuesto'] ?? 0);
        $total = (float) ($input['total'] ?? 0);
        $nombre = trim((string) ($input['nombre'] ?? ''));
        $correo = trim((string) ($input['correo'] ?? ''));
        $telefono = trim((string) ($input['telefono'] ?? ''));
        $tipoDoc = trim((string) ($input['tipo_doc'] ?? ''));
        $numDoc = trim((string) ($input['num_doc'] ?? ''));

        if ($destino === '' || $total <= 0 || $nombre === '' || $correo === '') {
            throw new ValidationException('❌ Faltan datos principales.');
        }

        $reference = 'DISP-' . strtoupper(bin2hex(random_bytes(4)));
        $descripcion = 'Tiquete a ' . $destino;

        $dispersionId = $this->dispersiones->create([
            'destino' => $destino,
            'descripcion' => $descripcion,
            'precio_total' => $total,
            'precio_base' => $base,
            'impuesto' => $impuesto,
            'moneda' => 'COP',
            'usuario_id' => $usuarioCorreo,
            'estado' => 'pendiente',
            'request_id' => $reference,
        ]);

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');

        $body = [
            'payment' => [
                'reference' => $reference,
                'description' => $descripcion,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $total,
                ],
                'dispersion' => [
                    [
                        'agreement' => 1,
                        'agreementType' => 'AIRLINE',
                        'amount' => [
                            'currency' => 'COP',
                            'total' => $base,
                        ],
                    ],
                    [
                        'agreement' => 2,
                        'agreementType' => 'MERCHANT',
                        'amount' => [
                            'currency' => 'COP',
                            'total' => $impuesto,
                        ],
                    ],
                ],
            ],
            'buyer' => [
                'name' => $nombre,
                'surname' => '',
                'email' => $correo,
                'documentType' => $tipoDoc,
                'document' => $numDoc,
                'mobile' => $telefono,
            ],
            'expiration' => date('c', strtotime('+30 minutes')),
            'returnUrl' => $baseUrl . '/retorno_dispersion.php?disp_id=' . $dispersionId,
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
            'locale' => 'es_CO',
        ];

        $result = $this->client->createSession($body, 'dispersion');

        $status = $result['status']['status'] ?? 'FAILED';
        $processUrl = $result['processUrl'] ?? null;
        $requestId = $result['requestId'] ?? null;

        if ($requestId) {
            $this->dispersiones->updateRequestId($dispersionId, (string) $requestId);
        }

        return [
            'dispersionId' => $dispersionId,
            'status' => $status,
            'processUrl' => $processUrl,
        ];
    }

    public function procesarRetorno(int $dispersionId): array
    {
        $row = $this->dispersiones->findById($dispersionId);

        if ($row === null) {
            throw new DispersionNotFoundException();
        }

        $destino = $row['destino'];
        $total = (float) $row['precio_total'];
        $base = (float) $row['precio_base'];
        $impuesto = (float) $row['impuesto'];
        $requestId = $row['request_id'];

        $nuevoEstado = 'pendiente';
        $gwStatus = 'PENDING';

        if ($requestId) {
            $data = $this->client->querySession($requestId, 'dispersion');
            $gwStatus = $data['status']['status'] ?? 'PENDING';

            if (!empty($data['payment'])) {
                $gwStatus = $data['payment'][0]['status']['status'] ?? $gwStatus;
            }

            $nuevoEstado = match ($gwStatus) {
                'APPROVED' => 'aprobada',
                'PENDING' => 'pendiente',
                default => 'rechazada',
            };

            $this->dispersiones->updateEstado($dispersionId, $nuevoEstado);
        }

        return [
            'dispersionId' => $dispersionId,
            'destino' => $destino,
            'total' => $total,
            'base' => $base,
            'impuesto' => $impuesto,
            'requestId' => $requestId,
            'gwStatus' => $gwStatus,
            'nuevoEstado' => $nuevoEstado,
        ];
    }
}
