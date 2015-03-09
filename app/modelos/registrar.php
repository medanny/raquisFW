<?php
class Registrar extends Modelo{
    public $usuario;
	public $t_sesion;
	public $plantilla;

	public function __construct(){
		$this->usuario = new Usuario;
		global $sesion;
		$this->t_sesion =& $sesion;
		$this->plantilla = new Tema;
	}
	
}