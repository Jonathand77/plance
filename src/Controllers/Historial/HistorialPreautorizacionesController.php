<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\ReservacionRepository;

class HistorialPreautorizacionesController
{
    private ReservacionRepository $reservaciones;

    public function __construct(?ReservacionRepository $reservaciones = null)
    {
        $this->reservaciones = $reservaciones ?? new ReservacionRepository();
    }

    public function handleList(): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $verifyMsg = $_SESSION['verify_msg'] ?? '';
        unset($_SESSION['verify_msg']);

        return [
            'registros' => $this->reservaciones->findAllByUsuarioId($correo),
            'verifyMsg' => $verifyMsg,
        ];
    }
}
