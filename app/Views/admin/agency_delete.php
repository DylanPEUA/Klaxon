<?php
/**
 * Confirmation de suppression d'agence.
 * @var \App\Models\Agency $agency Agence à supprimer
 * @var string|null $error Message d'erreur
 */
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0"><i class="bi bi-trash"></i> Supprimer l'agence</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Attention !</strong> Cette action est irréversible.
                    <br>
                    <small>La suppression échouera si des trajets utilisent cette agence.</small>
                </div>

                <p>Êtes-vous sûr de vouloir supprimer l'agence suivante ?</p>

                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i class="bi bi-building display-4 text-danger"></i>
                        <h5 class="mt-3"><?= htmlspecialchars($agency->getName()) ?></h5>
                        <small class="text-muted">ID : <?= $agency->getId() ?></small>
                    </div>
                </div>

                <form method="POST">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Confirmer la suppression
                        </button>
                        <a href="/?route=admin/agencies" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>