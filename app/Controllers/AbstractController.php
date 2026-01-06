<?php

namespace App\Controllers;

use App\Services\AuthService;


/**
 * Classe de base des controllers.
 */
abstract class AbstractController   
{
    /**
     * Affiche une vue.
     *
     * @param array<string, mixed> $params
     */
    protected function render(string $view, array $params = []): void
    {
        extract($params);

        require __DIR__ . '/../Views/' . $view . '.php';
    }

    /**
     * Redirection HTTP.
     */
    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }

    /**
     * Vérifie que l'utilisateur est connecté.
     */
    protected function requireLogin(): void
    {
        $auth = new AuthService();

        if (!$auth->isLoggedIn()) {
            $this->redirect('/?route=login');
        }
    }

    /**
     * Vérifie que l'utilisateur est administrateur.
     */
    protected function requireAdmin(): void
    {
        $auth = new AuthService();

        if (!$auth->isAdmin()) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }
    }
}
