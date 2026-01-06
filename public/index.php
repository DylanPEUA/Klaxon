<?php

require __DIR__ . '/../vendor/autoload.php';

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

echo 'Application prête';