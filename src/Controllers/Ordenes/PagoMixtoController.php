<?php

namespace Plance\Controllers\Ordenes;

use Plance\Repositories\OrdenRepository;
use Plance\Services\Ordenes\Exceptions\ValidationException;
use Plance\Services\Ordenes\PagoMixtoService;

class PagoMixtoController
{
    private PagoMixtoService $service;

    public function __construct(?PagoMixtoService $service = null)
    {
        $this->service = $service ?? new PagoMixtoService(new OrdenRepository());
    }

    public function handleCreate(array $post): void
    {
        try {
            $result = $this->service->crear($post, $_SESSION['correo'] ?? '');
        } catch (ValidationException $e) {
            die($e->getMessage());
        }

        $_SESSION['mix_result'] = [
            'orden_id' => $result['ordenId'],
            'productos' => $result['productos'],
            'total' => $result['total'],
            'monto_parcial' => $result['montoParcial'],
            'allow_partial' => $result['allowPartial'],
            'reference' => $result['reference'],
            'requestId' => $result['requestId'],
            'processUrl' => $result['processUrl'],
            'status' => $result['status'],
            'message' => $result['message'],
        ];

        if ($result['status'] === 'OK' && $result['processUrl']) {
            header('Location: ' . $result['processUrl']);
            exit();
        }

        header('Location: ../retorno_mixto.php?error=1');
        exit();
    }

    public function handleReturn(array $session): array
    {
        $mix = $session['mix_result'] ?? null;
        unset($_SESSION['mix_result']);

        if (!$mix) {
            header('Location: index.php');
            exit();
        }

        return $this->service->procesarRetorno($mix);
    }

    public function handleContinuar(int $ordenId): void
    {
        try {
            $result = $this->service->continuar($ordenId);
        } catch (ValidationException $e) {
            header('Location: ../historial/reg-pgb.php?modo=mixto');
            exit();
        }

        $_SESSION['continuar_result'] = [
            'orden_id' => $result['ordenId'],
            'productos' => $result['productos'],
            'total' => $result['total'],
            'monto_pagado' => $result['montoPagado'],
            'saldo_rest' => $result['saldoRest'],
            'requestId' => $result['requestId'],
            'reference' => $result['reference'],
        ];

        if ($result['status'] === 'OK' && $result['processUrl']) {
            header('Location: ' . $result['processUrl']);
            exit();
        }

        header('Location: ../historial/reg-pgb.php?modo=mixto&error=1');
        exit();
    }

    public function handleContinuarReturn(array $session, ?int $fallbackOrdenId): array
    {
        $data = $session['continuar_result'] ?? [];
        unset($_SESSION['continuar_result']);

        try {
            return $this->service->procesarContinuarRetorno($data, $fallbackOrdenId);
        } catch (ValidationException $e) {
            header('Location: index.php');
            exit();
        }
    }
}
