<?php

namespace src\Repositories;

use Exception;
use PDO;
use PDOException;
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

}