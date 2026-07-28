<?php

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    // Fallback mientras no se haya corrido `composer install` (ver README/plan de refactor).
    spl_autoload_register(function (string $class): void {
        $prefix = 'Plance\\';

        if (!str_starts_with($class, $prefix)) {
            return;
        }

        $relative = substr($class, strlen($prefix));
        $path = __DIR__ . '/' . str_replace('\\', '/', $relative) . '.php';

        if (is_file($path)) {
            require $path;
        }
    });
}

\Plance\Config\Env::load();
