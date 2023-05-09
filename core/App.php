<?php

namespace core;

use src\Controllers\ProductController;
use src\Controllers\UserController;

class App
{

    public function run()
    {

        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        if ($uri == '/') {
            // $nctrl = new NewController;
            // $nctrl->index();
        } else if ($uri == '/products') {
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
        }
    }
}

//     $_SERVER['REQUEST_URI']
// si ( tu demandes la page /users/ ) {
//     charge l'action index du controlleur user
// }