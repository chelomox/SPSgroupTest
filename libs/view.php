<?php

class View {
    function __construct(){
        //echo "vista base";
    } 
    function render($name)
    {
        require('views/'.$name.'.php');

    }
}

