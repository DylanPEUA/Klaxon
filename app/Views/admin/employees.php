<h1>Liste des employés</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= htmlspecialchars((string) $employee->getId()) ?></td>
                <td><?= htmlspecialchars($employee->getLastname()) ?></td>
                <td><?= htmlspecialchars($employee->getFirstname()) ?></td>
                <td><?= htmlspecialchars($employee->getEmail()) ?></td>
                <td><?= htmlspecialchars($employee->getPhone() ?? '-') ?></td>
                <td><?= htmlspecialchars($employee->getRole()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p>
    <a href="/?route=admin">← Retour au tableau de bord</a>
</p>