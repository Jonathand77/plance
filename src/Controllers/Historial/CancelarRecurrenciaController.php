<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\RecurrenciaRepository;
use Plance\Repositories\SuscriptionRecRepository;
use Plance\Services\Historial\CancelarRecurrenciaService;
use Plance\Services\Historial\Exceptions\RecurrenciaNoCancelableException;

class CancelarRecurrenciaController
{
    public function __construct(private ?CancelarRecurrenciaService $service = null)
    {
    }

    public function handle(array $get): void
    {
        $tabla = ($get['tabla'] ?? 'recurrencias') === 'suscription_rec' ? 'suscription_rec' : 'recurrencias';
        $redirect = $tabla === 'suscription_rec'
            ? '../historial/reg-sus.php?modo=wc-rec'
            : '../historial/reg-rec.php';
        $recId = (int) ($get['id'] ?? 0);

        if (!$recId) {
            header('Location: ' . $redirect);
            exit();
        }

        $service = $this->service ?? new CancelarRecurrenciaService(
            $tabla === 'suscription_rec' ? new SuscriptionRecRepository() : new RecurrenciaRepository()
        );

        try {
            $rec = $service->cancelar($recId, $_SESSION['correo'] ?? '');
        } catch (RecurrenciaNoCancelableException $e) {
            $_SESSION['cancel_msg'] = $e->getMessage();
            header('Location: ' . $redirect);
            exit();
        }

        $_SESSION['cancel_msg'] = '🚫 #' . $recId . ' (' . $rec['servicio'] . ' — ' . $rec['plan']
            . ') cancelado correctamente.';
        header('Location: ' . $redirect);
        exit();
    }
}
