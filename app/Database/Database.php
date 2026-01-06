<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Connexion à la base de données (Singleton).
 */
class Database
{
    private static ?PDO $pdo = null;

    /**
     * Retourne l'instance PDO de connexion à la base de données.
     */
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
