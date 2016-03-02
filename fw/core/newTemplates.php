<?php

namespace fw\core;

class newTemplates{
	var $valores = array();
	var $tpl;
	var $partialBuffer;

	function __construct($_path = " "){

		if(!empty($_path)){
			if(file_exists($_path)){
				this->tpl = file_get_contents($_path);
			}else{
				//error code
			}
		}

	}

	function __assign($_searchString, $_replaceString){
		if(!empty($_searchString)){
			$this->valores[strtoupper($_searchString)] = $_replaceString;
		}
	}

	function renderPartial($_searchString, $_path, $_assignValues = array()){
		if(!empty($_searchString)){
			if(file_exists($_path)){
				$this->partialBuffer = file_get_contents($_path);

				if(count($_assignValues) > 0){
					foreach ($_assignValues as $key => $value) {
						$this-> partialBuffer = '{' . str_replace(strtoupper($key) . '}', $value, $this->partialBuffer);
					}
				}

				$this->tpl  = str_replace('['.strtoupper($_searchString).']', $this->partialBuffer, $this->tpl);

			}else{
				//error code
			}
		}

	}

	function show(){
		if(count($this->valores) > 0){
				foreach ($this->valores as $key => $value) {
					$this ->tpl = str_replace('{'.$key.'}',$value,$this->tpl);
				}
		}
		echo $this->tpl;

	}
}