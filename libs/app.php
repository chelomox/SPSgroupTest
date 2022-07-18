<?php

require_once 'controllers/errorSistema.php';

class App{
    function __construct(){

        if(!isset($_GET['url'])){
            $_GET['url'] = '';
        }

        $url = $_GET['url'];
        $url = rtrim($url,'/');
        $url = explode("/",$url);

        if(empty($url[0])){
            include('views/index.php');
            return false;
        }

        $archivoController = 'controllers/'. $url[0] . '.php';
        if(file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            if(isset($url[1]))
            {
                if(method_exists($controller,$url[1]))
                {
                    $controller->{$url[1]}();
                }else{
                    $controller = new ErrorSistema();
                    $controller->noMetodo();
                }
            }
        }else{
            $controller = new ErrorSistema();
            $controller->noController();
        }
       
    }

}
