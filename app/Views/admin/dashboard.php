<?php
/**
 * Tableau de bord administrateur.
 */
?>

<h1 class="mb-4"><i class="bi bi-speedometer2"></i> Tableau de bord</h1>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-people display-4 text-primary"></i>
                <h5 class="card-title mt-3">Employés</h5>
                <p class="card-text">Consulter la liste des employés</p>
                <a href="/?route=admin/employees" class="btn btn-primary">
                    <i class="bi bi-arrow-right"></i> Accéder
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-building display-4 text-success"></i>
                <h5 class="card-title mt-3">Agences</h5>
                <p class="card-text">Gérer les agences (villes)</p>
                <a href="/?route=admin/agencies" class="btn btn-success">
                    <i class="bi bi-arrow-right"></i> Accéder
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-body text-center">
                <i class="bi bi-car-front display-4 text-warning"></i>
                <h5 class="card-title mt-3">Trajets</h5>
                <p class="card-text">Consulter et supprimer les trajets</p>
                <a href="/?route=admin/trips" class="btn btn-warning">
                    <i class="bi bi-arrow-right"></i> Accéder
                </a>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="/" class="btn btn-outline-secondary">
        <i class="bi bi-house"></i> Retour à l'accueil
    </a>
</div>
