<?php

namespace Plance\Controllers\Reservaciones;

use Plance\Repositories\ReservacionRepository;
use Plance\Services\Reservaciones\Exceptions\ReservacionNotFoundException;
use Plance\Services\Reservaciones\Exceptions\ValidationException;
use Plance\Services\Reservaciones\PreauthorizationService;

class PreauthorizationController
{
    private PreauthorizationService $service;

    public function __construct(?PreauthorizationService $service = null)
    {
        $this->service = $service ?? new PreauthorizationService(new ReservacionRepository());
    }

    public function handleCreate(array $post): void
    {
        $correo = $_SESSION['correo'] ?? '';

        try {
            $result = $this->service->crear($post, $correo);
        } catch (ValidationException $e) {
            die($e->getMessage());
        }

        $_SESSION['pre_result'] = [
            'reserva_id' => $result['reservaId'],
            'habitacion' => $result['habitacion'],
            'total' => $result['total'],
            'noches' => $result['noches'],
            'checkin' => $result['checkin'],
            'checkout' => $result['checkout'],
            'nombre' => $result['nombre'],
            'correo' => $result['correo'],
            'reference' => $result['reference'],
            'requestId' => $result['requestId'],
            'processUrl' => $result['processUrl'],
            'status' => $result['status'],
        ];

        if ($result['status'] === 'OK' && $result['processUrl']) {
            header('Location: ' . $result['processUrl']);
            exit();
        }

        header('Location: ../retorno_preautorizacion.php?reserva_id=' . $result['reservaId'] . '&error=1');
        exit();
    }

    public function handleReturn(array $get, array $session): array
    {
        $pre = $session['pre_result'] ?? null;
        unset($_SESSION['pre_result']);

        $reservaId = (int) ($get['reserva_id'] ?? ($pre['reserva_id'] ?? 0));

        if (!$reservaId) {
            header('Location: index.php');
            exit();
        }

        try {
            return $this->service->procesarRetorno($reservaId, $pre['nombre'] ?? '');
        } catch (ReservacionNotFoundException $e) {
            header('Location: index.php');
            exit();
        }
    }
}
