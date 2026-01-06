<?php

namespace App\Controllers;

use App\Services\AuthService;

/**
 * Authentification.
 */
class AuthController extends AbstractController
{
    /**
     * Affiche le formulaire de connexion et traite la soumission.
     */
    public function login(): void
    {
        $auth = new AuthService();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($auth->login($_POST['email'], $_POST['password'])) {
                $this->redirect('/');
            }

            $this->render('login', [
                'error' => 'Identifiants invalides'
            ]);
            return;
        }

        $this->render('login');
    }

    /**
     * Déconnecte l'utilisateur et redirige vers l'accueil.
     */
    public function logout(): void
    {
        $auth = new AuthService();
        $auth->logout();

        $this->redirect('/');
    }
}
