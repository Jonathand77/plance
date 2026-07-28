<?php

namespace Plance\Services\Historial;

use Plance\Repositories\Contracts\RecurrenciaRepositoryInterface;
use Plance\Services\Historial\Exceptions\RecurrenciaNoCancelableException;

class CancelarRecurrenciaService
{
    public function __construct(private RecurrenciaRepositoryInterface $recurrencias)
    {
    }

    public function cancelar(int $recId, string $usuarioCorreo): array
    {
        $rec = $this->recurrencias->findByIdYUsuarioId($recId, $usuarioCorreo);

        if ($rec === null) {
            throw new RecurrenciaNoCancelableException(
                '❌ No se encontró la membresía o no tienes permisos para cancelarla.'
            );
        }

        if (strtolower($rec['estado']) !== 'aprobada') {
            throw new RecurrenciaNoCancelableException(
                '❌ Solo se pueden cancelar membresías activas (aprobadas).'
            );
        }

        $this->recurrencias->updateEstado($recId, 'cancelada');

        return [
            'servicio' => $rec['servicio'],
            'plan' => $rec['plan'],
        ];
    }
}
