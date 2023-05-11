<?php

namespace src\models;

use core\BaseModel;
use PDOException;
use PDO;

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

    public function insertUser($fName, $lName, $solde, $email, $password, $isAdmin)
    {
        try {
            $sql = "INSERT INTO $this->table (`nom`, `prenom`, `solde`,`email`,`password`,`is_admin`) VALUES (:nom,:prenom,:solde,:email,:password,:is_admin)";
            $query = $this->_connexion->prepare($sql);
            $query->bindparam(':nom', $fName);
            $query->bindparam(':prenom', $lName);
            $query->bindparam(':solde', $solde);
            $query->bindparam(':email', $email);
            $query->bindparam(':password', $password);
            $query->bindparam(':is_admin', $isAdmin);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function productUser($id)
    {
        try {
            $sql = "DELETE FROM " . $this->table . " WHERE id=" . $id;
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function checkAuth($username)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE email = :username ";
            $query = $this->_connexion->prepare($sql);
            $query->bindparam(':username', $username);
            $query->execute();
            return $query->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}