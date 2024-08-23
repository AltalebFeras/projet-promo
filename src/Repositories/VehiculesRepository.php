<?php

namespace src\Repositories;

use PDO;
use src\Models\Database;

class VehiculesRepository
{
    private $DB;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../../config.php';
    }

    public function getAllVehicules()
    {
        $query = 'SELECT v.*, e.nom AS etat_nom 
                  FROM ' . PREFIXE . 'vehicules v
                  JOIN ' . PREFIXE . 'etat e ON v.Id_etat_vehicule = e.Id_etat_vehicule';
        
        $statement = $this->DB->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getVehiculeById($Id_vehicule)
    {
        $query = 'SELECT v.*, e.nom AS etat_nom 
                  FROM ' . PREFIXE . 'vehicules v
                  JOIN ' . PREFIXE . 'etat e ON v.Id_etat_vehicule = e.Id_etat_vehicule
                  WHERE v.Id_vehicule = :Id_vehicule';
                  
        $statement = $this->DB->prepare($query);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getKilometrageByIdVehicule($vehiculeId)
    {
        $query = 'SELECT km 
                  FROM ' . PREFIXE. 'vehicules 
                  WHERE Id_vehicule = :vehiculeId';
                  
        $statement = $this->DB->prepare($query);
        $statement->bindParam(':vehiculeId', $vehiculeId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC)['km'];
    }

    public function ajouterKilometrage($vehiculeId, $kilometrage)
    {
        $query = 'UPDATE '. PREFIXE. 'vehicules 
                  SET km = :km 
                  WHERE Id_vehicule = :Id_vehicule';
                  
        $statement = $this->DB->prepare($query);
        $statement->bindParam(':km', $kilometrage, PDO::PARAM_INT);
        $statement->bindParam(':Id_vehicule', $vehiculeId, PDO::PARAM_INT);
        $statement->execute();
        
        return $statement->rowCount() > 0;
    }
    public function getAllEtatOfVehicule(){
        $query = 'SELECT * FROM '. PREFIXE. 'etat';
        $statement = $this->DB->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

    // src/Repositories/VehiculesRepository.php

public function updateVehiculeLieu($vehiculeId, $Id_etat_vehicule)
{
    $query = 'UPDATE ' . PREFIXE . 'vehicules 
              SET Id_etat_vehicule = :Id_etat_vehicule 
              WHERE Id_vehicule = :Id_vehicule';
              
    $statement = $this->DB->prepare($query);
    $statement->bindParam(':Id_etat_vehicule', $Id_etat_vehicule, PDO::PARAM_STR);
    $statement->bindParam(':Id_vehicule', $vehiculeId, PDO::PARAM_INT);
    $statement->execute();

    return $statement->rowCount() > 0;
}

}
