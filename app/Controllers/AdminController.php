<?php

namespace App\Controllers;

use App\Repositories\EmployeeRepository;
use App\Repositories\TripRepository;
use App\Services\AgencyService;

/**
 * Tableau de bord administrateur.
 */
class AdminController extends AbstractController
{
    private AgencyService $agencyService;
    private EmployeeRepository $employeeRepository;
    private TripRepository $tripRepository;

    public function __construct()
    {
        $this->agencyService = new AgencyService();
        $this->employeeRepository = new EmployeeRepository();
        $this->tripRepository = new TripRepository();
    }

    /**
     * Affiche le tableau de bord administrateur.
     */
    public function dashboard(): void
    {
        $this->requireAdmin();

        $this->render('admin/dashboard');
    }

    /**
     * Affiche la liste des employés.
     */
    public function employees(): void
    {
        $this->requireAdmin();

        $employees = $this->employeeRepository->findAll();

        $this->render('admin/employees', ['employees' => $employees]);
    }

    /**
     * Affiche la liste des agences.
     */
    public function agencies(): void
    {
        $this->requireAdmin();

        $agencies = $this->agencyService->getAllAgencies();

        $this->render('admin/agencies', ['agencies' => $agencies]);
    }

    /**
     * Crée une nouvelle agence.
     */
    public function createAgency(): void
    {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->agencyService->createAgency($_POST);
                $this->redirect('/?route=admin/agencies');
            } catch (\InvalidArgumentException $e) {
                $this->render('admin/agency_create', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->render('admin/agency_create');
    }

    /**
     * Modifie une agence existante.
     */
    public function editAgency(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $agency = $this->agencyService->getAgency($id);

        if ($agency === null) {
            http_response_code(404);
            echo 'Agence non trouvée';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->agencyService->updateAgency($id, $_POST);
                $this->redirect('/?route=admin/agencies');
            } catch (\InvalidArgumentException $e) {
                $this->render('admin/agency_edit', [
                    'agency' => $agency,
                    'error' => $e->getMessage()
                ]);
                return;
            }
        }

        $this->render('admin/agency_edit', ['agency' => $agency]);
    }

    /**
     * Supprime une agence.
     */
    public function deleteAgency(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $agency = $this->agencyService->getAgency($id);

        if ($agency === null) {
            http_response_code(404);
            echo 'Agence non trouvée';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->agencyService->deleteAgency($id);
                $this->redirect('/?route=admin/agencies');
            } catch (\InvalidArgumentException $e) {
                $this->render('admin/agency_delete', [
                    'agency' => $agency,
                    'error' => $e->getMessage()
                ]);
                return;
            }
        }

        $this->render('admin/agency_delete', ['agency' => $agency]);
    }

    /**
     * Affiche la liste de tous les trajets.
     */
    public function trips(): void
    {
        $this->requireAdmin();

        $trips = $this->tripRepository->findAll();

        $this->render('admin/trips', ['trips' => $trips]);
    }

    /**
     * Supprime un trajet (admin).
     */
    public function deleteTrip(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        $trip = $this->tripRepository->find($id);

        if ($trip === null) {
            http_response_code(404);
            echo 'Trajet non trouvé';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->tripRepository->delete($id);
            $this->redirect('/?route=admin/trips');
        }

        $this->render('admin/trip_delete', ['trip' => $trip]);
    }
}
