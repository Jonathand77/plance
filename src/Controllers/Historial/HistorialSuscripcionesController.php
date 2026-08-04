<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\GatewaySuscripcionRepository;
use Plance\Repositories\GatewaySuscriptionRepository;
use Plance\Repositories\SuscripcionRepository;
use Plance\Repositories\SuscriptionRecRepository;
use Plance\Repositories\SuscriptionRepository;

class HistorialSuscripcionesController
{
    public function __construct(
        private SuscripcionRepository $suscripciones = new SuscripcionRepository(),
        private SuscriptionRecRepository $suscriptionRec = new SuscriptionRecRepository(),
        private SuscriptionRepository $suscription = new SuscriptionRepository(),
        private GatewaySuscripcionRepository $gatewaySuscripciones = new GatewaySuscripcionRepository(),
        private GatewaySuscriptionRepository $gatewaySuscription = new GatewaySuscriptionRepository()
    ) {
    }

    public function handleList(string $modo): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $registros = match ($modo) {
            'wc-rec' => $this->suscriptionRec->findAllByUsuarioId($correo),
            'wc-pura' => $this->suscription->findAllByUsuarioId($correo),
            'gw-sub' => $this->gatewaySuscripciones->findAllByCorreo($correo),
            'gw-pura' => $this->gatewaySuscription->findAllByCorreo($correo),
            default => $this->suscripciones->findAllByUsuarioId($correo),
        };

        $verifyMsg = $_SESSION['verify_msg'] ?? '';
        $cancelMsg = $_SESSION['cancel_msg'] ?? '';
        unset($_SESSION['verify_msg'], $_SESSION['cancel_msg']);

        return [
            'registros' => $registros,
            'verifyMsg' => $verifyMsg,
            'cancelMsg' => $cancelMsg,
        ];
    }
}
