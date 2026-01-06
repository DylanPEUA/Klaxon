<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use App\Models\Employee;

/**
 * Service d'authentification.
 */
class AuthService
{
    private EmployeeRepository $employeeRepository;

    public function __construct()
    {
        $this->employeeRepository = new EmployeeRepository();
    }

    /**
     * Tente de connecter un utilisateur.
     */
    public function login(string $email, string $password): bool
    {
        $employee = $this->employeeRepository->findByEmail($email);

        if (!$employee) {
            return false;
        }

        // ⚠️ Password simplifié pour le projet (seed)
        if ($password !== 'password') {
            return false;
        }

        $_SESSION['user'] = [
            'id' => $employee->getId(),
            'firstname' => $employee->getFirstname(),
            'lastname' => $employee->getLastname(),
            'email' => $employee->getEmail(),
            'role' => $employee->getRole(),
        ];

        return true;
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(): void
    {
        unset($_SESSION['user']);
    }

    /**
     * Retourne l'utilisateur connecté.
     *
     * @return array{
     *     id: int,
     *     firstname: string,
     *     lastname: string,
     *     email: string,
     *     role: string
     * }|null
     */
    public function getUser(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Vérifie si un utilisateur est connecté.
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Vérifie si l'utilisateur connecté est administrateur.
     */
    public function isAdmin(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'ADMIN';
    }
}
