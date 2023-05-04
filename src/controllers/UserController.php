<?php

namespace src\controllers;

use core\BaseController;
use src\models\User;

class UserController extends BaseController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new User;
    }

    // L'action index récupère les données du modèle et charge la vue
    public function index()
    {
        // echo "Ici nous aurons la liste des produits<br>";

        // Grâce aux méthodes du modèle, on récupère les données
        // que l'on stocke dans un tableau $produits
        // - - - Comment faire ?
        $users = $this->model->getAll();


        // Et on charge la vue, qui aura accès au tableau "$produits"
        // - - - Utilisez soit require() soit Twig

        $this->render("users.html.twig", array('user' => $users));
    }
}
