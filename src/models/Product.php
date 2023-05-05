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

    public function updateProduct($id)
    {
        $sql = "INSERT INTO " . $this->table . "  WHERE id=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}
