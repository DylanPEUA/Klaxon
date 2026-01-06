<h1>Supprimer le trajet</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<p>Êtes-vous sûr de vouloir supprimer ce trajet ?</p>

<div>
    <strong>Départ :</strong> <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?><br>
    <strong>Arrivée :</strong> <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?><br>
    <strong>Date de départ :</strong> <?= $trip->getDepartureDateTime()->format('d/m/Y H:i') ?><br>
    <strong>Date d'arrivée :</strong> <?= $trip->getArrivalDateTime()->format('d/m/Y H:i') ?><br>
    <strong>Places :</strong> <?= $trip->getAvailableSeats() ?> / <?= $trip->getTotalSeats() ?>
</div>

<form method="post">
    <button type="submit" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
    <a href="/">Annuler</a>
</form>
