<?php

namespace App\Controllers;

use App\Repositories\AgencyRepository;
use App\Repositories\EmployeeRepository;
use App\Services\AuthService;
use App\Services\TripService;
use InvalidArgumentException;

/**
 * Gestion des trajets.
 */
class TripController extends AbstractController
{
    /**
     * Affiche le formulaire de création de trajet et traite la soumission.
     */
    public function create(): void
    {
        $this->requireLogin();

        $service = new TripService();
        $auth = new AuthService();
        $employeeRepository = new EmployeeRepository();
        
        $employee = $auth->getCurrentUser();
        
        if ($employee === null) {
            $this->redirect('/?route=login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $service->createTrip($_POST, $employee);
                $this->redirect('/');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        $agencyRepository = new AgencyRepository();

        $this->render('trip/create', [
            'agencies' => $agencyRepository->findAll(),
            'employee' => $employee,
            'error' => $error ?? null
        ]);
    }

    /**
     * Affiche le formulaire de modification de trajet et traite la soumission.
     */
    public function edit(): void
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $service = new TripService();
        $auth = new AuthService();

        $trip = $service->getTrip($id);

        if ($trip === null) {
            http_response_code(404);
            echo 'Trajet introuvable';
            return;
        }

        // Vérifier que l'utilisateur est le propriétaire du trajet ou admin
        $currentUserId = $auth->getCurrentUserId();
        $isAdmin = $auth->isAdmin();
        
        if ($trip->getContact()->getId() !== $currentUserId && !$isAdmin) {
            http_response_code(403);
            echo 'Accès interdit';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $service->updateTrip($id, $_POST);
                $this->redirect('/');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        $agencyRepository = new AgencyRepository();

        $this->render('trip/edit', [
            'trip' => $trip,
            'agencies' => $agencyRepository->findAll(),
            'error' => $error ?? null
        ]);
    }

    /**
     * Supprime un trajet.
     */
    public function delete(): void
    {
        $this->requireLogin();

        $id = (int) ($_GET['id'] ?? 0);
        $service = new TripService();
        $auth = new AuthService();

        $trip = $service->getTrip($id);

        if ($trip === null) {
            http_response_code(404);
            echo 'Trajet introuvable';
            return;
        }

        // Vérifier que l'utilisateur est le propriétaire du trajet ou admin
        $currentUserId = $auth->getCurrentUserId();
        $isAdmin = $auth->isAdmin();
        
        if ($trip->getContact()->getId() !== $currentUserId && !$isAdmin) {
            http_response_code(403);
            echo 'Accès interdit';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $service->deleteTrip($id);
                $this->redirect('/');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        $this->render('trip/delete', [
            'trip' => $trip,
            'error' => $error ?? null
        ]);
    }
}
