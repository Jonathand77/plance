<?php

namespace Plance\Config;

class Env
{
    private static bool $loaded = false;

    public static function load(string $path = null): void
    {
        if (self::$loaded) {
            return;
        }

        $path = $path ?? dirname(__DIR__, 2) . '/.env';

        if (!is_file($path)) {
            self::$loaded = true;
            return;
        }

        foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (!str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if (strlen($value) >= 2 && in_array($value[0], ["'", '"'], true) && $value[-1] === $value[0]) {
                $value = substr($value, 1, -1);
            }

            if (getenv($key) === false) {
                putenv("$key=$value");
                $_ENV[$key] = $value;
            }
        }

        self::$loaded = true;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        self::load();

        $value = getenv($key);

        return $value === false ? $default : $value;
    }
}
