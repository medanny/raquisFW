<?php
namespace fw\mods\db\drivers;

class mySQL implements \fw\mods\db\mainDBIntf{

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


        $this->con = new \PDO("mysql:host=".$host.";dbname=".$dbname."", $dbuser, $dbpass );


    }

}