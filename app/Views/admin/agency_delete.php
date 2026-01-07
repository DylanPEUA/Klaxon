<h1>Supprimer l'agence</h1>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="alert alert-warning">
    <p>Êtes-vous sûr de vouloir supprimer l'agence <strong><?= htmlspecialchars($agency->getName()) ?></strong> ?</p>
    <p><strong>Attention :</strong> Cette action est irréversible et peut échouer si des trajets utilisent cette agence.</p>
</div>

<form method="POST">
    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
    <a href="/?route=admin/agencies" class="btn btn-secondary">Annuler</a>
</form>