<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/bootstrap.php';

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\TripController;
use App\Controllers\AdminController;

$route = $_GET['route'] ?? '/';

switch ($route) {
    case '/':
        (new HomeController())->index();
        break;

    case 'login':
        (new AuthController())->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;
    
    case 'trip/create':
        (new TripController())->create();
        break;

    case 'trip/edit':
        (new TripController())->edit();
        break;

    case 'trip/delete':
        (new TripController())->delete();
        break;

    // Routes admin
    case 'admin':
        (new AdminController())->dashboard();
        break;

    case 'admin/employees':
        (new AdminController())->employees();
        break;

    case 'admin/agencies':
        (new AdminController())->agencies();
        break;

    case 'admin/agency/create':
        (new AdminController())->createAgency();
        break;

    case 'admin/agency/edit':
        (new AdminController())->editAgency();
        break;

    case 'admin/agency/delete':
        (new AdminController())->deleteAgency();
        break;

    case 'admin/trips':
        (new AdminController())->trips();
        break;

    case 'admin/trip/delete':
        (new AdminController())->deleteTrip();
        break;

    default:
        http_response_code(404);
        echo 'Page non trouvée';
}