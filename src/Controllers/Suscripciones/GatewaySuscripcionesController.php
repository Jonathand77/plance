<?php

namespace Plance\Controllers\Suscripciones;

use Plance\Repositories\GatewaySuscripcionRepository;
use Plance\Services\Ordenes\Exceptions\PersistenceException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;
use Plance\Services\Suscripciones\GatewaySuscripcionesService;

class GatewaySuscripcionesController
{
    private GatewaySuscripcionesService $service;

    public function __construct(?GatewaySuscripcionesService $service = null)
    {
        $this->service = $service ?? new GatewaySuscripcionesService(new GatewaySuscripcionRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->procesar($post);
        } catch (ValidationException | PersistenceException $e) {
            die($e->getMessage());
        }

        $_SESSION['gw_sub_result'] = [
            'orden_id' => $result['ordenId'],
            'tipo' => 'suscripciones',
            'status' => $result['status'],
            'estado' => $result['estado'],
            'servicio' => $result['servicio'],
            'plan' => $result['plan'],
            'precio' => $result['precio'],
            'nombre' => $result['nombre'],
            'correo' => $result['correo'],
            'reference' => $result['reference'],
            'token' => $result['token'],
            'message' => $result['message'],
        ];

        unset($_SESSION['gw_subs_pending']);

        header('Location: ../retorno_suscripciones_gateway.php?orden=' . $result['ordenId']);
        exit();
    }
}
