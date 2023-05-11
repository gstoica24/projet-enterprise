<?php

namespace core;

class BaseController
{
    private $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FileSystemLoader('../templates');
        $this->twig = new \Twig\Environment($loader);
        $this->twig->addGlobal('session', $_SESSION);
    }

    public function render($name, $context)
    {
        echo $this->twig->render($name, $context);
    }
}