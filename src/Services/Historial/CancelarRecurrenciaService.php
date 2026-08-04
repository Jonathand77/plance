<?php

namespace Plance\Services\Historial;

use Plance\Repositories\Contracts\RecurrenciaRepositoryInterface;
use Plance\Repositories\Contracts\SuscriptionRecRepositoryInterface;
use Plance\Services\Historial\Exceptions\RecurrenciaNoCancelableException;

class CancelarRecurrenciaService
{
    public function __construct(
        private RecurrenciaRepositoryInterface|SuscriptionRecRepositoryInterface $repositorio
    ) {
    }

    public function cancelar(int $recId, string $usuarioCorreo): array
    {
        $rec = $this->repositorio->findByIdYUsuarioId($recId, $usuarioCorreo);

        if ($rec === null) {
            throw new RecurrenciaNoCancelableException(
                '❌ No se encontró el servicio o no tienes permisos para cancelarlo.'
            );
        }

        if (strtolower($rec['estado']) !== 'aprobada') {
            throw new RecurrenciaNoCancelableException(
                '❌ Solo se pueden cancelar servicios activos (aprobados).'
            );
        }

        $this->repositorio->updateEstado($recId, 'cancelada');

        return [
            'servicio' => $rec['servicio'],
            'plan' => $rec['plan'],
        ];
    }
}
