<?php
namespace fw\mods\db\drivers;

class sqlLite implements \fw\db\mainDBIntf{

    public $con;

    public function connect($host=null,$dbname=null,$dbuser=null,$dbpass=null){

        if (is_array($host)){
            $host=$host['bd_path'];

        }elseif(is_null($host)){
            $host=DB_PATH;

        }

        $this->con = new \PDO("sqlite:/path/to/database.sdb");
    }

}