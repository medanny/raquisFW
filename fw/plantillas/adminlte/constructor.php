<?php

namespace fw\plantillas\adminlte;
class Constructor extends \fw\mods\plantillas\Constructor{

	function __construct($_titulo){
		parent::__construct();
		$this->titulo=$_titulo;
		$this->parciales = array(
			"content" => "contenido principal de la aplicacion",
			"header" => "contenido principal de la aplicacion",
			"sidebar" => "contenido principal de la aplicacion",
			"footer" => "contenido principal de la aplicacion",
			"rightsidebar" => "contenido principal de la aplicacion"
			
			);
		$this->valoresRequeridos = array(
			"helloworld" => "sample string",
			"skin" => "plantilla y estilo de body"
			);

	}
}

?>