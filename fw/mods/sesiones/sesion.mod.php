<?php

namespace fw\core\sesiones;
class Sesion {
	private $sesion;


    function __construct(){
    	session_start();
    	$this->sesion =& $_SESSION;


    }

    public function asignarxArray($variables = array()){
    	if(is_array($variables) && count($variables)>0){
    		foreach ($variable as $key => $value) {
    			$this->sesion[$key]= $value;
    		}
    	}

    }

    public function eliminar($nombre){
    	unset($this->sesion[$nombre]);
    }

    public function id_sesion(){
    	return session_id();

    }

    public function asignar($nombre,$valor){
    	$this->sesion[$nombre]=$valor;

    }

    public function verificar($nombre){
    	return isset($this->sesion[$nombre]);
    }

    public function valor($nombre){
    	if (isset($this->sesion[$nombre])){
    		return $this->sesion[$nombre];

    	}else {

    		return false;
    	}
    }

    public function destruir(){
    	$this->sesion = array();
		session_destroy();

    }


    
}