<?php

namespace src\Controllers;

use Exception;
use src\Repositories\VehiculesRepository;

class VehiculesController
{

    public function validateKM($Id_vehicule)
    {
        $vehiculesRepository = new VehiculesRepository();
        return $vehiculesRepository->getKilometrageByIdVehicule($Id_vehicule);
    }

    public function ajouterKilometrage()
    {
        try {
            $Id_vehicule = isset($_POST['Id_vehicule']) ? htmlspecialchars($_POST['Id_vehicule']) : null;
            if ($_SESSION['role'] !== 'conducteur') {
                header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&error=Vous ne pouvez pas effectuer cette action.');
                exit();
            }
            $vehiculesRepository = new VehiculesRepository();

            $kilometrage = isset($_POST['km']) ? htmlspecialchars($_POST['km']) : null;

            if (!$kilometrage) {
                throw new Exception('Veuillez renseigner le kilométrage.');
            }


            if (!$Id_vehicule) {
                throw new Exception('Veuillez renseigner l\'ID du véhicule.');
            }

            // Validate the new kilometrage against the current one
            $currentKM = $this->validateKM($Id_vehicule);

            if ($kilometrage <= $currentKM) {
                throw new Exception('Le kilométrage ne peut pas être inférieur ou égal au kilométrage actuel.');
            }

            if ($kilometrage > 500000) {
                throw new Exception('Le kilométrage ne peut pas dépasser 500 000.');
            }

            $vehiculesRepository->ajouterKilometrage($Id_vehicule, $kilometrage);

            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&success=Kilométrage ajouté avec succès.');
            exit();
        } catch (Exception $e) {

            error_log("AjouterKilometrage Error: " . $e->getMessage());
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    }


public function declarerChangementLieu()
{
    try {
        $Id_vehicule = isset($_POST['Id_vehicule']) ? htmlspecialchars($_POST['Id_vehicule']) : null;
        if ($_SESSION['role'] == 'conducteur' && $_POST['Id_etat_vehicule'] == 3){
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&error=Vous ne pouvez pas effectuer cette action.');
            exit();
        }
        if ($_SESSION['role'] == 'mecanicien' && $_POST['Id_etat_vehicule'] == 1){
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&error=Vous ne pouvez pas effectuer cette action.');
            exit();
        }

        $Id_etat_vehicule = isset($_POST['Id_etat_vehicule']) ? htmlspecialchars($_POST['Id_etat_vehicule']) : null;

        if (!$Id_etat_vehicule) {
            throw new Exception('Veuillez renseigner le lieu.');
        }

        if (!$Id_vehicule) {
            throw new Exception('Veuillez renseigner l\'ID du véhicule.');
        }

        $vehiculesRepository = new VehiculesRepository();
        $isUpdated = $vehiculesRepository->updateVehiculeLieu($Id_vehicule, $Id_etat_vehicule);

        if ($isUpdated) {
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&success=Lieu mis à jour avec succès.');
        } else {
            throw new Exception('Vous n\'avez pas modifié le lieu actuel!');
        }

        exit();
    } catch (Exception $e) {
        error_log("DeclarerChangementLieu Error: " . $e->getMessage());
        header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $Id_vehicule . '&error=' . urlencode($e->getMessage()));
        exit();
    }
}
public function ajouterCommentaire(){
    try {
        $Id_vehicule = isset($_POST['Id_vehicule'])? htmlspecialchars($_POST['Id_vehicule']) : null;
        if (!$Id_vehicule) {
            throw new Exception('Veuillez renseigner l\'ID du véhicule.');
        }
        $Id_personnel = $_SESSION['Id_personnel'];
        $commentaire = isset($_POST['texte'])? htmlspecialchars($_POST['texte']) : null;
        if (!$commentaire) {
            throw new Exception('Veuillez renseigner un commentaire.');
        }
        $vehiculesRepository = new VehiculesRepository();
        $vehiculesRepository->ajouterCommentaire($Id_vehicule, $Id_personnel, $commentaire);
        header('Location: '. HOME_URL. 'dashboard/vehicule_detaille?Id_vehicule='. $Id_vehicule. '&success=Commentaire ajouté avec succès.');
        exit();
        
    } catch (Exception $e) {
        error_log("AjouterCommentaire Error: ". $e->getMessage());
        header('Location: '. HOME_URL. 'dashboard/vehicule_detaille?Id_vehicule='. $Id_vehicule. '&error='. urlencode($e->getMessage()));
        exit();
    
    }
}
public function updateDate_ct(){
    try {
        $Id_vehicule = isset($_POST['Id_vehicule'])? htmlspecialchars($_POST['Id_vehicule']) : null;
        if (!$Id_vehicule) {
            throw new Exception('Veuillez renseigner l\'ID du véhicule.');
        }
       
        $vehiculesRepository = new VehiculesRepository();
        $vehiculesRepository->updateDtaeCT($Id_vehicule);
        header('Location: '. HOME_URL. 'dashboard/vehicule_detaille?Id_vehicule='. $Id_vehicule. '&success=Temps de conso mis à jour avec succès.');
        exit();
        
    } catch (Exception $e) {
        error_log("updateDate_ct Error: ". $e->getMessage());
        header('Location: '. HOME_URL. 'dashboard/vehicule_detaille?Id_vehicule='. $Id_vehicule. '&error='. urlencode($e->getMessage()));
        exit();
    }
}
}
