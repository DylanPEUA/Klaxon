<?php

namespace App\Repositories;

use App\Database\Database;
use App\Models\Agency;
use PDO;

/**
 * Repository pour les agences.
 */
class AgencyRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Retourne toutes les agences.
     *
     * @return Agency[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT id, name FROM agencies ORDER BY name');
        $rows = $stmt->fetchAll();

        $agencies = [];

        foreach ($rows as $row) {
            $agencies[] = new Agency(
                (int) $row['id'],
                $row['name']
            );
        }

        return $agencies;
    }
}
