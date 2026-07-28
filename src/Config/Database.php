<?php

namespace Plance\Config;

use PDO;
use PDOException;
use mysqli;

class Database
{
    private static ?PDO $pdo = null;
    private static ?mysqli $mysqli = null;

    public static function pdo(): PDO
    {
        if (self::$pdo === null) {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                Env::get('DB_HOST', 'localhost'),
                Env::get('DB_PORT', '3306'),
                Env::get('DB_NAME')
            );

            try {
                self::$pdo = new PDO($dsn, Env::get('DB_USER'), Env::get('DB_PASS'), [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
            } catch (PDOException $e) {
                throw new PDOException(
                    'Error de conexión a la base de datos: ' . $e->getMessage(),
                    (int) $e->getCode()
                );
            }
        }

        return self::$pdo;
    }

    /**
     * Conexión mysqli para el código legacy que aún no ha migrado a PDO.
     */
    public static function mysqli(): mysqli
    {
        if (self::$mysqli === null) {
            self::$mysqli = mysqli_connect(
                Env::get('DB_HOST', 'localhost'),
                Env::get('DB_USER'),
                Env::get('DB_PASS'),
                Env::get('DB_NAME'),
                (int) Env::get('DB_PORT', '3306')
            );

            if (!self::$mysqli) {
                die('Error de conexión: ' . mysqli_connect_error());
            }
        }

        return self::$mysqli;
    }
}
