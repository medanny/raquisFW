<?php

namespace fw\mods\sesiones;
/**
 * Class Sesion
 * @package fw\core\sesiones
 */
class Sesion {
	/**
	 * @var
     */
	private $sesion;


	/**
	 *
     */
	function __construct(){
    	session_start();
    	$this->sesion =& $_SESSION;


    }

	/**
	 * @param array $variables
     */
	public function asignarxArray($variables = array()){
    	if(is_array($variables) && count($variables)>0){
    		foreach ($variables as $key => $value) {
    			$this->sesion[$key]= $value;
    		}
    	}

    }

	/**
	 * @param $nombre
     */
	public function eliminar($nombre){
    	unset($this->sesion[$nombre]);
    }

	/**
	 * @return string
     */
	public function id_sesion(){
    	return session_id();

    }

	/**
	 * @param $nombre
	 * @param $valor
     */
	public function asignar($nombre,$valor){
    	$this->sesion[$nombre]=$valor;

    }

	/**
	 * @param $nombre
	 * @return bool
     */
	public function verificar($nombre){
    	return isset($this->sesion[$nombre]);
    }

	/**
	 * @param $nombre
	 * @return bool
     */
	public function valor($nombre){
    	if (isset($this->sesion[$nombre])){
    		return $this->sesion[$nombre];

    	}else {

    		return false;
    	}
    }

	/**
	 *
     */
	public function destruir(){
    	$this->sesion = array();
		session_destroy();

    }


    
}