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

    public function getKilometrageByIdVehicule($Id_vehicule)
    {
        $query = 'SELECT km 
                  FROM ' . PREFIXE . 'vehicules 
                  WHERE Id_vehicule = :Id_vehicule';

        $statement = $this->DB->prepare($query);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC)['km'];
    }

    public function ajouterKilometrage($Id_vehicule, $kilometrage)
    {
        $query = 'UPDATE ' . PREFIXE . 'vehicules 
                  SET km = :km 
                  WHERE Id_vehicule = :Id_vehicule';

        $statement = $this->DB->prepare($query);
        $statement->bindParam(':km', $kilometrage, PDO::PARAM_INT);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
    public function getAllEtatOfVehicule()
    {
        $query = 'SELECT * FROM ' . PREFIXE . 'etat';
        $statement = $this->DB->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // src/Repositories/VehiculesRepository.php

    public function updateVehiculeLieu($Id_vehicule, $Id_etat_vehicule)
    {
        $query = 'UPDATE ' . PREFIXE . 'vehicules 
              SET Id_etat_vehicule = :Id_etat_vehicule 
              WHERE Id_vehicule = :Id_vehicule';

        $statement = $this->DB->prepare($query);
        $statement->bindParam(':Id_etat_vehicule', $Id_etat_vehicule, PDO::PARAM_STR);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->execute();

        return $statement->rowCount() > 0;
    }
    public function ajouterCommentaire($Id_vehicule, $Id_personnel, $commentaire)
    {
        $query = 'INSERT INTO ' . PREFIXE . 'commentaires (Id_vehicule, Id_personnel, texte, dtc) 
              VALUES (:Id_vehicule, :Id_personnel, :texte, NOW())';

        $statement = $this->DB->prepare($query);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->bindParam(':Id_personnel', $Id_personnel, PDO::PARAM_INT);
        $statement->bindParam(':texte', $commentaire, PDO::PARAM_STR);
        $statement->execute();

        return $this->DB->lastInsertId();
    }

    public function getLastCommentairesByIdVehicule($Id_vehicule, $Id_role)

    {
        $query = 'SELECT c.texte, c.dtc, p.nom, p.prenom 
        FROM ' . PREFIXE . 'commentaires c
        JOIN ' . PREFIXE . 'personnels p ON c.Id_personnel = p.Id_personnel
        WHERE c.Id_vehicule = :Id_vehicule
        AND p.Id_role = :Id_role
        ORDER BY c.dtc DESC
        LIMIT 1';

        $statement = $this->DB->prepare($query);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->bindParam(':Id_role', $Id_role, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateDtaeCT($Id_vehicule)
    {

        $query = 'UPDATE ' . PREFIXE . 'vehicules 
              SET date_ct = NOW() WHERE id_vehicule = :Id_vehicule';
        $statement = $this->DB->prepare($query);
        $statement->bindParam(':Id_vehicule', $Id_vehicule, PDO::PARAM_INT);
        $statement->execute();
        return $statement->rowCount() > 0;
    }
    public function getAllEtats()
    {
        $query = 'SELECT * FROM ' . PREFIXE . 'etat';
        $statement = $this->DB->prepare($query);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
