<?php

namespace src\models;

use core\BaseModel;

class Product extends BaseModel
{

    public function __construct()
    {
        $this->table = "product";
        $this->getConnection();
    }

    public function updateStockA($id)
    {
        $sql = "UPDATE " . $this->table . " SET quantite = quantite + 10 WHERE id=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
    public function updateStockS($id)
    {
        $sql = "UPDATE " . $this->table . " SET quantite = quantite - 10 WHERE id=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }


    public function updateProduct($id, $name, $quantity, $price)
    {
        $sql = "UPDATE $this->table SET nom ='$name', quantite = $quantity, prix = $price WHERE id= $id";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return ($query->rowcount() > 0);
    }

    public function insertProduct($id, $name, $quantity, $price)
    {
        $sql = "INSERT INTO $this->table (`nom`, `quantite`, `prix`) VALUES ('$name',$quantity,$price)";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
