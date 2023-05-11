<?php

namespace core;

use PDO;
use PDOException;

class BaseModel
{

    private $host = "localhost";
    private $db_name = "backoffice";
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
}
