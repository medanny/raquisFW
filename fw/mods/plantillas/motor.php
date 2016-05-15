<?php

namespace fw\mods\plantillas;

use fw\mods\validadores\Validar;

class Motor{
	var $valores = array();
	var $tpl;
	var $partialBuffer;
	var $delSimple_Abrir="{";
	var $delSimple_Cerrar="}";
	var $delParcial_Abrir="[";
	var $delParcial_Cerrar="]";
	var $delComplejo_Abrir="{{";
	var $delComplejo_Cerrar="}}";


	function __construct($_path = " "){

		if(!empty($_path)){
				$this->tpl = file_get_contents($_path);
			}else{
			throw new \Exception("La plantilla no existe.");
			}
		

	}

	function __assign($_searchString, $_replaceString){
		if(!empty($_searchString)){
			$this->valores[strtoupper($_searchString)] = $_replaceString;
		}
	}

	function _parsearEtiqueta($_etiqueta,$_dato,$_html){
		if($_etiqueta){
			if(is_array($_dato)){
				return $this->_remplazoComplejo($_etiqueta,$_dato,$_html);
			}else{
				return $this->_remplazoSimple($_etiqueta,$_dato,$_html);
			}
		}else{
			throw new \Exception("Una etiqueta es necesaria para poder parsear.");
		}
	}

	function _remplazoSimple($_etiqueta,$_dato,$_html){
		Validar::noVacio($_etiqueta);
		Validar::noVacio($_html);
		$_etiqueta = $this->delSimple_Abrir . $_etiqueta . $this->delSimple_Cerrar;

		return str_replace($_etiqueta, $_dato, $_html);
	}

	function _remplazoComplejo($_etiqueta,$_dato,$_html){
		Validar::noVacio($_etiqueta);
		Validar::noVacio($_html);
		if(($resultado = $this->_encontrarPar($_html, $_etiqueta)) === false){
			return $_html;
		}
		$str = '';
		foreach($_dato as $row)
		{
			$temp = $resultado['1'];
			foreach($row as $key => $val)
			{
				if(!is_array($val)){
					$temp = $this->_remplazoSimple(strtoupper($key), $val, $temp);
				}
				else{
					$temp = $this->_remplazoComplejo(strtoupper($key), $val, $temp);
				}
			}
			$str .= $temp;
		}
		return str_replace($resultado['0'], $str, $_html);
	}

	function _encontrarPar($_html, $_etiqueta)
	{
		if (!preg_match("|" . preg_quote($this->delComplejo_Abrir) . $_etiqueta . preg_quote($this->delComplejo_Cerrar) . "(.+?)". preg_quote($this->delComplejo_Abrir) . '/' . $_etiqueta . preg_quote($this->delComplejo_Cerrar) . "|s", $_html, $resultado))
			return false;
		return $resultado;

	}


	function renderPartialasHTML($_searchString,$_html){
		if(!empty($_searchString)){
			$this->tpl = str_replace($this->delParcial_Abrir . strtoupper($_searchString) . $this->delParcial_Cerrar, $_html, $this->tpl);
			}else{
				//error code
			}
		}

	function renderPartial($_searchString, $_path, $_assignValues = array()){
		if (!empty($_searchString)) {
			if (file_exists($_path)) {
				$this->partialBuffer = file_get_contents($_path);
				if (count($_assignValues) > 0) {
					foreach ($_assignValues as $key => $value) {
						$this->partialBuffer= $this->_parsearEtiqueta(strtoupper($key),$value,$this->partialBuffer);
					}
				}
				$this->tpl = str_replace($this->delParcial_Abrir . strtoupper($_searchString) . $this->delParcial_Cerrar, $this->partialBuffer, $this->tpl);
			} else {
				throw new \Exception("El parcial en $_path no pudo ser encontrado.");
			}
		}

	}


	function show(){
		if (count($this->valores) > 0) {
			foreach ($this->valores as $key => $value) {
				$this->tpl = $this->_parsearEtiqueta($key, $value, $this->tpl);
			}
		}
		echo $this->tpl;
	}
}