<?php

namespace core;

use src\Controllers\ProductController;
use src\Controllers\UserController;

class App
{

    public function run()
    {

        $uri = $_SERVER['REQUEST_URI'];

        if ($uri == '/') {
            // $nctrl = new NewController;
            // $nctrl->index();
        } else if ($uri == '/products') {
            // créer prdct ctrl
            // appeler action index

            $pctrl = new ProductController;
            $pctrl->index();
        } else if ($uri == '/user') {
            $uctrl = new UserController;
            $uctrl->index();
        }
    }
}

//     $_SERVER['REQUEST_URI']
// si ( tu demandes la page /users/ ) {
//     charge l'action index du controlleur user
// }