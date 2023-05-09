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

        $this->render("users.html.twig", array('users' => $users));
    }

    public function user()
    {
        $user = $this->model->getOne($_GET['id']);
        $this->render("user.html.twig", array('user' => $user));
    }

    public function userModify()
    {
        $this->model->updateUser($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['solde']);
        header('Location: /users');
    }
}