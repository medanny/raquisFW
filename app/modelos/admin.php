<?php

/**
* 
*/
class Admin extends Modelo
{
	public $usuario;
	public $t_sesion;
	public $plantilla;

	public function __construct(){
		$this->usuario = new Usuario;
		global $sesion;
		$this->t_sesion =& $sesion;
		$this->plantilla = new Tema;
	}


	public function sayHello(){
		return "Hello";
	}
	public function inciarSesion($usuario,$contrasena){
		return $this->usuario->inciarSesion($usuario,$contrasena);
	}
	
}