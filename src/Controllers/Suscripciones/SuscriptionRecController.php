<?php

namespace Plance\Controllers\Suscripciones;

use Plance\Repositories\SuscriptionRecRepository;
use Plance\Services\Suscripciones\Exceptions\SuscriptionRecNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;
use Plance\Services\Suscripciones\SuscriptionRecService;

class SuscriptionRecController
{
    private SuscriptionRecService $service;

    public function __construct(?SuscriptionRecService $service = null)
    {
        $this->service = $service ?? new SuscriptionRecService(new SuscriptionRecRepository());
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
        echo "<a href='../plataformas/ia.php' style='color:#8b5cf6;'>← Volver</a>";
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
        } catch (SuscriptionRecNotFoundException $e) {
            header('Location: index.php');
            exit();
        }
    }
}
