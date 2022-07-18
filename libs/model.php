<?php

class Model
{

    function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connect();
    }
}
