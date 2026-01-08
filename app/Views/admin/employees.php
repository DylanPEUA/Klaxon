<?php
/**
 * Liste des employés (admin).
 * @var array $employees Liste des employés
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-people"></i> Liste des employés</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
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
                            <td>
                                <a href="mailto:<?= htmlspecialchars($employee->getEmail()) ?>">
                                    <i class="bi bi-envelope"></i>
                                    <?= htmlspecialchars($employee->getEmail()) ?>
                                </a>
                            </td>
                            <td>
                                <?php if ($employee->getPhone()): ?>
                                    <a href="tel:<?= htmlspecialchars($employee->getPhone()) ?>">
                                        <i class="bi bi-telephone"></i>
                                        <?= htmlspecialchars($employee->getPhone()) ?>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($employee->getRole() === 'ADMIN'): ?>
                                    <span class="badge bg-danger">
                                        <i class="bi bi-shield-check"></i> Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-person"></i> User
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="/?route=admin" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Retour au tableau de bord
    </a>
</div>