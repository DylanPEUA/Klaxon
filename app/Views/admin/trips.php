<?php
/**
 * Liste des trajets (admin).
 * @var array $trips Liste des trajets
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-car-front"></i> Liste des trajets</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">ID</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date départ</th>
                        <th>Places</th>
                        <th>Contact</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($trips)): ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Aucun trajet enregistré.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($trips as $trip): ?>
                            <tr>
                                <td><?= $trip->getId() ?></td>
                                <td>
                                    <i class="bi bi-geo-alt text-success"></i>
                                    <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?>
                                </td>
                                <td>
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?>
                                </td>
                                <td>
                                    <i class="bi bi-calendar"></i>
                                    <?= $trip->getDepartureDateTime()->format('d/m/Y H:i') ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $trip->getAvailableSeats() > 0 ? 'success' : 'secondary' ?>">
                                        <?= $trip->getAvailableSeats() ?> / <?= $trip->getTotalSeats() ?>
                                    </span>
                                </td>
                                <td>
                                    <i class="bi bi-person"></i>
                                    <?= htmlspecialchars($trip->getContact()->getFirstname() . ' ' . $trip->getContact()->getLastname()) ?>
                                </td>
                                <td>
                                    <a href="/?route=admin/trip/delete&id=<?= $trip->getId() ?>" 
                                       class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="/?route=admin" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour au tableau de bord
    </a>
</div>