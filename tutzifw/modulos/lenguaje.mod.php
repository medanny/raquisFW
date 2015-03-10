<?php
/**
 * la clase Lenguaje puede ser usadaba para crear aplicaciones, en diferentes diferentes idiomas
 * usando archivos .ini faciles de entender y desarrollar por usuarios comunes, facilitando su 
 * traduccion.
 *
 * @author Daniel Lozano Carrillo <daniel@unav.edu.mx>
 * @package Mod
 * @version 0.1
 * @license MIT
 * 
 */
class Lenguaje {
	private $lenguaje;
	public $g = Array();
	/**
	 * Constructor, se encarga, de construir la plantilla rexibe el lenguaje.
	 * @param String $lenguaje el lenguaje ex: en,es,fr
	 */
	public function __construct($lenguaje){
		$this->lenguaje = $lenguaje;
		$archivo=ROOT."/app/lenguaje/".$lenguaje.".ini";
		if(!file_exists($archivo)){
    }
    $this->g = parse_ini_file($archivo);
	}



}