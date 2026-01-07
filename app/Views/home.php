<?php
/**
 * Page d'accueil - Liste des trajets.
 * @var array $trips Liste des trajets disponibles
 */

use App\Services\AuthService;

$auth = new AuthService();
$isLoggedIn = $auth->isLoggedIn();
$currentUserId = $auth->getCurrentUserId();
$isAdmin = $auth->isAdmin();
?>

<h1 class="mb-4"><i class="bi bi-car-front"></i> Trajets disponibles</h1>

<?php if (empty($trips)): ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Aucun trajet disponible pour le moment.
    </div>
<?php else: ?>
    <div class="row">
        <?php foreach ($trips as $trip): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-trip h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?>
                            <i class="bi bi-arrow-right"></i>
                            <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?>
                        </h5>
                        <p class="card-text">
                            <i class="bi bi-calendar"></i>
                            <strong>Départ :</strong> <?= $trip->getDepartureDateTime()->format('d/m/Y à H:i') ?><br>
                            <i class="bi bi-calendar-check"></i>
                            <strong>Arrivée :</strong> <?= $trip->getArrivalDateTime()->format('d/m/Y à H:i') ?>
                        </p>
                        <p class="card-text">
                            <span class="badge bg-success">
                                <i class="bi bi-person"></i>
                                <?= $trip->getAvailableSeats() ?> place(s) disponible(s)
                            </span>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <?php if ($isLoggedIn): ?>
                            <!-- Bouton modal détails -->
                            <button type="button" class="btn btn-sm btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#tripModal<?= $trip->getId() ?>">
                                <i class="bi bi-info-circle"></i> Détails
                            </button>
                            
                            <?php if ($isAdmin || $trip->getContact()->getId() === $currentUserId): ?>
                                <a href="/?route=trip/edit&id=<?= $trip->getId() ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="/?route=trip/delete&id=<?= $trip->getId() ?>" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($isLoggedIn): ?>
                <!-- Modal détails -->
                <div class="modal fade" id="tripModal<?= $trip->getId() ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">
                                    <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?>
                                    → <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?>
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <h6><i class="bi bi-person-badge"></i> Contact</h6>
                                <ul class="list-unstyled ms-3">
                                    <li>
                                        <i class="bi bi-person"></i>
                                        <?= htmlspecialchars($trip->getContact()->getFirstname() . ' ' . $trip->getContact()->getLastname()) ?>
                                    </li>
                                    <li>
                                        <i class="bi bi-telephone"></i>
                                        <a href="tel:<?= htmlspecialchars($trip->getContact()->getPhone() ?? '') ?>">
                                            <?= htmlspecialchars($trip->getContact()->getPhone() ?? 'Non renseigné') ?>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="bi bi-envelope"></i>
                                        <a href="mailto:<?= htmlspecialchars($trip->getContact()->getEmail()) ?>">
                                            <?= htmlspecialchars($trip->getContact()->getEmail()) ?>
                                        </a>
                                    </li>
                                </ul>
                                
                                <h6><i class="bi bi-info-circle"></i> Informations</h6>
                                <ul class="list-unstyled ms-3">
                                    <li><strong>Places totales :</strong> <?= $trip->getTotalSeats() ?></li>
                                    <li><strong>Places disponibles :</strong> <?= $trip->getAvailableSeats() ?></li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['user'])): ?>
    <p><a href="/?route=trip/create">+ Créer un trajet</a></p>
<?php else: ?>
    <p><a href="/?route=login">Se connecter</a> pour créer un trajet</p>
<?php endif; ?>
