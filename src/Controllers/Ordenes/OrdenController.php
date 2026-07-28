<?php

namespace Plance\Controllers\Ordenes;

use Plance\Repositories\OrdenRepository;
use Plance\Services\Ordenes\Exceptions\GatewaySessionException;
use Plance\Services\Ordenes\Exceptions\ValidationException;
use Plance\Services\Ordenes\OrdenService;

class OrdenController
{
    private OrdenService $service;

    public function __construct(?OrdenService $service = null)
    {
        $this->service = $service ?? new OrdenService(new OrdenRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->crear($post, $_SESSION['correo'] ?? '');
        } catch (ValidationException $e) {
            die($e->getMessage());
        } catch (GatewaySessionException $e) {
            echo "<h3 style='font-family:sans-serif;color:#e05252;'>❌ Error al crear sesión de pago</h3>";
            echo "<p style='font-family:sans-serif;color:#f0f1f3;'>Orden <strong>#{$e->getOrderId()}</strong> "
                . 'guardada en BD pero el pago no pudo iniciarse.</p>';
            echo "<pre style='background:#1e2128;color:#f0f1f3;padding:1rem;border-radius:8px;font-size:0.85rem;'>";
            print_r($e->getGatewayResult());
            echo '</pre>';
            echo "<a href='../index.php' style='color:#FF6C0C;font-family:sans-serif;'>← Volver al inicio</a>";
            return;
        }

        $_SESSION['p2p_requestId'] = $result['requestId'];
        $_SESSION['p2p_order_id'] = $result['orderId'];

        header('Location: ' . $result['processUrl']);
        exit();
    }

    public function handleReturn(array $get, array $session): array
    {
        $orderId = (int) ($get['order'] ?? 0);
        $requestId = (string) ($session['p2p_requestId'] ?? '');

        if (!$orderId || !$requestId) {
            header('Location: index.php');
            exit();
        }

        $view = $this->service->procesarRetorno($orderId, $requestId);

        unset($_SESSION['p2p_requestId'], $_SESSION['p2p_order_id']);

        return $view;
    }
}
