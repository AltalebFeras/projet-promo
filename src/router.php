<?php

use src\Controllers\HomeController;
use src\Controllers\PersonnelsController;
 
$homeController = new HomeController();
$personnelsController = new PersonnelsController();

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

        case HOME_URL. 'dashboard' :
            if (isset($_SESSION['connecte']) && $_SESSION['connecte']) {
                $homeController->displayDashboard();
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
