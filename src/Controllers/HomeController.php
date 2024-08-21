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

        $personnels = $personnelsRepository->getAllPersonnels();
        // var_dump($personnels);
        // die();

        $personnelsWithRolesAndStatus = [];

        foreach ($personnels as $personnel) {
            $Id_role = $personnel['Id_role'];
            $roleName = $personnelsRepository->getRole($Id_role);

            // $Id_statut_personnels = $personnel['Id_statut_personnels'];
            // $statut_personnels = $personnelsRepository->getStatutPersonnel($Id_statut_personnels);

            $Id_personnel = $personnel['Id_personnel'];
            $evaluation = $personnelsRepository->getLastEvaluationForThisPersonnel($Id_personnel);

            // $personnel['statut_personnels'] = $statut_personnels;
            $personnel['role_name'] = $roleName;
            $personnel['evaluation'] = $evaluation;  

            $personnelsWithRolesAndStatus[] = $personnel;
           
        }

        // var_dump($personnelsWithRolesAndStatus);
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
        // var_dump($personnel);
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
