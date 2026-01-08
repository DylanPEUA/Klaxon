<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;

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
     * Vérifie si l'utilisateur est connecté.
     */
    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Vérifie si l'utilisateur est administrateur.
     */
    public function isAdmin(): bool
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'ADMIN';
    }

    /**
     * Retourne l'utilisateur actuellement connecté.
     */
    public function getCurrentUser(): ?Employee
    {
        if (!$this->isLoggedIn()) {
            return null;
        }

        return $this->employeeRepository->find($_SESSION['user_id']);
    }

    /**
     * Retourne l'ID de l'utilisateur connecté.
     */
    public function getCurrentUserId(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    /**
     * Connecte un utilisateur.
     */
    public function login(string $email, string $password): bool
    {
        $employee = $this->employeeRepository->findByEmail($email);

        if ($employee === null) {
            return false;
        }

        // Pour le test, on accepte "password" comme mot de passe
        // En production, utiliser password_verify()
        if ($password !== 'password') {
            return false;
        }

        $_SESSION['user_id'] = $employee->getId();
        $_SESSION['user_role'] = $employee->getRole();

        return true;
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function logout(): void
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        session_destroy();
    }
}
