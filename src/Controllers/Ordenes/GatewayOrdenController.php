<?php

namespace Plance\Controllers\Ordenes;

use Plance\Repositories\GatewayOrdenRepository;
use Plance\Services\Ordenes\Exceptions\PersistenceException;
use Plance\Services\Ordenes\Exceptions\ValidationException;
use Plance\Services\Ordenes\GatewayOrdenService;

class GatewayOrdenController
{
    private GatewayOrdenService $service;

    public function __construct(?GatewayOrdenService $service = null)
    {
        $this->service = $service ?? new GatewayOrdenService(new GatewayOrdenRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->procesar($post);
        } catch (ValidationException | PersistenceException $e) {
            die($e->getMessage());
        }

        $_SESSION['gw_result'] = [
            'orden_id' => $result['ordenId'],
            'status' => $result['status'],
            'estado' => $result['estado'],
            'producto' => $result['producto'],
            'precio' => $result['precio'],
            'correo' => $result['correo'],
            'nombre' => $result['nombre'],
            'message' => $result['message'],
            'razon' => $result['razon'],
            'gw_status' => $result['gwStatus'],
            'reference' => $result['reference'],
            'metodo' => $result['metodo'],
        ];

        unset($_SESSION['gw_pending']);

        header('Location: ../retorno_gateway.php?orden=' . $result['ordenId']);
        exit();
    }
}
