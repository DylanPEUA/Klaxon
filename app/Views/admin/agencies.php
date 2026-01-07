<h1>Gestion des agences</h1>

<p>
    <a href="/?route=admin/agency/create" class="btn btn-primary">+ Ajouter une agence</a>
</p>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($agencies as $agency): ?>
            <tr>
                <td><?= htmlspecialchars((string) $agency->getId()) ?></td>
                <td><?= htmlspecialchars($agency->getName()) ?></td>
                <td>
                    <a href="/?route=admin/agency/edit&id=<?= $agency->getId() ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="/?route=admin/agency/delete&id=<?= $agency->getId() ?>" class="btn btn-sm btn-danger">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="/?route=admin">← Retour au tableau de bord</a>
</p>