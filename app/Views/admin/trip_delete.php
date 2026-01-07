<h1>Supprimer le trajet</h1>

<div class="alert alert-warning">
    <p>Êtes-vous sûr de vouloir supprimer ce trajet ?</p>
    <ul>
        <li><strong>Départ :</strong> <?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?></li>
        <li><strong>Arrivée :</strong> <?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?></li>
        <li><strong>Date :</strong> <?= $trip->getDepartureDateTime()->format('d/m/Y H:i') ?></li>
        <li><strong>Contact :</strong> <?= htmlspecialchars($trip->getContact()->getFirstname() . ' ' . $trip->getContact()->getLastname()) ?></li>
    </ul>
</div>

<form method="POST">
    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
    <a href="/?route=admin/trips" class="btn btn-secondary">Annuler</a>
</form>