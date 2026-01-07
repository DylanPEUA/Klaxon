<?php

namespace App\Services;

use App\Models\Agency;
use App\Repositories\AgencyRepository;
use InvalidArgumentException;

/**
 * Service de gestion des agences.
 */
class AgencyService
{
    private AgencyRepository $agencyRepository;

    public function __construct()
    {
        $this->agencyRepository = new AgencyRepository();
    }

    /**
     * Retourne toutes les agences.
     *
     * @return Agency[]
     */
    public function getAllAgencies(): array
    {
        return $this->agencyRepository->findAll();
    }

    /**
     * Retourne une agence par son identifiant.
     */
    public function getAgency(int $id): ?Agency
    {
        return $this->agencyRepository->find($id);
    }

    /**
     * Crée une nouvelle agence.
     *
     * @param array<string, mixed> $data
     */
    public function createAgency(array $data): void
    {
        $name = trim($data['name'] ?? '');

        if ($name === '') {
            throw new InvalidArgumentException('Le nom de l\'agence est obligatoire.');
        }

        $agency = new Agency(null, $name);
        $this->agencyRepository->save($agency);
    }

    /**
     * Met à jour une agence existante.
     *
     * @param array<string, mixed> $data
     */
    public function updateAgency(int $id, array $data): void
    {
        $agency = $this->agencyRepository->find($id);

        if ($agency === null) {
            throw new InvalidArgumentException('Agence introuvable.');
        }

        $name = trim($data['name'] ?? '');

        if ($name === '') {
            throw new InvalidArgumentException('Le nom de l\'agence est obligatoire.');
        }

        $updatedAgency = new Agency($id, $name);
        $this->agencyRepository->update($updatedAgency);
    }

    /**
     * Supprime une agence.
     */
    public function deleteAgency(int $id): void
    {
        $agency = $this->agencyRepository->find($id);

        if ($agency === null) {
            throw new InvalidArgumentException('Agence introuvable.');
        }

        $this->agencyRepository->delete($id);
    }
}