<h1>Créer un trajet</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="departure_agency">Agence de départ</label>
        <select name="departure_agency" id="departure_agency">
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= $agency->getId() ?>">
                    <?= htmlspecialchars($agency->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="arrival_agency">Agence d'arrivée</label>
        <select name="arrival_agency" id="arrival_agency">
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= $agency->getId() ?>">
                    <?= htmlspecialchars($agency->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="departure_datetime">Date et heure de départ</label>
        <input type="datetime-local" name="departure_datetime" id="departure_datetime" required>
    </div>

    <div>
        <label for="arrival_datetime">Date et heure d'arrivée</label>
        <input type="datetime-local" name="arrival_datetime" id="arrival_datetime" required>
    </div>

    <div>
        <label for="total_seats">Nombre de places</label>
        <input type="number" name="total_seats" id="total_seats" min="1" value="4" required>
    </div>

    <button type="submit">Créer</button>
    <a href="/">Annuler</a>
</form>
