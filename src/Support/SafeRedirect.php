<?php

namespace Plance\Support;

/**
 * Evita "open redirect": solo permite redirigir a rutas relativas dentro del propio
 * sitio. Si el candidato apunta a otro host (http://, https://, //host) se usa el default.
 */
class SafeRedirect
{
    public static function resolve(?string $candidate, string $default): string
    {
        if ($candidate === null || $candidate === '') {
            return $default;
        }

        if (preg_match('#^([a-z][a-z0-9+.-]*:)?//#i', $candidate) || str_contains($candidate, '\\')) {
            return $default;
        }

        return $candidate;
    }
}
