<?php

namespace Plance\Services\Profile;

use Plance\Repositories\UserPreferenceRepository;

/**
 * Preferencia de tema claro/oscuro. Para usuarios logueados se persiste en BD
 * (user_preferences); para invitados sólo en la sesión, ya que no tienen cuenta.
 */
class ThemeService
{
    public function __construct(private UserPreferenceRepository $preferencias = new UserPreferenceRepository())
    {
    }

    public function obtener(string $correo, bool $esInvitado): string
    {
        if ($esInvitado || $correo === '') {
            return $_SESSION['tema_invitado'] ?? 'oscuro';
        }

        return $this->preferencias->obtenerTema($correo) ?? 'oscuro';
    }

    public function guardar(string $correo, bool $esInvitado, string $temaSolicitado): string
    {
        $tema = $temaSolicitado === 'claro' ? 'claro' : 'oscuro';

        if ($esInvitado || $correo === '') {
            $_SESSION['tema_invitado'] = $tema;

            return $tema;
        }

        $this->preferencias->guardarTema($correo, $tema);

        return $tema;
    }
}
