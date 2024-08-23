<?php

namespace src\Controllers;

use Exception;
use src\Repositories\VehiculesRepository;

class VehiculesController
{

    public function validateKM($vehiculeId)
    {
        $vehiculesRepository = new VehiculesRepository();
        return $vehiculesRepository->getKilometrageByIdVehicule($vehiculeId);
    }

    public function ajouterKilometrage()
    {
        try {
            $vehiculeId = isset($_POST['Id_vehicule']) ? htmlspecialchars($_POST['Id_vehicule']) : null;
            if ($_SESSION['role'] !== 'conducteur') {
                header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&error=Vous ne pouvez pas effectuer cette action.');
                exit();
            }
            $vehiculesRepository = new VehiculesRepository();

            $kilometrage = isset($_POST['km']) ? htmlspecialchars($_POST['km']) : null;

            if (!$kilometrage) {
                throw new Exception('Veuillez renseigner le kilométrage.');
            }


            if (!$vehiculeId) {
                throw new Exception('Veuillez renseigner l\'ID du véhicule.');
            }

            // Validate the new kilometrage against the current one
            $currentKM = $this->validateKM($vehiculeId);

            if ($kilometrage <= $currentKM) {
                throw new Exception('Le kilométrage ne peut pas être inférieur ou égal au kilométrage actuel.');
            }

            if ($kilometrage > 500000) {
                throw new Exception('Le kilométrage ne peut pas dépasser 500 000.');
            }

            $vehiculesRepository->ajouterKilometrage($vehiculeId, $kilometrage);

            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&success=Kilométrage ajouté avec succès.');
            exit();
        } catch (Exception $e) {

            error_log("AjouterKilometrage Error: " . $e->getMessage());
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    }


public function declarerChangementLieu()
{
    try {
        $vehiculeId = isset($_POST['Id_vehicule']) ? htmlspecialchars($_POST['Id_vehicule']) : null;
        if ($_SESSION['role'] == 'conducteur' && $_POST['Id_etat_vehicule'] == 3){
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&error=Vous ne pouvez pas effectuer cette action.');
            exit();
        }
        if ($_SESSION['role'] == 'mecanicien' && $_POST['Id_etat_vehicule'] == 1){
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&error=Vous ne pouvez pas effectuer cette action.');
            exit();
        }

        $Id_etat_vehicule = isset($_POST['Id_etat_vehicule']) ? htmlspecialchars($_POST['Id_etat_vehicule']) : null;

        if (!$Id_etat_vehicule) {
            throw new Exception('Veuillez renseigner le lieu.');
        }

        if (!$vehiculeId) {
            throw new Exception('Veuillez renseigner l\'ID du véhicule.');
        }

        $vehiculesRepository = new VehiculesRepository();
        $isUpdated = $vehiculesRepository->updateVehiculeLieu($vehiculeId, $Id_etat_vehicule);

        if ($isUpdated) {
            header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&success=Lieu mis à jour avec succès.');
        } else {
            throw new Exception('Erreur lors de la mise à jour du lieu.');
        }

        exit();
    } catch (Exception $e) {
        error_log("DeclarerChangementLieu Error: " . $e->getMessage());
        header('Location: ' . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehiculeId . '&error=' . urlencode($e->getMessage()));
        exit();
    }
}

}
