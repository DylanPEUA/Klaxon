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

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFullName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'ADMIN';
    }
}
