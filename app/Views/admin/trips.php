<h1>Liste des trajets</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Départ</th>
            <th>Arrivée</th>
            <th>Date départ</th>
            <th>Places dispo</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trips as $trip): ?>
            <tr>
                <td><?= $trip->getId() ?></td>
                <td><?= htmlspecialchars($trip->getDepartureAgency()->getName()) ?></td>
                <td><?= htmlspecialchars($trip->getArrivalAgency()->getName()) ?></td>
                <td><?= $trip->getDepartureDateTime()->format('d/m/Y H:i') ?></td>
                <td><?= $trip->getAvailableSeats() ?> / <?= $trip->getTotalSeats() ?></td>
                <td><?= htmlspecialchars($trip->getContact()->getFirstname() . ' ' . $trip->getContact()->getLastname()) ?></td>
                <td>
                    <a href="/?route=admin/trip/delete&id=<?= $trip->getId() ?>" class="btn btn-sm btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="/?route=admin">← Retour au tableau de bord</a>
</p>