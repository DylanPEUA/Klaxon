<?php

namespace App\Controllers;

/**
 * Tableau de bord administrateur.
 */
class AdminController extends AbstractController
{
    /**
     * Affiche le tableau de bord administrateur.
     */
    public function dashboard(): void
    {
        $this->requireAdmin();

        $this->render('admin/dashboard');
    }
}
