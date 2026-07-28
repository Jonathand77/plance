<?php

require __DIR__ . '/../src/bootstrap.php';

use Plance\Support\Migrator;

$ejecutadas = Migrator::run();

if (empty($ejecutadas)) {
    echo "Sin migraciones pendientes.\n";
    exit(0);
}

foreach ($ejecutadas as $migracion) {
    echo "Aplicada: {$migracion}\n";
}
