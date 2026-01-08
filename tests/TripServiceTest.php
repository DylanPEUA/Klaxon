<?php

use PHPUnit\Framework\TestCase;
use App\Services\TripService;
use App\Models\Employee;

/**
 * Tests unitaires pour TripService.
 */
class TripServiceTest extends TestCase
{
    private TripService $service;
    private Employee $employee;

    protected function setUp(): void
    {
        $this->service = new TripService();
        $this->employee = new Employee(
            1,
            'Jean',
            'Dupont',
            'jean.dupont@test.fr',
            '0600000000',
            'USER'
        );
    }

    /**
     * Teste la création d'un trajet avec succès.
     */
    public function testCreateTripSuccess(): void
    {
        $data = [
            'departure_agency'   => 1,
            'arrival_agency'     => 2,
            'departure_datetime' => '2030-12-10 08:00:00',
            'arrival_datetime'   => '2030-12-10 12:00:00',
            'total_seats'        => 4
        ];

        $this->service->createTrip($data, $this->employee);

        $this->assertTrue(true);
    }

    /**
     * Teste la création d'un trajet avec la même agence de départ et d'arrivée.
     */
    public function testCreateTripSameAgencyThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Les agences doivent être différentes');

        $data = [
            'departure_agency'   => 1,
            'arrival_agency'     => 1,
            'departure_datetime' => '2030-12-10 08:00:00',
            'arrival_datetime'   => '2030-12-10 12:00:00',
            'total_seats'        => 4
        ];

        $this->service->createTrip($data, $this->employee);
    }

    /**
     * Teste la création d'un trajet avec une date d'arrivée avant la date de départ.
     */
    public function testCreateTripArrivalBeforeDepartureThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Arrivée avant départ');

        $data = [
            'departure_agency'   => 1,
            'arrival_agency'     => 2,
            'departure_datetime' => '2030-12-10 12:00:00',
            'arrival_datetime'   => '2030-12-10 08:00:00',
            'total_seats'        => 4
        ];

        $this->service->createTrip($data, $this->employee);
    }

    /**
     * Teste la création d'un trajet avec un nombre de places invalide.
     */
    public function testCreateTripInvalidSeatsThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Nombre de places invalide');

        $data = [
            'departure_agency'   => 1,
            'arrival_agency'     => 2,
            'departure_datetime' => '2030-12-10 08:00:00',
            'arrival_datetime'   => '2030-12-10 12:00:00',
            'total_seats'        => 0
        ];

        $this->service->createTrip($data, $this->employee);
    }
}
