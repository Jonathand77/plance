<?php

namespace Plance\Controllers\Historial;

use Plance\Repositories\OrdenRepository;
use Plance\Repositories\RecurrenciaRepository;
use Plance\Repositories\SuscripcionRepository;
use Plance\Services\Historial\Exceptions\TransaccionNoEncontradaException;
use Plance\Services\Historial\Exceptions\ValidationException;
use Plance\Services\Historial\ReversoService;

class ReversosController
{
    private ReversoService $service;

    public function __construct(?ReversoService $service = null)
    {
        $this->service = $service ?? new ReversoService(
            new OrdenRepository(),
            new SuscripcionRepository(),
            new RecurrenciaRepository()
        );
    }

    public function handleList(): array
    {
        $correo = $_SESSION['correo'] ?? '';

        $msg = $_SESSION['reverso_msg'] ?? '';
        $msgType = $_SESSION['reverso_msg_type'] ?? '';
        unset($_SESSION['reverso_msg'], $_SESSION['reverso_msg_type']);

        return [
            'transacciones' => $this->service->listarAprobadas($correo),
            'msg' => $msg,
            'msgType' => $msgType,
        ];
    }

    public function handleDetalle(array $get): array
    {
        $id = (int) ($get['id'] ?? 0);
        $tipo = (string) ($get['tipo'] ?? '');
        $correo = $_SESSION['correo'] ?? '';

        try {
            $detalle = $this->service->obtenerDetalle($tipo, $id, $correo);
        } catch (ValidationException | TransaccionNoEncontradaException $e) {
            header('Location: reversos.php');
            exit();
        }

        $msg = $_SESSION['reverso_msg'] ?? '';
        $msgType = $_SESSION['reverso_msg_type'] ?? '';
        unset($_SESSION['reverso_msg'], $_SESSION['reverso_msg_type']);

        return [
            'id' => $id,
            'tipo' => $tipo,
            'trx' => $detalle['trx'],
            'nombre' => $detalle['nombre'],
            'usuario' => $detalle['usuario'],
            'msg' => $msg,
            'msgType' => $msgType,
        ];
    }

    public function handleReversar(array $get): void
    {
        $id = (int) ($get['id'] ?? 0);
        $tipo = (string) ($get['tipo'] ?? '');
        $correo = $_SESSION['correo'] ?? '';

        try {
            $resultado = $this->service->reversar($tipo, $id, $correo);
        } catch (ValidationException | TransaccionNoEncontradaException $e) {
            $_SESSION['reverso_msg'] = '❌ No se encontró la transacción o no tienes permisos para reversarla.';
            $_SESSION['reverso_msg_type'] = 'error';
            header('Location: ../historial/reversos.php');
            exit();
        }

        $_SESSION['reverso_msg'] = '✅ Transacción #' . $id . ' (' . $resultado['nombre']
            . ') reversada correctamente. El dinero será devuelto al cliente.';
        $_SESSION['reverso_msg_type'] = 'success';
        header('Location: ../historial/reversos.php');
        exit();
    }
}
