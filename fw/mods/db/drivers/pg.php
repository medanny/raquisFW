<?php
namespace fw\mods\db\drivers;

class pg implements \fw\db\mainDBIntf{

    public $con;

    public function connect($host=null,$dbname=null,$dbuser=null,$dbpass=null){

        if (is_array($host)){
            $dbname=$host['bd_nombre'];
            $dbuser=$host['bd_usuario'];
            $dbpass=$host['bd_pass'];
            $host=$host['host'];

         }elseif(is_null($host)){
            $dbname=BD_NOMBRE;
            $dbuser=BD_USUARIO;
            $dbpass=BD_CONTRASENA;
            $host=BD_SERVIDOR;
        }

        $this->con = new \PDO("pgsql:dbname=".$dbname.";host=".$host."", $dbuser, $dbpass );
    }

}