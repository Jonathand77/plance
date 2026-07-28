<?php

namespace Plance\Controllers\Suscripciones;

use Plance\Repositories\GatewaySuscriptionRepository;
use Plance\Services\Ordenes\Exceptions\PersistenceException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;
use Plance\Services\Suscripciones\GatewaySuscriptionService;

class GatewaySuscriptionController
{
    private GatewaySuscriptionService $service;

    public function __construct(?GatewaySuscriptionService $service = null)
    {
        $this->service = $service ?? new GatewaySuscriptionService(new GatewaySuscriptionRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->procesar($post);
        } catch (ValidationException | PersistenceException $e) {
            die($e->getMessage());
        }

        $_SESSION['gw_mus_result'] = [
            'orden_id' => $result['ordenId'],
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

        header('Location: ../retorno_suscription_gateway.php?orden=' . $result['ordenId']);
        exit();
    }
}
