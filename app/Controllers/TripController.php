<?php

namespace App\Controllers;

use App\Repositories\TripRepository;
use App\Repositories\AgencyRepository;
use App\Services\AuthService;

/**
 * Gestion des trajets.
 */
class TripController extends AbstractController
{
    public function create(): void
    {
        $this->requireLogin();

        $agencyRepository = new AgencyRepository();
        $agencies = $agencyRepository->findAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // (logique à venir)
            echo 'Trajet créé (temporaire)';
            return;
        }

        $this->render('trip/create', [
            'agencies' => $agencies
        ]);
    }
}
