<?php

namespace Plance\Repositories\Contracts;

/**
 * Contrato mínimo compartido por los repositorios de transacciones de pago,
 * usado por VerificarPagoService para actualizar el estado sin conocer la tabla concreta.
 */
interface ActualizaEstadoInterface
{
    public function updateEstado(int $id, string $estado): void;
}
