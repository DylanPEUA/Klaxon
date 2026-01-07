<?php

namespace App\Repositories;

use App\Database\Database;
use App\Models\Trip;
use App\Models\Agency;
use App\Models\Employee;
use DateTime;
use PDO;

/**
 * Repository pour les trajets.
 */
class TripRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Enregistre un nouveau trajet en base de données.
     */
    public function save(Trip $trip): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO trips 
            (departure_agency_id, arrival_agency_id, departure_datetime, arrival_datetime, total_seats, available_seats, contact_employee_id)
            VALUES (:dep, :arr, :dep_dt, :arr_dt, :total, :avail, :emp)'
        );

        $stmt->execute([
            'dep' => $trip->getDepartureAgency()->getId(),
            'arr' => $trip->getArrivalAgency()->getId(),
            'dep_dt' => $trip->getDepartureDateTime()->format('Y-m-d H:i:s'),
            'arr_dt' => $trip->getArrivalDateTime()->format('Y-m-d H:i:s'),
            'total' => $trip->getTotalSeats(),
            'avail' => $trip->getAvailableSeats(),
            'emp' => $trip->getContact()->getId(),
        ]);
    }

    /**
     * Retourne tous les trajets (pour l'admin).
     *
     * @return Trip[]
     */
    public function findAll(): array
    {
        $sql = '
            SELECT
                t.*,
                da.id AS dep_id,
                da.name AS dep_name,
                aa.id AS arr_id,
                aa.name AS arr_name,
                e.id AS emp_id,
                e.firstname,
                e.lastname,
                e.email,
                e.phone,
                e.role
            FROM trips t
            JOIN agencies da ON da.id = t.departure_agency_id
            JOIN agencies aa ON aa.id = t.arrival_agency_id
            JOIN employees e ON e.id = t.contact_employee_id
            ORDER BY t.departure_datetime DESC
        ';

        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();

        return $this->hydrateTrips($rows);
    }

    /**
     * Retourne les trajets futurs avec des places disponibles.
     *
     * @return Trip[]
     */
    public function findAvailableFutureTrips(): array
    {
        $sql = '
            SELECT
                t.*,
                da.id AS dep_id,
                da.name AS dep_name,
                aa.id AS arr_id,
                aa.name AS arr_name,
                e.id AS emp_id,
                e.firstname,
                e.lastname,
                e.email,
                e.phone,
                e.role
            FROM trips t
            JOIN agencies da ON da.id = t.departure_agency_id
            JOIN agencies aa ON aa.id = t.arrival_agency_id
            JOIN employees e ON e.id = t.contact_employee_id
            WHERE t.available_seats > 0
              AND t.departure_datetime > NOW()
            ORDER BY t.departure_datetime ASC
        ';

        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();

        return $this->hydrateTrips($rows);
    }

    /**
     * Trouve un trajet par son identifiant.
     */
    public function find(int $id): ?Trip
    {
        $sql = '
            SELECT
                t.*,
                da.id AS dep_id,
                da.name AS dep_name,
                aa.id AS arr_id,
                aa.name AS arr_name,
                e.id AS emp_id,
                e.firstname,
                e.lastname,
                e.email,
                e.phone,
                e.role
            FROM trips t
            JOIN agencies da ON da.id = t.departure_agency_id
            JOIN agencies aa ON aa.id = t.arrival_agency_id
            JOIN employees e ON e.id = t.contact_employee_id
            WHERE t.id = :id
        ';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return $this->hydrateTrip($row);
    }

    /**
     * Met à jour un trajet existant.
     */
    public function update(Trip $trip): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE trips SET
                departure_agency_id = :dep,
                arrival_agency_id = :arr,
                departure_datetime = :dep_dt,
                arrival_datetime = :arr_dt,
                total_seats = :total,
                available_seats = :avail
            WHERE id = :id'
        );

        $stmt->execute([
            'id' => $trip->getId(),
            'dep' => $trip->getDepartureAgency()->getId(),
            'arr' => $trip->getArrivalAgency()->getId(),
            'dep_dt' => $trip->getDepartureDateTime()->format('Y-m-d H:i:s'),
            'arr_dt' => $trip->getArrivalDateTime()->format('Y-m-d H:i:s'),
            'total' => $trip->getTotalSeats(),
            'avail' => $trip->getAvailableSeats(),
        ]);
    }

    /**
     * Supprime un trajet par son identifiant.
     */
    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM trips WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }

    /**
     * Hydrate un tableau de trajets.
     *
     * @param array<int, array<string, mixed>> $rows
     * @return Trip[]
     */
    private function hydrateTrips(array $rows): array
    {
        $trips = [];

        foreach ($rows as $row) {
            $trips[] = $this->hydrateTrip($row);
        }

        return $trips;
    }

    /**
     * Hydrate un trajet à partir d'une ligne de résultat.
     *
     * @param array<string, mixed> $row
     */
    private function hydrateTrip(array $row): Trip
    {
        return new Trip(
            (int) $row['id'],
            new Agency((int) $row['dep_id'], $row['dep_name']),
            new Agency((int) $row['arr_id'], $row['arr_name']),
            new DateTime($row['departure_datetime']),
            new DateTime($row['arrival_datetime']),
            (int) $row['total_seats'],
            (int) $row['available_seats'],
            new Employee(
                (int) $row['emp_id'],
                $row['firstname'],
                $row['lastname'],
                $row['email'],
                $row['phone'],
                $row['role']
            )
        );
    }
}
