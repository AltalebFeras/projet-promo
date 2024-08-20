<?php

namespace src\Controllers;

use src\Repositories\PersonnelsRepository;

class PersonnelsController
{
    public function treatmentSignIn()
    {
        try {
            $personnelRepository = new PersonnelsRepository();

            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
            $mdp = isset($_POST['mdp']) ? htmlspecialchars($_POST['mdp']) : null;

            $user = $personnelRepository->treatmentSignIn($email, $mdp);

            if ($user) {
                // var_dump($user);
                // die();
                $_SESSION['connecte'] = true;
                $_SESSION['Id_personnel'] = $user['Id_personnel'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['date_arrive'] = $user['date_arrive'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['mdp'] = $user['mdp'];
                $_SESSION['dtc'] = $user['dtc'];
                $_SESSION['Id_statut_personnels'] = $user['Id_statut_personnels'];

                $Id_role = $user['Id_role'];
                $_SESSION['role'] = $personnelRepository->getRole($Id_role);

                header('Location: ' . HOME_URL . 'dashboard?success=Vous êtes connectés avec succès.');
                exit();
            }
        } catch (\Exception $e) {
            error_log("SignUp Error: " . $e->getMessage()); // Log the error for debugging
            // Redirect to sign-up page with error message
            header('Location: ' . HOME_URL . '?error=' . urlencode($e->getMessage()));
        }
    }

    public function ajouterEvaluation()
{
    try {
        $personnelRepository = new PersonnelsRepository();
        
        // Ensure the variable names are correct
        $Id_personnel = isset($_POST['Id_personnel']) ? htmlspecialchars($_POST['Id_personnel']) : null;
        $Id_admin = isset($_POST['Id_admin']) ? htmlspecialchars($_POST['Id_admin']) : null;
        $texte = isset($_POST['texte']) ? htmlspecialchars($_POST['texte']) : null;

        // Check for null values and handle appropriately
        if ($Id_personnel && $Id_admin && $texte) {
            $personnelRepository->ajouterEvaluation($Id_personnel, $Id_admin, $texte);
            header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&success=Evaluation ajoutée avec succès.');
            exit();
        } else {
            throw new Exception('Required fields are missing.');
        }
        
    } catch (\Exception $e) {
        error_log("AjouterEvaluation Error: " . $e->getMessage()); // Log the error for debugging
        // Redirect to detail page with error message
        header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&error=' . urlencode($e->getMessage()));
        exit();
    }
}

}
