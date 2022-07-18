<?php

class EmpleadoModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($nombre, $correo)
    {
        $sql="insert into dbo.empleados (nombre,correo,created_at) VALUES ('".$nombre."','".$correo."', getdate())";
        $query = $this->conn->prepare($sql);
        $query->execute(); 
        $lastInsertId = $this->conn->lastInsertId();
        if ($lastInsertId > 0) {
            return $lastInsertId;
        } else {
            return false;
        }
    }
    public function show()
    {
        $sql = "SELECT * from empleados";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        //var_dump($results);
        return $results;
    }
    public function update($id, $nombre, $correo){
        $sql = "UPDATE empleados set nombre = '$nombre', correo = '$correo', updated_at=getdate() from empleados where id = $id ";
        $sql = $this->conn->prepare($sql);
        return $sql -> execute(); 
    }
    public function delete($id)
    {
        $sql = "DELETE from empleados where id = $id ";
        $query = $this->conn->prepare($sql);
        return $query->execute();
    }
    public function edit($id)
    {
        $sql = "SELECT nombre, correo from empleados where id = $id ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $empleado = $query->fetch(PDO::FETCH_OBJ);

        return $empleado;
    }
}
