<?php

namespace src\logModel;

use PDO;
use PDOException;

class Logs
{


    private $host = "localhost";
    private $db_name = "logs";
    private $username = "root";
    private $password = "";
    public $table;
    public $id;
    protected $_connexion;

    public function getConnection()

    {
        // On supprime la connexion précédente
        $this->_connexion = null;

        // On essaie de se connecter à la base avec PDO
        try {
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
            $this->_connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }


    public function __construct()
    {
        $this->getConnection();
    }


    public function getOne($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id=" . $id;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }


    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    // public function insert($id, $fName, $lName, $solde)
    // {
    //     try {
    //         $sql = " $this->table SET nom =:nom, prenom = :prenom, solde = :solde WHERE id= $id";
    //         $query = $this->_connexion->prepare($sql);
    //         $query->bindparam(':nom', $fName);
    //         $query->bindparam(':prenom', $lName);
    //         $query->bindparam(':solde', $solde);
    //         $query->execute();
    //         return ($query->rowcount() > 0);
    //     } catch (PDOException $exception) {
    //         echo "Erreur de connexion : " . $exception->getMessage();
    //     }
    // }
}
