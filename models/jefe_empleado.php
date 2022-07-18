<?php

Class JefeEmpleadoModel extends Model{
    public function __construct() {
        parent::__construct();
    }

    public function insert($id_empleado,$id_jefe){
        $sql="insert into jefes_empleados (jefe_id,empleado_id) values ($id_jefe,$id_empleado)";
        $sql = $this->conn->prepare($sql);
        return $sql -> execute(); 

    }
    public function delete_empleado($id_empleado){
        $sql="delete from jefes_empleados where empleado_id = $id_empleado";
        $sql = $this->conn->prepare($sql);
        return $sql -> execute(); 

    }
    public function delete_jefe($id_jefe){
        $sql="delete from jefes_empleados where jefe_id = $id_jefe";
        $sql = $this->conn->prepare($sql);
        return $sql -> execute(); 

    }

}