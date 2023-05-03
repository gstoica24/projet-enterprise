<?php

namespace core;



class App
{

    public function run()
    {

        $server = $_SERVER['REQUEST_URI'];

        if ($server == '/') {
            echo 'Bonjour';
        }
    }
}

//     $_SERVER['REQUEST_URI']
// si ( tu demandes la page /users/ ) {
//     charge l'action index du controlleur user
// }