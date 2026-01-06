<h1>Créer un trajet</h1>

<form method="post">
    <select name="departure_agency">
        <?php foreach ($agencies as $agency): ?>
            <option value="<?= $agency->getId() ?>">
                <?= $agency->getName() ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Créer</button>
</form>
