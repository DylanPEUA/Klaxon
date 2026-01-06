<h1>Trajets disponibles</h1>

<?php foreach ($trips as $trip): ?>
    <p>
        <?= $trip->getDepartureAgency()->getName() ?>
        →
        <?= $trip->getArrivalAgency()->getName() ?>
    </p>
<?php endforeach; ?>
