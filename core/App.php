<?php

namespace core;

use src\Controllers\ProductController;
use src\Controllers\UserController;
use src\models\Product;

class App
{

    public function __construct()
    {
        session_start();
    }

    public function run()
    {



        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        if ($uri == '/api/products') {
            $pctrl = new ProductController;
            $pctrl->apiProducts();
        } else if ($uri == '/api/products/consume' && isset($_GET['id'])) {
            $pctrl = new ProductController;
            $pctrl->apiProductsConsume();
        }
        if (isset($_SESSION['username'])) {
            if ($uri == '/') {
                $nctrl = new UserController;
                $nctrl->accueil();
            }
        }
        if (isset($_SESSION['username'])) {
            if ($uri == '/products') {
                // créer prdct ctrl
                // appeler action index
                $pctrl = new ProductController;
                $pctrl->index();
            } else if ($uri == '/users') {
                $uctrl = new UserController;
                $uctrl->index();
            } else if ($uri == '/products/restock+' && isset($_GET['id'])) {
                $pctrl = new ProductController;
                $pctrl->addTen();
            } else if ($uri == '/products/restock-' && isset($_GET['id'])) {
                $pctrl = new ProductController;
                $pctrl->supTen();
            } else if ($uri == '/product' && isset($_GET['id'])) {
                $pctrl = new ProductController;
                $pctrl->product();
            } else if ($uri == '/product/modifyDB') {
                $pctrl = new ProductController;
                $pctrl->productModify();
            } else if ($uri == '/addproduct') {
                $pctrl = new ProductController;
                $pctrl->productNew();
            } else if ($uri == '/addproduct/insert') {
                $pctrl = new ProductController;
                $pctrl->productInsert();
            } else if ($uri == '/user' && isset($_GET['id'])) {
                $ucrtl = new UserController;
                $ucrtl->user();
            } else if ($uri == '/user/modifyUserDB') {
                $uctrl = new UserController;
                $uctrl->userModify();
            } else if ($uri == '/addusers') {
                $uctrl = new UserController;
                $uctrl->userNew();
            } else if ($uri == '/addusers/insert') {
                $uctrl = new UserController;
                $uctrl->userInsert();
            } else if ($uri == '/product/delete') {
                $pctrl = new ProductController;
                $pctrl->deleteProduct();
            } else if ($uri == '/user/delete') {
                $ucrtl = new UserController;
                $ucrtl->deleteUser();
            } else if ($uri == '/logout') {
                $ucrtl = new UserController;
                $ucrtl->logout();
            } else if ($uri == '/logs') {
                $pctrl = new ProductController;
                $pctrl->logs();
            }
        } else {

            if ($uri == '/auth') {

                $urcsCTRL = new UserController;
                $urcsCTRL->auth();
            } else if ($uri == '/login') {
                $nctrl = new UserController;
                $nctrl->accueil();
            }
        }
    }
}
