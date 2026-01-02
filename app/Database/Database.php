<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $pdo = null;

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $config = require __DIR__ . '/../../config/database.php';

            try {
                self::$pdo = new PDO(
                    'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
                    $config['user'],
                    $config['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données');
            }
        }

        return self::$pdo;
    }
}

?>
