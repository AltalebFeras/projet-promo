<?php

namespace src\Models;

use src\Services\Hydratation;

class Personnels
{
    private $id_personnel;
    private $nom;
    private $prenom;
    private $date_arrive;
    private $telephone;
    private $email;
    private $mdp;
    private $dtc;
    private $Id_statut_personnels;
    private $Id_role;


    use Hydratation;

    /**
     * Get the value of id_personnel
     *
     * @return  mixed
     */
    public function getIdPersonnel()
    {
        return $this->id_personnel;
    }

    /**
     * Set the value of id_personnel
     *
     * @param   mixed  $id_personnel  
     *
     */
    public function setIdPersonnel($id_personnel)
    {
        $this->id_personnel = $id_personnel;
    }
    /**
     * Get the value of nom
     *
     * @return  mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param   mixed  $nom  
     *
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get the value of prenom
     *
     * @return  mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param   mixed  $prenom  
     *
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * Get the value of date_arrive
     *
     * @return  mixed
     */
    public function getDateArrive()
    {
        return $this->date_arrive;
    }

    /**
     * Set the value of date_arrive
     *
     * @param   mixed  $date_arrive  
     *
     */
    public function setDateArrive($date_arrive)
    {
        $this->date_arrive = $date_arrive;
    }

    /**
     * Get the value of telephone
     *
     * @return  mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param   mixed  $telephone  
     *
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Get the value of email
     *
     * @return  mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param   mixed  $email  
     *
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of mdp
     *
     * @return  mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of mdp
     *
     * @param   mixed  $mdp  
     *
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * Get the value of dtc
     *
     * @return  mixed
     */
    public function getDtc()
    {
        return $this->dtc;
    }

    /**
     * Set the value of dtc
     *
     * @param   mixed  $dtc  
     *
     */
    public function setDtc($dtc)
    {
        $this->dtc = $dtc;
    }

    /**
     * Get the value of Id_statut_personnels
     *
     * @return  mixed
     */
    public function getIdStatutPersonnels()
    {
        return $this->Id_statut_personnels;
    }

    /**
     * Set the value of Id_statut_personnels
     *
     * @param   mixed  $Id_statut_personnels  
     *
     */
    public function setIdStatutPersonnels($Id_statut_personnels)
    {
        $this->Id_statut_personnels = $Id_statut_personnels;
    }

    /**
     * Get the value of Id_role
     *
     * @return  mixed
     */
    public function getIdRole()
    {
        return $this->Id_role;
    }

    /**
     * Set the value of Id_role
     *
     * @param   mixed  $Id_role  
     *
     */
    public function setIdRole($Id_role)
    {
        $this->Id_role = $Id_role;
    }
}
