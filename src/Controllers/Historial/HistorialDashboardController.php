<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\DispersionRepository;
use Plance\Repositories\OrdenRepository;
use Plance\Repositories\PaymentLinkRepository;
use Plance\Repositories\RecurrenciaRepository;
use Plance\Repositories\ReservacionRepository;
use Plance\Repositories\SuscripcionRepository;

class HistorialDashboardController
{
    public function __construct(
        private OrdenRepository $ordenes = new OrdenRepository(),
        private SuscripcionRepository $suscripciones = new SuscripcionRepository(),
        private RecurrenciaRepository $recurrencias = new RecurrenciaRepository(),
        private PaymentLinkRepository $paymentLinks = new PaymentLinkRepository(),
        private DispersionRepository $dispersiones = new DispersionRepository(),
        private ReservacionRepository $reservaciones = new ReservacionRepository()
    ) {
    }

    public function handleList(): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $totalOrdenes = count($this->ordenes->findWcByCorreo($correo))
            + count($this->ordenes->findMixtoByCorreo($correo));
        $totalSubs = count($this->suscripciones->findAllByUsuarioId($correo));
        $totalRecs = count($this->recurrencias->findAllByUsuarioId($correo));
        $totalLinks = count($this->paymentLinks->findAllByCorreo($correo));
        $totalDisp = count($this->dispersiones->findAllByUsuarioId($correo));
        $totalPrea = count($this->reservaciones->findAllByUsuarioId($correo));

        return [
            'totalOrdenes' => $totalOrdenes,
            'totalSubs' => $totalSubs,
            'totalRecs' => $totalRecs,
            'totalLinks' => $totalLinks,
            'totalDisp' => $totalDisp,
            'totalPrea' => $totalPrea,
            'totalPagos' => number_format($totalOrdenes + $totalSubs + $totalRecs, 0, ',', '.'),
        ];
    }
}
