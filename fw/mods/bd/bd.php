<?php
/**
 * Created by PhpStorm.
 * User: Beast
 * Date: 5/19/2016
 * Time: 7:51 AM
 */
namespace fw\mods\bd;
class BD
{

    //var $conexion;
    public $conn;

    function __construct($servidor= null, $usuario= null, $contrasena= null, $bd_nombre= null) {
        $bd_nombre=BD_NOMBRE;
        $usuario=BD_USUARIO;
        $contrasena=BD_CONTRASENA;
        $servidor=BD_SERVIDOR;

        $this->conn = new mysqli($servidor, $usuario, $contrasena, $bd_nombre);
    }

    public function query($query) {
        // echo $query;
        return $this->conn->query($query);
    }

    public function aArray($data) {
        if (!$data == FALSE) {
            while ($rows[] = $data->fetch_assoc());
            array_pop($rows);
            return $rows;
        } else {

        }
    }

    public function insertarxArray($data) {

        $tabla = $data['nombre_tabla'];
        $query = "INSERT INTO $tabla ";
        unset($data['nombre_tabla']);
        $campos = "( ";
        $valores = "( ";

        foreach ($data as $key => $value) {

            $campos = $campos . $key . ",";
            $valores = $valores . '"' . $value . '"' . ",";
        }

        $campos = substr($campos, 0, -1);
        $valores = substr($valores, 0, -1);

        $campos = $campos . ')';
        $valores = $valores . ')';
        $this->query($query . $campos . ' VALUES ' . $valores);
    }

    public function actualizarxArray($data) {
        $table = $data['nombre_tabla'];
        $query = "UPDATE  $table SET ";
        foreach ($data as $key => $value) {
            if ($key != "nombre_tabla" && $key != "nombre_identificador" && $key != "identificador_valor") {
                $query = $query . $key . " = '" . $value . "',";
            }
        }
        $query = substr($query, 0, -1);
        $field = $data['nombre_identificador'];
        $field_id = $data['identificador_valor'];
        $query = $query . "WHERE " . $field . " = " . $field_id;
        $this->query($query);
    }
}
