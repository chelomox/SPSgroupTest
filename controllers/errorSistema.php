<?php

class ErrorSistema extends Controller{

    function __construct()
    {
        
    }
    function noController()
    {
        echo "<p>Recurso no disponible.</p>";
    }
    function noMetodo()
    {
        echo "<p>Método no disponible.</p>";
    }
}