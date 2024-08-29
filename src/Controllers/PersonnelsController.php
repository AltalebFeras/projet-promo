<?php

namespace src\Controllers;

use Exception;
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


                $_SESSION['connecte'] = true;
                $_SESSION['Id_personnel'] = $user['Id_personnel'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['date_arrive'] = $user['date_arrive'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['mdp'] = $user['mdp'];
                $_SESSION['dtc'] = $user['dtc'];
                $Id_role = $user['Id_role'];
                $_SESSION['role'] = $personnelRepository->getRole($Id_role);

                header('Location: ' . HOME_URL . 'dashboard?success=Vous êtes connectés avec succès.');
                exit();
            }
        } catch (Exception $e) {
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

            if ($_SESSION['role'] !== 'admin') {
                throw new Exception('cette action est reservée aux admins');
            }
            // Check for null values and handle appropriately
            if ($Id_personnel && $Id_admin && $texte) {
                $personnelRepository->ajouterEvaluation($Id_personnel, $Id_admin, $texte);
                header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&success=Evaluation ajoutée avec succès.');
                exit();
            } else {
                throw new Exception('Des champs obligatoires sont manquants.');
            }
        } catch (Exception $e) {
            error_log("AjouterEvaluation Error: " . $e->getMessage()); // Log the error for debugging
            // Redirect to detail page with error message
            header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
    public function ajouterPersonnel()
    {
        try {
            $personnelRepository = new PersonnelsRepository();

            // Sanitize and validate inputs
            $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;
            $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null;
            $date_arrive = isset($_POST['date_arrive']) ? htmlspecialchars($_POST['date_arrive']) : null;
            $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : null;
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
            $mdp = isset($_POST['mdp']) ? htmlspecialchars($_POST['mdp']) : null;
            $mdpConfirmer = isset($_POST['mdpConfirmer']) ? htmlspecialchars($_POST['mdpConfirmer']) : null;
            $Id_role = isset($_POST['Id_role']) ? htmlspecialchars($_POST['Id_role']) : null;
            $Id_statut = isset($_POST['Id_statut']) ? htmlspecialchars($_POST['Id_statut']) : null;
            $date_debut =  isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : null;
            $date_fin =  isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : null;

            if ($_SESSION['role'] !== 'admin') {
                throw new Exception('cette action est reservée aux admins');
            }

            if (!$nom || !$prenom || !$date_arrive || !$telephone || !$email || !$mdp || !$mdpConfirmer || !$Id_role || !$Id_statut) {
                throw new Exception('Des champs obligatoires sont manquants.');
            }
            if ($mdp !== $mdpConfirmer) {
                throw new Exception('Les mots de passe doivent être identiques.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Format d\'email invalide.');
            }

            if ($personnelRepository->emailExists($email)) {
                throw new Exception('Cet email existe déjà. Veuillez utiliser une autre adresse email.');
            }

            if (strlen($mdp) < 6) {
                throw new Exception('Le mot de passe doit contenir au moins 6 caractères..');
            }

            $personnelRepository->ajouterPersonnel($nom, $prenom, $date_arrive, $telephone, $email, $mdp, $Id_role, $Id_statut, $date_debut, $date_fin);

            header('Location: ' . HOME_URL . 'dashboard?success=Personnel ajouté avec succès.');
            exit();
        } catch (Exception $e) {
            error_log("AjoutPersonnel Error: " . $e->getMessage());
            header('Location: ' . HOME_URL . 'dashboard/ajouter_personnel?error=' . urlencode($e->getMessage()));
            exit();
        }
    }
    public function editPersonnel()
    {
        try {
            $Id_personnel = isset($_GET['Id_personnel']) ? htmlspecialchars($_GET['Id_personnel']) : null;
            $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : null;
            $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : null;
            $date_arrive = isset($_POST['date_arrive']) ? htmlspecialchars($_POST['date_arrive']) : null;
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
            $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : null;

            $personnelRepository = new PersonnelsRepository();
            $personnel = $personnelRepository->getPersonnelById($Id_personnel);
            if (!$personnel) {
                throw new Exception('Ce personnel n\'existe pas.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception('Format d\'email invalide.');
            }
            $personnelRepository->editPersonnel($Id_personnel, $nom, $prenom, $date_arrive, $telephone, $email);
            header('Location: ' . HOME_URL . 'dashboard?success=Personnel modifié avec succès.');
            exit();
        } catch (Exception $e) {
            error_log("EditPersonnel Error: " . $e->getMessage());
            header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
    public function supprimerPersonnel()
    {

        try {
            $Id_personnel = isset($_GET['Id_personnel']) ? htmlspecialchars($_GET['Id_personnel']) : null;
            $personnelRepository = new PersonnelsRepository();
            $personnelRepository->supprimerPersonnel($Id_personnel);
            if ($_SESSION['Id_personnel'] == $_GET['Id_personnel']) {
                session_unset();
                session_destroy();
                header('Location: ' . HOME_URL . '?success=Vous êtes déconnecté et votre compte a été supprimé avec succès.');
                exit();
            }
            header('Location: ' . HOME_URL . 'dashboard?success=Personnel supprimé avec succès.');
            exit();
        } catch (Exception $e) {
            error_log("SupprimerPersonnel Error: " . $e->getMessage());
            header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
    public function ajouterStatusPersonnel()
    {
        try {
            $Id_personnel = isset($_POST['Id_personnel']) ? htmlspecialchars($_POST['Id_personnel']) : null;
            $Id_statut = isset($_POST['Id_statut']) ? htmlspecialchars($_POST['Id_statut']) : null;
            $date_debut = isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : null;
            $date_fin = isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : null;

            if (!$Id_personnel || !$Id_statut) {
                throw new Exception('Des champs obligatoires sont manquants.');
            }

            if ($Id_statut !== '1') { // Assuming '1' is a Id_status for present
                if (empty($date_debut) || empty($date_fin)) {
                    throw new Exception('Les dates de début (date_debut) et de fin (date_fin) sont toutes deux requises pour ce statut.');
                }
            }

            $personnelRepository = new PersonnelsRepository();
            $personnelRepository->ajouterStatusPersonnel($Id_personnel, $Id_statut, $date_debut, $date_fin);

            header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&success=Statut du personnel modifié avec succès.');
            exit();
        } catch (Exception $e) {
            error_log("ajouterStatusPersonnel Error: " . $e->getMessage());
            header('Location: ' . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $Id_personnel . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    }
}
