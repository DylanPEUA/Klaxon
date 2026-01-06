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

    /**
     * Retourne l'identifiant du trajet.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Retourne l'agence de départ.
     */
    public function getDepartureAgency(): Agency
    {
        return $this->departureAgency;
    }

    /**
     * Retourne l'agence d'arrivée.
     */
    public function getArrivalAgency(): Agency
    {
        return $this->arrivalAgency;
    }

    /**
     * Retourne la date et heure de départ.
     */
    public function getDepartureDateTime(): DateTime
    {
        return $this->departureDateTime;
    }

    /**
     * Retourne la date et heure d'arrivée.
     */
    public function getArrivalDateTime(): DateTime
    {
        return $this->arrivalDateTime;
    }

    /**
     * Retourne le nombre total de places.
     */
    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }

    /**
     * Retourne le nombre de places disponibles.
     */
    public function getAvailableSeats(): int
    {
        return $this->availableSeats;
    }

    /**
     * Retourne l'employé contact du trajet.
     */
    public function getContact(): Employee
    {
        return $this->contact;
    }

    /**
     * Vérifie s'il reste des places disponibles.
     */
    public function hasAvailableSeats(): bool
    {
        return $this->availableSeats > 0;
    }
}
