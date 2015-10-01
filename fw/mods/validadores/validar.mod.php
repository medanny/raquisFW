<?php
namespace fw\core\validadores;
class Validar {

	public static function entre($valor,$min,$max){
		if($valor>=$min && $valor<=$max){
			return true;
		}else{
			return false;
		}
	}

	public static function mayor($valor,$valor_base){

		if($valor>$valor_base){
			return true;
		}else{
			return false;
		}
	}

	public static function vacio($valor){

		if($valor==""){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public static function menor($valor,$valor_base){
		if($valor<$valor_base){
			return true;
		}{
			return false;
		}
	}

	public static function igual($valor,$valor_base){
		if($valor==$valor_base){
			return true;
		}else{
			return false;
		}
	}

	public static function dominio($dominio){
		return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $dominio) //valid chars check
            && preg_match("/^.{1,253}$/", $dominio) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $dominio)   ); //length of each label
	}

	public static function correo($correo){
		return filter_var($correo, FILTER_VALIDATE_EMAIL);
	}

	public static function url($url){
		return filter_var($url, FILTER_VALIDATE_URL);
	}

	public static function ip(){

	}

	public static function mac($mac){
		return (preg_match('/([a-fA-F0-9]{2}[:|\-]?){6}/', $mac) == 1);
	}
}
?>