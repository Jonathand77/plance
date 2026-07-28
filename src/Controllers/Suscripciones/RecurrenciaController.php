<?php

namespace Plance\Controllers\Suscripciones;

use Plance\Repositories\RecurrenciaRepository;
use Plance\Services\Suscripciones\Exceptions\RecurrenciaNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;
use Plance\Services\Suscripciones\RecurrenciaService;

class RecurrenciaController
{
    private RecurrenciaService $service;

    public function __construct(?RecurrenciaService $service = null)
    {
        $this->service = $service ?? new RecurrenciaService(new RecurrenciaRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->crear($post);
        } catch (ValidationException $e) {
            die($e->getMessage());
        }

        if ($result['processUrl']) {
            header('Location: ' . $result['processUrl']);
            exit();
        }

        echo "<h3 style='font-family:sans-serif;color:#e05252;'>❌ Error al crear sesión de pago</h3>";
        echo "<p style='font-family:sans-serif;color:#f0f1f3;'>Recurrencia <strong>#{$result['recId']}</strong> "
            . 'guardada en BD pero el pago no pudo iniciarse.</p>';
        echo "<pre style='background:#1e2128;color:#f0f1f3;padding:1rem;border-radius:8px;font-size:0.85rem;'>";
        print_r($result['gatewayResult']);
        echo '</pre>';
        echo "<a href='../plataformas/redes.php' style='color:#0062A8;font-family:sans-serif;'>← Volver</a>";
    }

    public function handleReturn(array $get): array
    {
        $recId = (int) ($get['rec'] ?? 0);

        if (!$recId) {
            header('Location: index.php');
            exit();
        }

        try {
            return $this->service->procesarRetorno($recId);
        } catch (RecurrenciaNotFoundException $e) {
            header('Location: index.php');
            exit();
        }
    }
}
