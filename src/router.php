<?php

use src\Controllers\HomeController;
 
$homeController = new HomeController();

$route = $_SERVER['REDIRECT_URL'] ?? '/';
$method = $_SERVER['REQUEST_METHOD'];

switch ($route) {
    case HOME_URL:
        if ($method === 'POST') {
            // $userController->treatmentSignIn();
        } elseif (isset($_SESSION['connected']) && $_SESSION['connected']) {
            // $homeController->displayDashboard();
        } else {
            $homeController->index();
        }
        break;
  

    case HOME_URL . 'deconnexion':
        // $homeController->signOut();
        break;
    default:
        $homeController->page404();
        break;
}
