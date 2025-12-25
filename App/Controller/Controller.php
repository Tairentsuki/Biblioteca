<?php


namespace App\Controller;

abstract class Controller
{

    protected static function isProtected(){
        if(!isset($_SESSION['usuario_id'])){
            header("Location: /login");
            exit();
        }
    }
}