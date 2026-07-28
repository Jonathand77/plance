<?php

namespace Plance\Services\Reservaciones;

use Plance\Config\Env;
use Plance\Repositories\Contracts\ReservacionRepositoryInterface;
use Plance\Services\Payments\PlaceToPayClient;
use Plance\Services\Reservaciones\Exceptions\ReservacionNotFoundException;
use Plance\Services\Reservaciones\Exceptions\ValidationException;

class PreauthorizationService
{
    public function __construct(
        private ReservacionRepositoryInterface $reservaciones,
        private PlaceToPayClient $client = new PlaceToPayClient()
    ) {
    }

    public function crear(array $input, string $usuarioCorreo): array
    {
        $habitacion = trim((string) ($input['habitacion'] ?? ''));
        $precio = (float) ($input['precio'] ?? 0);
        $total = (float) ($input['total'] ?? 0);
        $noches = (int) ($input['noches'] ?? 1);
        $checkin = trim((string) ($input['checkin'] ?? ''));
        $checkout = trim((string) ($input['checkout'] ?? ''));
        $nombre = trim((string) ($input['nombre'] ?? ''));
        $correo = trim((string) ($input['correo'] ?? ''));
        $telefono = trim((string) ($input['telefono'] ?? ''));
        $tipoDoc = trim((string) ($input['tipo_doc'] ?? ''));
        $numDoc = trim((string) ($input['num_doc'] ?? ''));

        $faltanDatos = $habitacion === '' || $total <= 0 || $checkin === '' || $checkout === ''
            || $nombre === '' || $correo === '';

        if ($faltanDatos) {
            throw new ValidationException('❌ Faltan datos. Por favor completa todos los campos.');
        }

        $reference = 'PRE-' . strtoupper(bin2hex(random_bytes(4)));
        $descripcion = "{$habitacion} (checkin: {$checkin} al {$checkout})";

        $reservaId = $this->reservaciones->create([
            'habitacion' => $habitacion,
            'descripcion' => $descripcion,
            'precio' => $total,
            'moneda' => 'COP',
            'usuario_id' => $usuarioCorreo,
            'estado' => 'pendiente',
            'request_id' => $reference,
        ]);

        $baseUrl = Env::get('APP_BASE_URL', 'http://localhost/plance');

        $body = [
            'locale' => 'es_CO',
            'type' => 'checkin',
            'payment' => [
                'reference' => $reference,
                'description' => 'Reserva ' . $habitacion . ' - ' . $noches . ' noches',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $total,
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
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => $baseUrl . '/retorno_preautorizacion.php?reserva_id=' . $reservaId,
            'ipAddress' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
            'userAgent' => $_SERVER['HTTP_USER_AGENT'] ?? 'PlanceDemoAgent/1.0',
        ];

        $result = $this->client->createSession($body, 'reservaciones');

        $status = $result['status']['status'] ?? 'FAILED';
        $requestId = $result['requestId'] ?? null;
        $processUrl = $result['processUrl'] ?? null;

        if ($requestId) {
            $this->reservaciones->updateRequestId($reservaId, (string) $requestId);
        }

        return [
            'reservaId' => $reservaId,
            'habitacion' => $habitacion,
            'total' => $total,
            'noches' => $noches,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'nombre' => $nombre,
            'correo' => $correo,
            'reference' => $reference,
            'requestId' => $requestId,
            'processUrl' => $processUrl,
            'status' => $status,
        ];
    }

    public function procesarRetorno(int $reservaId, string $nombreSesion = ''): array
    {
        $row = $this->reservaciones->findById($reservaId);

        if ($row === null) {
            throw new ReservacionNotFoundException();
        }

        $habitacion = $row['habitacion'];
        $total = (float) $row['precio'];
        $correo = $row['usuario_id'];
        $requestId = $row['request_id'];

        $descripcion = $row['descripcion'];
        preg_match('/checkin: (.+) al (.+)\)/', $descripcion, $matches);
        $checkin = $matches[1] ?? '';
        $checkout = $matches[2] ?? '';
        $noches = $checkin && $checkout ? (int) ((strtotime($checkout) - strtotime($checkin)) / 86400) : 1;

        $nuevoEstado = 'pendiente';
        $gwStatus = 'PENDING';
        $gwReason = '';

        if ($requestId) {
            $data = $this->client->querySession($requestId, 'reservaciones');
            $gwStatus = $data['status']['status'] ?? 'PENDING';
            $gwReason = $data['status']['reason'] ?? '';

            if (!empty($data['payment'])) {
                $gwStatus = $data['payment'][0]['status']['status'] ?? $gwStatus;
                $gwReason = $data['payment'][0]['status']['reason'] ?? $gwReason;
            }

            $nuevoEstado = match ($gwStatus) {
                'APPROVED' => 'aprobada',
                'PENDING' => 'pendiente',
                default => 'rechazada',
            };

            $this->reservaciones->updateEstado($reservaId, $nuevoEstado);
        }

        return [
            'reservaId' => $reservaId,
            'habitacion' => $habitacion,
            'total' => $total,
            'correo' => $correo,
            'requestId' => $requestId,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'noches' => $noches,
            'nombre' => $nombreSesion,
            'gwStatus' => $gwStatus,
            'gwReason' => $gwReason,
            'nuevoEstado' => $nuevoEstado,
        ];
    }
}
