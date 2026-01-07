<?php
/**
 * Formulaire de création de trajet.
 * @var array $agencies Liste des agences
 * @var \App\Models\Employee $employee Employé connecté
 * @var string|null $error Message d'erreur
 */
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Proposer un trajet</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <!-- Informations conducteur (lecture seule) -->
                    <fieldset class="mb-4">
                        <legend><i class="bi bi-person"></i> Vos informations</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" class="form-control" 
                                       value="<?= htmlspecialchars($employee->getLastname()) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input type="text" class="form-control" 
                                       value="<?= htmlspecialchars($employee->getFirstname()) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" 
                                       value="<?= htmlspecialchars($employee->getEmail()) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text" class="form-control" 
                                       value="<?= htmlspecialchars($employee->getPhone() ?? 'Non renseigné') ?>" readonly>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Informations trajet -->
                    <fieldset class="mb-4">
                        <legend><i class="bi bi-geo-alt"></i> Trajet</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="departure_agency" class="form-label">Agence de départ</label>
                                <select name="departure_agency" id="departure_agency" class="form-select" required>
                                    <option value="">-- Choisir --</option>
                                    <?php foreach ($agencies as $agency): ?>
                                        <option value="<?= $agency->getId() ?>">
                                            <?= htmlspecialchars($agency->getName()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="arrival_agency" class="form-label">Agence d'arrivée</label>
                                <select name="arrival_agency" id="arrival_agency" class="form-select" required>
                                    <option value="">-- Choisir --</option>
                                    <?php foreach ($agencies as $agency): ?>
                                        <option value="<?= $agency->getId() ?>">
                                            <?= htmlspecialchars($agency->getName()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Horaires -->
                    <fieldset class="mb-4">
                        <legend><i class="bi bi-clock"></i> Horaires</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="departure_datetime" class="form-label">Date et heure de départ</label>
                                <input type="datetime-local" name="departure_datetime" id="departure_datetime" 
                                       class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="arrival_datetime" class="form-label">Date et heure d'arrivée</label>
                                <input type="datetime-local" name="arrival_datetime" id="arrival_datetime" 
                                       class="form-control" required>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Places -->
                    <fieldset class="mb-4">
                        <legend><i class="bi bi-people"></i> Places</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="total_seats" class="form-label">Nombre de places disponibles</label>
                                <input type="number" name="total_seats" id="total_seats" 
                                       class="form-control" min="1" max="10" required>
                            </div>
                        </div>
                    </fieldset>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Créer le trajet
                        </button>
                        <a href="/" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
