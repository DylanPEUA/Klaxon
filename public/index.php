<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Database\Database;

try {
    $pdo = Database::getConnection();
    echo 'Connexion DB OK';
} catch (Throwable $e) {
    echo 'Erreur de connexion DB';
}