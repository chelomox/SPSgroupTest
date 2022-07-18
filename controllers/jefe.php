<?php

require_once 'models/jefe.php';

class Jefe extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $jefeModel = new JefeModel();
        $jefes = $jefeModel->show();
        //var_dump($jefes);
        include('views/jefe/index.php');
    }

    function create()
    {
        include('views/jefe/create.php');
    }

    function insert()
    {
        $nombre = $_REQUEST['nombre'];
        $correo = $_REQUEST['correo'];
        $jefeModel = new JefeModel();
        return $jefeModel->insert($nombre, $correo);
    }

    function update()
    {

        $nombre = $_REQUEST['nombre'];
        $correo = $_REQUEST['correo'];
        $id = $_REQUEST['id'];
        $jefeModel = new JefeModel();
        if($jefeModel->update($id, $nombre, $correo))
        {
            $salida['mensaje'] = "Registro actualizado correctamente.";
        }else{
            $salida['mensaje'] = "No se pudo actualizar, intente nuevamente.";
        }
        echo $salida['mensaje'];
    }

    function delete()
    {
        $id = $_REQUEST['id'];
        $jefeModel = new JefeModel();
        $jefeModel->delete($id);
        echo "Registro eliminado";
    }

    function edit()
    {
        $jefeModel = new JefeModel();
        $id = $_REQUEST['id'];
        $jefe = $jefeModel->edit($id);

        echo json_encode($jefe);
    }

    function show()
    {
        $data["data"] = array();

        $jefeModel = new JefeModel();

        foreach ($jefeModel->show() as $key => $jefe) {
            $ret['id'] = $jefe->id;
            $ret['nombre'] = $jefe->nombre;
            $ret['correo'] = $jefe->correo;
            $ret['correos'] = $jefe->correos;
            $ret['botones'] =  "
                        <button type=\"button\" class=\"btn btn-primary editar\" jefe_id=\"$jefe->id\">
                            Editar
                        </button>
                        <button type=\"button\" class=\"btn btn-danger eliminar\" jefe_id=\"$jefe->id\">
                            Eliminar
                        </button>";
            $data["data"][] = $ret;
        }
        echo json_encode($data);
    }
}
