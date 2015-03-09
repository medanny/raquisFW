<?php

class Lenguaje {
	private $lenguaje;
	public $g = Array();

	public function __construct($lenguaje){
		$this->lenguaje = $lenguaje;
		$archivo=ROOT."/app/lenguaje/".$lenguaje.".ini";
		if(!file_exists($archivo)){
    }
    $this->g = parse_ini_file($archivo);
	}



}