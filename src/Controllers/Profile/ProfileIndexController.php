<?php

namespace Plance\Controllers\Profile;

use Plance\Repositories\GatewayOrdenRepository;
use Plance\Repositories\GatewaySuscripcionRepository;
use Plance\Repositories\GatewaySuscriptionRepository;
use Plance\Repositories\OrdenRepository;
use Plance\Repositories\RecurrenciaRepository;
use Plance\Repositories\SuscripcionRepository;
use Plance\Repositories\UserRepository;

class ProfileIndexController
{
    public function __construct(
        private UserRepository $users = new UserRepository(),
        private OrdenRepository $ordenes = new OrdenRepository(),
        private SuscripcionRepository $suscripciones = new SuscripcionRepository(),
        private RecurrenciaRepository $recurrencias = new RecurrenciaRepository(),
        private GatewayOrdenRepository $gatewayOrdenes = new GatewayOrdenRepository(),
        private GatewaySuscripcionRepository $gatewaySuscripciones = new GatewaySuscripcionRepository(),
        private GatewaySuscriptionRepository $gatewaySuscription = new GatewaySuscriptionRepository()
    ) {
    }

    public function handle(): array
    {
        $userId = (int) ($_SESSION['user_id'] ?? 0);
        $row = $this->users->findById($userId);

        if ($row === null) {
            header('Location: ../login.php');
            exit();
        }

        $correo = $row['correo'];

        $subs = $this->suscripciones->findAllByUsuarioId($correo);
        $recs = $this->recurrencias->findAllByUsuarioId($correo);

        $contarPorEstado = fn (array $registros, string $estado): int => count(array_filter(
            $registros,
            fn (array $r) => strtolower($r['estado']) === $estado
        ));

        $totalOrdenesPago = $this->ordenes->countByCorreo($correo) + count($subs) + count($recs);
        $totalAprobadas = $this->ordenes->countByCorreoYEstado($correo, 'aprobada')
            + $contarPorEstado($subs, 'aprobada') + $contarPorEstado($recs, 'aprobada');
        $totalRechazadas = $this->ordenes->countByCorreoYEstado($correo, 'rechazada')
            + $contarPorEstado($subs, 'rechazada') + $contarPorEstado($recs, 'rechazada');

        $actividadDias = [];
        foreach ($this->ordenes->actividadPorDiaByCorreo($correo, 365) as $r) {
            $actividadDias[$r['dia']] = ($actividadDias[$r['dia']] ?? 0) + (int) $r['cnt'];
        }
        foreach ($this->suscripciones->actividadPorDiaByUsuarioId($correo, 365) as $r) {
            $actividadDias[$r['dia']] = ($actividadDias[$r['dia']] ?? 0) + (int) $r['cnt'];
        }

        $msg = $_SESSION['profile_msg'] ?? '';
        $msgType = $_SESSION['profile_msg_type'] ?? '';
        unset($_SESSION['profile_msg'], $_SESSION['profile_msg_type']);

        return [
            'row' => $row,
            'totalOrdenesPago' => $totalOrdenesPago,
            'totalAprobadas' => $totalAprobadas,
            'totalOrdenesRechazadas' => $totalRechazadas,
            'totalOrdenes' => $this->ordenes->countByCorreo($correo),
            'totalSubs' => count($subs),
            'totalRecurrencias' => count($recs),
            'totalGwOrdenes' => count($this->gatewayOrdenes->findAllByCorreo($correo)),
            'totalGwSubs' => count($this->gatewaySuscripciones->findAllByCorreo($correo)),
            'totalGwSuscription' => count($this->gatewaySuscription->findAllByCorreo($correo)),
            'actividadJson' => json_encode($actividadDias),
            'msg' => $msg,
            'msgType' => $msgType,
        ];
    }
}
