<?php

namespace App\Controllers;

use App\Repositories\TripRepository;

/**
 * Page d'accueil.
 */
class HomeController extends AbstractController
{
    /**
     * Affiche la page d'accueil avec les trajets disponibles.
     */
    public function index(): void
    {
        $tripRepository = new TripRepository();
        $trips = $tripRepository->findAvailableFutureTrips();

        $this->render('home', [
            'trips' => $trips
        ]);
    }
}
