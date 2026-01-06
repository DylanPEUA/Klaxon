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

        $trips = [];

        foreach ($rows as $row) {
            $trips[] = new Trip(
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

        return $trips;
    }
}
