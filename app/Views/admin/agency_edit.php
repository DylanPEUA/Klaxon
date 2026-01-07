<h1>Modifier l'agence</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l'agence</label>
        <input type="text" name="name" id="name" class="form-control" 
               value="<?= htmlspecialchars($agency->getName()) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="/?route=admin/agencies" class="btn btn-secondary">Annuler</a>
</form>