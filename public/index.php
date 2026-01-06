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

    case 'admin':
        (new AdminController())->dashboard();
        break;

    default:
        http_response_code(404);
        echo 'Page non trouvée';
}

/* ________________________Teste de la connexion à la base de données________________________
use App\Database\Database;

try {
    $pdo = Database::getConnection();
    echo 'Connexion DB OK';
} catch (Throwable $e) {
    echo 'Erreur de connexion DB';
}
*/

/* ________________________Teste de AgencyRepository.php________________________
use App\Repositories\AgencyRepository;

$repo = new AgencyRepository();
$agencies = $repo->findAll();

foreach ($agencies as $agency) {
    echo $agency->getName() . '<br>';
}

*/


/* ________________________Teste de EmployeeRepository.php________________________
use App\Repositories\EmployeeRepository;

$repo = new EmployeeRepository();
$user = $repo->findByEmail('alexandre.martin@email.fr');

echo '<h2>Employé</h2>';

if ($user !== null) {
    echo $user->getFullName();
} else {
    echo 'Utilisateur introuvable';
}
*/

/* ________________________Teste de TripRepository.php________________________ 
use App\Repositories\TripRepository;

$repo = new TripRepository();
$trips = $repo->findAvailableFutureTrips();

foreach ($trips as $trip) {
    echo $trip->getDepartureAgency()->getName()
        . ' → '
        . $trip->getArrivalAgency()->getName()
        . '<br>';
}
*/

/* ________________________Teste de AuthService.php________________________ 
use App\Services\AuthService;

$auth = new AuthService();

if ($auth->login('alexandre.martin@email.fr', 'password')) {
    echo 'Connexion réussie<br>';
    echo 'Bonjour ' . $_SESSION['user']['firstname'];
} else {
    echo 'Échec de connexion';
}
$auth->logout();
echo '<br>Déconnecté';
*/ 

/*echo 'Application prête';*/