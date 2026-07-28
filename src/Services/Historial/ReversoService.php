<?php

namespace Plance\Services\Historial;

use Plance\Repositories\Contracts\OrdenRepositoryInterface;
use Plance\Repositories\Contracts\RecurrenciaRepositoryInterface;
use Plance\Repositories\Contracts\SuscripcionRepositoryInterface;
use Plance\Services\Historial\Exceptions\TransaccionNoEncontradaException;
use Plance\Services\Historial\Exceptions\ValidationException;

class ReversoService
{
    private const TIPOS_PERMITIDOS = ['orden', 'suscripcion', 'recurrencia'];

    public function __construct(
        private OrdenRepositoryInterface $ordenes,
        private SuscripcionRepositoryInterface $suscripciones,
        private RecurrenciaRepositoryInterface $recurrencias
    ) {
    }

    public function listarAprobadas(string $correo): array
    {
        $transacciones = [
            ...$this->ordenes->findAprobadasByCorreo($correo),
            ...$this->suscripciones->findAprobadasByUsuarioId($correo),
            ...$this->recurrencias->findAprobadasByUsuarioId($correo),
        ];

        usort($transacciones, fn (array $a, array $b) => strtotime($b['created_at']) <=> strtotime($a['created_at']));

        return $transacciones;
    }

    public function obtenerDetalle(string $tipo, int $id, string $correo): array
    {
        $trx = $this->buscarTransaccion($tipo, $id, $correo);

        if ($trx === null) {
            throw new TransaccionNoEncontradaException();
        }

        return [
            'trx' => $trx,
            'nombre' => $this->nombrePara($tipo, $trx),
            'usuario' => $this->usuarioPara($tipo, $trx),
        ];
    }

    public function reversar(string $tipo, int $id, string $correo): array
    {
        $trx = $this->buscarTransaccion($tipo, $id, $correo);

        if ($trx === null) {
            throw new TransaccionNoEncontradaException();
        }

        $nombre = $this->nombrePara($tipo, $trx);

        match ($tipo) {
            'orden' => $this->ordenes->updateEstado($id, 'reversada'),
            'suscripcion' => $this->suscripciones->updateEstado($id, 'reversada'),
            'recurrencia' => $this->recurrencias->updateEstado($id, 'reversada'),
        };

        return ['nombre' => $nombre];
    }

    private function buscarTransaccion(string $tipo, int $id, string $correo): ?array
    {
        if (!in_array($tipo, self::TIPOS_PERMITIDOS, true)) {
            throw new ValidationException();
        }

        return match ($tipo) {
            'orden' => $this->ordenes->findByIdAprobadaYCorreo($id, $correo),
            'suscripcion' => $this->suscripciones->findByIdAprobadaYUsuarioId($id, $correo),
            'recurrencia' => $this->recurrencias->findByIdAprobadaYUsuarioId($id, $correo),
        };
    }

    private function nombrePara(string $tipo, array $trx): string
    {
        return match ($tipo) {
            'orden' => $trx['producto'] ?? '',
            'suscripcion' => ($trx['plataforma'] ?? '') . ' — ' . ($trx['plan'] ?? ''),
            'recurrencia' => ($trx['servicio'] ?? '') . ' — ' . ($trx['plan'] ?? ''),
        };
    }

    private function usuarioPara(string $tipo, array $trx): string
    {
        return match ($tipo) {
            'orden' => $trx['jugador_id'] ?? '',
            default => $trx['usuario_id'] ?? '',
        };
    }
}
