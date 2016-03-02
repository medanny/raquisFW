<?php
namespace fw\mods\plantillas;
class Parcial{
	//uso \fw\mods\plantillas\Parcial\mostrar($url,$arreglodeValores);
	public static function mostrar($_path,$_valores){
		$html = file_get_contents($_path);
		if(count($_valores) > 0){
			foreach ($_valores as $key => $value) {
				$html = str_replace('{'.strtoupper($key).'}', $value, $html);
			}
		}
		echo $html;
	}
} 

?>