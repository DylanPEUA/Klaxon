<?php

namespace App\Models;

/**
 * Class Employee
 *
 * Représente un employé issu du système RH.
 */
class Employee
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;
    private ?string $phone;
    private string $role;

    public function __construct(
        int $id,
        string $firstname,
        string $lastname,
        string $email,
        ?string $phone,
        string $role
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->role = $role;
    }

    /**
     * Retourne l'identifiant de l'employé.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retourne le prénom de l'employé.
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Retourne le nom de famille de l'employé.
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Retourne le nom complet de l'employé.
     */
    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * Retourne l'email de l'employé.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Retourne le numéro de téléphone de l'employé.
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Retourne le rôle de l'employé.
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Vérifie si l'employé est administrateur.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }
}
