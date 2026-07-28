<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\DispersionRepository;

class HistorialDispersionesController
{
    private DispersionRepository $dispersiones;

    public function __construct(?DispersionRepository $dispersiones = null)
    {
        $this->dispersiones = $dispersiones ?? new DispersionRepository();
    }

    public function handleList(): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $verifyMsg = $_SESSION['verify_msg'] ?? '';
        unset($_SESSION['verify_msg']);

        return [
            'registros' => $this->dispersiones->findAllByUsuarioId($correo),
            'verifyMsg' => $verifyMsg,
        ];
    }
}
