<?php

namespace Plance\Controllers\PaymentLinks;

use Plance\Repositories\PaymentLinkRepository;
use Plance\Services\PaymentLinks\Exceptions\ValidationException;
use Plance\Services\PaymentLinks\PaymentLinkService;

class PaymentLinkController
{
    private PaymentLinkService $service;

    public function __construct(?PaymentLinkService $service = null)
    {
        $this->service = $service ?? new PaymentLinkService(new PaymentLinkRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->crear($post);
        } catch (ValidationException $e) {
            die($e->getMessage());
        }

        $_SESSION['link_result'] = [
            'registro_id' => $result['registroId'],
            'producto' => $result['producto'],
            'precio' => $result['precio'],
            'correo' => $result['correo'],
            'nombre' => $result['nombre'],
            'referencia' => $result['referencia'],
            'link_url' => $result['linkUrl'],
            'link_id' => $result['linkId'],
            'expiracion' => $result['expiracion'],
            'status' => $result['status'],
            'raw' => $result['raw'],
        ];

        header('Location: ../retorno_link.php');
        exit();
    }
}
