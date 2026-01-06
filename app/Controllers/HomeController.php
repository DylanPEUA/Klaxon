<?php

namespace App\Controllers;

use App\Repositories\TripRepository;

/**
 * Page d'accueil.
 */
class HomeController extends AbstractController
{
    public function index(): void
    {
        $tripRepository = new TripRepository();
        $trips = $tripRepository->findAvailableFutureTrips();

        $this->render('home', [
            'trips' => $trips
        ]);
    }
}
