<?php

namespace Plance\Controllers\Dispersiones;

use Plance\Repositories\DispersionRepository;
use Plance\Services\Dispersiones\DispersionService;
use Plance\Services\Dispersiones\Exceptions\DispersionNotFoundException;
use Plance\Services\Dispersiones\Exceptions\ValidationException;

class DispersionController
{
    private DispersionService $service;

    public function __construct(?DispersionService $service = null)
    {
        $this->service = $service ?? new DispersionService(new DispersionRepository());
    }

    public function handleCreate(array $post): void
    {
        $correo = $_SESSION['correo'] ?? '';

        try {
            $result = $this->service->crear($post, $correo);
        } catch (ValidationException $e) {
            die($e->getMessage());
        }

        if ($result['status'] === 'OK' && $result['processUrl']) {
            header('Location: ' . $result['processUrl']);
            exit();
        }

        header('Location: ../retorno_dispersion.php?disp_id=' . $result['dispersionId'] . '&error=1');
        exit();
    }

    public function handleReturn(array $get): array
    {
        $dispersionId = (int) ($get['disp_id'] ?? 0);

        if (!$dispersionId) {
            header('Location: index.php');
            exit();
        }

        try {
            return $this->service->procesarRetorno($dispersionId);
        } catch (DispersionNotFoundException $e) {
            header('Location: index.php');
            exit();
        }
    }
}
