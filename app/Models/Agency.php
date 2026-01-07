<?php

namespace App\Models;

/**
 * Class Agency
 *
 * Représente une agence (ville).
 */
class Agency
{
    private ?int $id;
    private string $name;

    /**
     * @param int|null $id
     * @param string $name
     */
    public function __construct(?int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Retourne l'identifiant de l'agence.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Retourne le nom de l'agence.
     */
    public function getName(): string
    {
        return $this->name;
    }
}
