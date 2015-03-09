<?php

/**
 * Database.php
 *
 * Esta clase esta echa para facilitar toda la comunicacion a la base de datos. Aqui se incluiran clases
 * para editar, insertar, y editar clases.
 * @author Daniel Lozano Carrillo
 * @version 2.4
 *
 */

class MySQLDB

//Inicio de clase

{
    var $conexion;
     //La conexion a la base de datos
    /* constructor */
    function MySQLDB() {

        /* Crear la conexion a la base de datos */
        $this->conexion = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_CONTRASENA, BD_NOMBRE);
        if ($this->conexion->connect_errno > 0) {
            die('Unable to connect to database [' . $this->conexion->connect_error . ']');
        }
    }

    /**
     * encargado de mandar querys generales a la base de datos.
     * @param  String $query El query a pasar a la base de datos (SELECT, UPDATE)
     * @return Objeto        El resultado del query.
     */
    function query($query) {
        if(ANVITO_DESARROLLO) {echo "<br>".$query."<br>";}
        $result = $this->conexion->query($query);
        return $result;
    }

    //funcion para seleccionar toda la informacion de una tabla, regresa un array con toda la informacion
    function elegirTodo($table) {
        global $database;
        $q = ("SELECT * FROM `" . $table . "`");
        $result = $this->conexion->query($q);
        return $result;
    }

    // Esta funcion selecciona la informacion de un campo especifico. regresa un array
    function elegirDondeCampo($table, $field, $id) {
        global $database;
        $q = ("SELECT * FROM `" . $table . "` WHERE `" . $field . "` = '" . $id . "'");
        $result = $this->conexion->query($q);
        return $result;
    }

    //Funcion para convertir el resultado de un query a un array.
    function aArray($data) {
        global $database;
        if (!$data == FALSE) {
            while ($rows[] = $data->fetch_assoc());
            array_pop($rows);
            return $rows;
        } else {
            //echo "ERROR not valid DATA!";
        }
    }

    
    function actualizarCampo($table, $field, $value, $field2, $id) {
        $q = "UPDATE " . $table . " SET " . $field . " = '$value' WHERE $field2 = '$id'";
        return $this->conexion->query($q);
    }


    function insertarValor($table, $values) {

        //"INSERT INTO ".TBL_USERS." VALUES ('$username', '$password', '0', $ulevel, '$email', $time)"
        $q = "INSERT INTO `" . $table . "` VALUES" . $values . ";";

        // echo $q;
        return $this->conexion->query($q);
    }

    function existe($query) {
        $result = $this->query($query);
        $nrows = $result->num_rows;
        if (!$result || $nrows < 1) {
            return FALSE;
        } else if ($nrows >= 1) {
            return TRUE;
        }
    }

    function contar($query) {
        return $query->num_rows;
    }

    function elegirUnCampo($table, $field, $where, $value) {
        $query = 'SELECT ' . $field . ' FROM ' . $table . ' WHERE ' . $where . '=' . $value;
        return array_values(mysqli_fetch_array($this->query($query))) [0];
    }

    function aMysqlFecha($date) {
        return date('Y-m-d', strtotime($date));
    }

    //array("Nombre"=>"Daniel","A_Paterno"=>"Lozano","A_Materno"=>"Carrillo");
    function insetarxArray($data) {
         //!!NO PROVADO
         $table=$data['table_name'];
        $query = "INSERT INTO $table ";
       // print_r($data);

        //INSERT INTO tbl_name (col1,col2) VALUES(15,col1*2);

        $fields = "( ";
        $values = "( ";

        foreach ($data as $key => $value) {
            if ($key != "table_name") {

                $fields = $fields . $key . ",";
                $values = $values . '"' . $value . '"' . ",";
            }

            // code...


        }
        $fields = substr($fields, 0, -1);
        $values = substr($values, 0, -1);

        $fields = $fields . ')';
        $values = $values . ')';
        $this->query($query . $fields . ' values ' . $values);
    }

    function actualizarxArray($data) {
         //!!NO PROVADO
         //!
         //!UPDATE  `lab_ligaunav`.`liga` SET  `liga` =  'liga45' WHERE  `liga`.`id` =11;
         $table=$data['table_name'];
        $query = "UPDATE  $table SET ";
       // print_r($data);

        //INSERT INTO tbl_name (col1,col2) VALUES(15,col1*2);

     
        foreach ($data as $key => $value) {
            if ($key != "table_name" && $key != "nombre_identificador" && $key != "identificador_valor") {
                $query=$query . $key . " = '" .$value."',";
            }

            // code...


        }
        $query = substr($query, 0, -1);

        //Esto se puede lograr con una simple variable variable 
        //Es necesario Corrigirla para minizar el trabajo requiero
        //y sea mas funcional la clase.
        $field=$data['nombre_identificador'];
        $field_id=$data['identificador_valor'];
        $query = $query . "WHERE " . $field ." = ". $field_id; 
        $this->query($query);
    }
};

/* Crear conexion a base de datos */

$database = new MySQLDB;
?>