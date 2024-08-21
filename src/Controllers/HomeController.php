<?php

namespace src\Controllers;

use src\Repositories\PersonnelsRepository;


class HomeController
{
    public function index()
    {
        include_once __DIR__ . '/../Views/home/connexion.php';
    }

    public function displayDashboard()
    {
        $personnelsRepository = new PersonnelsRepository();

        $personnels = $personnelsRepository->getAllPersonnelsDetailed();
        // var_dump($personnels);
        // die();

      
        include_once __DIR__ . '/../Views/dashboard/dashboard.php';
    }

    public function afficherPageGestionPersonnels()
    {
        include_once __DIR__ . '/../Views/dashboard/ajouter_personnel.php';
    }
    public function afficherPagePersonnelDetaille($Id_personnel){
        $personnelsRepository = new PersonnelsRepository();
        $personnel = $personnelsRepository->getPersonnelById($Id_personnel);
        $statuts = $personnelsRepository->getAllStatus();
        $statuts_personnel = $personnelsRepository->getStatusOfThisPersonnel($Id_personnel);
        // var_dump($statuts_personnel);
        // die();
        
        include_once __DIR__ . '/../Views/dashboard/personnel_detaille.php';
    }
    public function deconexion()
    {
        session_destroy();
        header('Location: ' . HOME_URL . '?success=Vous êtes deconnectés avec succès.');
    }
    public function page404()
    {
        include_once __DIR__ . '/../Views/home/404.php';
    }
}
