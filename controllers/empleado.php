<?php

require_once 'models/empleado.php';
require_once 'models/jefe_empleado.php';
class Empleado extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $empleadoModel = new EmpleadoModel();
        $empleados = $empleadoModel->show();
        include('views/empleado/index.php');
    }

    function insert()
    {
        $nombre = $_REQUEST['nombre'];
        $correo = $_REQUEST['correo'];
        $jefes_id = $_REQUEST['jefes_id'];
        //var_dump($jefes_id);
        $empleadoModel = new empleadoModel();
        $nuevoIdEmpleado =  $empleadoModel->insert($nombre, $correo);
        if($nuevoIdEmpleado > 0)
        {
            $jefe_empleadoModel = new JefeEmpleadoModel();
            foreach($jefes_id as $id_jefe)
            {
                $jefe_empleadoModel->insert($nuevoIdEmpleado,$id_jefe);
            }
            $salida['mensaje'] = "Registro actualizado correctamente.";
        }else{
            $salida['mensaje'] = "No se pudo actualizar, intente nuevamente.";
        }
        $data["data"][] =  $salida;
        echo json_encode($data);

    }

    function update()
    {
        $nombre = $_REQUEST['nombre'];
        $correo = $_REQUEST['correo'];
        $id = $_REQUEST['id'];
        $empeladoModel = new EmpleadoModel();
        return $empeladoModel->update($id, $nombre, $correo);
    }

    function delete()
    {
        $id = $_REQUEST['id'];
        $empleadoModel = new EmpleadoModel();
        if($empleadoModel->delete($id))
        {
            $salida['mensaje'] = "Registro eliminado correctamente.";
        } else{
            $salida['mensaje'] = "No se pudo eliminar, intente nuevamente.";
        }
        echo $salida['mensaje'];
    }

    function edit()
    {
        $id = $_REQUEST['id'];
        $empleadoModel = new EmpleadoModel();
        $empleado = $empleadoModel->edit($id);
        echo json_encode($empleado);
        
    }
    
    function show()
    {
        $data["data"] = array();

        $empleadoModel = new EmpleadoModel();

        foreach ($empleadoModel->show() as $key => $empleado) {
            $ret['id'] = $empleado->id;
            $ret['nombre'] = $empleado->nombre;
            $ret['correo'] = $empleado->correo;
            $ret['botones'] =  "
                        <button type=\"button\" class=\"btn btn-primary editar\" empleado_id=\"$empleado->id\">
                            Editar
                        </button>
                        <button type=\"button\" class=\"btn btn-danger eliminar\" empleado_id=\"$empleado->id\">
                            Eliminar
                        </button>";
            $data["data"][] = $ret;
        }
        echo json_encode($data);
    }
}
