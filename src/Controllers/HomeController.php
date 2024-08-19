<?php

namespace src\Controllers;


class HomeController
{
    public function index(){
        include_once __DIR__.'/../Views/home/connexion.php';
    }
    public function page404(){
        include_once __DIR__.'/../Views/home/404.php';

    }

}
