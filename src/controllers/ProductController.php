<?php

namespace src\controllers;

use core\BaseController;
use src\models\Product;

class ProductController extends BaseController
{
    private $model;
    private $logModel;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Product;
    }

    // L'action index récupère les données du modèle et charge la vue
    public function index()
    {
        // echo "Ici nous aurons la liste des produits<br>";

        // Grâce aux méthodes du modèle, on récupère les données
        // que l'on stocke dans un tableau $produits
        // - - - Comment faire ?
        $products = $this->model->getAll();

        //message flash pour chaque action;

        $message = $_SESSION['message'];



        // Et on charge la vue, qui aura accès au tableau "$produits"
        // - - - Utilisez soit require() soit Twig

        $this->render("products.html.twig", array('produits' => $products, 'message' => $message));
    }


    public function addTen()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->updateStockA($id);
            $_SESSION['message'] = 'Un produit a ete augmente de 10';
            header('Location: /products');
        }
    }
    public function supTen()
    {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->updateStockS($id);
            $_SESSION['message'] = 'Un produit a ete reduit de 10';
            header('Location: /products');
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->productDelete($id);
            $_SESSION['message'] = 'Un produit a ete supprime';
            header('Location: /products');
        }
    }

    public function product()
    {
        $id = $_GET['id'];
        if (isset($id)) {
            $product = $this->model->getOne($id);
            $this->render("product.html.twig", array('produit' => $product));
        }
    }

    public function productModify()
    {
        if (isset($_POST['id'], $_POST['nom'], $_POST['quantite'], $_POST['prix'])  && !empty(trim($_POST['nom']))  && !empty(trim($_POST['quantite']))  && !empty(trim($_POST['prix']))) {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $quantite = $_POST['quantite'];
            $prix = $_POST['prix'];
            $this->model->updateProduct($id, $nom, $quantite, $prix);
            $this->logModel->insert($quantite, $prix);
            $_SESSION['message'] = 'Le produit ' . $nom . ' a ete modifie';
            header('Location: /products');
        }
    }

    public function productNew()
    {
        $this->render("addproduct.html.twig", array('produit' => ""));
    }

    public function productInsert()
    {

        if (isset($_POST['nom'], $_POST['quantite'], $_POST['prix'])  && !empty(trim($_POST['nom']))  && !empty(trim($_POST['quantite']))  && !empty(trim($_POST['prix']))) {
            $nom = $_POST['nom'];
            $quantite = $_POST['quantite'];
            $prix = $_POST['prix'];
            $this->model->insertProduct($nom, $quantite, $prix);
            $_SESSION['message'] =  $nom . ' a ete ajoute dans la liste de produit';
            header('Location: /products');
        }
    }
}
