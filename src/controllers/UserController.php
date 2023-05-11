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
    public function accueil()
    {
        $this->render("login.html.twig", array('users' => ""));
    }
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
        if (isset($_GET['id'])) {
            $user = $this->model->getOne($_GET['id']);
            $this->render("user.html.twig", array('user' => $user));
        }
    }

    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->productUser($id);
            header('Location: /users');
        }
    }

    public function userModify()
    {
        if (isset($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['solde'])  && !empty(trim($_POST['nom']))  && !empty(trim($_POST['prenom']))  && !empty(trim($_POST['solde']))) {
            $this->model->updateUser($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['solde']);
            $message = 'L \'utilisateur' . $_POST['nom'] . 'a ete modifie';
            $this->render("users.html.twig", array('message' => $message));
        }
    }

    public function userNew()
    {
        $this->render("addusers.html.twig", array('user' => ""));
    }

    public function userInsert()
    {
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['solde'], $_POST['email'], $_POST['password'], $_POST['is_admin']) && !empty(trim($_POST['nom'])) && !empty(trim($_POST['prenom'])) && !empty(trim($_POST['solde'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
            $nom = $_POST['nom'];
            $prenom =  $_POST['prenom'];
            $solde = $_POST['solde'];
            $email = $_POST['email'];
            $isAdmin = $_POST['is_admin'];
            $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
            $this->model->insertUser($nom,  $prenom,  $solde, $email, $password, $isAdmin);
            header('Location: /users');
        }
    }

    public function auth()
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $resultat = $this->model->checkAuth($_POST['email']);
            if (password_verify($_POST["password"], $resultat->password) && $resultat->is_admin == 1) {
                $_SESSION['username'] = $resultat->nom;
                header("location: /users");
            } else {
                header('Location: /login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}