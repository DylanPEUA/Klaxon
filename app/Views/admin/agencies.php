<?php
/**
 * Liste des agences (admin).
 * @var array $agencies Liste des agences
 */
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-building"></i> Gestion des agences</h1>
    <a href="/?route=admin/agency/create" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Ajouter une agence
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nom</th>
                        <th style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($agencies)): ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Aucune agence enregistrée.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($agencies as $agency): ?>
                            <tr>
                                <td><?= htmlspecialchars((string) $agency->getId()) ?></td>
                                <td>
                                    <i class="bi bi-geo-alt"></i>
                                    <?= htmlspecialchars($agency->getName()) ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/?route=admin/agency/edit&id=<?= $agency->getId() ?>" 
                                           class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Modifier
                                        </a>
                                        <a href="/?route=admin/agency/delete&id=<?= $agency->getId() ?>" 
                                           class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Supprimer
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
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