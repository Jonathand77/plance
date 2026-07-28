<?php

namespace Plance\Controllers\Suscripciones;

use Plance\Repositories\SuscripcionRepository;
use Plance\Services\Suscripciones\Exceptions\SuscripcionNotFoundException;
use Plance\Services\Suscripciones\Exceptions\ValidationException;
use Plance\Services\Suscripciones\SuscripcionService;

class SuscripcionController
{
    private SuscripcionService $service;

    public function __construct(?SuscripcionService $service = null)
    {
        $this->service = $service ?? new SuscripcionService(new SuscripcionRepository());
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
        echo "<p style='font-family:sans-serif;color:#f0f1f3;'>Suscripción <strong>#{$result['subId']}</strong> "
            . 'guardada en BD pero el pago no pudo iniciarse.</p>';
        echo "<pre style='background:#1e2128;color:#f0f1f3;padding:1rem;border-radius:8px;font-size:0.85rem;'>";
        print_r($result['gatewayResult']);
        echo '</pre>';
        echo "<a href='../plataformas/streaming.php' style='color:#0062A8;font-family:sans-serif;'>← Volver</a>";
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
        } catch (SuscripcionNotFoundException $e) {
            header('Location: index.php');
            exit();
        }
    }

    public function handleTokenizar(array $get): void
    {
        $subId = (int) ($get['sub'] ?? 0);

        if (!$subId) {
            header('Location: ../index.php');
            exit();
        }

        try {
            $result = $this->service->iniciarTokenizacion($subId);
        } catch (SuscripcionNotFoundException $e) {
            header('Location: ../index.php');
            exit();
        }

        if ($result['processUrl']) {
            $_SESSION['token_requestId'] = $result['requestId'];
            $_SESSION['token_sub_id'] = $subId;
            header('Location: ' . $result['processUrl']);
            exit();
        }

        echo "<h3 style='font-family:sans-serif;color:#e05252;'>❌ Error al crear sesión de tokenización</h3>";
        echo "<pre style='background:#1e2128;color:#f0f1f3;padding:1rem;border-radius:8px;font-size:0.85rem;'>";
        print_r($result['gatewayResult']);
        echo '</pre>';
        echo "<a href='../plataformas/streaming.php' style='color:#0062A8;font-family:sans-serif;'>← Volver</a>";
    }

    public function handleReturnTokenizacion(array $get, array $session): array
    {
        $subId = (int) ($get['sub'] ?? ($session['token_sub_id'] ?? 0));
        $requestId = (string) ($session['token_requestId'] ?? '');

        if (!$subId || !$requestId) {
            header('Location: index.php');
            exit();
        }

        $view = $this->service->procesarRetornoTokenizacion($subId, $requestId);

        unset($_SESSION['token_requestId'], $_SESSION['token_sub_id']);

        return $view;
    }
}
