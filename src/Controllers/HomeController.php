<?php

namespace src\Controllers;

use src\Repositories\PersonnelsRepository;
use src\Repositories\VehiculesRepository;


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
    
    $allPersonnelsWithStatus = [];

    foreach ($personnels as $personnel) {
        $Id_personnel = $personnel['Id_personnel'];

        $status = $personnelsRepository->getTheLastStatusForEachPersonnel($Id_personnel);
        
        $personnel['status_name'] = $status ? $status['status_name'] : 'Aucun statut';

        $allPersonnelsWithStatus[] = $personnel;
    }
    
    $vehiculesRepository = new VehiculesRepository;
    $vehicules = $vehiculesRepository->getAllVehicules();
    // var_dump($vehicules);
    // die();

    include_once __DIR__ . '/../Views/dashboard/dashboard.php';
}

    

    public function afficherPageGestionPersonnels()
    {
        include_once __DIR__ . '/../Views/dashboard/ajouter_personnel.php';
    }
    public function afficherPagePersonnelDetaille($Id_personnel)
    {
        $personnelsRepository = new PersonnelsRepository();
        $personnel = $personnelsRepository->getPersonnelById($Id_personnel);
        $statuts = $personnelsRepository->getAllStatus();
        $statuts_personnel = $personnelsRepository->getStatusOfThisPersonnel($Id_personnel);
        // var_dump($statuts_personnel);
        // die();

        include_once __DIR__ . '/../Views/dashboard/personnel_detaille.php';
    }

    public function afficherPageVehiculeDetaille($Id_vehicule){
        $vehiculesRepository = new VehiculesRepository();
        $vehicule = $vehiculesRepository->getVehiculeById($Id_vehicule);
        $etats = $vehiculesRepository->getAllEtatOfVehicule();
        $commentaire = $vehiculesRepository->getLastCommentairesByIdVehicule($Id_vehicule);

        
        // var_dump($commentaire);
        // die();
        include_once __DIR__ . '/../Views/vehicule/vehicule_detaille.php';
        
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
