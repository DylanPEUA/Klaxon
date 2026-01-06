<?php

namespace App\Controllers;

use App\Services\AuthService;

/**
 * Authentification.
 */
class AuthController extends AbstractController
{
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

    public function logout(): void
    {
        $auth = new AuthService();
        $auth->logout();

        $this->redirect('/');
    }
}
