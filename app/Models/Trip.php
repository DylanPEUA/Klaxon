<?php

namespace App\Models;

use DateTime;

/**
 * Class Trip
 *
 * Représente un trajet de covoiturage.
 */
class Trip
{
    private int $id;
    private Agency $departureAgency;
    private Agency $arrivalAgency;
    private DateTime $departureDateTime;
    private DateTime $arrivalDateTime;
    private int $totalSeats;
    private int $availableSeats;
    private Employee $contact;

    public function __construct(
        int $id,
        Agency $departureAgency,
        Agency $arrivalAgency,
        DateTime $departureDateTime,
        DateTime $arrivalDateTime,
        int $totalSeats,
        int $availableSeats,
        Employee $contact
    ) {
        $this->id = $id;
        $this->departureAgency = $departureAgency;
        $this->arrivalAgency = $arrivalAgency;
        $this->departureDateTime = $departureDateTime;
        $this->arrivalDateTime = $arrivalDateTime;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $availableSeats;
        $this->contact = $contact;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDepartureAgency(): Agency
    {
        return $this->departureAgency;
    }

    public function getArrivalAgency(): Agency
    {
        return $this->arrivalAgency;
    }

    public function getDepartureDateTime(): DateTime
    {
        return $this->departureDateTime;
    }

    public function getArrivalDateTime(): DateTime
    {
        return $this->arrivalDateTime;
    }

    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }

    public function getAvailableSeats(): int
    {
        return $this->availableSeats;
    }

    public function getContact(): Employee
    {
        return $this->contact;
    }

    public function hasAvailableSeats(): bool
    {
        return $this->availableSeats > 0;
    }
}
