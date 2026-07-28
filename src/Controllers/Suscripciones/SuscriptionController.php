<?php

namespace Plance\Controllers\Suscripciones;

use Plance\Repositories\SuscriptionRepository;
use Plance\Services\Suscripciones\Exceptions\SuscriptionNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;
use Plance\Services\Suscripciones\SuscriptionService;

class SuscriptionController
{
    private SuscriptionService $service;

    public function __construct(?SuscriptionService $service = null)
    {
        $this->service = $service ?? new SuscriptionService(new SuscriptionRepository());
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

        echo "<h3 style='font-family:sans-serif;color:#e05252;'>❌ Error al crear sesión</h3>";
        echo "<pre style='background:#1e2128;color:#f0f1f3;padding:1rem;border-radius:8px;'>";
        print_r($result['gatewayResult']);
        echo '</pre>';
        echo "<a href='../plataformas/otras_streamings.php' style='color:#22c55e;'>← Volver</a>";
    }

    public function handleReturn(array $get): array
    {
        $subId = (int) ($get['sub'] ?? 0);

        if (!$subId) {
            header('Location: index.php');
            exit();
        }

        try {
            return $this->service->procesarRetorno($subId);
        } catch (SuscriptionNotFoundException $e) {
            header('Location: index.php');
            exit();
        }
    }
}
