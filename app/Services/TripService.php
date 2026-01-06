<?php

namespace App\Services;

use App\Models\Trip;
use App\Models\Agency;
use App\Models\Employee;
use App\Repositories\TripRepository;
use App\Repositories\AgencyRepository;
use DateTime;
use InvalidArgumentException;

/**
 * Gestion métier des trajets.
 */
class TripService
{
    private TripRepository $tripRepository;
    private AgencyRepository $agencyRepository;

    public function __construct()
    {
        $this->tripRepository = new TripRepository();
        $this->agencyRepository = new AgencyRepository();
    }

    /**
     * Crée un trajet.
     *
     * @param array<string, mixed> $data
     */
    public function createTrip(array $data, Employee $employee): void
    {
        if ($data['departure_agency'] === $data['arrival_agency']) {
            throw new InvalidArgumentException('Les agences doivent être différentes');
        }

        $departure = new DateTime($data['departure_datetime']);
        $arrival   = new DateTime($data['arrival_datetime']);

        if ($arrival <= $departure) {
            throw new InvalidArgumentException('Arrivée avant départ');
        }

        if ((int) $data['total_seats'] <= 0) {
            throw new InvalidArgumentException('Nombre de places invalide');
        }

        // 🔎 agences via findAll()
        $departureAgency = null;
        $arrivalAgency   = null;

        foreach ($this->agencyRepository->findAll() as $agency) {
            if ($agency->getId() === (int) $data['departure_agency']) {
                $departureAgency = $agency;
            }

            if ($agency->getId() === (int) $data['arrival_agency']) {
                $arrivalAgency = $agency;
            }
        }

        if (!$departureAgency || !$arrivalAgency) {
            throw new InvalidArgumentException('Agence invalide');
        }

        $trip = new Trip(
            0, 
            $departureAgency,
            $arrivalAgency,
            $departure,
            $arrival,
            (int) $data['total_seats'],
            (int) $data['total_seats'],
            $employee
        );

        $this->tripRepository->save($trip);
    }

}
