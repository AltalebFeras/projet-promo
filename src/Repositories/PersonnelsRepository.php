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
}