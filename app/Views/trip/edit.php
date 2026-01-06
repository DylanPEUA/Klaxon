<h1>Modifier le trajet</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="departure_agency">Agence de départ</label>
        <select name="departure_agency" id="departure_agency">
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= $agency->getId() ?>" <?= $trip->getDepartureAgency()->getId() === $agency->getId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($agency->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="arrival_agency">Agence d'arrivée</label>
        <select name="arrival_agency" id="arrival_agency">
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= $agency->getId() ?>" <?= $trip->getArrivalAgency()->getId() === $agency->getId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($agency->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="departure_datetime">Date et heure de départ</label>
        <input type="datetime-local" name="departure_datetime" id="departure_datetime" 
               value="<?= $trip->getDepartureDateTime()->format('Y-m-d\TH:i') ?>" required>
    </div>

    <div>
        <label for="arrival_datetime">Date et heure d'arrivée</label>
        <input type="datetime-local" name="arrival_datetime" id="arrival_datetime" 
               value="<?= $trip->getArrivalDateTime()->format('Y-m-d\TH:i') ?>" required>
    </div>

    <div>
        <label for="total_seats">Nombre total de places</label>
        <input type="number" name="total_seats" id="total_seats" min="1" 
               value="<?= $trip->getTotalSeats() ?>" required>
    </div>

    <div>
        <label for="available_seats">Places disponibles</label>
        <input type="number" name="available_seats" id="available_seats" min="0" 
               value="<?= $trip->getAvailableSeats() ?>" required>
    </div>

    <button type="submit">Modifier</button>
    <a href="/">Annuler</a>
</form>
