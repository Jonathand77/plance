<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\PaymentLinkRepository;

class HistorialLinksController
{
    private PaymentLinkRepository $links;

    public function __construct(?PaymentLinkRepository $links = null)
    {
        $this->links = $links ?? new PaymentLinkRepository();
    }

    public function handleList(): array
    {
        $correo = $_SESSION['correo'] ?? '';

        return [
            'registros' => $this->links->findAllByCorreo($correo),
        ];
    }
}
