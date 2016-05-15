<?php

namespace fw\mods\plantillas;

use \fw\mods\plantillas\Motor;
class Constructor{
	public $valoresRequeridos;
	public $valores;
	public $parciales;
	public $titulo;
	public $urlPlantilla;
	public $manejadordePlantillas;

	public function __construct(){
		$this->urlPlantilla = RUTA_PLANTILLA_HTML;
		$this->obtenerValoresyParciales();
		$this->manejadordePlantillas =  new Motor(RUTA_PLANTILLA_HTML."plantilla_principal.html");
	}

	public function obtenerValoresyParciales(){
		$valores = parse_ini_file(ROOT."/fw/plantillas/".PLANTILLA."/"."setup.ini",true);
		$this->parciales=$valores['parciales'];
		$this->valoresRequeridos=$valores['valores'];
	}

	public function valoresRequeridos (){
		$valores_requeridos = "";

		foreach ($this->valoresRequeridos as $key) {
			$valores_requeridos  += "," . $key;
		}
		return $valores_requeridos;
	}

	public function parcialesRequeridos (){
		$parciales_requeridos = "";

		foreach ($this->parciales as $key) {
			$parciales_requeridos  += "," .$key;
		}
		return $parciales_requeridos;
	}

	
	public function asignarValor($_llave,$_valor){
		$this->valores[$_llave] = $_valor;
		unset($this->valoresRequeridos[$_llave]);

	}
	
	public function asignarValorxArray($_valores){
		foreach ($_valores as $llave => $valor) {
			$this->valores[$llave] = $valor;
			unset($this->valoresRequeridos[$llave]);
		}
	}

	/**
	 * @param $nombre String Nombre del parcial como se encuentra en el setup.ini.
	 * @param $parcial String el nombre del archivo, parcial.html.
	 * @param array $_valores Array los valores a remplazar en el parcial.
     */
	public function asignarParcial($nombre,$parcial, $_valores=array()){
		$parcial_url= ROOT."/fw/plantillas/".PLANTILLA."/parciales/".$parcial."/".$parcial.".html";
		$this->manejadordePlantillas->renderPartial($nombre, $parcial_url, $_valores);
		$datos = parse_ini_file(ROOT."/fw/plantillas/".PLANTILLA."/parciales/".$parcial."/setup.ini",true);
		$this->parciales = array_merge($this->parciales,$datos['parciales']);
		$this->valoresRequeridos = array_merge($this->valoresRequeridos,$datos['valores']);
		unset($this->parciales[$nombre]);
	}
	
	public function asignarHtml($nombre,$_html){
		$this->manejadordePlantillas->renderPartialasHTML($nombre,$_html);
		unset($this->parciales[$nombre]);
	}


	public function mostrar(){
		$this->manejadordePlantillas->__assign("titulo",$this->titulo);
		$this->manejadordePlantillas->__assign("ruta_plantilla_html",$this->urlPlantilla);

		foreach ($this->valores as $key => $value) {
			$this->manejadordePlantillas->__assign($key,$value);
		}
		foreach ($this->valoresRequeridos as $key => $value) {
			$this->manejadordePlantillas->__assign($key,"");
		}
		foreach ($this->parciales as $key => $value) {
			$this->manejadordePlantillas->renderPartialasHTML($key,"");
		}

		$this->manejadordePlantillas->show();
		
	}
}