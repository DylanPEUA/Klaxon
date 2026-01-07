<?php

use PHPUnit\Framework\TestCase;
use App\Services\AgencyService;

/**
 * Tests unitaires pour AgencyService.
 */
class AgencyServiceTest extends TestCase
{
    private AgencyService $service;

    protected function setUp(): void
    {
        $this->service = new AgencyService();
    }

    /**
     * Teste la création d'une agence avec succès.
     */
    public function testCreateAgencySuccess(): void
    {
        $data = ['name' => 'Test Agency ' . uniqid()];

        $this->service->createAgency($data);

        $this->assertTrue(true);
    }

    /**
     * Teste la création d'une agence avec un nom vide.
     */
    public function testCreateAgencyEmptyNameThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de l\'agence est obligatoire.');

        $data = ['name' => ''];

        $this->service->createAgency($data);
    }

    /**
     * Teste la création d'une agence avec un nom contenant uniquement des espaces.
     */
    public function testCreateAgencyWhitespaceNameThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de l\'agence est obligatoire.');

        $data = ['name' => '   '];

        $this->service->createAgency($data);
    }

    /**
     * Teste la mise à jour d'une agence inexistante.
     */
    public function testUpdateAgencyNotFoundThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Agence introuvable.');

        $this->service->updateAgency(99999, ['name' => 'Test']);
    }

    /**
     * Teste la suppression d'une agence inexistante.
     */
    public function testDeleteAgencyNotFoundThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Agence introuvable.');

        $this->service->deleteAgency(99999);
    }
}