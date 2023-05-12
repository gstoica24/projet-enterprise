<?php

namespace src\logModel;

use core\BaseModel;
use PDOException;

class Logs extends BaseModel
{
    public function __construct()
    {
        $this->table = "logs";
        $this->getConnection();
    }

    public function insertProductLogs($name, $quantity, $price)
    {
        try {
            $sql = "INSERT INTO $this->table (`content-name`, `content-quantity`, `content-price`) VALUES (:nom,:quantite,:prix)";
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

    public function updateUserLog($name, $quantity, $price)
    {
        try {
            $sql = "INSERT INTO $this->table (`content-name`, `content-quantity`, `content-price`) VALUES (:nom,:quantite,:prix)";
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
}
