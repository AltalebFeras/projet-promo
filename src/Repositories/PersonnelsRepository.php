<?php

namespace src\Repositories;

use Exception;
use PDO;
use PDOException;
use src\Models\Personnels;
use src\Models\Database;

class PersonnelsRepository
{
    private $DB;

    public function __construct()
    {
        $database = new Database;
        $this->DB = $database->getDB();

        require_once __DIR__ . '/../../config.php';
    }

    public function treatmentSignIn($email, $mdp)
    {
        try {

            $query = $this->DB->prepare('SELECT * FROM ' . PREFIXE . 'personnels WHERE email = :email');
            $query->execute([ 'email' => $email ]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception('user not found');
            }

            // Verify mdp
            if (!password_verify($mdp, $user['mdp'])) {
                throw new Exception('Incorrect  mdp.');
            }
            return $user ;
        }catch (PDOException $e) {
            // Log detailed error message
            error_log('Database Error: ' . $e->getMessage());
            if ($e->getCode() == 23000) { // Duplicate entry error code
                throw new Exception('Username or email already exists.');
            } else {
                throw new Exception('An error occurred during registration: ' . $e->getMessage());
            }
        }
    }
    
    public function getRole($Id_role)
    {
        $query = $this->DB->prepare('SELECT * FROM ' . PREFIXE . 'roles WHERE Id_role = :Id_role');
        $query->execute(['Id_role' => $Id_role]);
        $role = $query->fetch(PDO::FETCH_ASSOC);
        // var_dump( $role['nom']);
        // die();
        return $role['nom']; 
    }
    public function getAllPersonnels(){
    
        $query = $this->DB->query('SELECT * FROM '. PREFIXE.'personnels');
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getStatutPersonnel($Id_statut_personnels){
        $query = $this->DB->prepare('SELECT * FROM '. PREFIXE.'statut WHERE Id_statut_personnels = :Id_statut_personnels');
        $query->execute(['Id_statut_personnels' => $Id_statut_personnels]);
        $statut = $query->fetch(PDO::FETCH_ASSOC);
        // var_dump( $statut['nom']);
        // die();
        return $statut['nom'];
    }
    public function getLastEvaluationForThisPersonnel($Id_personnel)
    {
        $query = $this->DB->prepare('SELECT * FROM '. PREFIXE .'evaluations WHERE Id_personnel = :Id_personnel ORDER BY dtc DESC LIMIT 1');
        $query->execute(['Id_personnel' => $Id_personnel]);
        $evaluation = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($evaluation !== false) {
            return $evaluation['texte']; 
        } else {
            return null; 
        }
    }
    public function getPersonnelById($Id_personnel)
    {
        $query = $this->DB->prepare('SELECT * FROM ' . PREFIXE . 'personnels WHERE Id_personnel = :Id_personnel');
        $query->execute(['Id_personnel' => $Id_personnel]);
        $personnel = $query->fetch(PDO::FETCH_ASSOC);
    
        // Fetch role and status
        $personnel['role_name'] = $this->getRole($personnel['Id_role']);
        // $personnel['statut_personnels'] = $this->getStatutPersonnel($personnel['Id_statut_personnels']);
        $personnel['evaluation'] = $this->getLastEvaluationForThisPersonnel($personnel['Id_personnel']);
    
        return $personnel;
    }
    public function ajouterEvaluation($Id_peronnel, $Id_admin, $texte){
        $query = $this->DB->prepare('INSERT INTO '. PREFIXE.'evaluations (Id_personnel, Id_admin, texte, dtc) VALUES (:Id_personnel, :Id_admin, :texte, NOW())');
        $query->execute(['Id_personnel' => $Id_peronnel, 'Id_admin' => $Id_admin, 'texte' => $texte]);
        return $this->DB->lastInsertId();
    }
    
    

}