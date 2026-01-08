<?php
/**
 * Layout de base.
 * @var string $content Le contenu de la page
 * @var string $title Le titre de la page
 */

use App\Services\AuthService;

$auth = new AuthService();
$isLoggedIn = $auth->isLoggedIn();
$isAdmin = $auth->isAdmin();
$currentUser = $isLoggedIn ? $auth->getCurrentUser() : null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Klaxon') ?> - Klaxon</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <?php if ($isAdmin): ?>
                <a class="navbar-brand" href="/?route=admin">
                    <i class="bi bi-car-front-fill"></i> Klaxon
                </a>
            <?php else: ?>
                <a class="navbar-brand" href="/">
                    <i class="bi bi-car-front-fill"></i> Klaxon
                </a>
            <?php endif; ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if ($isAdmin): ?>
                    <!-- Menu Admin -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/?route=admin/employees">
                                <i class="bi bi-people"></i> Employés
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?route=admin/agencies">
                                <i class="bi bi-building"></i> Agences
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?route=admin/trips">
                                <i class="bi bi-car-front"></i> Trajets
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>

                <ul class="navbar-nav ms-auto">
                    <?php if ($isLoggedIn && $currentUser !== null): ?>
                        <?php if (!$isAdmin): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/?route=trip/create">
                                    <i class="bi bi-plus-circle"></i> Proposer un trajet
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <span class="nav-link text-light">
                                <i class="bi bi-person-circle"></i>
                                <?= htmlspecialchars($currentUser->getFirstname() . ' ' . $currentUser->getLastname()) ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/?route=logout">
                                <i class="bi bi-box-arrow-right"></i> Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-light" href="/?route=login">
                                <i class="bi bi-box-arrow-in-right"></i> Connexion
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container my-4">
        <?= $content ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0">
                <i class="bi bi-car-front-fill"></i> Klaxon &copy; <?= date('Y') ?>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>