<?php

namespace src\models;

use core\BaseModel;
use PDOException;

class User extends BaseModel
{

    public function __construct()
    {
        $this->table = "user";
        $this->getConnection();
    }

    public function updateUser($id, $fName, $lName, $solde)
    {
        try {
            $sql = "UPDATE $this->table SET nom =:nom, prenom = :prenom, solde = :solde WHERE id= $id";
            $query = $this->_connexion->prepare($sql);
            $query->bindparam(':nom', $fName);
            $query->bindparam(':prenom', $lName);
            $query->bindparam(':solde', $solde);
            $query->execute();
            return ($query->rowcount() > 0);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}
