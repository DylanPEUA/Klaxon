<h1>Trajets disponibles</h1>

<?php if (empty($trips)): ?>
    <p>Aucun trajet disponible pour le moment.</p>
<?php else: ?>
    <?php foreach ($trips as $trip): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
            <h3>
                <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?>
                →
                <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?>
            </h3>
            <p>
                <strong>Départ :</strong> <?= $trip->getDepartureDateTime()->format('d/m/Y H:i') ?><br>
                <strong>Arrivée :</strong> <?= $trip->getArrivalDateTime()->format('d/m/Y H:i') ?><br>
                <strong>Places disponibles :</strong> <?= $trip->getAvailableSeats() ?> / <?= $trip->getTotalSeats() ?><br>
                <strong>Contact :</strong> <?= htmlspecialchars($trip->getContact()->getFullName()) ?>
            </p>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/?route=trip/edit&id=<?= $trip->getId() ?>">Modifier</a>
                <a href="/?route=trip/delete&id=<?= $trip->getId() ?>">Supprimer</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($_SESSION['user'])): ?>
    <p><a href="/?route=trip/create">+ Créer un trajet</a></p>
<?php else: ?>
    <p><a href="/?route=login">Se connecter</a> pour créer un trajet</p>
<?php endif; ?>
