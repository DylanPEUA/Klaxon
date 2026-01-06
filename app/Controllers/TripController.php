<?php

namespace App\Controllers;

use App\Repositories\TripRepository;
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
    public function create(): void
    {
        $this->requireLogin();

        $service = new TripService();
        $auth = new AuthService();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $employeeRepository = new EmployeeRepository();
                $employee = $employeeRepository->find($auth->getUser()['id']);
                
                if ($employee === null) {
                    throw new InvalidArgumentException('Employé introuvable');
                }
                
                $service->createTrip($_POST, $employee);
                $this->redirect('/');
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        $agencyRepository = new AgencyRepository();

        $this->render('trip/create', [
            'agencies' => $agencyRepository->findAll(),
            'error' => $error ?? null
        ]);
    }
}
