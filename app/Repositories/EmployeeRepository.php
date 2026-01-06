<?php

namespace App\Repository;

use App\Database\Database;
use App\Models\Employee;
use PDO;

/**
 * Repository pour les employés.
 */
class EmployeeRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Trouve un employé par email.
     */
    public function findByEmail(string $email): ?Employee
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, firstname, lastname, email, phone, role
             FROM employees
             WHERE email = :email'
        );

        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if (!$row) {
            return null;
        }

        return new Employee(
            (int) $row['id'],
            $row['firstname'],
            $row['lastname'],
            $row['email'],
            $row['phone'],
            $row['role']
        );
    }
}
