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

    /**
     * Trouve une agence par son identifiant.
     */
    public function find(int $id): ?Agency
    {
        $stmt = $this->pdo->prepare('SELECT id, name FROM agencies WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Agency(
            (int) $row['id'],
            $row['name']
        );
    }

    /**
     * Enregistre une nouvelle agence en base de données.
     */
    public function save(Agency $agency): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO agencies (name) VALUES (:name)');
        $stmt->execute(['name' => $agency->getName()]);
    }

    /**
     * Met à jour une agence existante.
     */
    public function update(Agency $agency): void
    {
        $stmt = $this->pdo->prepare('UPDATE agencies SET name = :name WHERE id = :id');
        $stmt->execute([
            'id' => $agency->getId(),
            'name' => $agency->getName()
        ]);
    }

    /**
     * Supprime une agence par son identifiant.
     */
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM agencies WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
