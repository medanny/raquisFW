<?php

namespace fw\mods\db;

class mainDBDriver {
    public $driver;
    public $result;
    public $n_querys;
    public $last_query;
    public $errors;



    public function __construct($driver,$host=null,$dbname=null,$dbuser=null,$dbpass=null) {

        $driver = "\\fw\\mods\\db\\drivers\\".$driver;
        $this->driver = new $driver;
        $this->driver->connect($host,$dbname,$dbuser,$dbpass);
    }

    public function q($stm){
        unset($this->result);
        $this->result=$this->driver->con->prepare($stm);
        $result = $this->result->execute();
        $this->last_query=$stm;
        $this->n_querys++;
        return $this;
    }

    public function query($stm){
        unset($this->result);
        $this->result=$this->driver->con->prepare($stm);
        $result = $this->result->execute();
        $this->last_query=$stm;
        $this->n_querys++;
        return $result;
    }

    public function aArray(){
        $this->result->setFetchMode(\PDO::FETCH_ASSOC);
        return $this->result->fetchAll();
    }

    public function insertar($vars, $exclude=Array(), $table=null) {
        //verify that table is set if not, look in vars for it.
        if ($table==null && isset($vars['table'])) {
            $table=$vars['table'];
            unset($vars['table']);
        } elseif ($table==null && !isset($vars['table']) ) {
            throw new \Exception('Table name not spicify');
        }
        /* @var $stm String */
        $stm = "INSERT INTO `{$table}` SET ";
        foreach($vars as $key=>$value){
            if(in_array($key, $exclude)){
                continue;
            }
            $stm .= "`{$key}` = '{$value}', ";
        }
        $stm = trim($stm, ', ');
        return $this->q($stm);
    }

   public function seleccionar($from, $cols="*", $where=null, $orderBy='', $limit=''){

        $query = "SELECT {$cols} FROM `{$from}` WHERE ";

        if(is_null($where)){
            $query = substr($query, 0, -6);
        }else{

        foreach ($where as $key) {
            if($key[2]==1){
                $query.= $key[0].'='.$key[1] . ' AND ';
            }
            if($key[2]==2){
                $query.= $key[0].' LIKE \'%'.$key[1].'%\' AND ';
            }

        }
            $query = substr($query, 0, -5);
        }

        if($orderBy != ''){
            $query .= ' ORDER BY ' . $orderBy;
        }
        if($limit != ''){
            $query .= ' LIMIT ' . $limit;
        }


        $this->q($query);
        return $this->aArray();
    }

    public function borrar($table,$where){
        $query = "DELETE FROM `{$table}` WHERE ";

        foreach ($where as $key) {
            if($key[2]==1){
                $query.= $key[0].'='.$key[1] . ' AND ';
            }
            if($key[2]==2){
                $query.= $key[0].' LIKE \'%'.$key[1].'%\' AND ';
            }

        }
            $query = substr($query, 0, -5);
           $result = $this->q($query);
        return $result;


    }

    public function actualizar(){

    }

    public function actualizarXArray($_data){
        $table = $_data['nombre_tabla'];
        $query = "UPDATE  $table SET ";
        foreach ($_data as $key => $value) {
            if ($key != "nombre_tabla" && $key != "nombre_identificador" && $key != "identificador_valor") {
                $query = $query . $key . " = '" . $value . "',";
            }
        }
        $query = substr($query, 0, -1);
        $field = $_data['nombre_identificador'];
        $field_id = $_data['identificador_valor'];
        $query = $query . "WHERE " . $field . " = " . $field_id;
        $this->query($query);
    }

    public function insertarXArray($_data){
        $tabla = $_data['nombre_tabla'];
        $query = "INSERT INTO $tabla ";
        unset($_data['nombre_tabla']);
        $campos = "( ";
        $valores = "( ";

        foreach ($_data as $key => $value) {

            $campos = $campos . $key . ",";
            $valores = $valores . '"' . $value . '"' . ",";
        }

        $campos = substr($campos, 0, -1);
        $valores = substr($valores, 0, -1);

        $campos = $campos . ')';
        $valores = $valores . ')';
        $this->query($query . $campos . ' VALUES ' . $valores);
    }






}