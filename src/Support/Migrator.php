<?php

namespace Plance\Support;

use PDO;
use Plance\Config\Database;

class Migrator
{
    public static function run(): array
    {
        $pdo = Database::pdo();

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS migrations (
                id INT NOT NULL AUTO_INCREMENT,
                migration VARCHAR(255) NOT NULL,
                applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id),
                UNIQUE KEY migration (migration)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
        );

        $applied = $pdo->query('SELECT migration FROM migrations')->fetchAll(PDO::FETCH_COLUMN);

        $files = glob(dirname(__DIR__, 2) . '/database/migrations/*.sql');
        sort($files);

        $ejecutadas = [];
        $insert = $pdo->prepare('INSERT INTO migrations (migration) VALUES (:migration)');

        foreach ($files as $file) {
            $nombre = basename($file);

            if (in_array($nombre, $applied, true)) {
                continue;
            }

            $pdo->exec(file_get_contents($file));
            $insert->execute(['migration' => $nombre]);
            $ejecutadas[] = $nombre;
        }

        return $ejecutadas;
    }
}
