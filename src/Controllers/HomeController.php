<?php

namespace src\Controllers;


class HomeController
{
    public function index()
    {
        include_once __DIR__ . '/../Views/home/connexion.php';
    }

    public function displayDashboard()
    {

        include_once __DIR__ . '/../Views/dashboard/dashboard.php';
    }
    public function deconexion() {
        session_destroy();
        header('Location: ' . HOME_URL .'?success=Vous êtes deconnectés avec succès.');
    }
    public function page404()
    {
        include_once __DIR__ . '/../Views/home/404.php';
    }
}
