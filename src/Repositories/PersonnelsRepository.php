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
                throw new Exception('Incorrect email.');
            }

            // Verify mdp
            if (!password_verify($mdp, $user['mdp'])) {
                throw new Exception('Incorrect password.');
            }
            return $user ;
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function getRole($Id_role)
    {
        $query = $this->DB->prepare('SELECT * FROM ' . PREFIXE . 'roles WHERE Id_role = :Id_role');
        $query->execute(['Id_role' => $Id_role]);
        $role = $query->fetch(PDO::FETCH_ASSOC);
        return $role; 
    }
}