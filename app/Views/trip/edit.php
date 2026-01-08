<?php
/**
 * Formulaire de modification de trajet.
 * @var \App\Models\Trip $trip Trajet à modifier
 * @var array $agencies Liste des agences
 * @var string|null $error Message d'erreur
 */
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h4 class="mb-0"><i class="bi bi-pencil"></i> Modifier le trajet</h4>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <!-- Trajet -->
                    <fieldset class="mb-4">
                        <legend><i class="bi bi-geo-alt"></i> Trajet</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="departure_agency" class="form-label">Agence de départ</label>
                                <select name="departure_agency" id="departure_agency" class="form-select" required>
                                    <?php foreach ($agencies as $agency): ?>
                                        <option value="<?= $agency->getId() ?>"
                                            <?= $agency->getId() === $trip->getDepartureAgency()->getId() ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($agency->getName()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="arrival_agency" class="form-label">Agence d'arrivée</label>
                                <select name="arrival_agency" id="arrival_agency" class="form-select" required>
                                    <?php foreach ($agencies as $agency): ?>
                                        <option value="<?= $agency->getId() ?>"
                                            <?= $agency->getId() === $trip->getArrivalAgency()->getId() ? 'selected' : '' ?>>
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
                                       class="form-control" 
                                       value="<?= $trip->getDepartureDateTime()->format('Y-m-d\TH:i') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="arrival_datetime" class="form-label">Date et heure d'arrivée</label>
                                <input type="datetime-local" name="arrival_datetime" id="arrival_datetime" 
                                       class="form-control" 
                                       value="<?= $trip->getArrivalDateTime()->format('Y-m-d\TH:i') ?>" required>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Places -->
                    <fieldset class="mb-4">
                        <legend><i class="bi bi-people"></i> Places</legend>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="total_seats" class="form-label">Nombre total de places</label>
                                <input type="number" name="total_seats" id="total_seats" class="form-control" 
                                       min="1" max="10" value="<?= $trip->getTotalSeats() ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="available_seats" class="form-label">Places disponibles</label>
                                <input type="number" name="available_seats" id="available_seats" class="form-control" 
                                       min="0" max="10" value="<?= $trip->getAvailableSeats() ?>" required>
                            </div>
                        </div>
                    </fieldset>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-lg"></i> Enregistrer
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