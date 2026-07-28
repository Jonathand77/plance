<?php

namespace Plance\Services\Payments;

use Plance\Repositories\Contracts\DispersionRepositoryInterface;
use Plance\Repositories\Contracts\GatewayOrdenRepositoryInterface;
use Plance\Repositories\Contracts\GatewaySuscripcionRepositoryInterface;
use Plance\Repositories\Contracts\GatewaySuscriptionRepositoryInterface;
use Plance\Repositories\Contracts\OrdenRepositoryInterface;
use Plance\Repositories\Contracts\PaymentLinkRepositoryInterface;
use Plance\Repositories\Contracts\RecurrenciaRepositoryInterface;
use Plance\Repositories\Contracts\ReservacionRepositoryInterface;
use Plance\Repositories\Contracts\SuscripcionRepositoryInterface;
use Plance\Repositories\Contracts\SuscriptionRecRepositoryInterface;
use Plance\Repositories\Contracts\SuscriptionRepositoryInterface;
use Plance\Repositories\DispersionRepository;
use Plance\Repositories\GatewayOrdenRepository;
use Plance\Repositories\GatewaySuscripcionRepository;
use Plance\Repositories\GatewaySuscriptionRepository;
use Plance\Repositories\OrdenRepository;
use Plance\Repositories\PaymentLinkRepository;
use Plance\Repositories\RecurrenciaRepository;
use Plance\Repositories\ReservacionRepository;
use Plance\Repositories\SuscripcionRepository;
use Plance\Repositories\SuscriptionRecRepository;
use Plance\Repositories\SuscriptionRepository;
use Plance\Services\Payments\Exceptions\InvalidPayloadException;
use Plance\Support\EstadoMapper;

/**
 * Procesa el webhook de notificaciones de PlaceToPay.
 *
 * La firma X-Signature usa el mismo algoritmo del notify.php original
 * (nonce + secretKey por SHA1, luego login + nonce + tranKey por SHA1).
 * No es el algoritmo estándar documentado por PlaceToPay para requests
 * salientes; se preserva tal cual porque no hay forma de confirmar contra
 * tráfico real cuál es el que la pasarela realmente firma en notificaciones.
 */
class NotifyService
{
    public function __construct(
        private OrdenRepositoryInterface $ordenes = new OrdenRepository(),
        private RecurrenciaRepositoryInterface $recurrencias = new RecurrenciaRepository(),
        private SuscripcionRepositoryInterface $suscripciones = new SuscripcionRepository(),
        private SuscriptionRepositoryInterface $suscription = new SuscriptionRepository(),
        private SuscriptionRecRepositoryInterface $suscriptionRec = new SuscriptionRecRepository(),
        private GatewayOrdenRepositoryInterface $gatewayOrdenes = new GatewayOrdenRepository(),
        private GatewaySuscripcionRepositoryInterface $gatewaySuscripciones = new GatewaySuscripcionRepository(),
        private GatewaySuscriptionRepositoryInterface $gatewaySuscription = new GatewaySuscriptionRepository(),
        private DispersionRepositoryInterface $dispersiones = new DispersionRepository(),
        private ReservacionRepositoryInterface $reservaciones = new ReservacionRepository(),
        private PaymentLinkRepositoryInterface $paymentLinks = new PaymentLinkRepository(),
    ) {
    }

    public function validarFirma(string $signature, array $data): bool
    {
        $login = PlaceToPayCredentials::login('estandar');
        $secretKey = PlaceToPayCredentials::secretKey('estandar');

        $nonce = $data['status']['date'] ?? date('c');
        $tranKey = base64_encode(sha1($nonce . $secretKey, true));
        $expectedSignature = base64_encode(sha1($login . $nonce . $tranKey, true));

        return $signature === $expectedSignature;
    }

    public function procesar(array $data): void
    {
        $status = $data['status']['status'] ?? '';
        $requestId = (string) ($data['requestId'] ?? '');
        $reference = $data['payment'][0]['reference'] ?? '';

        if ($status === '' || $requestId === '') {
            throw new InvalidPayloadException('Datos incompletos');
        }

        $token = $this->extraerToken($data);

        if (str_starts_with($reference, 'REC-')) {
            $this->actualizarEstado($this->recurrencias, $requestId, EstadoMapper::fromCheckout($status));
        } elseif (str_starts_with($reference, 'SUSC-')) {
            $estado = EstadoMapper::fromCheckout($status);
            $this->actualizarEstadoYToken($this->suscripciones, $requestId, $estado, $token);
        } elseif (str_starts_with($reference, 'SUB-')) {
            $this->actualizarEstadoYToken($this->suscription, $requestId, EstadoMapper::fromCheckout($status), $token);
        } elseif (str_starts_with($reference, 'SREC-')) {
            $this->actualizarEstado($this->suscriptionRec, $requestId, EstadoMapper::fromCheckout($status));
        } elseif (str_starts_with($reference, 'GW-BS-')) {
            $this->actualizarEstadoGateway($this->gatewayOrdenes, $requestId, EstadoMapper::fromGateway($status));
        } elseif (str_starts_with($reference, 'GWSUB-')) {
            $this->actualizarEstadoGateway($this->gatewaySuscripciones, $requestId, EstadoMapper::fromGateway($status));
        } elseif (str_starts_with($reference, 'GWMUS-')) {
            $this->actualizarEstadoGateway($this->gatewaySuscription, $requestId, EstadoMapper::fromGateway($status));
        } elseif (str_starts_with($reference, 'DISP-')) {
            $this->actualizarEstado($this->dispersiones, $requestId, EstadoMapper::fromGateway($status));
        } elseif (str_starts_with($reference, 'PRE-')) {
            $this->actualizarEstado($this->reservaciones, $requestId, EstadoMapper::fromGateway($status));
        } elseif (str_starts_with($reference, 'PL-')) {
            $this->actualizarPaymentLink($reference, EstadoMapper::fromCheckout($status));
        } else {
            $this->actualizarOrden($requestId, EstadoMapper::fromCheckout($status));
        }
    }

    private function actualizarEstado(
        RecurrenciaRepositoryInterface|SuscriptionRecRepositoryInterface
        |DispersionRepositoryInterface|ReservacionRepositoryInterface $repo,
        string $requestId,
        string $estado
    ): void {
        $row = $repo->findByRequestId($requestId);

        if ($row === null) {
            error_log("notify.php: sin coincidencia para request_id={$requestId}");

            return;
        }

        $repo->updateEstado((int) $row['id'], $estado);
    }

    private function actualizarEstadoYToken(
        SuscripcionRepositoryInterface|SuscriptionRepositoryInterface $repo,
        string $requestId,
        string $estado,
        string $token
    ): void {
        $row = $repo->findByRequestId($requestId);

        if ($row === null) {
            error_log("notify.php: sin coincidencia para request_id={$requestId}");

            return;
        }

        if ($estado === 'aprobada' && $token !== '') {
            $repo->updateEstadoYToken((int) $row['id'], $estado, $token);

            return;
        }

        $repo->updateEstado((int) $row['id'], $estado);
    }

    private function actualizarEstadoGateway(
        GatewayOrdenRepositoryInterface|GatewaySuscripcionRepositoryInterface
        |GatewaySuscriptionRepositoryInterface $repo,
        string $requestId,
        string $estado
    ): void {
        $row = $repo->findByRequestId($requestId);

        if ($row === null) {
            error_log("notify.php: sin coincidencia para request_id={$requestId}");

            return;
        }

        $repo->updateEstado((int) $row['id'], $estado);
    }

    private function actualizarOrden(string $requestId, string $estado): void
    {
        $row = $this->ordenes->findByRequestId((int) $requestId);

        if ($row === null) {
            error_log("notify.php: sin coincidencia para request_id={$requestId}");

            return;
        }

        $this->ordenes->updateEstado((int) $row['id'], $estado);
    }

    private function actualizarPaymentLink(string $referencia, string $estado): void
    {
        $row = $this->paymentLinks->findByReferencia($referencia);

        if ($row === null) {
            error_log("notify.php: sin coincidencia para referencia={$referencia}");

            return;
        }

        $this->paymentLinks->updateEstado((int) $row['id'], $estado);
    }

    private function extraerToken(array $data): string
    {
        $token = $this->buscarTokenEnLista($data['subscription']['instrument'] ?? null);

        if ($token !== '') {
            return $token;
        }

        return $this->buscarTokenEnLista($data['payment'][0]['subscription'] ?? null);
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
