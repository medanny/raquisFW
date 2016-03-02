<?php

namespace fw\mods\plantillas;

class Constructor{
	public $valoresRequeridos;
	public $valores;
	public $parciales;
	public $titulo;
	public $urlPlantilla;
	public $manejadordePlantillas;

	public function __construct(){
		$this->urlPlantilla = RUTA_PLANTILLA_HTML;
		$nombre_manejador = "\\fw\mods\plantillas\Motor";
		
		$this->manejadordePlantillas =  new $nombre_manejador(RUTA_PLANTILLA_HTML."plantilla_principal.html");

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
		return $valores_requeridos;
	}

	
	public function asignarValor($_llave,$_valor){
		$this->valores[$_llave] = $_valor;
		unset($this->valoresRequeridos[$_llave]);

	}
	
	public function asignarValorxArray($_valores){
		foreach ($_valores as $llave => $valor) {
			$this->valores[$_llave] = $_valor;
			unset($this->valoresRequeridos[$_llave]);
		}
	}

	public function asignarParcial($nombre,$parcial,$_valores=array()){
		$parcial_url= RUTA_PLANTILLA_HTML."parciales/".$parcial.".html";
		$this->manejadordePlantillas->renderPartial($nombre,$parcial_url,$_valores);
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