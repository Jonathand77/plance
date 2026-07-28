<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\GatewayOrdenRepository;
use Plance\Repositories\OrdenRepository;

class HistorialPagosBasicosController
{
    public function __construct(
        private OrdenRepository $ordenes = new OrdenRepository(),
        private GatewayOrdenRepository $gatewayOrdenes = new GatewayOrdenRepository()
    ) {
    }

    public function handleList(string $modo): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $registros = match ($modo) {
            'gateway' => $this->gatewayOrdenes->findAllByCorreo($correo),
            'mixto' => $this->ordenes->findMixtoByCorreo($correo),
            default => $this->ordenes->findWcByCorreo($correo),
        };

        $verifyMsg = $_SESSION['verify_msg'] ?? '';
        unset($_SESSION['verify_msg']);

        return [
            'registros' => $registros,
            'verifyMsg' => $verifyMsg,
        ];
    }
}
