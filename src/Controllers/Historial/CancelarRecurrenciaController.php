<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\RecurrenciaRepository;
use Plance\Services\Historial\CancelarRecurrenciaService;
use Plance\Services\Historial\Exceptions\RecurrenciaNoCancelableException;

class CancelarRecurrenciaController
{
    private CancelarRecurrenciaService $service;

    public function __construct(?CancelarRecurrenciaService $service = null)
    {
        $this->service = $service ?? new CancelarRecurrenciaService(new RecurrenciaRepository());
    }

    public function handle(array $get): void
    {
        $redirect = '../historial/reg-rec.php';
        $recId = (int) ($get['id'] ?? 0);

        if (!$recId) {
            header('Location: ' . $redirect);
            exit();
        }

        try {
            $rec = $this->service->cancelar($recId, $_SESSION['correo'] ?? '');
        } catch (RecurrenciaNoCancelableException $e) {
            $_SESSION['cancel_msg'] = $e->getMessage();
            header('Location: ' . $redirect);
            exit();
        }

        $_SESSION['cancel_msg'] = '🚫 Membresía #' . $recId . ' (' . $rec['servicio'] . ' — ' . $rec['plan']
            . ') cancelada correctamente.';
        header('Location: ' . $redirect);
        exit();
    }
}
