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
            $query->execute(['email' => $email]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception('Votre mot de passe et/ou votre email sont incorrect');
            }

            // Verify mdp
            if (!password_verify($mdp, $user['mdp'])) {
                throw new Exception('Votre mot de passe et/ou votre email sont incorrect');
            }
            return $user;
        } catch (PDOException $e) {
            // Log detailed error message
            error_log('Database Error: ' . $e->getMessage());

            throw new Exception('An error occurred during registration: ' . $e->getMessage());
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
    public function getAllPersonnelsDetailed()
    {
        try {
            $query = $this->DB->query('
                SELECT 
                    p.Id_personnel, 
                    p.nom, 
                    p.prenom, 
                    p.date_arrive, 
                    p.telephone, 
                    p.email, 
                    p.dtc, 
                    r.nom AS role_name, 
                    (SELECT texte 
                     FROM ' . PREFIXE . 'evaluations 
                     WHERE Id_personnel = p.Id_personnel 
                     ORDER BY dtc DESC 
                     LIMIT 1) AS last_evaluation
                FROM ' . PREFIXE . 'personnels p
                JOIN ' . PREFIXE . 'roles r ON p.Id_role = r.Id_role
                ORDER BY p.dtc DESC
            ');

            $personnels = $query->fetchAll(PDO::FETCH_ASSOC);
            return $personnels;
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('An error occurred while fetching detailed personnel information.');
        }
    }
    public function getAllPersonnels()
    {

        $query = $this->DB->query('SELECT * FROM ' . PREFIXE . 'personnels');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllStatus()
    {
        $query = $this->DB->query('SELECT * FROM ' . PREFIXE . 'statut');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTheLastStatusForEachPersonnel($Id_personnel)
    {
        try {
            $query = $this->DB->prepare('
                SELECT s.nom AS status_name
                FROM ' . PREFIXE . 'statut_personnel sp
                JOIN ' . PREFIXE . 'statut s ON sp.Id_statut = s.Id_statut
                WHERE sp.Id_personnel = :Id_personnel
                ORDER BY sp.dtc DESC, sp.date_debut DESC
                LIMIT 1
            ');
            $query->bindParam(':Id_personnel', $Id_personnel, PDO::PARAM_INT);
            $query->execute();

            $status = $query->fetch(PDO::FETCH_ASSOC);
            return $status;
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('An error occurred while fetching the personnel status.');
        }
    }


    public function getStatusOfThisPersonnel($Id_personnel)
    {
        try {
            // Query to fetch the most recent status of the personnel
            $query = $this->DB->prepare('
                SELECT sp.*, s.nom as status_name 
                FROM ' . PREFIXE . 'statut_personnel sp 
                JOIN ' . PREFIXE . 'statut s ON sp.Id_statut = s.Id_statut 
                WHERE sp.Id_personnel = :Id_personnel 
                ORDER BY sp.dtc DESC, sp.date_debut DESC
                LIMIT 1
            ');

            $query->execute(['Id_personnel' => $Id_personnel]);
            $statuts_personnel = $query->fetch(PDO::FETCH_ASSOC);

            // Check if a status was found
            if ($statuts_personnel) {
                return $statuts_personnel;
            } else {
                return null; // No status found for this personnel
            }
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('An error occurred while fetching the personnel status.');
        }
    }


    public function getLastEvaluationForThisPersonnel($Id_personnel)
    {
        $query = $this->DB->prepare('SELECT * FROM ' . PREFIXE . 'evaluations WHERE Id_personnel = :Id_personnel ORDER BY dtc DESC LIMIT 1');
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
        $personnel['evaluation'] = $this->getLastEvaluationForThisPersonnel($personnel['Id_personnel']);

        return $personnel;
    }
    public function ajouterEvaluation($Id_personnel, $Id_admin, $texte)
    {
        $query = $this->DB->prepare('INSERT INTO ' . PREFIXE . 'evaluations (Id_personnel, Id_admin, texte, dtc) VALUES (:Id_personnel, :Id_admin, :texte, NOW())');
        $query->execute(['Id_personnel' => $Id_personnel, 'Id_admin' => $Id_admin, 'texte' => $texte]);
        return $this->DB->lastInsertId();
    }
    public function emailExists($email)
    {
        try {
            $query = $this->DB->prepare('SELECT COUNT(*) FROM ' . PREFIXE . 'personnels WHERE email = :email');
            $query->execute(['email' => $email]);
            $count = $query->fetchColumn();

            return $count > 0; // Returns true if email exists, false otherwise
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception('An error occurred while checking the email.');
        }
    }

    public function ajouterPersonnel($nom, $prenom, $date_arrive, $telephone, $email, $mdp, $Id_role, $Id_statut)
    {
        try {
            $query = $this->DB->prepare('
                INSERT INTO ' . PREFIXE . 'personnels (nom, prenom, date_arrive, telephone, email, mdp, dtc, Id_role) 
                VALUES (:nom, :prenom, :date_arrive, :telephone, :email, :mdp, NOW(), :Id_role)
            ');

            $query->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'date_arrive' => $date_arrive,
                'telephone' => $telephone,
                'email' => $email,
                'mdp' => password_hash($mdp, PASSWORD_BCRYPT),
                'Id_role' => $Id_role
            ]);
            $Id_personnel = $this->DB->lastInsertId();

            // Insert personnel status
            $statusQuery = $this->DB->prepare('
                INSERT INTO ' . PREFIXE . 'statut_personnel (Id_statut, Id_personnel, date_debut) 
                VALUES (:Id_statut, :Id_personnel, NOW())
            ');

            $statusQuery->execute([
                'Id_statut' => $Id_statut,
                'Id_personnel' => $Id_personnel
            ]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception('An error occurred while adding the personnel.');
        }
    }
    public function editPersonnel($Id_personnel, $nom, $prenom, $date_arrive, $telephone, $email)
    {
        try {
            $query = $this->DB->prepare('UPDATE ' . PREFIXE . 'personnels SET nom = :nom, prenom = :prenom, date_arrive = :date_arrive, telephone = :telephone, email = :email WHERE Id_personnel = :Id_personnel');
            $query->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'date_arrive' => $date_arrive,
                'telephone' => $telephone,
                'email' => $email,
                'Id_personnel' => $Id_personnel
            ]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception('An error occurred while editing the personnel.');
        }
    }
    public function supprimerPersonnel($Id_personnel)
    {

        try {
            $query = $this->DB->prepare('DELETE FROM ' . PREFIXE . 'personnels WHERE Id_personnel = :Id_personnel');
            $query->execute(['Id_personnel' => $Id_personnel]);
            $query = $this->DB->prepare('DELETE FROM ' . PREFIXE . 'statut_personnel WHERE Id_personnel = :Id_personnel');
            $query->execute(['Id_personnel' => $Id_personnel]);
            $query = $this->DB->prepare('DELETE FROM ' . PREFIXE . 'evaluations WHERE Id_personnel = :Id_personnel');
            $query->execute(['Id_personnel' => $Id_personnel]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception('An error occurred while deleting the personnel.');
        }
    }
    public function ajouterStatusPersonnel($Id_personnel, $Id_statut, $date_debut, $date_fin)
    {

        try {
            $query = $this->DB->prepare('INSERT INTO ' . PREFIXE . 'statut_personnel (Id_statut, Id_personnel, date_debut, date_fin, dtc) VALUES (:Id_statut, :Id_personnel, :date_debut, :date_fin, NOW())');
            $query->execute([
                'Id_statut' => $Id_statut,
                'Id_personnel' => $Id_personnel,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin
            ]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception('An error occurred while adding the personnel status.');
        }
    }
}
