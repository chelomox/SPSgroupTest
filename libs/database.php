<?php

Class Database{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    function __construct(){
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->charset = constant('CHARSET');
    }

    function connect(){
        try {  
            $conn = new PDO( "sqlsrv:Server=".$this->host.";Database=".$this->db, $this->password, NULL);   
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
         }  
           
         catch( PDOException $e ) {  
            die( "Error connecting to SQL Server. ".$e->getMessage() );   
         }  
         return $conn;
    }

}

