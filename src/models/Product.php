<?php

namespace src\models;

use core\BaseModel;
use PDOException;

class Product extends BaseModel
{

    public function __construct()
    {
        $this->table = "product";
        $this->getConnection();
    }

    public function updateStockA($id)
    {
        try {
            $sql = "UPDATE " . $this->table . " SET quantite = quantite + 10 WHERE id=" . $id;
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
    public function updateStockS($id)
    {
        try {
            $sql = "UPDATE " . $this->table . " SET quantite = quantite - 10 WHERE id=" . $id;
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function productDelete($id)

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


    public function updateProduct($id, $name, $quantity, $price)
    {
        try {
            $sql = "UPDATE $this->table SET nom = :nom, quantite = :quantite, prix = :prix WHERE id= $id";
            $query = $this->_connexion->prepare($sql);
            $query->bindparam(':nom', $name);
            $query->bindparam(':quantite', $quantity);
            $query->bindparam(':prix', $price);
            $query->execute();
            return ($query->rowcount() > 0);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function insertProduct($name, $quantity, $price)
    {
        try {
            $sql = "INSERT INTO $this->table (`nom`, `quantite`, `prix`) VALUES (:nom,:quantite,:prix)";
            $query = $this->_connexion->prepare($sql);
            $query->bindparam(':nom', $name);
            $query->bindparam(':quantite', $quantity);
            $query->bindparam(':prix', $price);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }


    public function buyOne($id)
    {
        try {
            $sql = "UPDATE $this->table SET  quantite = quantite - 1 WHERE id= $id";
            $query = $this->_connexion->prepare($sql);
            $query->execute();
            return ($query->rowcount() > 0);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }
}
