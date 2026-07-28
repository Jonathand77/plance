<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\RecurrenciaRepository;

class HistorialRecurrenciasController
{
    private RecurrenciaRepository $recurrencias;

    public function __construct(?RecurrenciaRepository $recurrencias = null)
    {
        $this->recurrencias = $recurrencias ?? new RecurrenciaRepository();
    }

    public function handleList(): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $verifyMsg = $_SESSION['verify_msg'] ?? '';
        $cancelMsg = $_SESSION['cancel_msg'] ?? '';
        unset($_SESSION['verify_msg'], $_SESSION['cancel_msg']);

        return [
            'registros' => $this->recurrencias->findAllByUsuarioId($correo),
            'verifyMsg' => $verifyMsg,
            'cancelMsg' => $cancelMsg,
        ];
    }
}
