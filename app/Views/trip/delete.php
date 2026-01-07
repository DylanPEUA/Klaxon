<?php
/**
 * Confirmation de suppression de trajet.
 * @var \App\Models\Trip $trip Trajet à supprimer
 * @var string|null $error Message d'erreur
 */
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0"><i class="bi bi-trash"></i> Supprimer le trajet</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Attention !</strong> Cette action est irréversible.
                </div>

                <p>Êtes-vous sûr de vouloir supprimer ce trajet ?</p>

                <ul class="list-group mb-4">
                    <li class="list-group-item">
                        <i class="bi bi-geo-alt"></i>
                        <strong>Trajet :</strong>
                        <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?>
                        → <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-calendar"></i>
                        <strong>Date :</strong>
                        <?= $trip->getDepartureDateTime()->format('d/m/Y à H:i') ?>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-person"></i>
                        <strong>Contact :</strong>
                        <?= htmlspecialchars($trip->getContact()->getFirstname() . ' ' . $trip->getContact()->getLastname()) ?>
                    </li>
                    <li class="list-group-item">
                        <i class="bi bi-people"></i>
                        <strong>Places :</strong>
                        <?= $trip->getAvailableSeats() ?> / <?= $trip->getTotalSeats() ?> disponibles
                    </li>
                </ul>

                <form method="POST">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Confirmer la suppression
                        </button>
                        <a href="/" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
