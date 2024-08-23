<?php

use src\Controllers\HomeController;
use src\Controllers\PersonnelsController;
use src\Controllers\VehiculesController;

$homeController = new HomeController();
$personnelsController = new PersonnelsController();
$vehiculesController = new VehiculesController();

$route = $_SERVER['REDIRECT_URL'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

switch ($route) {
    case HOME_URL:
        if ($method === 'POST') {
            $personnelsController->treatmentSignIn();
        } elseif (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            $homeController->displayDashboard();
        } else {
            $homeController->index();
        }
        break;

    case HOME_URL . 'dashboard':
        if (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            $homeController->displayDashboard();
        } else {
            $homeController->index();
        }
        break;

    case HOME_URL . 'dashboard/ajouter_personnel':

        if (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            $homeController->afficherPageGestionPersonnels();
        } else {
            $homeController->index();
        }
        break;



    case HOME_URL . 'dashboard/personnel_detaille':
        if ($method == 'POST' && isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'ajout_personnel':
                        $personnelsController->ajouterPersonnel();
                        break;
                    case 'edit_personnel':
                        $personnelsController->editPersonnel();
                        break;
                    case 'ajouter_evaluation':
                        $personnelsController->ajouterEvaluation();
                        break;
                    case 'suprimmer_personnel':
                        $personnelsController->supprimerPersonnel();
                        break;
                    case 'changer_status_personnel':
                        $personnelsController->ajouterStatusPersonnel();
                        break;
                    default:
                        // Handle unknown actions
                        $homeController->page404();
                        break;
                }
            } else {
                // Handle the case where 'action' is not set
                $homeController->page404();
            }
        } elseif (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            $Id_personnel = $_GET['Id_personnel'];
            $homeController->afficherPagePersonnelDetaille($Id_personnel);
        } else {
            $homeController->index();
        }
        break;

    case HOME_URL . 'dashboard/vehicule_detaille':
        if ($method == 'POST' && isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'ajouter_kilometrage':
                        $vehiculesController->ajouterKilometrage();
                        break;
                    case 'declarer_un_changement_du_lieu':
                        $vehiculesController->declarerChangementLieu();
                        break;
                    case 'ajouter_C_T':
                        $vehiculesController->updateDate_ct();
                        break;
                    case 'ajouter_commentaire':
                        $vehiculesController->ajouterCommentaire();
                        break;

                    default:
                        // Handle unknown actions
                        $homeController->page404();
                        break;
                }
            } else {
                // Handle the case where 'action' is not set
                $homeController->page404();
            }
        } elseif (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
            $Id_vehicule = $_GET['Id_vehicule'];
            $homeController->afficherPageVehiculeDetaille($Id_vehicule);
        } else {
            $homeController->index();
        }
        break;









    case HOME_URL . 'deconnexion':
        $homeController->deconexion();
        break;
    default:
        $homeController->page404();
        break;
}
