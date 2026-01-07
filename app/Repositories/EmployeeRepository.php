<?php

namespace App\Repositories;

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
     * Retourne tous les employés.
     *
     * @return Employee[]
     */
    public function findAll(): array
    {
        $stmt = $this->pdo->query(
            'SELECT id, firstname, lastname, email, phone, role
             FROM employees
             ORDER BY lastname, firstname'
        );
        $rows = $stmt->fetchAll();

        $employees = [];

        foreach ($rows as $row) {
            $employees[] = new Employee(
                (int) $row['id'],
                $row['firstname'],
                $row['lastname'],
                $row['email'],
                $row['phone'],
                $row['role']
            );
        }

        return $employees;
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

    /**
     * Trouve un employé par ID.
     */
    public function find(int $id): ?Employee
    {
        $stmt = $this->pdo->prepare(
            'SELECT id, firstname, lastname, email, phone, role
             FROM employees
             WHERE id = :id'
        );

        $stmt->execute(['id' => $id]);
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
