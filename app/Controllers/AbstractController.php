<?php

namespace App\Controllers;

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
}
