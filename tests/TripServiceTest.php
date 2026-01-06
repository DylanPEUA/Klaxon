<?php

use PHPUnit\Framework\TestCase;
use App\Services\TripService;
use App\Models\Employee;

class TripServiceTest extends TestCase
{
    public function testCreateTripSuccess(): void
    {
        $service = new TripService();

        $employee = new Employee(
            1,
            'Jean',
            'Dupont',
            'jean.dupont@test.fr',
            '0600000000',
            'USER'
        );

        $data = [
            'departure_agency'   => 1,
            'arrival_agency'     => 2,
            'departure_datetime' => '2025-12-10 08:00:00',
            'arrival_datetime'   => '2025-12-10 12:00:00',
            'total_seats'        => 4
        ];

        $service->createTrip($data, $employee);

        $this->assertTrue(true); // Test passe sans exception
    }
}
