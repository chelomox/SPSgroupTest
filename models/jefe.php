<?php

class JefeModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert($nombre, $correo)
    {

        $sql = "insert into dbo.jefes (nombre,correo,created_at) VALUES ('" . $nombre . "','" . $correo . "', getdate())";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $lastInsertId = $this->conn->lastInsertId();
        if ($lastInsertId > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function show()
    {
        $sql = "SELECT j.id ";
        $sql .= ",j.nombre ";
        $sql .= " ,j.correo ";
        $sql .= " ,isnull(bc.correos,'') correos ";
        $sql .= " FROM dbo.jefes j ";
        $sql .= " left outer join (SELECT je.jefe_id, STRING_AGG(e.correo, '; ') AS correos ";
        $sql .= "                 FROM empleados e ";
        $sql .= "                 inner join jefes_empleados je ";
        $sql .= "                on e.id = je.empleado_id ";
        $sql .= "                GROUP BY je.jefe_id) as bc ";
        $sql .= "ON bc.jefe_id = j.id"; 
        $query = $this->conn->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        return $results;
    }
    public function update($id, $nombre, $correo)
    {
        $sql = "UPDATE jefes set nombre = '$nombre', correo = '$correo', updated_at=getdate() from jefes where id = $id ";
        $sql = $this->conn->prepare($sql);
        return $sql -> execute(); 
    }

    public function delete($id)
    {
        $sql = "DELETE from jefes where id = $id ";
        $query = $this->conn->prepare($sql);
        return $query->execute();
    }

    public function edit($id)
    {
        $sql = "SELECT id, nombre, correo from jefes where id = $id ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $jefe = $query->fetch(PDO::FETCH_OBJ);
        
        return $jefe;
    }
}
