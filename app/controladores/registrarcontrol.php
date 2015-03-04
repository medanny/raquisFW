<?php

class registrarControl extends Control{


	public function index(){
		global $sesion;
		$sesion->asignar("text1","text2");


	}

	public function pagina1(){
		global $sesion;
		$this->set("text",$sesion->valor("text1"));

	}
}