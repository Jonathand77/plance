<?php

namespace Plance\Services\Payments;

use Plance\Config\Env;

class PlaceToPayCredentials
{
    public static function login(string $tipo = 'estandar'): string
    {
        return (string) Env::get('P2P_LOGIN_' . strtoupper($tipo), '');
    }

    public static function secretKey(string $tipo = 'estandar'): string
    {
        return (string) Env::get('P2P_SECRET_' . strtoupper($tipo), '');
    }
}
