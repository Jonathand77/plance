<?php

namespace Plance\Controllers\Historial;

use Plance\Services\Historial\Exceptions\ValidationException;
use Plance\Services\Historial\VerificarPagoService;
use Plance\Support\SafeRedirect;

class VerificarPagoController
{
    private VerificarPagoService $service;

    public function __construct(?VerificarPagoService $service = null)
    {
        $this->service = $service ?? new VerificarPagoService();
    }

    public function handle(array $get): void
    {
        $tabla = (string) ($get['tabla'] ?? '');
        $id = (int) ($get['id'] ?? 0);
        $requestId = (string) ($get['request_id'] ?? '');
        $redirect = SafeRedirect::resolve($get['redirect'] ?? null, '../historial/historial.php');

        try {
            $nuevoEstado = $this->service->verificar($tabla, $id, $requestId);
        } catch (ValidationException $e) {
            header('Location: ' . $redirect);
            exit();
        }

        $_SESSION['verify_msg'] = "✅ Orden #{$id} actualizada a: " . strtoupper($nuevoEstado);
        header('Location: ' . $redirect);
        exit();
    }
}
