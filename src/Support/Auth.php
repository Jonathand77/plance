<?php

namespace Plance\Support;

/**
 * Centraliza la verificación de acceso a páginas que requieren sesión:
 * un usuario logueado o alguien navegando en modo invitado (sin cuenta).
 */
class Auth
{
    public static function puedeAcceder(): bool
    {
        return isset($_SESSION['usuario']) || !empty($_SESSION['invitado']);
    }

    public static function esInvitado(): bool
    {
        return !isset($_SESSION['usuario']) && !empty($_SESSION['invitado']);
    }
}
